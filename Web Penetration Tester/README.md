# 📘 CRONOGRAMA INTEGRADO — 25 SEMANAS  
**Versão Carreira • Executável • Mentalidade de Campo**
---

## ⚠️ Aviso Importante sobre Ritmo de Estudo

Este cronograma foi planejado considerando, **em média, apenas 3 dias de estudo por semana**, com sessões de **70–90 minutos**.

👉 **O cronograma pode (e deve) ser ajustado à disponibilidade de cada pessoa**, mantendo a ordem dos conteúdos e a lógica de progressão.

O foco aqui é **consistência no longo prazo**, não velocidade.

---

## 🎯 Base do Treinamento

- **HC (Hacking Club)** — visão prática + mentalidade
- **HTB Academy — Web Pen Tester**
- **HTB Academy — Penetration Tester (selecionado)**
- **HTB Machines / Challenges**
- **Bug Bounty** (HackerOne / Bugcrowd)

## ℹ️ Nota sobre Fontes de Estudo

A internet está cheia de **conteúdo gratuito e de alta qualidade** — com tempo e determinação, é totalmente possível montar um plano sólido apenas garimpando materiais abertos.

Neste cronograma, optei por utilizar **conteúdos pagos** principalmente por **praticidade** e **falta de tempo para uma busca detalhada**, não por serem a única forma de aprender.

👉 O método e a progressão continuam válidos independentemente da fonte escolhida.

---

📅 **Ritmo fixo:** 3 sessões por semana (70–90 min)

---

## 🔁 Regra Global (Do Início ao Fim)

📌 **Após CADA vulnerabilidade estudada:**
- ➡️ 1 sessão dedicada **exclusivamente a reports reais**, substituindo revisão genérica.

### 🧠 Formato Fixo da Sessão de Reports
Para **2–3 reports reais**:
1. Onde o hacker começou?
2. Qual sinal levantou suspeita?
3. O que foi testado antes de achar o bug?
4. Qual detalhe fez a diferença?
5. Gerar **checklist prático reutilizável**

📌 **Objetivo:**  
Criar **instinto de campo**, não apenas conhecimento técnico.

---

# 🗓 SEMANAS 1–6 — FUNDAMENTOS + RECON (SEM BOUNTY)

🎯 **Objetivo:** base técnica + metodologia  
❌ **Nada de caçar bugs ainda**

---

## 🔹 Semanas 1–2 — Fundamentos & Metodologia

### Sessões
#### 📘 Teoria / Labs
- 🟦 HC: Metodologia, mentalidade, HTTP  
- 🟦 HTB-W: Web Requests, HTTP Basics  
- 🟦 HTB-P: Penetration Testing Process  

#### 🧪 Prática
- 🟩 Labs HTTP  
- 🟥 Starting Point — Meow, Fawn  

#### 🧠 Reports
- Apenas leitura leve  
- ❌ Sem checklist (ainda)

📌 *Aqui você aprende a pensar, não a atacar.*

---

## 🔹 Semanas 3–4 — Proxies & Parameter Discovery

### Sessões
#### 📘
- 🟦 HC: Burp, Parameter Discovery  
- 🟦 HTB-W: Web Proxies, Parameter Fuzzing  
- 🟦 HTB-P: Intercepting Web Traffic  

#### 🧪
- 🟩 Labs Burp / FFUF  
- 🟥 Web Challenge — Parameters  

#### 🧠 Reports (obrigatórios)
- Parameter pollution  
- Hidden parameters  

📌 *Você está aprendendo onde olhar, não onde atacar.*

---

## 🔹 Semanas 5–6 — DNS & Infra Web

### Sessões
#### 📘
- 🟦 HC: DNS, Infra, Takeover  
- 🟦 HTB-W: DNS + Subdomain Enumeration  
- 🟦 HTB-P: DNS Enumeration  

#### 🧪
- 🟩 Amass / dnsrecon  
- 🟥 Academy Labs — Subdomain Takeover  

#### 🧠 Reports
- Subdomain takeover reais  
- Enumeração ignorada por devs  

📌 *Aqui nasce o olhar de recon profissional.*

---

# 🗓 SEMANAS 7–8 — XSS (PRIMEIRA VULN REAL)

🚫 **Ainda sem caça**  
🎯 **Objetivo:** reconhecer padrões antes de agir

---

## 🔹 Semana 7 — XSS Fundamentals

#### 📘
- 🟦 HC: Reflected / Stored / DOM  
- 🟦 HTB-W: XSS  
- 🟦 HTB-P: Client-Side Attacks  

#### 🧪
- 🟩 Academy Labs — XSS  

#### 🧠 Reports
- XSS simples  
- Checklist: contextos, sinks, reflection  

---

## 🔹 Semana 8 — XSS Avançado

#### 📘
- 🟦 HC: Blind XSS  
- 🟦 HTB-W: Advanced XSS / Filter Evasion  

#### 🧪
- 🟥 Web Challenge — XSS  

#### 🧠 Reports
- Blind XSS reais  
- Payloads “improváveis”  

📌 *Você aprende a reconhecer cheiro de bug.*

---

# 🗓 SEMANAS 9–12 — SQLi + RCE  
⚠️ **Entrada Guiada em Bug Bounty**

---

## 🔹 Semana 9 — SQL Injection Manual

#### 📘
- 🟦 HC: SQLi manual  
- 🟦 HTB-W: SQLi Fundamentals  
- 🟦 HTB-P: SQLi Attacks  

#### 🧪
- 🟥 Starting Point — Appointment  

#### 🧠 Reports
- SQLi reais  

#### 🎯 Bug Bounty (guiado)
- 1 alvo  
- Apenas parâmetros óbvios  
- Zero expectativa de bug  

---

## 🔹 Semana 10 — SQLi Avançado

#### 📘
- 🟦 HC: UNION / Time-based  
- 🟦 HTB-W: Advanced SQLi  

#### 🧪
- 🟥 Web Challenge — SQLi  

#### 🧠 Reports
- SQLi avançados  

🎯 *Caça focada exclusivamente em SQLi.*

---

## 🔹 Semana 11 — Command Injection

#### 📘
- 🟦 HC: Command Injection  
- 🟦 HTB-W: Command Injection  

#### 🧪
- 🟥 Machine — Bashed  

#### 🧠 Reports
- RCE reais  

🎯 *Caça apenas em funções “system-like”.*

---

## 🔹 Semana 12 — LFI / RFI

#### 📘
- 🟦 HC: File Inclusion  
- 🟦 HTB-W: File Inclusion  

#### 🧪
- 🟥 Machine — Nineveh  

#### 🧠 Reports
- LFI / RFI reais  

🎯 *Caça focada em parâmetros de path.*

📌 *Aqui você já é ativo, mesmo sem achar nada.*

---

# 🗓 SEMANAS 13–16 — AUTH, IDOR & APIs  
✅ **Bug Bounty Real**

---

## 🔹 Semana 13 — Broken Access Control

#### 📘
- 🟦 HC: Auth / IDOR  
- 🟦 HTB-W: Broken Access Control  
- 🟦 HTB-P: Auth Attacks  

#### 🧪
- 🟩 Academy Labs — BAC  

#### 🧠 Reports
- IDOR / BOLA  

🎯 *Bug bounty sério começa aqui.*

---

## 🔹 Semana 14 — CSRF & Logic Flaws

#### 📘
- 🟦 HC: CSRF / lógica  
- 🟦 HTB-W: CSRF Attacks  

#### 🧪
- 🟥 Web Challenge — Auth  

#### 🧠 Reports
- Falhas de lógica reais  

🎯 *Testes de fluxo completo.*

---

## 🔹 Semana 15 — APIs REST & NoSQL

#### 📘
- 🟦 HC: REST / NoSQL  
- 🟦 HTB-W: API Attacks  

#### 🧪
- 🟥 Machine — Stocker  

#### 🧠 Reports
- APIs reais  

🎯 *Caça focada em endpoints.*

---

## 🔹 Semana 16 — GraphQL & API Auth

#### 📘
- 🟦 HC: GraphQL  
- 🟦 HTB-W: GraphQL Attacks  

#### 🧪
- 🟥 Web Challenge — API  

#### 🧠 Reports
- GraphQL reais  

🎯 *Caça focada em auth bypass.*

📌 *Aqui você já é operacional em Bug Bounty.*

---

# 🗓 SEMANAS 17–18 — UPLOAD & MISCONFIGS

#### 📘
- 🟦 HC: Upload / WebDAV  
- 🟦 HTB-W: Upload & Misconfigs  

#### 🧪
- 🟥 Shocker / ScriptKiddie  

#### 🧠 Reports
- Casos reais  

🎯 *Caça direcionada.*

---

# 🗓 SEMANA 19 — CONSOLIDAÇÃO

- 🟥 Machine Easy → Medium  
- 📝 Writeup estilo pentest  
- 🧠 Checklist final por vulnerabilidade  
- 🎯 1 sessão livre de bounty  

---

# 🗓 SEMANAS 20–25 — BUG BOUNTY FOCUSED PHASE

❌ Nenhum conteúdo novo  
✅ Apenas execução e refinamento

### Estrutura Semanal
- 🎯 2 sessões de bug bounty  
- 🧠 1 sessão de reports + checklist  

### 🎯 Objetivo Realista
- 1 bug **low/medium válido** **OU**  
- Domínio completo do processo  

📌 *Ambos são vitória.*

---
