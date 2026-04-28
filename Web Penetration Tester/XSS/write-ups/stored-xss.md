# 📚 XSS no Facebook via PNG

🔗 Artigo: XSS on Facebook via PNG Content-Types

---

## 🌐 Onde os arquivos ficam

* O Facebook utiliza um **CDN (Content Delivery Network)** para servir conteúdos estáticos.
* Domínio comum:

  * `fbcdn.net`

💡 **CDN** = rede de servidores distribuídos que entrega conteúdo mais rápido e escalável.

---

## 🧪 Manipulação da extensão

### 🔍 Descoberta importante

* A maioria das imagens tinha **parâmetros de proteção** que impediam alterações.
* Porém, **imagens de anúncios NÃO tinham essa proteção**.

### 💥 Exploração

O atacante conseguiu alterar:

```
image/png  →  text/html
```

E acessar:

```
imagem.png → imagem.html
```

👉 Isso muda como o navegador interpreta o conteúdo.

---

## ⚠️ Por que isso é um problema?

* O navegador passa a interpretar a imagem como **HTML**
* Se existir código escondido:

  * `<script>`
  * tags HTML

💣 Ele será executado!

---

## 🚧 Obstáculo: Compressão do Facebook

* O Facebook:

  * comprime imagens
  * remove metadados

❌ Isso destrói payloads simples (ex: comentários da imagem)

---

## 🧠 Entendendo a anatomia do PNG

Um PNG é dividido em **chunks (blocos)**:

| Chunk | Função                               |
| ----- | ------------------------------------ |
| IHDR  | Dimensões                            |
| PLTE  | Paleta de cores                      |
| IDAT  | Dados da imagem (pixels comprimidos) |

🔥 **IDAT = coração da imagem**

---

## 💣 O desafio do payload

### ❌ Não funciona:

* Inserir payload em:

  * metadados
  * comentários

👉 Porque são removidos

---

## ✅ Solução: Payload dentro do IDAT

Problema:

* O IDAT é **comprimido (DEFLATE)**

👉 O payload não permaneceria legível

---

## 🧬 Técnica usada: “Criptoanálise reversa”

### 🔁 Ideia:

Em vez de:

```
Texto → Compressão → Binário
```

O atacante fez:

```
Binário calculado → Compressão → Texto (payload válido)
```

### 💡 Como?

* Calculou quais pixels (cores) gerariam:

  ```
  <script>alert(1)</script>
  ```

  **após a compressão**

🔥 O payload virou “pixels legítimos”

---

## 🚀 Execução do ataque

1. Upload da imagem
2. Passa pela compressão
3. Payload “renasce” após compressão
4. Armazenado no servidor → **Stored XSS**

---

## 🎯 Trigger final

Basta acessar:

```
imagem.png → imagem.html
```

👉 O navegador:

* interpreta como HTML
* executa o payload

---

## 🧠 Conceitos-chave

* Content-Type confusion
* Stored XSS
* Compressão DEFLATE
* Engenharia reversa de dados

---

---

# 🚗 Uber Bug Bounty: Transformando Self-XSS em Stored XSS

🔗 Artigo: Uber: Turning Self-XSS into Good XSS

---

## 📍 Onde está a vulnerabilidade?

* Portal de parceiros da Uber:

  * `partners.uber.com`

### 💥 XSS encontrado:

```html
<script>alert(document.domain);</script>
```

---

## 🤔 Problema: Self-XSS

* Só o próprio usuário vê o payload
* Impacto baixo

🎯 Objetivo:
➡️ Fazer **outras pessoas executarem o payload**

---

## 🔗 Ideia: usar CSRF

### 📌 Cross-Site Request Forgery

* Força o navegador da vítima a executar ações sem consentimento

---

## ❗ Falha crítica: ausência de `state`

* No fluxo de autenticação:

  * deveria existir um parâmetro `state`
* Ele garante integridade da sessão

❌ Não existia → vulnerável a CSRF

---

## 🔐 Entendendo o fluxo de autenticação

Dois domínios principais:

* `login.uber.com` → autenticação central
* `partners.uber.com` → portal

💡 Se autenticado no login → acesso liberado no ecossistema

---

## 🧩 Problema avançado

O atacante queria:

✔️ Logar a vítima na conta dele
❌ Sem deslogar a vítima da própria conta

---

## 🧠 Solução criativa

### 🔒 Bloquear domínio:

* Bloqueia `login.uber.com`

👉 Resultado:

* logout não completa totalmente
* sessão principal da vítima permanece ativa

---

## ⚙️ Payload passo a passo

### 1. 🔓 Logout forçado

* Remove sessão do `partners.uber`

### 2. 🔑 Login na conta do atacante

* Vítima entra automaticamente

### 3. 💣 Execução do XSS

* Payload roda

### 4. 🔄 Restaurar sessão da vítima

* Via iframe
* Login automático (sessão ainda válida)

---

## 🛡️ Por que funciona?

### 📌 Same-Origin Policy (SOP)

* Scripts podem acessar dados do mesmo domínio

👉 O iframe roda em `partners.uber.com`

🔥 Resultado:

* script malicioso acessa dados da vítima

---

## 🎯 Resultado final

* Self-XSS → Stored/real XSS
* Acesso a dados da vítima
* Execução invisível

---

## 🧠 Conceitos-chave

* Self-XSS vs Stored XSS
* CSRF
* OAuth flaws (`state` ausente)
* Same-Origin Policy
* Manipulação de sessão

---

# 🧩 Conexões importantes entre os dois casos

| Facebook               | Uber                  |
| ---------------------- | --------------------- |
| Content-Type confusion | CSRF + Auth flaw      |
| Manipulação de binário | Manipulação de sessão |
| PNG → HTML             | Login forçado         |
| Stored XSS             | Escalada de impacto   |

---

# 🧠 Insight final

Ambos os casos mostram:

> 🔥 **XSS não é só sobre `<script>` — é sobre contexto, fluxo e criatividade**

* Facebook: exploração de **formato + compressão**
* Uber: exploração de **autenticação + comportamento do navegador**

