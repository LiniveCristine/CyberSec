# 📚 WRITE-UPS XSS (DOM + CSP BYPASS) 
---

# 🧠 1. DOM XSS vs Stored/Reflected (entendendo de verdade)

## 🔹 Stored / Reflected XSS

* Acontecem no **servidor**
* O fluxo é:

```
Input → Servidor → Response HTTP → Navegador
```

👉 O payload aparece no **HTML da resposta**

---

## 🔹 DOM XSS

* Acontece no **navegador (client-side)**
* O fluxo é:

```
Input → Navegador → JavaScript → DOM → Execução
```

👉 O servidor:

* **não processa o payload**
* **não reflete ele no response**

---

## ⚠️ Por que isso é importante?

Ferramentas como:

* `kxss`
* `xssstrike`

👉 Funcionam analisando:

* Response HTTP
* Reflexão de payload

❌ Problema:

* No DOM XSS, o payload **não aparece no response**
* Ele só aparece **depois que o JS roda**

👉 Resultado:

* Falso negativo (parece seguro, mas não está)

---

# 🔍 2. O coração do DOM XSS: Source → Sink

## 🔹 Source (entrada controlada pelo usuário)

São pontos onde dados entram no JS:

```js
location.search
document.cookie
document.URL
window.name
```

👉 Pense como:

> “De onde o atacante consegue injetar dados?”

---

## 🔹 Sink (onde o código executa)

São funções perigosas:

```js
innerHTML
eval()
document.write()
setTimeout()
```

👉 Pense como:

> “Onde esse dado pode virar código executável?”

---

## 🧠 Regra de ouro:

```
Se um dado controlado (source) chega em um sink perigoso → XSS
```

---

# 🛠️ 3. DOM Invader (Burp Suite)

## 🔹 Problema que ele resolve

* Código JS moderno é:

  * Gigante
  * Cheio de bibliotecas

👉 Analisar manualmente é inviável

---

## 🔹 O que o DOM Invader faz

Ele automatiza:

* Descoberta de **sources**
* Descoberta de **sinks**
* Rastreio do fluxo

---

## 🐤 Canários (Canaries)

São strings únicas que a ferramenta injeta.

Exemplo:

```
burpdomxss123
```

👉 Objetivo:

* Ver onde essa string aparece no DOM
* Identificar se ela chega a um sink

---

## ⚙️ Funcionamento passo a passo

1. Injeta canário no input
2. Página carrega
3. JS processa o valor
4. DOM Invader mostra:

```
Source → Sink
```

👉 Isso transforma DOM XSS em algo visível (quase como reflected)

---

# 💣 4. Caso real: DOM XSS no PayPal

---

## 🔍 Descoberta inicial

O pesquisador encontrou:

* Input refletindo em:

```
element.innerHTML
```

👉 Isso já indica:

* Sink perigoso

---

## ⚠️ Mas tinha um problema…

### 🛡️ CSP (Content Security Policy)

O navegador bloqueava:

* Scripts inline
* Funções perigosas

👉 Resultado:

* XSS existia, mas **não executava**

---

# 🛡️ 5. CSP — Entendendo de verdade

## 🔹 O que é?

Um header HTTP que diz ao navegador:

> “Só execute scripts dessas fontes confiáveis”

---

## 🔹 O que ele bloqueia?

* `<script>alert(1)</script>`
* `eval()`
* `setTimeout("...")`

---

## 🔹 Mecanismos

* **Nonces** → código único por request
* **Hashes** → valida conteúdo do script

---

## 🧠 Insight importante:

> CSP não remove a vulnerabilidade
> Ele só impede a exploração direta

---

# 🚨 6. Bypass de CSP (o pulo do gato)

---

## 🔹 Problema real

Sites grandes (como PayPal):

* Precisam permitir vários scripts
* CSP fica **menos restritivo**

---

## 🔹 Estratégia: Script Gadgets

### 🧠 Ideia:

Usar código **já permitido pelo CSP**

👉 Em vez de injetar script:

* Você faz um script legítimo executar seu payload

---

# 🧩 7. Gadget encontrado no PayPal

Arquivo:

```
youtube.js
```

---

## 🔹 O que ele fazia?

1. Procurava:

```html
.youtube-player
```

2. Pegava:

```html
data-id="..."
```

3. Montava HTML

4. Passava para jQuery

---

## 💥 Problema

O jQuery:

* Quando recebe HTML com `<script>`
* **executa automaticamente**

---

## 🧠 Resultado:

Se você controla `data-id` → controla execução

---

# 🐴 8. Ataque final (explicado passo a passo)

---

## 🔹 Problema a resolver

* Precisamos:

  * Executar código confiável (CSP)
  * Inserir payload na página principal

---

## 🔹 Solução: `<iframe srcdoc>`

### 🧠 Por que usar?

* Permite criar uma página dentro da página
* Sem requisição externa
* Sem quebrar CSP

---

## 🔹 Estrutura do ataque

```html
<iframe srcdoc="
    <script src='jquery.js'></script>
    <script src='youtube.js'></script>

    <div class='youtube-player'
         data-id='PAYLOAD'>
    </div>
">
</iframe>
```

---

## 🔁 Fluxo completo

1. Vulnerabilidade:

   ```
   innerHTML
   ```
2. CSP bloqueia payload direto ❌
3. Encontramos gadget (`youtube.js`) ✅
4. Criamos iframe com scripts confiáveis
5. Inserimos payload em `data-id`
6. `youtube.js` processa
7. jQuery executa
8. 🎯 XSS

---

# 🧪 9. Caso 2: Angular + CSP Bypass (Piwik PRO)

---

## 🔍 Descoberta inicial

* DOM Invader não mostrou reflexão
* Mas:

  * Input vazio revelou sinks

👉 Isso é uma técnica importante:

> Testar comportamentos inesperados

---

# 🚩 10. Debug Flag (conceito MUITO importante)

## 🔹 O que é?

Parâmetro oculto tipo:

```
?debug=true
```

---

## 🔹 O que ativa?

* Funcionalidades internas
* Código não exposto ao usuário comum

---

## ⚠️ Por que é perigoso?

* Menos testado
* Pode carregar:

  * Novas bibliotecas
  * Novos sinks

---

# 🧠 11. O insight crítico

Ao ativar debug:

* **AngularJS foi carregado**

---

# ⚡ 12. Angular e CSP Bypass

---

## 🔹 Como Angular funciona?

Ele interpreta:

```html
{{ expressão }}
```

👉 Isso:

* Não é `<script>`
* Passa pelo CSP

---

## 💥 Isso vira código executável

Angular funciona como um “mini interpretador” no navegador.

---

# 🧬 13. CSTI (Client-Side Template Injection)

---

## 🔹 Diferença para DOM XSS

| DOM XSS         | CSTI                |
| --------------- | ------------------- |
| JS da aplicação | Framework (Angular) |
| `<script>`      | `{{ }}`             |

---

## 🔹 Exploit usado

```js
{{$event.characterSet.prototype.constructor.constructor('alert(1)')()}}
```

---

## 🧠 O que isso faz?

1. Acessa objetos internos
2. Chega no `constructor`
3. Cria uma função
4. Executa código

---

## ⚠️ Detalhe crítico

* Funcionava por:

  * comportamento específico do Firefox
  * bypass das proteções do Angular

---

# 🧩 14. Resumo mental (forma de pensar como hunter)

---

## 🔍 DOM XSS

* Não confie no response HTTP
* Pense em:

  ```
  Source → Sink
  ```

---

## 🛠️ Ferramenta

* DOM Invader é essencial

---

## 🛡️ CSP

* Não elimina XSS
* Só dificulta

---

## 🚨 Bypass

* Script gadgets
* Bibliotecas confiáveis
* Angular (CSTI)

---

## 🧠 Mentalidade avançada

Sempre pergunte:

* Existe código escondido? (debug)
* Existe biblioteca carregada?
* Posso usar código confiável contra ele mesmo?

