
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

# 🔄 Fluxo até o momento

Combinação de ferramentas para melhor resultado:

```bash
subfinder -d meusite.com -o subs.txt
httpx -l subs.txt -title -status-code -tech-detect
```

---

## 📊 Pipeline

1. **subfinder** → coleta subdomínios (passivo)
2. **httpx** → identifica ativos e tecnologias

---

# ⚠️ Boas Práticas

* Prefira métodos passivos inicialmente
* Evite gerar muito ruído desnecessário
* Combine múltiplas fontes
* Valide sempre os resultados
* Documente tudo

---

# 📚 APPLICATION DISCOVERY

> 🎯 **Objetivo:** Descobrir **endpoints, parâmetros e conteúdos ocultos** de uma aplicação para ampliar a superfície de ataque.

---

# 🔎 VISÃO GERAL

Application Discovery se divide em 3 pilares:

```text
1. URL Discovery        → Encontrar endpoints/rotas
2. Parameter Discovery  → Encontrar entradas (inputs)
3. Content Discovery    → Analisar conteúdo e comportamento
```

---

# 🌐 URL DISCOVERY

> 🎯 Encontrar **todas as URLs possíveis** de um domínio

## 🛠️ Ferramentas

* `gau` → coleta URLs históricas (**passivo**)
* `wfuzz`, `ffuf`, `dirsearch` → brute force de diretórios

---

## ⚙️ GAU (GetAllURLs)

* Faz **recon passivo**
* Busca URLs em:

  * Wayback Machine
  * Common Crawl
* Retorna **muito conteúdo (incluindo lixo)**

---

## 🔁 Fluxo básico

```bash
subfinder → subdomínios
gau       → coleta URLs
httpx     → valida ativos
```

---

## 🧪 Pipeline completo (filtrado)

```bash
subfinder -d teste.com.br -silent \
| gau \
| grep -Ev "\.(jpg|jpeg|png|gif|svg|ico|css|woff|woff2|ttf|eot)(\?|$)" \
| httpx -silent -mc 200,301,302,403 \
| sort -u \
| tee urls_filtradas.txt
```

---

## 💡 Pontos importantes

* `httpx`:

  * Verifica **status code**
  * Pode testar paths → `-path /admin/`
  * Pode escanear portas

* Filtrar extensões evita:

  * imagens
  * fontes
  * arquivos irrelevantes

---

# 🔑 PARAMETER DISCOVERY

> 🎯 Descobrir **inputs da aplicação** (`?id=`, `?page=`, etc.)

---

## 🛠️ Ferramentas

* `paramspider` → busca URLs com parâmetros (**passivo**)
* `gf` → padrões de vulnerabilidade
* `parth` → extração de parâmetros
* `kxss` → análise de reflexão (XSS)
* `ffuf` → brute force

---

## ⚙️ ParamSpider

* Mais **focado que o gau**
* Retorna apenas URLs com `?param=`

💡 Alternativa com GAU:

```bash
grep "=" urls.txt > params.txt
```

---

## ⚙️ KXSS (detecção de reflexão)

> 🔥 Detecta se um parâmetro:

* aceita caracteres especiais (`< >`)
* reflete no HTML

➡️ Indício de possível **XSS**

---

## 🧪 Fluxo ideal

```text
ParamSpider → KXSS → FFUF
```

---

## 🧪 Exemplo prático

```bash
cat resultados.txt \
| kxss \
| tee potenciais_xss.txt
```

---


## 🧠 Insight importante

* KXSS **reduz drasticamente** o escopo
* FFUF fica:

  * mais rápido
  * mais preciso

---

# 📂 CONTENT DISCOVERY

> 🎯 Entender o **conteúdo e comportamento** da aplicação

---

## 🛠️ Ferramentas

* `httpx` → valida endpoints
* `aquatone` → visual recon
* `secretFinder` → busca segredos em JS

---

## ⚙️ Aquatone

> 🔥 Ferramenta de **visual recon**

### O que faz:

* Tira **prints em massa**
* Identifica:

  * tecnologias
  * servidores
* Gera relatório HTML interativo

---

## 🧪 Uso

```bash
cat urls_vivas.txt | aquatone
```

Abrir relatório:

```bash
brave-browser aquatone_report.html
```

---

## 💡 Vantagem

* Evita acessar manualmente cada domínio
* Ajuda a encontrar:

  * painéis admin
  * páginas interessantes
  * superfícies de ataque visuais

---

# 🔄 FLUXO COMPLETO

## 🧠 Pipeline geral

```text
1. Recon & Validação
   subfinder → gau → httpx

2. Parameter Mining e Visual Recon (em paralelo)
   paramspider e aquatone

3. Análise inicial (no resultado do paramspider)
   kxss

4. Exploração
   ffuf
   
```

---

## 🧪 Exemplo completo

```bash
# Execução em Paralelo (Abra dois terminais)

# Terminal 1: Focado em descobrir páginas VIVAS e VER o site
subfinder -d alvo.com -silent | gau --subs | sort -u | httpx -mc 200,301,302,403 -o urls_vivas.txt
cat urls_vivas.txt | aquatone -out ./aquatone_results


# Terminal 2: Focado em minerar PARÂMETROS (independente de estarem vivas no httpx)
paramspider -d alvo.com
cat results/alvo.com.txt | grep -Ev "\.(jpg|jpeg|png|gif|svg|ico|css|js)" | sort -u | kxss | tee potenciais_xss.txt
```

---

# 🧪 TESTE PRÁTICO (XSS)

Alvo: `xss-game.appspot.com`

```bash
paramspider -d xss-game.appspot.com
cat resultado.txt | kxss | tee possiveis_xss.txt
```

➡️ Teste manual:

```html
<script>alert(1)</script>
```

---

# 🧠 RESUMO FINAL 

- ✔ **URL Discovery** → Onde posso entrar?
- ✔ **Parameter Discovery** → Onde posso injetar?
- ✔ **Content Discovery** → O que tem dentro?





