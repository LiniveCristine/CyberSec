
# 💥 FUZZING NA WEB

## ⚔️ Fuzzing x Brute Force

### 💥 Fuzzing (testagem ampla)

- Envia **várias combinações diferentes** para o sistema  
- Inclui:
  - Dados inválidos
  - Dados malformados
  - Inputs sem sentido  

🎯 Objetivo:
- Observar como a aplicação responde
- Identificar comportamentos inesperados

---

### 🔐 Brute Force (testagem direcionada)

- Testa **múltiplas possibilidades de um valor específico**

Exemplos:
- Senhas
- IDs
- Tokens

🎯 Objetivo:
- Encontrar o valor correto

---

# 📂 DIRECTORY AND FILE FUZZING

## 🕵️ Ativos ocultos

Aplicações web geralmente possuem recursos que **não estão visíveis na interface**:

- Diretórios escondidos
- Arquivos sensíveis
- Endpoints não documentados

---

## 🚨 O que podemos encontrar?

### 🔐 Dados sensíveis
- Backups (`.bak`)
- Arquivos de configuração
- Logs
- Credenciais

---

### 🧪 Ambientes de teste
- Dev / staging
- Podem conter falhas graves

---

### 🧩 Funcionalidades escondidas
- Endpoints internos
- Features não documentadas
- Possíveis vulnerabilidades

---

## 🧠 Importância

Cada descoberta ajuda a:

- 🗺️ Mapear a aplicação
- 🔍 Entender a estrutura
- 💡 Encontrar pontos de ataque

➡️ Mesmo sem vulnerabilidade imediata, a informação é valiosa

---

# 📚 WORDLIST

## ⚙️ O que é?

Uma **wordlist** é uma lista de palavras que será usada no fuzzing.

Ela define **quais caminhos a ferramenta vai testar**.

---

## 🚨 Importância

- É a **base do fuzzing**
- Pode determinar:
  - ❌ Falha no teste
  - ✅ Descoberta de recursos importantes

---

## 📦 SecLists (wordlists populares)

- `Discovery/web-content/common.txt`  
  → Uso geral (bom ponto de partida)

- `Discovery/web-content/directory-list-2.3-medium.txt`  
  → Lista maior focada em diretórios  

- `Discovery/web-content/raft-large-directories.txt`  
  → Lista grande (diretórios)

- `Discovery/web-content/big.txt`  
  → Lista grande (arquivos + diretórios)

---

# 🚀 FFUF (Fuzz Faster U Fool)

## ⚙️ Como funciona

Para usar o FFUF você precisa de:

- 📚 Uma wordlist  
- 🌐 Uma URL com a palavra-chave `FUZZ`

---

### 🧩 Placeholder

```

FUZZ

````

➡️ Será substituído por cada palavra da wordlist

---

## 🔁 Fluxo

### 📤 Request
- FFUF envia uma requisição para cada palavra

### 📥 Response
- Recebe a resposta
- Analisa o comportamento

---

# 📂 FUZZING DE DIRETÓRIOS

```bash
ffuf -w wordlist.txt -u http://IP:PORTA/FUZZ
````

### 🔎 Parâmetros

* `-w` → wordlist
* `-u` → URL
* `FUZZ` → placeholder

---

# 📄 FUZZING DE ARQUIVOS

🎯 Objetivo:
Encontrar arquivos dentro de diretórios

Extensões comuns:

* `.php`
* `.html`
* `.txt`
* `.bak`
* `.js`

Exemplos:

* `config.php.bak`
* `teste.php`

---

```bash
ffuf -w wordlist.txt -u http://IP:PORTA/diretorio/FUZZ -e .php,.html,.txt,.bak,.js -v
```

### 🔎 Parâmetros

* `-e` → extensões
* `-v` → verbose (mais detalhes)

---

# ⚙️ OUTRAS FLAGS IMPORTANTES

### 📏 Filtrar por tamanho

```bash
-fs 1000
```

➡️ Ignora respostas com 1000 bytes

---

### ❌ Ignorar status code

```bash
-fc 404
```

➡️ Ignora respostas `404`

---

### ✅ Filtrar por sucesso

```bash
-mc 200
```

➡️ Mostra apenas respostas `200 OK`

---

# 🧾 RESUMO

* 💥 Fuzzing = exploração ampla
* 🔐 Brute force = tentativa direcionada
* 📂 Directory fuzzing revela ativos ocultos
* 📚 Wordlist é essencial
* 🚀 FFUF automatiza o processo
* ⚙️ Filtros ajudam a reduzir ruído

---

