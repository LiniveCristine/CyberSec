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
