# 🍪 CSRF — Cross Site Request Forgery

## 📖 O que é?

**CSRF (Cross Site Request Forgery)** significa:

```text id="b5i27e"
Falsificação de Requisição Entre Sites
```

É um ataque que força um usuário autenticado a executar ações indesejadas em uma aplicação.

---

# 🧠 Como isso é possível?

## 🔑 Confiança excessiva no cookie

Quando um usuário faz login:

1. o servidor cria um cookie de sessão;
2. o navegador armazena esse cookie;
3. toda requisição futura envia esse cookie automaticamente.

---

## ⚠️ Problema

O navegador adiciona o cookie:

* automaticamente;
* independentemente da origem da requisição.

Ou seja:

```text id="n9fy1e"
se a requisição vier de outro site,
o cookie ainda pode ser enviado
```

---

# ⚙️ Como o ataque funciona?

## 🌐 Cenário

Temos:

* Site legítimo:

  ```text id="1n7v33"
  bancolegitimo.com
  ```

* Site malicioso:

  ```text id="fym7op"
  sitemalicioso.com
  ```

---

## 👤 Situação do usuário

O usuário:

* está logado no banco;
* possui um cookie de sessão válido.

---

## 💣 Ataque

1. o usuário acessa o site malicioso;
2. o site malicioso envia uma requisição para o banco;
3. o navegador adiciona o cookie automaticamente;
4. o banco acredita que a ação foi feita pelo usuário legítimo.

---

# 🔄 Fluxo do Ataque

```text id="f8z2tx"
Usuário logado → acessa site malicioso →
payload escondido envia request →
cookie é anexado automaticamente →
ação executada no site legítimo
```

---

# 🖼️ Exemplo com GET

## 💸 Transferência bancária

A aplicação usa GET:

```http id="y73k5j"
http://bancolegitimo.com/transferir?destino=fulano&valor=1000
```

---

## 👨‍💻 Payload do atacante

```html id="9k82h7"
<img src="http://bancolegitimo.com/transferir?destino=hacker&valor=1000" width="0" height="0" />
```

---

## 🔍 O que acontece?

Ao carregar a imagem:

1. o navegador acessa a URL;
2. o cookie da sessão é enviado;
3. a transferência é executada.

---

# 📨 Exemplo com POST

## 🧾 Formulário falso

```html id="6d03z6"
<form id="formularioAtaque"
action="http://bancolegitimo.com/transferir"
method="POST">

    <input type="hidden" name="destino" value="hacker" />
    <input type="hidden" name="valor" value="1000" />
</form>

<script>
document.getElementById('formularioAtaque').submit();
</script>
```

---

## ⚠️ Resultado

O formulário é enviado automaticamente sem interação do usuário.

---

# 🛡️ Proteções Contra CSRF

# 🔐 Anti-CSRF Token

## Como funciona?

O servidor cria um token único para cada formulário legítimo.

Esse token:

* é enviado junto da página;
* deve acompanhar a requisição;
* é validado pelo servidor.

---

## 📌 Fluxo

```text id="vl7v6h"
Cookie válido + Token válido = requisição aceita
```

---

## 🚫 Problema para o atacante

O atacante consegue forçar o cookie…

MAS:

```text id="th0dyv"
não consegue acessar o token legítimo
```

Porque o token está na página original do site.

---

# 🍪 SameSite Cookie

## O que faz?

Define que o cookie só deve ser enviado:

* em requisições originadas do próprio site.

---

## 🎯 Objetivo

Impedir que:

```text id="1v8b8w"
sites externos enviem cookies automaticamente
```

---

# 🔍 Como identificar a vulnerabilidade?

# ⚠️ Buscar mudança de estado (Side Effect)

CSRF normalmente afeta funcionalidades que alteram dados.

---

## Exemplos comuns

* alteração de senha;
* atualização de e-mail;
* exclusão de conta;
* publicação de posts;
* adicionar itens ao carrinho;
* transferências bancárias.

---

# 🍪 Sessão baseada em Cookie

## Vulnerável

Aplicações que usam:

```text id="qqg32m"
cookies automáticos de sessão
```

são alvos clássicos de CSRF.

---

# 🔑 JWT e CSRF

## Situação comum

Quando o JWT é enviado manualmente no header HTTP:

```http id="s5m5jp"
Authorization: Bearer TOKEN
```

o CSRF se torna muito mais difícil.

---

## 🧠 Motivo

O navegador NÃO adiciona automaticamente esse header.

---

# 🚨 Atenção aos Tokens

Nomes comuns:

```text id="kn07cq"
csrf
xsrf
_token
csrf_token
```

A presença desses parâmetros pode indicar proteção CSRF.

---

# 🔮 Previsibilidade

## O que significa?

A requisição precisa ser previsível.

Ou seja:

* o atacante deve conseguir reproduzir exatamente o request legítimo.

---

## Exemplos

Precisamos conhecer:

* parâmetros;
* nomes dos campos;
* método HTTP;
* formato do request.

---

# 🧪 Testes para Identificação

# 1️⃣ Remover o Token

Enviar a requisição:

* sem token;
* com token vazio;
* com token inválido.

---

## Resultado esperado

Se funcionar mesmo assim:

```text id="0m7q7v"
possível vulnerabilidade CSRF
```

---

# 2️⃣ Alterar Método HTTP

Exemplo:

```text id="pyl0lg"
POST → GET
```

Algumas aplicações aceitam ambos os métodos indevidamente.

---

# 📌 Resumo Rápido

| Conceito           | Explicação                           |
| ------------------ | ------------------------------------ |
| CSRF               | Forçar ações usando sessão da vítima |
| Principal causa    | Cookies enviados automaticamente     |
| Requisito          | Usuário autenticado                  |
| Ataque comum       | Formulários ou imagens ocultas       |
| Proteção principal | Anti-CSRF Token                      |
| Defesa adicional   | SameSite Cookies                     |
| Alvos comuns       | Mudanças de estado                   |

---

# 🧠 Ideia Central

> CSRF explora a confiança do navegador nos cookies de sessão para executar ações em nome do usuário autenticado sem seu consentimento.
