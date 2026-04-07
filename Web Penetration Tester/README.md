# 📑 Índice

| Seção | Descrição | Seção | Descrição |
|------|----------|------|----------|
| [🔹 BLOCO 1 — Recon & Superfície de Ataque](#-bloco-1--recon--superfície-de-ataque) | Mapeamento inicial do alvo | [🔹 BLOCO 9 — Authentication & Brute Force](#-bloco-9--authentication--brute-force) | Ataques de login |
| [🔹 BLOCO 2 — XSS](#-bloco-2--xss) | Execução de código no navegador | [🔹 BLOCO 10 — File Upload & Webshell](#-bloco-10--file-upload--webshell) | Execução persistente |
| [🔹 BLOCO 3 — SQL Injection](#-bloco-3--sql-injection) | Ataques a banco de dados | [🔹 BLOCO 11 — APIs & GraphQL](#-bloco-11--apis--graphql) | Backend direto |
| [🔹 BLOCO 4 — Command Injection](#-bloco-4--command-injection) | Execução de comandos | [🔹 BLOCO 12 — Server-Side Attacks](#-bloco-12--server-side-attacks) | Exploração avançada |
| [🔹 BLOCO 5 — CSRF & Open Redirect](#-bloco-5--csrf--open-redirect) | Manipulação de usuário | [🔹 BLOCO 13 — Security Misconfiguration](#-bloco-13--security-misconfiguration) | Falhas simples |
| [🔹 BLOCO 6 — File Inclusion](#-bloco-6--file-inclusion) | Acesso a arquivos internos | [🔹 BLOCO 14 — Aplicações Reais](#-bloco-14--aplicações-reais) | Ambientes reais |
| [🔹 BLOCO 7 — NoSQL Injection](#-bloco-7--nosql-injection) | Bancos modernos | [🔹 BLOCO 15 — Máquinas](#-bloco-15--máquinas) | Consolidação prática |
| [🔹 BLOCO 8 — IDOR & Web Attacks](#-bloco-8--idor--web-attacks) | Quebra de autorização | [🔹 BLOCO 16 — Bug Bounty](#-bloco-16--bug-bounty) | Monetização |

---

> ⚠️ **Aviso Importante**
>
> Os conteúdos base deste cronograma são pagos (Hacking Club e Hack The Box Academy), **não por serem a única ou melhor fonte de conhecimento**.
>
> Existe uma infinidade de conteúdos gratuitos disponíveis na internet — basta ter **tempo, curiosidade e disposição para procurar**.
>
> A escolha por conteúdos pagos foi feita por **praticidade e organização do aprendizado**.
>
> 👉 **Mas é totalmente possível seguir este cronograma sem eles.**

---

# 📚 CRONOGRAMA ZERO AO BOUNTY

---


## 🔹 BLOCO 1 — RECON & SUPERFÍCIE DE ATAQUE
🎯 **Meta:** identificar todos os pontos de entrada possíveis

### 📘 Hacking Club
- O que é Recon e como funciona
- Subdomain Discovery
- Application Discovery
- Parameter Discovery
- Content Discovery
- Fuzzing de pasta e arquivos (wfuzz, ffuf)
- PortScan
- Fuzz

### 🌐 Pentest Web — Information Gathering
- Introduction
- WHOIS
- DNS & Subdomains
- Fingerprinting
- Crawling
- Discovery
- Automation

### 🌐 Pentest Web — Using Web Proxies
- Getting Started
- Web Proxy
- Web Fuzzer
- Web Scanner

### 🌐 Pentest Web — Web Fuzzing
- Introduction
- Directory and File Fuzzing
- Parameter and Value Fuzzing
- Virtual Host and Subdomain Fuzzing
- Filtering
- Validation
- APIs

### 📘 Hacking Club
- Git Exposed Attack

### 🧪 Labs Extras (PortSwigger)
- Information disclosure
- Directory traversal
- Hidden directories
- API discovery
- Parameter discovery

### 🧠 Leitura de Reports
- Recon → exploração encadeada
- Vazamento via Git
- Descoberta de endpoints ocultos

---

## 🔹 BLOCO 2 — XSS
🎯 **Meta:** executar código no navegador da vítima

### 📘 Hacking Club
- XSS - Cross-site scripting (Reflected)
- XSS Reflected
- XSS - Cross-site scripting (Stored)
- XSS Stored
- XSS - Cross-site scripting (Dom based)
- XSS Dom Based

### 🌐 Pentest Web — XSS
- XSS Basics
- XSS Attacks
- XSS Prevention

### 🌐 Pentest Web — JavaScript Deobfuscation
- Introduction
- Obfuscation
- Deobfuscation
- Examples

### 🧪 Labs Extras (PortSwigger)
- Reflected XSS
- Stored XSS
- DOM XSS
- Filter bypass
- Context-based XSS

### 🧠 Leitura de Reports
- XSS → takeover
- XSS → roubo de sessão
- Blind XSS

---

## 🔹 BLOCO 3 — SQL INJECTION
🎯 **Meta:** manipular banco de dados

### 📘 Hacking Club
- SQL Injection Manual
- SQL injection manual
- SQL Injection (WebShell)
- SQL Injection Webshell
- SQL Injection Time Based Blind
- SQL Injection Blind Time-Based
- Wasps

### 🌐 Pentest Web — SQL Injection Fundamentals
- Introduction
- Databases
- MySQL
- SQL Injection
- Exploitation
- Mitigation

### 🌐 Pentest Web — SQLMap
- SQLMap Overview
- Getting Started with SQLMap
- SQLMap Output Description
- Running SQLMap on an HTTP Request
- Handling SQLMap Errors
- Attack Tuning
- Database Enumeration
- Advanced Database Enumeration
- Bypassing Web Application Protections
- OS Exploitation

### 🧪 Skills Assessment
- Skills Assessment

### 🧪 Labs Extras (PortSwigger)
- UNION SQLi
- Blind SQLi
- Error-based SQLi
- Auth bypass

### 🧠 Leitura de Reports
- SQLi → RCE
- SQLi → vazamento massivo
- SQLi em APIs

---

## 🔹 BLOCO 4 — COMMAND INJECTION
🎯 **Meta:** executar comandos no servidor

### 📘 Hacking Club
- Command injection
- Command Injection

### 🌐 Pentest Web — Command Injection
- Introduction
- Exploitation
- Filter Evasion
- Prevention

### 🧪 Labs Extras (PortSwigger)
- Basic OS injection
- Blind injection
- Filter bypass

### 🧠 Leitura de Reports
- RCE real
- Injection via headers

---

## 🔹 BLOCO 5 — CSRF & OPEN REDIRECT
🎯 **Meta:** manipular ações do usuário

### 📘 Hacking Club
- CSRF - Cross-site request forgery
- CSRF
- OpenRedirect
- Open Redirect

### 🌐 Pentest Web
- Example 2: Reporting CSRF

### 🧪 Labs Extras (PortSwigger)
- CSRF básico
- CSRF bypass token
- SameSite bypass
- Open redirect

### 🧠 Leitura de Reports
- CSRF → mudança de senha
- Open redirect → phishing

---

## 🔹 BLOCO 6 — FILE INCLUSION
🎯 **Meta:** acessar arquivos internos

### 📘 Hacking Club
- Local File Inclusion
- LFI
- Remote File Inclusion
- RFI

### 🌐 Pentest Web — File Inclusion
- Introduction
- File Disclosure
- RCE
- Automation
- Prevention

### 🧪 Labs Extras (PortSwigger)
- Path traversal
- LFI → RCE

### 🧠 Leitura de Reports
- LFI → credenciais
- LFI → execução remota

---

## 🔹 BLOCO 7 — NoSQL INJECTION
🎯 **Meta:** explorar bancos modernos

### 📘 Hacking Club
- NoSQL Injection
- NoSQL Injection

### 🧪 Labs Extras (PortSwigger)
- MongoDB injection
- Auth bypass

### 🧠 Leitura de Reports
- NoSQL → login bypass

---

## 🔹 BLOCO 8 — IDOR & WEB ATTACKS
🎯 **Meta:** quebrar autorização

### 📘 Hacking Club
- IDOR
- IDOR

### 🌐 Pentest Web — Web Attacks
- HTTP Verb Tampering
- IDOR
- XXE

### 🧪 Labs Extras (PortSwigger)
- IDOR
- XXE
- Mass assignment

### 🧠 Leitura de Reports
- IDOR → vazamento crítico

---

## 🔹 BLOCO 9 — AUTHENTICATION & BRUTE FORCE
🎯 **Meta:** quebrar login

### 🌐 Pentest Web — Login Brute Forcing
- Introduction
- Password Security Fundamentals
- Brute Force Attacks
- Dictionary Attacks
- Hybrid Attacks
- Hydra
- Basic HTTP Authentication
- Login Forms
- Medusa
- Web Services
- Custom Wordlists

### 🌐 Pentest Web — Broken Authentication
- What is Authentication
- Attacks on Authentication
- Enumerating Users
- Brute-Forcing Passwords
- Brute-Forcing Password Reset Tokens
- Brute-Forcing 2FA Codes
- Weak Brute-Force Protection
- Default Credentials
- Vulnerable Password Reset
- Authentication Bypass via Direct Access
- Authentication Bypass via Parameter Modification
- Attacking Session Tokens
- Further Session Attacks

### 🧪 Skills Assessment
- Skills Assessment

### 🧪 Labs Extras (PortSwigger)
- Brute force
- 2FA bypass

### 🧠 Leitura de Reports
- Account takeover

---

## 🔹 BLOCO 10 — FILE UPLOAD & WEBSHELL
🎯 **Meta:** execução persistente

### 📘 Hacking Club
- Unrestricted file upload
- Unrestricted File Upload
- Webshell (webdav)
- Webshell (Webdav)

### 🌐 Pentest Web — File Upload Attacks
- Intro to File Upload Attacks
- Absent Validation
- Upload Exploitation
- Client-Side Validation
- Blacklist Filters
- Whitelist Filters
- Type Filters
- Limited File Uploads
- Other Upload Attacks
- Preventing File Upload Vulnerabilities

### 🧪 Skills Assessment
- Skills Assessment

### 🧪 Labs Extras (PortSwigger)
- Upload bypass
- MIME bypass

### 🧠 Leitura de Reports
- Upload → RCE

---

## 🔹 BLOCO 11 — APIs & GRAPHQL
🎯 **Meta:** backend direto

### 📘 Hacking Club
- API REST
- Rest API
- API GraphQL
- Graphql

### 🌐 Pentest Web — API Attacks
- Introduction to API Attacks
- Introduction to Lab
- OWASP API Top 10
- Broken Object Level Authorization
- Broken Authentication
- Broken Object Property Level Authorization
- Unrestricted Resource Consumption
- Broken Function Level Authorization
- Unrestricted Access to Sensitive Business Flows
- Server Side Request Forgery
- Security Misconfiguration
- Improper Inventory Management
- Unsafe Consumption of APIs

### 🌐 Pentest Web — GraphQL
- Introduction to GraphQL
- Information Disclosure
- IDOR
- Injection Attacks
- DoS & Batching
- Mutations
- Tools
- Prevention

### 🧪 Labs Extras (PortSwigger)
- API abuse
- GraphQL exploitation

### 🧠 Leitura de Reports
- API → vazamento

---

## 🔹 BLOCO 12 — SERVER-SIDE ATTACKS
🎯 **Meta:** exploração avançada

### 🌐 Pentest Web
- SSRF
- SSTI
- Outros
- SSI Injection
- XSLT Injection

### 🧪 Labs Extras (PortSwigger)
- SSRF
- SSTI

### 🧠 Leitura de Reports
- SSRF → cloud takeover

---

## 🔹 BLOCO 13 — SECURITY MISCONFIGURATION
🎯 **Meta:** falhas simples

### 📘 Hacking Club
- Subdomain Takeover
- Security Missing Configuration
- Security Misconfiguration

### 🧪 Labs Extras (PortSwigger)
- CORS
- Headers

### 🧠 Leitura de Reports
- Misconfig crítica

---

## 🔹 BLOCO 14 — APLICAÇÕES REAIS
🎯 **Meta:** ambiente real

### 🌐 Pentest Web — Attacking Common Applications
- WordPress
- Joomla
- Drupal
- Tomcat
- Jenkins
- Splunk
- PRTG
- GitLab
- CGI / Shellshock
- Thick Clients
- ColdFusion
- LDAP
- IIS Tilde
- Mass Assignment
- Integrações

### 🧠 Leitura de Reports
- Exploits reais

---

## 🔹 BLOCO 15 — MÁQUINAS
🎯 **Meta:** consolidar

### 📘 Hacking Club
- Lion
- Calc
- Retro

---

## 🔹 BLOCO 16 — BUG BOUNTY
🎯 **Meta:** monetização

### 🌐 Pentest Web
- Bug Bounty Programs
- Writing a Good Report
- Interacting with Organizations
- Reporting Stored XSS
- Reporting CSRF
- Reporting RCE

### 🧠 Leitura Final
- Reports reais aceitos
- Comparação de impacto
