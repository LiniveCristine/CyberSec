# 🌍 O que é HTTP?

**HTTP (HyperText Transfer Protocol)** é o protocolo usado para comunicação entre cliente e servidor.

## 🔄 Fluxo HTTP

1. Cliente envia uma requisição
2. Servidor processa
3. Servidor retorna uma resposta

📡 Porta padrão:

- `TCP 80`

---

# 🔗 Estrutura de uma URL

Exemplo:

```bash
http://admin:password@inlanefreight.com:80/dashboard.php?login=true#status
```

---

## 🧩 Componentes

| Parte               | Descrição               |
| ------------------- | ----------------------- |
| `http://`           | Protocolo (schema)      |
| `admin:password@`   | Credenciais (opcional)  |
| `inlanefreight.com` | Host (domínio ou IP)    |
| `:80`               | Porta                   |
| `/dashboard.php`    | Caminho (path)          |
| `?login=true`       | Query string            |
| `#status`           | Fragmento (client-side) |

---

## ⚠️ Observações

- HTTP → porta 80 (padrão)
- HTTPS → porta 443 (padrão)
- Fragmento (`#`) **não vai para o servidor**

---

# 🧠 Fluxo Completo HTTP

## 👥 Participantes

- Usuário
- Browser
- DNS Server
- Web Server

---

## 🔄 Processo

1. Usuário acessa `http://site.com`
2. Browser consulta DNS (ou `/etc/hosts`)
3. Obtém o IP
4. Envia request:

```http
GET / HTTP/1.1
```

5. Servidor responde:

```http
HTTP/1.1 200 OK
```

---

# 🧪 cURL (Client URL)

Ferramenta CLI para enviar requisições HTTP.

---

## 🔧 Uso básico

```bash
curl site.com
```

✔️ Retorna resposta **bruta (não renderizada)**

---

## 📥 Baixar arquivos

```bash
curl -O site.com/index.html
curl site.com/download.php -o arquivo.txt
```

---

## ⚙️ Flags importantes

| Flag | Função                  |
| ---- | ----------------------- |
| `-v` | Verbose (detalhado)     |
| `-s` | Silencioso              |
| `-O` | Salva com nome original |
| `-o` | Define nome do arquivo  |
| `-H` | Modifica headers        |
| `-I` | Apenas headers          |
| `-i` | Headers + body          |
| `-A` | User-Agent              |
| `-k` | Ignora SSL              |
| `-u` | Credenciais             |

---

# 🔐 HTTPS (HTTP Secure)

## 🧩 Diferença

| HTTP              | HTTPS         |
| ----------------- | ------------- |
| Não criptografado | Criptografado |
| Vulnerável a MITM | Seguro        |
| Porta 80          | Porta 443     |

---

## 🔒 TLS (Transport Layer Security)

HTTPS = HTTP + TLS

---

## 🔄 Fluxo HTTPS

1. Cliente faz request HTTP
2. Servidor responde com **301 Redirect**
3. Cliente envia request HTTPS
4. TLS Handshake ocorre:

### 🤝 Handshake

- Cliente envia "hello"
- Servidor responde + certificado
- Cliente valida
- Troca de chaves
- Conexão criptografada

---

## ⚠️ DNS e Privacidade

Mesmo com HTTPS:

- DNS pode expor o domínio acessado

✔️ Use DNS seguro:

- `8.8.8.8`
- `1.1.1.1`

---

# 📤 HTTP Request

## 📌 Estrutura

```http
GET /users/login.html HTTP/1.1
Host: inlanefreight.com
User-Agent: Mozilla
```

---

## 🧩 Componentes

### 🔹 Request Line

- Método: `GET`
- Caminho: `/users/login.html`
- Versão: `HTTP/1.1`

---

### 🔹 Headers

- `Host`
- `User-Agent`
- `Cookie`
- `Accept`

---

### 🔹 Body (opcional)

✔️ Presente em:

- POST
- PUT
- PATCH

---

# 📥 HTTP Response

## 📌 Estrutura

```http
HTTP/1.1 200 OK
Content-Type: text/html
```

---

## 🧩 Componentes

- Status Code
- Headers
- Body (HTML, JSON, etc)

---

# 🧠 HTTP Headers

## 📂 Categorias

### 🔹 Gerais

- `Date`
- `Connection`
- `Server`

---

### 🔹 Entidade

- `Content-Type`
- `Content-Length`
- `Content-Encoding`

---

### 🔹 Request Headers

- `Host`
- `User-Agent`
- `Referer`
- `Cookie`
- `Authorization`

---

### 🔹 Response Headers

- `Set-Cookie`
- `Server`
- `WWW-Authenticate`

---

### 🔐 Segurança

- `Content-Security-Policy` → previne XSS
- `Strict-Transport-Security` → força HTTPS

---

# 🍪 Cookies & Autenticação

## 🍪 Cookies

- Formato: `key=value`
- Mantêm sessão do usuário
- Enviados em toda requisição

---

## 🔑 Authorization

- `Basic` → Base64 (decodificável)
- `Bearer` → JWT (mais seguro)

---

# 🧪 Técnicas Importantes

## 🔥 Host Header Injection / Enum

```bash
curl -H "Host: admin.site.com" http://IP
```

---

## 🔎 Brute force de subdomínio

```bash
ffuf -w wordlist.txt -u http://IP -H "Host: FUZZ.site.com"
```

---

## ⚠️ Referer manipulável

- Pode ser falsificado
- Não é confiável para validação

---

# 🌐 Browser DevTools

## 🛠️ Acessar

- `F12` ou `Ctrl + Shift + I`

---

## 📊 Aba Network

✔️ Permite:

- Ver requests
- Ver responses
- Copiar como cURL
- Filtrar URLs

---

# 🔁 Métodos HTTP

| Método  | Função              |
| ------- | ------------------- |
| GET     | Buscar recurso      |
| POST    | Enviar dados        |
| HEAD    | Apenas headers      |
| PUT     | Criar recurso       |
| DELETE  | Apagar recurso      |
| OPTIONS | Métodos permitidos  |
| PATCH   | Atualização parcial |

---

## ⚠️ Riscos

- PUT → upload malicioso
- DELETE → DoS
- GET → exposição de dados

---

# 📊 Status Codes

## 🧩 Classes

| Código | Significado      |
| ------ | ---------------- |
| 1xx    | Informativo      |
| 2xx    | Sucesso          |
| 3xx    | Redirecionamento |
| 4xx    | Erro do cliente  |
| 5xx    | Erro do servidor |

---

## 🧠 Exemplos

- `200 OK`
- `301 Moved Permanently`
- `404 Not Found`
- `500 Internal Server Error`

---
