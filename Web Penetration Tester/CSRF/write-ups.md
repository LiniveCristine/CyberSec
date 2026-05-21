# 🔓 Bypassing GitHub's OAuth

📚 Referência original:
[Bypassing GitHub's OAuth — Teddy Katz](https://blog.teddykatz.com/2019/11/05/github-oauth-bypass.html?utm_source=chatgpt.com)

---

# 🧠 O que é OAuth?

OAuth é um mecanismo de autorização utilizado para permitir que aplicações terceiras acessem dados de outra plataforma.

Exemplo comum:

```text id="g8xtl5"
"Entrar com Google"
"Entrar com GitHub"
```

---

# 🎯 Objetivo do OAuth

Permitir que um site terceiro:

* autentique usuários;
* utilize dados da conta;
* acesse recursos autorizados.

---

## 🔐 Importante

O nível de acesso depende das permissões concedidas.

Exemplos:

* acesso ao perfil;
* e-mail;
* repositórios privados;
* organizações;
* permissões administrativas.

---

# ⚙️ Fluxo do OAuth

# 1️⃣ Usuário inicia login

Ao clicar em:

```text id="hvl3bo"
"Login com GitHub"
```

o fluxo OAuth começa.

---

# 2️⃣ Redirecionamento

O usuário é enviado para:

```http id="k1wy0u"
GET /login/oauth/authorize
```

---

# 3️⃣ Página de autorização

O GitHub exibe:

```text id="lshv1h"
Botão "Authorize"
```

---

# 4️⃣ Clique no botão

Ao clicar:

* uma requisição POST é enviada;
* para o mesmo endpoint.

```http id="fhzzwi"
POST /login/oauth/authorize
```

---

# 5️⃣ Backend processa autorização

O servidor:

* confirma a identidade do usuário;
* aprova o aplicativo;
* gera um token OAuth.

---

# 🧱 Framework Ruby on Rails

O Ruby on Rails possui um comportamento importante relacionado aos métodos HTTP.

---

# 🔍 Comportamento do método HEAD

No Rails:

```text id="hz3r4q"
HEAD é tratado internamente como GET
```

---

## ⚠️ Diferença

A única diferença é:

| Método | Resposta       |
| ------ | -------------- |
| GET    | Body + Headers |
| HEAD   | Apenas Headers |

---

# 💥 Onde surgiu o problema?

O problema apareceu por causa de uma incompatibilidade entre:

* o framework;
* e a lógica do backend.

---

# 🧠 Lógica do Backend

O endpoint:

```http id="2t6x0t"
/login/oauth/authorize
```

era usado em dois momentos:

| Método | Função              |
| ------ | ------------------- |
| GET    | Mostrar página      |
| POST   | Aprovar autorização |

---

## Possível lógica usada

```python id="ms6f9l"
if metodo == GET:
    mostrar_pagina()
else:
    aprovar_autorizacao()
```

---

# ⚠️ Erro da lógica

O backend assumia:

```text id="j1if7l"
"Se não for GET, então deve ser POST"
```

Mas isso não é verdade.

Existem outros métodos HTTP:

* HEAD
* PUT
* DELETE
* OPTIONS
* PATCH

---

# 🐱 O pulo do gato

O pesquisador Teddy Katz enviou uma requisição:

```http id="f06htf"
HEAD /login/oauth/authorize
```

---

# 🔄 O que aconteceu?

# 🧱 Passo 1 — Framework Rails

O Rails tratou:

```text id="m1h82n"
HEAD como GET
```

Então a requisição chegou normalmente ao endpoint OAuth.

---

# 🧠 Passo 2 — Backend

O backend verificou:

```text id="0r7pc6"
É GET?
```

Resposta:

```text id="krlyje"
NÃO
```

---

# ❌ Conclusão errada

O sistema então assumiu:

```text id="1j7b1j"
"Então é POST"
```

E aprovou a autorização automaticamente.

---

# 🎟️ Resultado

O servidor retornava:

```text id="tqclvz"
token OAuth da vítima
```

sem o usuário clicar em “Authorize”.

---

# 🔥 Impacto

Com o token OAuth roubado, o atacante poderia:

* acessar dados da conta;
* acessar repositórios privados;
* clonar projetos;
* modificar código;
* injetar backdoors.

---

# 🌐 Cenário de Exploração

O atacante poderia criar:

```text id="kt4w1w"
site malicioso
```

Quando a vítima acessasse:

1. uma requisição HEAD seria enviada;
2. o OAuth aprovaria automaticamente;
3. o token seria retornado ao atacante.

---

# 💻 Exemplo Prático

## Listando repositórios privados

```bash id="iwg4a0"
curl -H "Authorization: token TOKEN_ROUBADO_DA_VITIMA" \
https://api.github.com/user/repos?type=private
```

---

## ⚠️ O que isso permite?

O atacante poderia:

* baixar projetos privados;
* roubar código-fonte;
* encontrar segredos;
* inserir código malicioso.

---

# 🛡️ Falha Principal

A vulnerabilidade foi causada por:

```text id="l4i5rz"
assumir que só existiam GET e POST
```

---

# ✅ Como prevenir?

# 1️⃣ Validar explicitamente métodos HTTP

❌ Errado:

```python id="azw9g2"
if metodo == GET:
    mostrar()
else:
    aprovar()
```

---

✅ Correto:

```python id="9e6fcv"
if metodo == GET:
    mostrar()

elif metodo == POST:
    aprovar()

else:
    bloquear()
```

---

# 2️⃣ Não confiar no comportamento do framework

Frameworks podem:

* alterar comportamento;
* abstrair lógica;
* tratar métodos de forma diferente.

---

# 3️⃣ Bloquear métodos inesperados

Aceitar apenas métodos necessários:

```text id="fdp61y"
GET
POST
```

---

# 📌 Resumo Rápido

| Conceito               | Explicação                             |
| ---------------------- | -------------------------------------- |
| OAuth                  | Delegação de autenticação/autorização  |
| Problema               | Backend assumia GET ou POST            |
| Comportamento do Rails | HEAD tratado como GET                  |
| Exploração             | HEAD burlava a lógica                  |
| Resultado              | Token OAuth liberado                   |
| Impacto                | Acesso à conta e repositórios privados |

---

# 💥 From Self-XSS to Account Takeover

📚 Artigo original:
[From Self-XSS to Account Takeover](https://medium.com/@splintercat/from-self-xss-to-account-takeover-c6488adc5737?utm_source=chatgpt.com)

---

# 🧠 Visão Geral

Esse caso mostra como vulnerabilidades consideradas “baixas” podem ser combinadas para gerar um impacto crítico.

O pesquisador transformou:

* um **Self-XSS**;
* ausência de proteção **CSRF**;
* e manipulação de cookies;

em um **Account Takeover**.

---

# 🧩 Ingredientes da Exploração

## 1️⃣ Self-XSS

Um campo do perfil era vulnerável a XSS.

Porém:

```text id="5em22o"
somente o próprio usuário conseguia visualizar o payload
```

---

## 2️⃣ Login sem proteção CSRF

O formulário de login:

* NÃO exigia token CSRF;
* aceitava apenas usuário e senha.

---

## 3️⃣ Alteração de e-mail protegida

A funcionalidade de troca de e-mail:

* exigia token CSRF válido.

---

# 🪞 Self-XSS

## 🔍 O que aconteceu?

O pesquisador encontrou um XSS em sua própria conta.

Exemplo:

```html id="wb8hgd"
<script>alert(1)</script>
```

---

## ⚠️ Problema

O payload só executava:

```text id="r5n2qk"
na própria sessão do atacante
```

Por isso muitos programas classificam Self-XSS como baixo impacto.

---

# 🎯 Objetivo do Pesquisador

Ele precisava fazer:

```text id="n4k18u"
outras pessoas executarem o payload
```

---

# 🔐 Descoberta Importante

O login NÃO possuía proteção CSRF.

Isso significava que qualquer site externo poderia enviar uma requisição de login automaticamente.

---

# 🌐 Forçando a Vítima a Logar na Conta do Hacker

# 💣 Ideia do ataque

O pesquisador criou:

```text id="0a0aqn"
site malicioso
```

com um formulário oculto contendo:

* usuário do atacante;
* senha do atacante.

---

## 🧾 Formulário automático

```html id="9mv6sm"
<form action="/login" method="POST">
  <input type="hidden" name="user" value="hacker">
  <input type="hidden" name="password" value="senha_hacker">
</form>
```

---

## ⚙️ Resultado

Quando a vítima acessava o site:

1. o formulário era enviado automaticamente;
2. a vítima era autenticada na conta do hacker;
3. o Self-XSS passava a executar no navegador da vítima.

---

# 🍪 Manipulação de Cookies

## ⚠️ Novo problema

Agora o XSS executava no navegador da vítima…

MAS:

```text id="u7e1v4"
a vítima ainda estava logada na conta do hacker
```

Isso impedia acesso aos dados reais da vítima.

---

# 🧠 Objetivo

O atacante precisava:

* restaurar a sessão legítima da vítima;
* sem perder o XSS.

---

# 🪝 Criando um Cookie Especial

O payload criou um novo cookie com:

```text id="t4epn9"
path=/perfil/vulneravel
```

---

## 🔍 O que isso faz?

Esse cookie só seria utilizado quando a vítima acessasse:

```text id="tmg5gk"
/perfil/vulneravel
```

---

# 🌉 A “ponte” do ataque

Esse cookie funcionava como:

```text id="7g9g8f"
uma ponte entre a vítima e o perfil vulnerável do hacker
```

---

## Resultado

Quando a vítima acessasse a área vulnerável:

* o navegador usaria o cookie do hacker;
* o XSS continuaria executando.

---

# 🗑️ Apagando o Cookie da Sessão do Hacker

## Problema

Após o login forçado:

```text id="l29zrm"
a vítima continuava autenticada como hacker
```

Precisávamos restaurar a sessão original.

---

# 🌊 Técnica: Cookie Jar Overflow

## 🧠 Conceito

Os navegadores possuem limite de cookies.

Quando o limite é atingido:

```text id="8yxhwb"
cookies antigos começam a ser removidos
```

---

# 💣 Exploração

O atacante enviou vários cookies até:

* o cookie principal da sessão do hacker ser apagado.

---

## ⚠️ Importante

O cookie especial:

```text id="b4d5ol"
path=/perfil/vulneravel
```

foi mantido.

---

# 🍪 Resultado Final dos Cookies

Agora existiam dois comportamentos:

| Área acessada        | Cookie usado              |
| -------------------- | ------------------------- |
| Site normal          | Sessão legítima da vítima |
| `/perfil/vulneravel` | Sessão do hacker          |

---

# 🔄 Consequência

A vítima:

* parecia estar em sua própria conta;
* mas o XSS continuava acessível em segundo plano.

---

# ☠️ Account Takeover

Agora o atacante tinha:

✅ XSS executando
✅ Sessão legítima da vítima
✅ Ponte para o perfil vulnerável

---

# 📥 Capturando o Token CSRF

O payload fez um:

```javascript id="f6mwnw"
fetch('/account/dashboard.php')
```

---

## 🎯 Objetivo

Ler o HTML da página e extrair:

```text id="6s2jja"
token CSRF da vítima
```

---

# 🔓 Alterando o E-mail

Com o token CSRF válido:

* o atacante podia simular ações legítimas.

---

# 📨 Payload de alteração

```javascript id="5s8y3m"
const form = document.createElement('form');

form.action = '/account/dashboard.php';
form.method = 'POST';

form.innerHTML = `
  <input type="hidden" name="csrf_token"
         value="${csrf_vítima}">

  <input type="hidden" name="email"
         value="email_do_hacker@atack.com">
`;

document.body.appendChild(form);
form.submit();
```

---

# ⚙️ Resultado Final

A requisição continha:

* cookie legítimo da vítima;
* token CSRF legítimo.

Logo:

```text id="wvb13m"
o e-mail da conta foi alterado
```

---

# 🔥 Impacto

Após trocar o e-mail, o atacante poderia:

* resetar senha;
* assumir totalmente a conta;
* realizar Account Takeover completo.

---

# 🛡️ Falhas que Permitiram o Ataque

| Falha                   | Impacto                 |
| ----------------------- | ----------------------- |
| Self-XSS                | Execução de JavaScript  |
| Login sem CSRF          | Login forçado           |
| Má gestão de cookies    | Persistência do XSS     |
| Token acessível via XSS | Bypass da proteção CSRF |

---

# 📌 Resumo Rápido

| Etapa               | Objetivo                   |
| ------------------- | -------------------------- |
| Self-XSS            | Executar JS                |
| Login CSRF          | Forçar vítima a logar      |
| Cookie especial     | Manter ponte com XSS       |
| Cookie Overflow     | Restaurar sessão da vítima |
| Roubo de CSRF Token | Executar ações legítimas   |
| Troca de e-mail     | Tomar conta da conta       |

---

