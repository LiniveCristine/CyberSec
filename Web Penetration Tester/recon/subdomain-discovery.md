
# 🕵️ Recon & Intelligence Gathering

## 📌 Objetivo

Coletar o máximo de informações possíveis sobre o **alvo** antes de qualquer interação ativa.

---

# 🔎 Subdomain Discovery

Descoberta de subdomínios é essencial para expandir a superfície de ataque.

---

# 🕰️ Histórico de Subdomínios

Pesquisar versões antigas pode revelar ativos esquecidos.

## 🔗 Ferramentas

* [https://subdomainfinder.c99.nl/](https://subdomainfinder.c99.nl/)
* [https://web.archive.org/](https://web.archive.org/)

## 💡 Casos de uso

### 🚧 Bypass de WAF

* WAF pode esconder o IP real do servidor
* DNS aponta para o WAF
* Buscar registros antigos → encontrar IP original
* Testar acesso direto ao servidor

### 🔗 Descoberta de links antigos

* Usar snapshots do Wayback Machine
* Encontrar:

  * endpoints esquecidos
  * páginas ainda ativas
  * funcionalidades antigas

---

# 💣 Bruteforce (Método Ativo)

Técnica para descobrir subdomínios tentando combinações.

---

## 🛠️ Ferramentas

* sublist3r
* subbrute
* Amass

---

## 🧪 Bruteforce Manual

### 🔎 Testando resolução DNS

```bash
host meusite.com
```

### 📌 Resultado

* Existe → retorna IP
* Não existe → `NXDOMAIN`

---

## 📄 Criando Wordlist

```bash
nano wordlist.txt
```

Ou usar lista pronta:

```bash
wget https://raw.githubusercontent.com/danielmiessler/SecLists/refs/heads/master/Discovery/DNS/subdomains-top1million-5000.txt
```

---

## 🔁 Script Simples

```bash
for subdominio in $(cat wordlist.txt); do 
  host "$subdominio.meusite.com"; 
done
```

### 🔍 Filtrar apenas válidos

```bash
for subdominio in $(cat wordlist.txt); do 
  host "$subdominio.meusite.com" | grep -v 'NXDOMAIN'; 
done
```

⚠️ **Observação:**

* Gera muito ruído
* Pode ser detectado facilmente
* Não é eficiente em larga escala

---

# 🧠 Métodos Passivos (Mais Stealth)

Não interagem diretamente com o alvo.

---

## 🛠️ Ferramentas

* subfinder
* certspotter
* crt.sh
* chaos.projectdiscovery.io

---

## 🔐 Certificados

Certificados TLS podem revelar subdomínios.

## 🔎 Consulta

* Usar: [https://crt.sh](https://crt.sh)

### 💡 Insights

* Subdomínios internos podem aparecer:

  * `intranet.empresa.com`
* Alguns:

  * não resolvem externamente
  * estão fora do ar
  * são antigos

---

## 🤖 CTFR (Automação)

Consulta certificados automaticamente.

### ▶️ Uso

```bash
source venv/bin/activate

python ctfr.py -d meusite.com -o resultados.txt

deactivate
```

📌 Output:

* Lista de subdomínios encontrados via certificados

---

# ⚡ Subfinder

Ferramenta de recon passivo poderosa.

## 🔍 Coleta:

* Certificados
* APIs públicas
* OSINT
* Bases de dados

---

# 🔄 Fluxo Profissional

Combinação de ferramentas para melhor resultado:

```bash
subfinder -d meusite.com -o subs.txt
dnsx -l subs.txt -a -resp -o resolved.txt
httpx -l subs.txt -title -status-code -tech-detect
```

---

## 📊 Pipeline

1. **subfinder** → coleta subdomínios (passivo)
2. **dnsx** → resolve DNS
3. **httpx** → identifica ativos e tecnologias

---

# ⚠️ Boas Práticas

* Prefira métodos passivos inicialmente
* Evite gerar muito ruído desnecessário
* Combine múltiplas fontes
* Valide sempre os resultados
* Documente tudo

---

# 🎯 Conclusão

Recon é a base de qualquer teste de segurança:

* Quanto mais informação → maior a chance de sucesso
* Subdomínios esquecidos = oportunidades
* Automação + análise manual = melhor abordagem

