# 🧩 O que são Aplicações Web?

- Aplicações executadas no **navegador**
- Não precisam de instalação
- Dependem de um **servidor remoto**

---

# 🏗️ Arquitetura

## 📐 Modelo Cliente-Servidor

Aplicações web são divididas em:

### 🎨 Front-end (Cliente)

- Interface do usuário
- HTML, CSS, JavaScript
- Executado no navegador

---

### ⚙️ Back-end (Servidor)

- Lógica da aplicação
- Banco de dados
- Processamento de requisições

---

# 💡 Exemplos

- 📧 Gmail (email)
- 🛒 Amazon (e-commerce)
- 📝 Google Docs (edição de texto)

---

# 🌍 Web 1.0 vs Web 2.0

## 🧱 Web 1.0 (Websites)

- Conteúdo **estático**
- Atualização manual
- Sem interação dinâmica

---

## ⚡ Web 2.0 (Aplicações Web)

- Conteúdo **dinâmico**
- Baseado na interação do usuário
- Responsivo e modular

---

# 💻 Web Apps vs Apps Nativas

| Aplicações Web         | Aplicações Nativas     |
| ---------------------- | ---------------------- |
| Independentes de SO    | Dependem do SO         |
| Rodam no navegador     | Precisam de instalação |
| Executadas remotamente | Executadas localmente  |
| Mais lentas            | Mais rápidas           |

---

# 📦 Distribuição de Aplicações Web

## 🟢 Código Aberto

- Personalizáveis
- Exemplo:
  - WordPress
  - OpenCart
  - Joomla

---

## 🔒 Código Fechado

- Geralmente pagos (SaaS)
- Exemplo:
  - Wix
  - Shopify
  - DotNetNuke

---

# ⚠️ Segurança em Aplicações Web

## 📚 Referência

- OWASP WSTG (Web Security Testing Guide)
- OWASP Top 10

---

## 🔍 Etapas de Análise

### 1️⃣ Front-end

Analisar:

- HTML
- CSS
- JavaScript

🔎 Buscar:

- Exposição de dados sensíveis
- XSS (Cross-Site Scripting)

---

### 2️⃣ Back-end / Funcionamento

- Interagir com a aplicação
- Analisar requisições/respostas
- Identificar tecnologias

📌 Testar:

- Usuário não autenticado
- Usuário autenticado

---

# 💥 Vulnerabilidades Comuns

## 💉 SQL Injection (SQLi)

- Manipulação de queries SQL
- Pode expor dados sensíveis
- Ex: usuários do banco

---

## 📂 File Inclusion (FI)

- Usuário controla arquivos carregados
- Pode usar **Path Traversal**
- Acesso a arquivos internos

---

## 📤 Unrestricted File Upload

- Upload sem restrição
- Possível envio de arquivos maliciosos

---

## 🆔 IDOR (Insecure Direct Object Reference)

- Acesso direto a IDs
- Sem validação de permissão

📌 Exemplo:

```bash
/user?id=1001
/user?id=1002
```

🚨 Acesso a dados de outros usuários

---

## 🔓 Broken Access Control (BAC)

- Falha no controle de permissões
- Usuário pode:
  - Escalar privilégios
  - Executar ações indevidas

---

## 🧠 Relação IDOR vs BAC

- IDOR é um tipo de **BAC**
- Problema ocorre quando:
  - Sistema confia no ID
  - Não valida autorização

---

# 🌐 Layout de Aplicações Web

## 📌 Conceito Geral

* Nenhuma aplicação web é **100% igual**
* Podem ser parecidas, mas o **backend sempre varia**
* Divididas em três pilares:

```md
INFRAESTRUTURA → Onde roda?
COMPONENTES → Do que é feito?
ARQUITETURA → Como tudo se conecta?
```

---

## 🏗️ Categorias de Layout

## 🔧 Infraestrutura (Base Técnica)

Responsável por manter a aplicação funcionando.

**Inclui:**

* Servidores
* Banco de Dados
* Rede
* Sistema Operacional
* Serviços de hospedagem

---

## 🧩 Componentes (Funcionalidades)

Partes que o usuário interage.

**Inclui:**

* UI (Interface)
* UX (Experiência)
* Client-side (Front-end)
* Server-side (Back-end)

---

## 🧠 Arquitetura (Organização)

Define como tudo se conecta.

**Define:**

* Fluxo de dados
* Comunicação Cliente ↔ Servidor ↔ Banco de Dados

---

## 🏛️ Modelos de Arquitetura

## 🔹 Cliente-Servidor

* Modelo padrão
* Cliente: navegador
* Servidor: processa requisições

---

### 🔹 Um Servidor

* Tudo em um único servidor
* ❌ Alto risco

  * Se comprometido → tudo cai

---

### 🔹 Muitos Servidores + 1 Banco de Dados

* BD separado
* Vários servidores web

**Vantagens:**

* Distribuição de carga
* Comprometimento isolado

---

### 🔹 Muitos Servidores + Muitos Bancos

* Cada servidor com seu BD

**Vantagens:**

* Redundância
* Alta disponibilidade

**Desvantagem:**

* Alta complexidade

---

## ☁️ Serverless (Sem Servidor)

* Infra gerenciada (AWS, GCP)
* Você escreve apenas funções

**Comunicação:**

* APIs
* Eventos

---

## 🧱 Microsserviços

* Aplicação dividida em serviços menores

**Exemplo:**

* Usuário
* Carrinho
* Pagamento

**Características:**

* Independentes
* Linguagens diferentes
* Comunicação via API

---

# ⚙️ Componentes da Aplicação

## 🖥️ Cliente (Front-end)

* HTML, CSS, JS
* Executado no navegador

---

## 🗄️ Servidor (Back-end)

### 🔹 Servidor Web

* Recebe requisições HTTP
* Ex: Apache, Nginx

### 🔹 Lógica da Aplicação

* Regras de negócio
* Autenticação

### 🔹 Banco de Dados

* Armazena dados

### 🔹 Frameworks

* Ex: Laravel, Express, ASP.NET

---

### 🔗 Serviços

* APIs externas (pagamento, login Google)
* Comunicação entre microsserviços

---

## 🔐 Segurança da Arquitetura

> Muitas vulnerabilidades estão no **design**, não no código.

---

## 🎨 Front-end vs Back-end

### 🖼️ Front-end

* Interface com usuário
* Tecnologias: HTML, CSS, JS

**Conceitos:**

* UI → Interface
* UX → Experiência

---

### ⚙️ Back-end

* Processa dados
* Controla funcionalidades

**Responsabilidades:**

* Lógica da aplicação
* Banco de dados
* APIs
* Integrações

---

# 🚨 Erros Comuns de Segurança

## 🔥 Principais Falhas

1. Falta de validação (SQLi, XSS)
2. Confiar no usuário
3. Criar criptografia própria
4. Segurança como último passo
5. Senhas em texto puro
6. Senhas fracas
7. Dados sem criptografia
8. Validação só no front-end
9. Código de terceiros vulnerável
10. SQL Injection não tratada
11. RFI (Remote File Inclusion)
12. XSS / dados não sanitizados
13. Logs inexistentes
14. WAF mal configurado

---

## 🛡️ OWASP Top 10

* Broken Access Control
* Falhas criptográficas
* Injeções
* Design inseguro
* Security Misconfiguration
* Componentes vulneráveis
* Falhas de autenticação
* Integridade de dados
* Logging insuficiente
* SSRF

---


# 🌍 HTML

## 🔐 Percent Encoding (URL Encoding)

Transforma caracteres especiais em formato seguro:

```md
% + código hexadecimal
```

**Exemplo:**

```
João Silva → Jo%C3%A3o%20Silva
```

---

## 🧱 Estrutura HTML

```html
<head>
  <!-- Configurações -->
</head>

<body>
  <!-- Conteúdo visível -->
</body>
```

---

## 🌳 DOM (Document Object Model)

* Representação do HTML em árvore
* Permite manipulação via JS

---


# 🎨 CSS

* Estiliza o HTML

```css
body {
  background-color: black;
}
```

## 📦 Frameworks

* Bootstrap
* SASS
* Bulma
* Foundation

---


# ⚡ JavaScript

## 📌 Função

* Adicionar interatividade

### 🧪 Exemplo

```javascript
document.getElementById("button1").innerHTML = "Changed Text!";
```

---

### 🔄 AJAX

* Requisições sem recarregar página

---

### 🧰 Frameworks

* React
* Angular
* Vue
* jQuery

---


# 🧨 Vulnerabilidades Front-end

> Geralmente afetam o **usuário**, não diretamente o servidor

---

## 🔍 Exposição de Dados Sensíveis

**Onde encontrar:**

* Código fonte (Ctrl+U)
* JS
* Burp Suite

**Buscar por:**

```
api_key, token, auth, password, secret
```

---

## 💉 HTML Injection

Quando entrada do usuário é exibida sem validação.

**Tipos:**

* Stored
* Reflected
* DOM-based

⚠️ Não é XSS (não executa JS diretamente)

---

# 💥 XSS (Cross-Site Scripting)

Vulnerabilidade onde o atacante injeta **JavaScript malicioso** em uma aplicação web.

📌 **Diferença importante:**

- HTML Injection → apenas HTML
- XSS → **executa JavaScript**

---

# 🧩 Tipos de XSS

## 🔁 Reflected XSS

- O payload é enviado na requisição
- O servidor reflete o conteúdo na resposta
- Executado no navegador da vítima

📌 Exemplo:

```bash
https://site.com/search?q=<script>alert(1)</script>
````

⚠️ Requer interação da vítima (clicar no link)

---

## 💾 Stored XSS

* Payload é armazenado no banco de dados
* Executa automaticamente ao acessar a página

🚨 **Mais perigoso**

* Não precisa de interação
* Afeta múltiplos usuários

---

## 🧠 DOM XSS

* Ocorre **totalmente no navegador**
* Não envolve o servidor
* JavaScript manipula o DOM com input do usuário sem validação

---

### 💻 Exemplo Prático

```html
<button onclick="inputFunction()">Click</button>
<p id="output"></p>
```

```javascript
function inputFunction() {
    var input = prompt("Enter your name", "");

    if (input != null) {
        document.getElementById("output").innerHTML = "Your name is " + input;
    }
}
```

🚨 Problema:

* `innerHTML` insere input do usuário sem validação

---

### 💣 Payload

```html
"><img src=/ onerror=alert(document.cookie)>
```

---

## 🧠 Regra do Payload

1. **Quebrar contexto** → `">`
2. **Injetar tag** → `<img>`
3. **Executar evento** → `onerror=`

---

## 🧪 Payloads Comuns

```html
"><script>alert(1)</script>
<img src=x onerror=alert(1)>
</script><script>alert(1)</script>
<svg/onload=alert(1)>
```

---

## 🔗 XSS via URL

* Utiliza `#` (hash)

```javascript
element.innerHTML = location.hash
```

📌 Com `#` → existe input
📌 Sem `#` → não há input

---

# 🛑 CSRF (Cross-Site Request Forgery)

Ataque onde o atacante faz a vítima executar ações **sem perceber**.

---

## 🎯 Objetivo

* Explorar uma sessão autenticada
* Enviar requisições sem consentimento

---

## 🧠 Funcionamento

1. Usuário está logado
2. Atacante envia link ou página maliciosa
3. Navegador da vítima executa a requisição automaticamente

---

## ⚔️ CSRF vs XSS

| CSRF               | XSS                  |
| ------------------ | -------------------- |
| Engana o navegador | Controla o navegador |
| Usa sessão ativa   | Executa JS malicioso |
| Não lê resposta    | Pode ler respostas   |

---

## 🔥 Combinação XSS + CSRF

* XSS pode:

  * Fazer requisições
  * Ler respostas
  * Controlar totalmente a sessão

🚨 Resultado: **controle total da vítima**

---

# 🛡️ Prevenção

## 🧹 Sanitização

* Remover caracteres perigosos
* Ex: `< > " '`

---

## ✅ Validação

* Garantir formato correto
* Ex: email válido

---

## 🧱 Outras Proteções

* WAF (Web Application Firewall)
* Tokens CSRF
* Escaping de saída

---

# 🖥️ Servidores Back-end

Responsáveis por executar a aplicação web.

---

## 🧩 Componentes

* Sistema Operacional (Linux / Windows)
* Web Server
* Aplicação (PHP, Java, etc)
* Banco de dados

---

# 🏗️ Stacks Comuns

| Stack | Componentes                           |
| ----- | ------------------------------------- |
| LAMP  | Linux + Apache + MySQL + PHP          |
| WAMP  | Windows + Apache + MySQL + PHP        |
| WINS  | Windows + IIS + .NET + SQL Server     |
| MAMP  | macOS + Apache + MySQL + PHP          |
| XAMPP | Cross-platform + Apache + MySQL + PHP |

📌 Pode ser distribuído (cloud / múltiplos servidores)

---

# 🌐 Servidores Web

Aplicação que gerencia requisições HTTP.

---

## ⚙️ Funções

* Receber requisições
* Processar
* Retornar respostas

---

## 📡 Portas

* HTTP → 80
* HTTPS → 443

---

## 🔄 Fluxo

1. Recebe request
2. Processa
3. Retorna status:

```http
200 OK
404 Not Found
403 Forbidden
```

---

## 📥 Tipos de Entrada

* JSON
* Arquivos (binário)

---

# 🧠 Tipos de Web Server

## 🟥 Apache

* +40% dos sites
* Código aberto

---

## 🟩 Nginx

* ~30% dos sites
* Alta performance
* Muito usado em alto tráfego

---

## 🟦 IIS

* Servidor da Microsoft
* Usado com .NET
* ~15% dos sites

---


