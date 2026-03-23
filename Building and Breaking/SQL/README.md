# 🧠 Curso de SQL — (Foco em Cybersecurity)

## 🎯 Objetivo de Estudo

Curso baseado no canal **Téo Me Why (Téo Calvo)** com foco em:

> 🔥 **Building and Breaking** → entender para explorar vulnerabilidades

---

## 📚 Tópicos Prioritários

### ✅ Essenciais

- `SELECT` + `WHERE`
- `AND` / `OR` / `LIKE` / `IN`
- `INSERT`, `UPDATE`, `DELETE`
- `GROUP BY` + funções

### 🔥 Muito Importantes (Pentest)

- `JOIN`
- `SUBQUERY`

---

# 🗄️ O que é um SGBD?

**SGBD (Sistema de Gerenciamento de Banco de Dados)**:

- Gerencia bancos de dados
- Controla acesso, armazenamento e manipulação

## 🧰 Exemplos:

- MySQL
- MariaDB
- Oracle

---

# ⚙️ Estrutura do Banco de Dados

## 🖥️ Instância

> Ambiente onde o SGBD está rodando

- Pode conter **vários databases**

---

## 📦 Database

> Conjunto organizado de dados

- Cada database possui suas próprias tabelas

---

## 📊 Tabelas

> Estrutura principal de armazenamento

- **Linhas (entidades)** → dados
- **Colunas (atributos)** → propriedades

---

# 🧩 O que é SQL?

**SQL (Structured Query Language)**:

- Linguagem de consulta
- ❌ Não é linguagem de programação
- Usada para interagir com bancos de dados

---

# 🔧 Elementos do SQL

## 📌 Comandos

Executam ações no banco:

```sql
SELECT
INSERT
UPDATE
DELETE
```

---

## 📌 Cláusulas

Refinam os comandos:

```sql
FROM
WHERE
GROUP BY
```

---

## 📌 Expressões

Realizam operações:

```sql
A + B
A * B
```

---

## 📌 Predicados

Retornam verdadeiro ou falso:

```sql
A > B
C BETWEEN 20 AND 200
```

---

## 📌 Queries

> Conjunto completo de instruções SQL

```sql
SELECT coluna FROM tabela;
```

---

# 🧬 Tipos de Dados

| Tipo      | Descrição         |
| --------- | ----------------- |
| int       | números inteiros  |
| float     | números decimais  |
| string    | texto             |
| boolean   | true / false      |
| date      | data              |
| timestamp | data + hora       |
| null      | ausência de valor |

⚠️ `NULL` ≠ `0`

---

# 🔑 Estruturas Importantes

## 🆔 Primary Key (PK)

- Identificador único
- Não pode se repetir

---

## 🔗 Foreign Key (FK)

- Referência a uma **Primary Key**
- Cria relacionamento entre tabelas

📌 Regra:

> Uma FK sempre aponta para uma PK

---

# 🧠 Resumo

| Conceito  | Explicação                     |
| --------- | ------------------------------ |
| SGBD      | Gerencia bancos de dados       |
| Instância | Ambiente do SGBD               |
| Database  | Conjunto de dados              |
| Tabela    | Estrutura com linhas e colunas |
| SQL       | Linguagem de consulta          |
| PK        | Identificador único            |
| FK        | Relacionamento entre tabelas   |

---

# 📌 Criação de Arquivo

- Banco SQLite → extensão: `.sqlite` (ou `.db`)
- Scripts SQL → extensão: `.sql`

📌 No VS Code:

- Executar queries: `Ctrl + Shift + Q`
- Pode ser necessário selecionar o **database**

---

# 🧠 Comandos Básicos

## 🔎 SELECT

Usado para **selecionar dados**.

```sql
SELECT 'olá mundo';
SELECT 1 + 1 * 10;
```

📌 Observações:

- Não precisam de tabela
- O resultado aparece abaixo
- O cabeçalho mostra a expressão

---

# 📊 Selecionando Dados de Tabelas

## 📌 Todas as colunas

```sql
SELECT * FROM clientes;
```

- `*` → todas as colunas
- `clientes` → nome da tabela

---

## 📌 Colunas específicas

```sql
SELECT idcliente, QtdePontos FROM clientes;
```

📌 Seleciona apenas os atributos desejados

---

# 📋 Listar Tabelas

## SQLite:

```sql
.tables
```

## MySQL:

```sql
SHOW TABLES;
```

📌 `.tables` não retorna dados, apenas lista

---

# 🔢 Limitando Resultados

```sql
SELECT * FROM clientes
LIMIT 10;
```

📌 Retorna apenas:

- As **10 primeiras linhas**

⚠️ Regra:

> `LIMIT` deve ser o **último elemento da query**

---

# 🧩 Ponto e Vírgula (`;`)

Usado para separar múltiplas queries:

```sql
SELECT idcliente FROM clientes;
SELECT 'testando';
```

---

# 💬 Comentários

## 📌 Linha única

```sql
-- comentário
```

---

## 📌 Bloco

```sql
/* comentário
   em várias linhas */
```

⚠️ Regra:

> A última linha do arquivo **não deve ser comentário**

---

# 🧠 Resumo

| Conceito     | Explicação             |
| ------------ | ---------------------- |
| SELECT       | Selecionar dados       |
| \*           | Todas as colunas       |
| FROM         | Define tabela          |
| LIMIT        | Limita resultados      |
| .tables      | Lista tabelas (SQLite) |
| ;            | Finaliza query         |
| -- / /\* \*/ | Comentários            |

---

# 🔍 WHERE (Filtrando Dados)

A cláusula **WHERE** é usada em SQL para **filtrar registros (linhas)** em uma consulta.

🎯 **Objetivo:**
Retornar apenas os dados que atendem a uma **condição específica**.

---

# 🧩 Sintaxe Básica

```sql
SELECT * FROM tabela
WHERE coluna = 'valor';
```


📌 Interpretação:

- `SELECT *` → seleciona todas as colunas
- `FROM tabela` → define a tabela
- `WHERE` → aplica um filtro

---

## ⚠️ Regras Importantes

- `'valor'` → **aspas simples = valor**
- `"coluna"` → **aspas duplas = nome de coluna (dependendo do SGBD)**
- Comparações podem ser:
  - `=` → igual
  - `!=` → diferente
  - `>=` → maior igual
  - `<=` → menor igual

---

## 🧠 Exemplo

```sql
SELECT * FROM usuarios
WHERE nome = 'teste';
```

✔️ Retorna todos os usuários com nome **teste**

---

## 🔤 Case Sensitive

⚠️ Dependendo do banco:

- Pode diferenciar **maiúsculas/minúsculas**
- `'Teste'` ≠ `'teste'`

---

# 🔗 Combinando Filtros

## 🔹 OR (OU)

```sql
WHERE coluna = 'teste1' OR coluna = 'teste2';
```

✔️ Retorna registros que atendem **qualquer uma das condições**

---

## 🔹 IN (Lista de valores)

```sql
WHERE coluna IN ('valor1', 'valor2', 'valor3');
```

✔️ Equivalente a vários `OR`

---

## 🧠 Exemplo

```sql
SELECT * FROM usuarios
WHERE nome IN ('ana', 'joao', 'maria');
```

---

# 🔎 Buscas Parciais com LIKE

A cláusula **LIKE** permite buscar padrões em textos.

---

## 🔹 Começa com

```sql
WHERE coluna LIKE 'Teste%';
```

✔️ Retorna valores que **começam com "Teste"**

---

## 🔹 Termina com

```sql
WHERE coluna LIKE '%Teste';
```

✔️ Retorna valores que **terminam com "Teste"**

---

## 🔹 Contém (no meio)

```sql
WHERE coluna LIKE '%Teste%';
```

✔️ Retorna valores que **contêm "Teste" em qualquer posição**

---

## 🧠 Coringa (%)

- `%` → representa **qualquer quantidade de caracteres**

---

````
