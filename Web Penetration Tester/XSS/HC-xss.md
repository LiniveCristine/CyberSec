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

