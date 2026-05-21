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
