
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

# 📂 Fuzzing Recursivo

## 🔍 Conceito

Fuzzing recursivo permite explorar **diretórios aninhados automaticamente**, indo além da raiz do site.

## ⚙️ Funcionamento

* **Nível 0 (padrão):**

  ```
  site.com/FUZZ
  ```
* **Descoberta:**

  * Encontrou `/admin`
* **Recursão:**

  ```
  site.com/admin/FUZZ
  ```
* **Aprofundamento:**

  ```
  site.com/admin/config/FUZZ
  ```

### 🎯 Controle de Profundidade

| Flag                 | Descrição                     |
| -------------------- | ----------------------------- |
| `-recursion`         | Ativa fuzzing recursivo       |
| `-recursion-depth N` | Define níveis de profundidade |

---

### ⚡ Exemplo FFUF

```bash
ffuf -w directory-list-2.3-medium.txt \
-u http://IP:PORT/FUZZ \
-e .html \
-recursion -recursion-depth 2 \
-rate 500 -ic -v
```

### 🔑 Flags importantes

* `-w` → wordlist
* `-u` → URL com FUZZ
* `-e` → extensões (.html, .txt)
* `-rate` → requisições por segundo ⚠️ evita DoS
* `-ic` → ignora comentários na wordlist
* `-v` → verbose

---

### ⚠️ Cuidados

* Pode gerar **explosão de requisições**
* Risco de:

  * DoS
  * bloqueios (WAF / rate limit)

---

# 🔄 Integração com Caido

## 📌 Comando FFUF

```bash
ffuf -w directory-medium.txt \
-u http://IP/recursive_fuzz/FUZZ \
-recursion -recursion-depth 3 \
-e .html,.txt \
-mc 200,301 \
-fc 400,404 \
-rate 50 -t 30 -ac -sf \
-o resultados.json
```

### 🔍 Explicação

* `-mc` → status aceitos
* `-fc` → status ignorados
* `-t` → threads
* `-ac` → auto-calibração (remove falsos positivos)
* `-sf` → para se houver muitos erros
* `-o` → output

---

## 📡 Envio para Caido

```bash
cat valid.txt | xargs -n 1 -P 5 -I {} \
curl -s -o /dev/null -L \
-x http://127.0.0.1:8081 "{}" 2>/dev/null
```

### 🔍 Explicação

* `cat valid.txt` → lista de URLs válidas
* `xargs` → executa comandos em lote

  * `-n 1` → 1 URL por execução
  * `-P 5` → 5 execuções paralelas
* `curl`

  * `-s` → silencioso
  * `-o /dev/null` → descarta resposta
  * `-L` → segue redirects
  * `-x` → proxy (Caido)
* `2>/dev/null` → ignora erros

---

# 🔑 Fuzzing de Parâmetros

## 🧠 Conceito

Parâmetros são como **variáveis da aplicação web**.

## 🎯 Objetivo

* Descobrir parâmetros ocultos
* Alterar comportamento da aplicação
* Explorar vulnerabilidades

---

## 🌐 GET vs POST

### 🔎 GET

```
site.com?query=fuzzing&category=security
```

* Visível na URL
* Usado para consultas

---

### 📦 POST

* Dados no **body da requisição**
* Usado em formulários

#### Tipos:

* `application/x-www-form-urlencoded`
* `multipart/form-data`

---

## ⚙️ Fuzzing com FFUF (POST)

```bash
ffuf -u http://IP/post.php \
-X POST \
-H "Content-Type: application/x-www-form-urlencoded" \
-d "y=FUZZ" \
-w param-mining.txt \
-mc 200,302,403 \
-fs 0 \
-o resultado.json
```

### 🔑 Flags

* `-X POST` → método POST
* `-H` → header
* `-d` → body (onde entra FUZZ)
* `-fs 0` → remove respostas vazias

---

## 🧪 Ferramentas

| Ferramenta | Uso                        |
| ---------- | -------------------------- |
| **ffuf**   | fuzzing geral              |
| **arjun**  | descoberta de parâmetros   |
| **Caido**  | automação + análise visual |

---

# 🌍 Fuzzing de Subdomínios e VHOSTs

## 🧠 Conceito

### 🔹 Subdomínio

* Ex: `api.site.com`
* Possui IP próprio

### 🔹 VHOST

* Mesmo IP
* Diferenciado pelo **header Host**

---

### 🔍 Fuzzing de Subdomínios (dnsx)

```bash
dnsx -d site.com -w wordlist.txt -o subs.txt
```

---

### ⚙️ Fuzzing de VHOST (FFUF)

```bash
ffuf -u http://site.com \
-w common.txt \
-H "Host: FUZZ.site.com" \
-mc 200,301,302 \
-fc 404,400
```

---

### ⚖️ Diferença

| Tipo       | Técnica     |
| ---------- | ----------- |
| Subdomínio | DNS         |
| VHOST      | Header HTTP |

---

# 🎯 Filtragem de Resultados

## 🔑 Principais Flags

| Flag  | Função               |
| ----- | -------------------- |
| `-mc` | incluir status       |
| `-fc` | excluir status       |
| `-fs` | filtrar por tamanho  |
| `-fw` | filtrar por palavras |
| `-fl` | filtrar por linhas   |

---

### 📌 Exemplo

```bash
ffuf -u http://example.com/FUZZ \
-w wordlist.txt \
-mc 200 \
-fw 427 \
-ms >500
```

---

# ✅ Validação de Resultados

## 🎯 Por que validar?

* Evitar falsos positivos
* Confirmar vulnerabilidade
* Criar evidências (PoC)

---

## 🔍 Métodos

### Manual

* Abrir no navegador
* Reproduzir com `curl`

### Análise

* Ver response
* Buscar:

  * erros
  * dados sensíveis
  * comportamento estranho

---
