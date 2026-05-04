# 🔐 Introdução ao IDOR (Insecure Direct Object References)

## 📌 O que é IDOR?

**IDOR (Insecure Direct Object References)** é uma vulnerabilidade onde:

* O sistema expõe diretamente a referência de um objeto
* O usuário consegue **manipular essa referência**
* E acessar **dados de outros usuários**

👉 Faz parte de:

* **Broken Access Control (BAC)**

---

## 🧠 Conceito-chave

> IDOR acontece quando o sistema **não valida se o usuário tem permissão** para acessar aquele recurso.

---

## 🎯 Exemplo clássico

```url
download?file_id=123
```

💡 Problema:

* Se existe `123`, provavelmente existem:

  * `122`, `121`, `124`...

👉 Teste:

```url
download?file_id=122
```

🚨 Se acessar arquivo de outro usuário = **IDOR confirmado**

---

## ⚠️ Quando vira IDOR?

Para ser IDOR, precisa de:

1. 🔓 Referência direta ao objeto (ID, nome, etc.)
2. ❌ Falha no controle de acesso

👉 O sistema **não verifica**:

* Quem é o usuário
* Se ele tem permissão

---

## 💥 Impactos do IDOR

### Information Disclosure

* Acesso a dados de outros usuários

### Modificação de dados

* Alterar informações privadas

### Exclusão de dados

* Deletar recursos

### Escalação de privilégios

* Acessar funções de admin

### Account Takeover (ATO)

* Resetar senha
* Controlar conta de terceiros

---

# 🔍 Como identificar IDOR

## 🌐 1. Parâmetros na URL / API

Fique atento a:

```url
?uid=1
?file=report.pdf
?id=123
```

👉 Estratégia:

* Alterar valores (manual ou fuzzing)

Ferramentas:

* ffuf
* Burp Suite
* Caido

---

## ⚡ 2. Camadas AJAX

### O que é AJAX?

* Permite atualizar partes da página sem reload
* Usa requisições em background

### Problema comum:

* Endpoints sensíveis expostos no JavaScript

👉 Exemplo:

```js
$.ajax({
    url: "admin/api/users",
})
```

💡 Mesmo que não apareça na interface:

* Pode ser acessado diretamente

---

## 🔐 3. Hashing e Codificação

Exemplo:

```url
download.php?filename=c81e728d9d4c2f636f067f89cc14862c
```

Parece seguro… mas:

```js
data: {filename: CryptoJS.MD5('file_1.pdf')}
```

👉 Conclusão:

* Hash pode ser reproduzido
* Não é proteção real

---

## 🧪 Dica prática

✔ Use **duas contas diferentes**:

* Usuário A
* Usuário B

👉 Compare acessos entre elas

---

# 🛠️ Técnicas de Exploração

## 📁 1. Static File IDOR

Arquivos seguem padrão previsível:

```url
/documents/Invoice_1_09_2021.pdf
/documents/Report_1_10_2021.pdf
```

👉 Ataque:

* Alterar `uid`
* Enumerar arquivos

---

### 💻 Automação (exemplo)

```bash
#!/bin/bash

url="http://SERVER_IP:PORT"

for i in {1..10}; do
    for link in $(curl -s "$url/documents.php?uid=$i" | grep -oP "\/documents.*?.pdf"); do
        wget -q $url/$link
    done
done
```

💡 O que acontece:

* Loop em usuários
* Extrai links com `grep`
* Baixa arquivos com `wget`

---

## 🔌 2. IDOR em APIs

### 📖 Information Disclosure

* Ler dados de outros usuários

### ⚙️ Insecure Function Calls

* Executar ações como outro usuário

---

### 🧪 Exemplo de resposta da API:

```json
{
    "uid": 1,
    "role": "employee",
    "email": "user@email.com"
}
```

👉 Testes importantes:

* Alterar `uid`
* Alterar `role`
* Testar métodos HTTP:

  * GET
  * POST
  * PUT
  * DELETE

---

### 🎯 Exemplo de endpoint:

```url
/profile/api.php/profile/5
```

👉 Teste:

* `/profile/1`
* `/profile/2`

🚨 Se retornar dados → IDOR

---

## 🔄 3. Manipulação de Parâmetros Sensíveis

Fique de olho em:

* `uid`
* `role`
* `uuid`
* cookies

👉 Se estiverem no request:

* Tente modificar

---

# 🔗 Chaining (Encadeamento)

## Ideia:

Usar um IDOR para explorar outro

### Exemplo:

1. IDOR → pega dados de admin
2. Usa esses dados → muda senha
3. Resultado → **Account Takeover**

---

## 🎯 Casos comuns:

* Vazamento de dados → escalada de privilégio
* Acesso a API → ações administrativas
* Dados financeiros → fraude

---

# 🧠 Resumo Final

## 🔗 Fluxo de exploração

1. Identificar parâmetro controlável
2. Testar outros valores (fuzzing)
3. Verificar ausência de controle de acesso
4. Explorar:

   * leitura
   * modificação
   * exclusão
5. Encadear com outras falhas

---

