# 🔓 Casos Reais de IDOR e Falhas de Access Control (Facebook & Instagram)

## 📌 Visão Geral

Esses três casos mostram como falhas de **Broken Access Control (BAC)** podem levar a:

* Vazamento de arquivos privados
* Acesso a conteúdos restritos
* Geração indevida de tokens de acesso

👉 Em todos os cenários, o problema central é o mesmo:
**o servidor não valida corretamente se o usuário tem permissão**

---

# 💬 1. Facebook Messenger — Vazamento de Anexos Privados

## 🚩 Ponto de Partida

* Nova funcionalidade: **chat bot**
* Possibilidade de **anexar arquivos**

---

## 🔍 Descoberta

Ao interceptar a requisição:

```http
image_ids[0]=123
```

💡 O ID representa a imagem enviada

---

## 🧪 Exploração

### 🔥 Ideia:

> “E se eu trocar esse ID por outro?”

### ✔ Passos:

1. Obter ID de outro arquivo (outra conta / brute force)
2. Substituir na requisição:

```http
image_ids[0]=999
```

### 💣 Resultado:

* A imagem de outro usuário aparece no chat
* Acesso indevido a arquivos privados

---

## 📂 Testes adicionais

* Funcionou com:

  * Imagens
  * Arquivos de texto

---

## ⚠️ Vulnerabilidade

* Falha de **Broken Access Control**
* O servidor **não valida a autorização**

👉 Não verifica:

* Quem enviou a requisição
* Se o usuário tem acesso ao arquivo

---

## 🌍 Impacto

* Afeta **todos os chats**
* Exposição massiva de dados

---

# 📸 2. Instagram — Acesso a Posts/Stories Privados

## 🚩 O que era possível?

* Ver:

  * Posts
  * Reels
  * Stories

👉 Mesmo se:

* Conta privada 🔒
* Conteúdo arquivado 🗄️

---

## 🔍 Técnica

Tudo girava em torno de um:

```text
media_id
```

👉 Identificador único do conteúdo

---

## 🌐 Endpoint explorado

```http
POST https://i.instagram.com/api/v1/ads/graphql/
```

💡 Endpoints de ads costumam ter regras diferentes (mais permissivos)

---

## 🧪 Exploração

### ✔ Passos:

1. Descobrir `media_id`

   * Aplicação
   * Fuzzing
   * Requisições interceptadas

2. Enviar POST para API

---

## 💣 Resultado

O response retornava:

* Comentários
* Dados da postagem
* URL direta do CDN
* Informações vinculadas ao Facebook

👉 Acesso direto ao conteúdo privado

---

## 🛠️ Correção (parcial)

* Adicionaram:

```text
access_token
```

---

## 🔓 Bypass

```text
access_token = null
```

💥 Resultado:

* Dados ainda eram retornados

👉 Proteção ineficaz

---

# 🔑 3. Facebook — Geração de Token para Qualquer Usuário

## 🚩 Contexto

Ferramenta: **Rights Manager**

* Gerencia conteúdo de páginas
* Detecta pirataria
* Age automaticamente

👉 Precisa de:

```text
Page Access Token
```

---

## 🔍 Funcionamento normal

Requisição:

```http
POST /authorization
```

Envia:

```json
{
  "page_id": "123"
}
```

Resposta:

```json
{
  "access_token": "TOKEN"
}
```

---

## 💥 Vulnerabilidade

👉 O endpoint **não valida o tipo do ID**

### Problema:

* Esperado: ID de página
* Aceito: ID de usuário 😬

---

## 🧪 Exploração

1. Interceptar requisição
2. Alterar:

```json
"page_id": "USER_ID"
```

---

## 💣 Resultado

* Token gerado para um usuário

---

## ⚠️ Impacto

Não era acesso total, mas permitia:

* Ver dados pessoais
* Acessar mídia privada
* Informações sensíveis

---

# 🧠 Conexão entre os 3 casos

## 🔗 Padrão comum

Todos envolvem:

* Referência direta (ID)
* Falta de validação de autorização

👉 Isso é **IDOR + Broken Access Control**

---

# 💥 Impactos gerais

* Vazamento de arquivos
* Espionagem de conteúdo privado
* Geração indevida de tokens
* Possível escalada de privilégios

---

# 🔍 Como identificar vulnerabilidades assim

## 🎯 1. Parâmetros suspeitos

* `image_ids`
* `media_id`
* `user_id`
* `page_id`

👉 Sempre tente alterar

---

## 🌐 2. APIs internas

* Especialmente:

  * Ads
  * Admin
  * Ferramentas internas

---

## 🔑 3. Tokens e autenticação

* Testar:

  * Token inválido
  * Token nulo
  * Token de outro usuário

---

## 🔄 4. Testes clássicos

* Trocar IDs
* Usar outra conta
* Fuzzing
* Requisições diretas (Burp/Caido)

---

# 🎓 Lições Importantes

## 🔐 Para defesa

* Validar autorização no backend
* Nunca confiar em IDs vindos do cliente
* Tokens devem ser obrigatórios e validados corretamente
* Verificar tipo do objeto (user vs page)

---

## 🧪 Para Bug Bounty

* Sempre pense:

  > “E se eu trocar esse ID?”

* Explore:

  * APIs internas
  * Funcionalidades novas
  * Endpoints de ads

* Teste bypass:

  * `null`
  * valores vazios
  * tipos errados

---

# 🧠 Resumo Final

> IDOR não é sobre “adivinhar IDs”
> É sobre o sistema **não verificar quem deveria acessar o quê**

