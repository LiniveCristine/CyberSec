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

