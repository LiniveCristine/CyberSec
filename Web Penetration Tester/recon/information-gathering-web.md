# 🔍 RECONHECIMENTO

## 🎯 Objetivo

O **reconhecimento (recon)** é a fase inicial do pentest focada em entender o alvo e coletar o máximo de informações possíveis.

### 🧭 Identificar Ativos

* Páginas web
* Subdomínios
* Endereços IP
* Tecnologias utilizadas

👉 Fornece uma **visão geral do alvo**

---

### 🕵️ Descobrir Informações Ocultas

* Arquivos `.bak` (backup)
* Arquivos de configuração
* Documentação interna

⚠️ Podem conter:

* Credenciais
* Endpoints sensíveis
* Possíveis pontos de entrada

---

### 🧠 Gathering Intelligence

* Identificar pessoas
* Coletar e-mails
* Mapear comportamentos

🎯 Uso:

* Engenharia social
* Ataques direcionados

---

## ⚖️ Tipos de Reconhecimento

### 🔴 Ativo

* Interação direta com o alvo (requisições)
* Maior precisão
* 🚨 Maior risco de detecção

---

### 🟢 Passivo

* Uso de fontes públicas
* Sem contato direto
* 🔒 Mais discreto

---

# ⚔️ RECONHECIMENTO ATIVO

## 🔎 Técnicas

### 🚪 Port Scanning

* Identifica portas e serviços abertos
* Ferramentas: `nmap`, `masscan`
* 🚨 Risco: **Alto**

---

### 🧨 Vulnerability Scanning

* Busca vulnerabilidades conhecidas (SQLi, XSS)
* Ferramenta: `nuclei`
* 🚨 Risco: **Alto**

---

### 🗺️ Network Mapping

* Mapeia a estrutura da rede
* Ferramentas: `nmap`, `traceroute`
* ⚠️ Risco: Médio a alto

---

### 🏷️ Banner Grabbing

* Coleta informações dos serviços:

  * Versão do software
  * Tipo de servidor

**Exemplo:**

```bash
subfinder -d target.com -silent | httpx -sc -td -server -title -o web_banners.txt
```

**Flags importantes:**

* `-sc`: status code
* `-td`: tecnologias
* `-server`: servidor
* `-title`: título HTML

**Nuclei:**

```bash
nuclei -l hosts.txt -tags network,fingerprint -bs 50 -o network_banners.txt
```

* `-l`: lista
* `-tags`: tipo de template
* `-bs`: concorrência

🟡 Risco: **Baixo**

---

### 💻 Identificar Sistema Operacional

* Ferramenta: `nmap -O`
* 🟢 Risco: Baixo

---

### 🔢 Enumeração de Serviços

* Identifica versões dos serviços
* Ferramenta: `nmap -sV`
* 🟢 Risco: Baixo

---

### 🕸️ Web Spidering

* Descobre páginas ocultas
* Mapeia estrutura do site
* Ferramenta: `Katana`
* ⚠️ Risco: Baixo a médio

---

# 🕵️‍♂️ RECONHECIMENTO PASSIVO

### 🔍 Pesquisas (OSINT)

* Google, Shodan
* Encontrar:

  * Funcionários
  * GitHub
  * Redes sociais

---

### 📇 WHOIS Lookup

* Consulta registros de domínio
* Ferramenta: `whois`

---

### 🌐 DNS Analysis

* Identificar:

  * Subdomínios
  * Servidores de e-mail
* Ferramenta: `dnsx`

---

### 🕰️ Histórico

* Ver mudanças no site
* Ferramentas:

  * Wayback Machine
  * Web Archive

---

### 📱 Redes Sociais

* LinkedIn, Twitter
* Coleta de informações pessoais

---

### 💻 Repositórios

* GitHub
* Buscar:

  * Credenciais
  * Vulnerabilidades

---

# 📇 WHOIS

## 📌 O que é

* Protocolo de consulta
* “Lista telefônica da internet”

---

## 📊 Informações Obtidas

* Domínio
* Empresa registradora
* Contato do dono
* Contato técnico
* Datas (criação/expiração)

---

# 🌐 DNS

## 🧠 Conceito

* Funciona como um **GPS da internet**
* Traduz:

  * Nome → IP

---

## ⚙️ Como Funciona

1. Consulta cache local
2. Se não encontrar:

   * Consulta servidor DNS
3. Se necessário:

   * ROOT → TLD → Autoritativo

📌 Resultado:

* Retorna IP
* Armazena em cache

---

# 📁 Arquivo Hosts

## 📌 O que é

* Mapeamento manual de domínio → IP
* Ignora DNS

---

## 📍 Localização

* Linux: `/etc/hosts`
* Windows: `C:\Windows\System32\drivers\etc\hosts`

---

# 🧾 Tipos de Registros DNS

* **A** → IPv4
* **AAAA** → IPv6
* **CNAME** → Alias (apelido de domínio)
* **MX** → Servidor de e-mail
* **NS** → Servidor autoritativo
* **TXT** → Texto (verificação, SPF, etc.)
* **SOA** → Informações da zona

---

## 🚨 Importância

* Detectar novos subdomínios
* Encontrar novos pontos de entrada

---

# 🛠️ Ferramentas DNS

* `dig`
* `nslookup`
* `host`
* **dnsx** (mais moderno)

---

## ⚡ DNSX Diferencial

* Consultas em massa
* Filtros por tipo de registro
* Remove falsos positivos
* Verifica se domínio está ativo

---

# 🔄 Fluxo de Reconhecimento (Moderno)

## ⚡ Pipeline Atualizado

### 1️⃣ Recon + Filtro DNS

```bash
subfinder -d alvo.com -silent | dnsx -silent -a -resp-only -o resolved_subs.txt
```

---

### 2️⃣ Validação Web

```bash
cat resolved_subs.txt | httpx -silent -mc 200,301,302,403 -o alive.txt
```

---

### 3️⃣ Subdomain Takeover

```bash
cat resolved_subs.txt | dnsx -cname -resp -silent | grep -E "github|aws|s3|azure|cloudfront" | tee potential_takeovers.txt
```

---

### 4️⃣ Recon Visual + Fuzzing

```bash
cat alive.txt | aquatone
```

```bash
ffuf -w alive.txt:DOMAIN -w discovery_wordlist.txt:FUZZ -u DOMAIN/FUZZ -mc 200,301,302 -t 50 -o web_discovery.txt
```

---

### 5️⃣ Mineração de Parâmetros

```bash
paramspider -d alvo.com
```

---

### 6️⃣ Detecção de Reflexão (XSS)

```bash
cat results/alvo.com.txt | grep -Ev "\.(jpg|jpeg|png|gif|css|js)" | kxss | grep -E "<|>" | tee xss_targets.txt
```

---

### 7️⃣ Fuzzing de Confirmação

```bash
ffuf -w xss_targets.txt:URL -w xss_payloads.txt:PAYLOAD -u "URLPAYLOAD" -mr "PAYLOAD"
```

---

## 🧠 Dicas Importantes

* Use `dnsx` **antes do httpx** para evitar perda de tempo
* Nem todo subdomínio “morto” é inútil → pode indicar **takeover**
* Sempre combine:

  * Recon passivo + ativo
* Automatize, mas valide manualmente

