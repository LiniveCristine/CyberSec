# 🚀 Pipeline de Automação em Bug Bounty

Participei da **Oxehacker** e assisti a talk do *Cangaceiro* (adendo: mais que merecedor da reputação que tem).
Ele mostrou seu fluxo de automação em reconhecimento, as tecnologias e ferramentas que utiliza, explicando de uma forma tão clara que até uma iniciante consegue entender.

---

## 🧠 Visão Geral do Fluxo

A automação funciona como um ciclo contínuo:

* 🔍 Reconhecimento (passivo + ativo)
* 📜 Análise de JavaScript
* 💣 Análise de vulnerabilidades
* 🗄️ Armazenamento dos dados
* 🔔 Notificação de descobertas

💡 Tudo roda de forma recorrente (ex: a cada 24h), garantindo que novos ativos sejam encontrados rapidamente.

---

## 🔎 Reconhecimento (Recon)

### 🌐 Recon Passivo

Coleta informações sem interagir diretamente com o alvo.

* Deve rodar frequentemente (menos de 24h)
* Busca novos subdomínios
* Evita duplicados

**Ferramentas:**

* Subfinder
* Amass
* SecurityTrails

---

### ⚡ Recon Ativo

Interage diretamente com os alvos encontrados.

* Descobre endpoints, páginas e estruturas
* Complementa o recon passivo

**Ferramentas:**

* Katana
* hakrawler

---

## 📜 Análise de JavaScript

* Extrai endpoints ocultos
* Descobre tokens, rotas e lógica da aplicação

**Ferramenta:**

* Mantra

---

## 💣 Análise de Vulnerabilidades

* Automatiza a busca por falhas conhecidas
* Escaneia serviços e endpoints

**Ferramenta:**

* Nuclei

---

## 🗄️ Armazenamento de Dados

* Todos os dados são salvos
* Permite histórico e comparação
* Evita retrabalho

**Arquitetura utilizada pelo Cangaceiro:**

* 🧩 API: Flask
* 🍃 Banco de dados: MongoDB

---

## 🔔 Notificação

* Sempre que algo novo aparece → alerta automático
* Ajuda a agir rápido

**Ferramenta:**

* Notify

---

# 🧸 Versão Simplificada (Kids)

⚠️ **Aviso:** essa versão ainda não está finalizada.
Ela é uma adaptação simples baseada no fluxo apresentado pelo Cangaceiro na Oxehacker, criada para estudo e evolução contínua.

---

## 🛠️ Componentes

* 🐚 **Bash** → scripts do fluxo
* ⏰ **Cron** → automação (executa sozinho)
* 📄 **TXT** → banco de dados simples
* 🔄 **Anew** → detecta novidades
* 🔔 **Notify** → envia alertas

---

## ⏰ Automação com Cron

Exemplo de agendamento:

```bash
crontab -e
0 */12 * * * /bin/bash /home/seu_usuario/scripts/recon_automatico.sh
```

✔ Executa a cada 12 horas
✔ Mantém o recon sempre atualizado

---

## 🧩 Estrutura do Pipeline (Script)

### 📁 Organização

* `all_subs.txt` → todos subdomínios encontrados
* `all_alive.txt` → hosts ativos
* `new_subs.txt` → novidades do dia
* `new_alive.txt` → novos ativos

---

## 🔄 Etapas do Fluxo

### 🥇 Recon + Validação DNS

* Coleta subdomínios
* Resolve DNS
* Remove duplicados
* Identifica novidades com **Anew**

💡 Primeira execução cria a base inicial

---

### 🌍 Validação Web

* Usa `httpx` para verificar quais estão ativos
* Filtra status HTTP relevantes

✔ Evita perder tempo com hosts mortos

---

### ⚠️ Detecção de Takeover

* Analisa registros CNAME
* Busca serviços vulneráveis (AWS, GitHub, Azure...)

💡 Possíveis falhas críticas

---

### 🖼️ Recon Visual + Fuzzing

* Screenshot com Aquatone
* Fuzzing de diretórios com FFUF

✔ Foco apenas nos ativos novos → otimização

---

### 🔗 Parâmetros + XSS

* Coleta parâmetros com ParamSpider
* Testa reflexão com KXSS

💡 Excelente para encontrar XSS rapidamente

---

### 🔔 Notificação Final

* Envia alertas se encontrar:

  * novos subdomínios
  * takeovers
  * possíveis XSS

---

## 🎯 Principais Ideias do Pipeline

* 🔁 **Automação contínua**
* 🧹 **Evitar duplicados**
* ⚡ **Foco em novidades**
* 📊 **Organização de dados**
* 🔔 **Resposta rápida**

---

## 💡 Dica Importante

Seu pipeline **não precisa ser perfeito no início**.

Ele evolui com você:

* adicionando ferramentas
* melhorando filtros
* ajustando etapas

👉 O mais importante é: **começar simples e iterar constantemente**

---

## 📜 Script de Exemplo

```bash
#!/bin/bash

# --- CONFIGURAÇÕES INICIAIS ---
TARGET="alvo.com"
BASE_DIR="$HOME/recon/$TARGET"
WORDLIST_DIR="/usr/share/seclists/Discovery/Web-Content" # Ajuste conforme seu sistema
mkdir -p "$BASE_DIR/history" "$BASE_DIR/aquatone"

# Arquivos que funcionam como nosso "Banco de Dados"
DB_SUBS="$BASE_DIR/all_subs.txt"
DB_ALIVE="$BASE_DIR/all_alive.txt"

# Arquivos de trabalho (Novidades do dia)
NEW_SUBS="$BASE_DIR/new_subs_resolved.txt"
NEW_ALIVE="$BASE_DIR/new_alive.txt"

echo "[*] Iniciando Pipeline de Recon para: $TARGET"

# --- ETAPA 1: RECON PASSIVO E FILTRO DNS (COM VALIDAÇÃO) ---

if [ ! -f "$DB_SUBS" ]; then
    echo "[+] Primeira execução: Criando base de dados inicial..."
    subfinder -d $TARGET -silent | dnsx -silent -a -resp-only | sort -u > "$DB_SUBS"
    cp "$DB_SUBS" "$NEW_SUBS"
    echo "[!] Base inicial criada com $(wc -l < "$DB_SUBS") subdomínios." | notify -silent
else
    echo "[*] Buscando novos subdomínios (Diffing com Anew)..."
    subfinder -d $TARGET -silent | dnsx -silent -a -resp-only | anew "$DB_SUBS" > "$NEW_SUBS"
    
    if [ ! -s "$NEW_SUBS" ]; then
        echo "[-] Nenhuma novidade encontrada. Encerrando."
        exit 0
    fi
    num_new=$(wc -l < "$NEW_SUBS")
    echo "[!] $num_new novos subdomínios encontrados!" | notify -bullet -title "Novos Alvos: $TARGET"
fi

# --- ETAPA 2: VALIDAÇÃO WEB (QUEM ESTÁ VIVO AGORA) ---

echo "[*] Validando serviços web nos novos alvos..."
cat "$NEW_SUBS" | httpx -silent -mc 200,204,301,302,307,401,403,405,500| anew "$DB_ALIVE" > "$NEW_ALIVE"

if [ ! -s "$NEW_ALIVE" ]; then
    echo "[-] Os novos subdomínios não possuem serviços web ativos. Verificando Takeovers..."
else
    echo "[+] $(wc -l < "$NEW_ALIVE") novos sites ativos para análise."
fi

# --- ETAPA 3: CAÇA A TAKEOVERS (BASEADO NO DNS RESOLVIDO) ---

echo "[*] Verificando vulnerabilidades de Takeover..."
cat "$NEW_SUBS" | dnsx -cname -resp -silent | grep -E "github|aws|s3|azure|cloudfront" | anew "$BASE_DIR/potential_takeovers.txt" | notify -title "Possível Takeover Identificado"

# --- ETAPA 4: RECON VISUAL E FUZZING (FOCO NO NEW_ALIVE) ---

if [ -s "$NEW_ALIVE" ]; then
    echo "[*] Iniciando Recon Visual (Aquatone)..."
    cat "$NEW_ALIVE" | aquatone -out "$BASE_DIR/aquatone/$(date +%F_%H%M)"

    echo "[*] Iniciando Fuzzing de Diretórios (FFUF)..."
    ffuf -w "$NEW_ALIVE":DOMAIN -w "$WORDLIST_DIR/common.txt":FUZZ \
         -u DOMAIN/FUZZ -mc 200,301,302 -t 50 -o "$BASE_DIR/history/fuzz_$(date +%F).json" -silent
fi

# --- ETAPA 5 & 6: PARÂMETROS E XSS (PARAMSPIDER + KXSS) ---

echo "[*] Minerando parâmetros e testando reflexão..."
for domain in $(cat "$NEW_ALIVE" 2>/dev/null); do
    clean_domain=$(echo $domain | sed -e 's|^[^/]*//||' -e 's|/.*$||')
    paramspider -d "$clean_domain" --quiet
done

if [ -d "results" ]; then
    cat results/*.txt | grep -Ev "\.(jpg|jpeg|png|gif|css|js)" | kxss | grep -E "<|>" | anew "$BASE_DIR/xss_targets.txt"
    rm -rf results/
fi

# --- ETAPA 7: NOTIFICAÇÃO FINAL ---

if [ -s "$BASE_DIR/xss_targets.txt" ]; then
    echo "[!] Alvos de XSS identificados!"
    cat "$BASE_DIR/xss_targets.txt" | notify -title "Potenciais XSS: $TARGET"
fi

echo "[+] Recon finalizado com sucesso às $(date)"
```
