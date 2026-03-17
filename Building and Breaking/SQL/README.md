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
