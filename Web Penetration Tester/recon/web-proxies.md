# 🌐 Introdução a Web Proxies

## 🔎 O que são Web Proxies

Web proxies são ferramentas que ficam entre o cliente (como um navegador ou aplicativo) e o servidor.

Eles funcionam como intermediários capazes de interceptar e visualizar as requisições e respostas HTTP/HTTPS enviadas entre as duas partes.

De forma simples, atuam como um tipo de **“man-in-the-middle” (MITM)** controlado, permitindo observar e manipular o tráfego web.

### 🧰 O que é possível fazer com eles:
- Capturar requisições HTTP/HTTPS
- Visualizar dados enviados e recebidos
- Modificar requisições antes de chegarem ao servidor
- Analisar como o back-end responde a diferentes entradas

---

## ⚙️ Funções dos Web Proxies

Além de interceptar tráfego, os web proxies são amplamente usados em testes de segurança e análise de aplicações web:

- **Verificação de vulnerabilidades web**
- **Fuzzing** (envio de entradas aleatórias para encontrar falhas)
- **Crawling** (mapeamento automático da aplicação)
- **Mapeamento da estrutura da aplicação**
- **Code review indireto** (análise de requisições e comportamento do sistema)

---

## 🛠️ Ferramentas mais usadas

- **Burp Suite**
- **OWASP ZAP**
- **Caido** (pra quem é liso)

---

# ⚙️ Configurações iniciais

## 🟠 Burp Suite

- Proxy → Intercept → Open Browser  
  (abre o navegador interno do Burp)

- Porta padrão: `8080`  
  Ajuste em:
  - Proxy → Proxy settings → Proxy listeners

---

## 🔵 Caido

- Não possui navegador interno
- Configuração de porta:
  - Settings → Network → HTTP Proxies
  - Exemplo: `8081`

---

## 🌐 Configuração no Firefox

### 🔌 Extensão FoxyProxy

Permite gerenciar múltiplos proxies facilmente:

- Criar perfis (ex: Burp, Caido)
- Alternar entre portas rapidamente
- Melhor produtividade durante testes

Exemplo:
- 8080 → Burp
- 8081 → Caido

---

## 🔐 Certificado CA (Certificate Authority)

Web proxies conseguem interceptar tráfego HTTPS, mas para isso é necessário instalar o certificado CA.

Sem ele, não é possível visualizar:

- Cookies
- APIs seguras
- Conteúdo criptografado

---

### 🟠 Burp Suite

- Proxy → Intercept → Open Browser
- Acesse: `http://burp`
- Baixe o certificado CA

---

### 🔵 Caido

- Settings → Certificates → Export
- Exporta como `.p12`
- Firefox não reconhece diretamente

Converter para `.pem`:

```bash
openssl pkcs12 -in caido-cert.p12 -out caido-cert.pem -nodes
```

---

### 🧩 Adicionando no Firefox

* Configurações → Privacidade e Segurança
* Certificados → Gerenciar certificados
* Importar arquivo `.pem`
* Marcar como confiável (sites e e-mail)

---

# 🧪 Interceptando requisições

## 🟠 Burp Suite

* Proxy → Intercept → On/Off

## 🔵 Caido

* Proxy → Intercept → Forwarding

---

### 🔄 Como funciona

* A requisição é interceptada
* Fica pausada (pendente)
* Você pode editar antes de enviar (forward)

---

# 🔁 Modificação automática (Match & Replace)

## 🟠 Burp Suite
Caminho:
- Proxy → Intercept → Proxy settings → HTTP Match and Replace

## 🔵 Caido
Caminho:
- Menu lateral → Match & Replace

---

## 🧩 O que podemos modificar

Podemos escolher exatamente onde aplicar a alteração:

- 📥 Request (requisição)
- 📤 Response (resposta)

E também o nível de alteração:

- Headers
- Body
- Query string
- Status code

---

### 🔎 Uso de Regex

É possível utilizar **expressões regulares** para identificar padrões.

Exemplo:

```

User-Agent: .*

```

Isso captura qualquer linha que comece com `User-Agent`.

---

## 🧠 Uso de condições (filtros extras)

Para evitar quebrar requisições legítimas, podemos adicionar condições.

### 🔵 Caido (DSL)

Caido utiliza uma linguagem de filtros chamada DSL.

Exemplo:

```

req.path.cont:"/ping"

```

Significa:
- Só aplicar a regra se o caminho conter `/ping`

---

## 🚨 Importância prática

Esses recursos são muito usados em segurança ofensiva:

- 🔄 Alteração automática de headers bloqueados
- 🕵️‍♂️ Modificação de User-Agent
- 🧱 Bypass de WAF (Web Application Firewall)
- ⚙️ Testes automatizados em massa

---

# 📜 Histórico do Proxy

Os proxies armazenam todo o tráfego interceptado.

### O que podemos fazer:

- Ver todas as requisições que passaram pelo proxy
- Reenviar requisições com alterações
- Testar variações de uma mesma request

---

## 🔁 Reenvio de requisições

Atalho:
```

Ctrl + R

```

Isso envia a requisição para o Repeater (ou equivalente), permitindo edição manual antes de reenviar.

---

### ⚠️ Observação importante

Ao reenviar a requisição diretamente do proxy:

- Ela vai direto para o servidor
- Não passa novamente pelo navegador
- Não altera o estado da página no browser

Ou seja, o navegador não “vê” essa nova requisição.

---

# 🔐 CODIFICAÇÃO E DECODIFICAÇÃO URL

## 🌐 Introdução

Alguns caracteres especiais não são permitidos diretamente na URL.  
Eles precisam ser codificados para serem transmitidos corretamente nas requisições HTTP.

### 📌 Exemplo

```

/search?q=teste 123

```

Codificado:

```

/search?q=teste%20123

```

---

## 🔄 Mais usados

| Caractere | Codificado |
|----------|-----------|
| espaço   | `%20`     |
| /        | `%2F`     |
| =        | `%3D`     |
| &        | `%26`     |

---

## ⚙️ Na prática

Caso a requisição seja alterada manualmente:

- Pode ser necessário codificar novamente
- Caso não seja feito:
  - ❌ O servidor pode interpretar incorretamente
  - ❌ A requisição pode quebrar

---

## 🧰 Caido

### 📍 Como usar

1. HTTP History → `Ctrl + R` na requisição → Replay  
2. Selecionar o trecho desejado  
3. Botão direito → **Convert → URL**

➡️ Também funciona fora do Replay  
➡️ Também possui opção de Base64

---

## 🚨 Importância

- 🔓 Bypass em filtros e validações  
- 🧱 Testes em WAF  

---

## 🔍 Decodificação

### ❌ O Caido NÃO suporta:

- HTML  
- Unicode  
- ASCII hexadecimal  

### 🟠 Observação:
O Burp suporta esses formatos

---

# 🧑‍💻 UTILIZANDO PROXY EM LINHA DE COMANDO

## 🌐 Uso em ferramentas de recon

É possível adicionar proxy diretamente nas ferramentas via CLI.  
Cada ferramenta possui sua própria forma de configuração.

### 📌 Exemplos

```

katana -proxy [http://127.0.0.1:8081](http://127.0.0.1:8081)

```
```

ffuf -replay-proxy [http://127.0.0.1:8081](http://127.0.0.1:8081)

```

---

## 🕸️ PROXYCHAINS

Ferramenta que força aplicações a utilizarem proxy,  
mesmo que não tenham suporte nativo.

### 🔗 Tipos

- HTTP  
- SOCKS5  
- SOCKS4  

### ⚠️ Observações

- 🐢 Pode deixar as requisições lentas  
- ❌ Não suporta bem scans avançados (ex: SYN scan)  

---

# 💥 FUZZING

## ⚔️ Ferramentas

- Burp → Intruder *(limitado no Community)*  
- Caido → Automate  

---

## 🚀 FFUF x AUTOMATE (Caido)

### 💣 FFUF — ideal para:

- Fuzzing de diretórios/arquivos  
- Descoberta de subdomínios (vhosts)  
- Grande volume de dados  

---

### 🤖 AUTOMATE — ideal para:

- Ataques de lógica de negócios  
- Bypass de WAF e filtros  
- Poucos payloads com muita análise  

---

## 🧪 Como utilizar (Caido)

### 📍 Passos

1. HTTP History → `Ctrl + M` (Send to Automate)  
2. Identifique o dado para fuzzing  
3. Adicione um placeholder:

```

id=1 → id={{1}}

```

---

## 📦 Payloads

Na lateral direita:

- Adicionar wordlist manualmente  
- Upload de arquivo  
- Intervalo de números  

📁 Para adicionar arquivos:
- Menu esquerdo → **Files**

---

## 🔍 Resultado

É possível filtrar com regex:

```

resp.code.eq:200

```

---

## 🔁 Avançado

- Suporte a múltiplos placeholders  
- Uso de múltiplas wordlists  

---

# 🕷️ SCANNER

## 🟠 Burp

- Possui scanner e crawler  
- Scanner ativo e passivo  
- Geração de relatórios  

---

## 🔵 Caido

- ❌ Não possui scanner/crawler completo  
- ✅ Possui **Workflow**

---

## ⚙️ WORKFLOW NO CAIDO

Serve para automatizar tarefas repetitivas.  
Funciona como blocos de montagem (nós).

### 🧩 Possibilidades

- 🔄 Alterar parâmetros automaticamente  
- 🎨 Colorir saída de requisições específicas  
- 📜 Executar scripts em JavaScript  
- 💻 Rodar comandos shell  




