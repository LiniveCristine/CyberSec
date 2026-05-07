# 💉 SQL

---

# 📖 Introdução

O banco de dados é utilizado para tornar aplicações dinâmicas.

O backend envia consultas ao banco de dados para:

* recuperar informações,
* armazenar dados,
* montar respostas para o usuário.

---

# 🔄 Fluxo de funcionamento

```text id="q51mp6"
Cliente/Navegador → Servidor → Banco de Dados
Banco de Dados → Servidor → Cliente
```

### 📌 Exemplo:

1. Usuário pesquisa um produto
2. O servidor consulta o banco
3. O resultado é devolvido ao navegador

---

# ⚠️ Onde nasce o problema

Assim como em outras vulnerabilidades de injection (ex: XSS), o problema é:

* confiança excessiva no input do usuário.

A aplicação:

* recebe dados do usuário,
* monta uma query SQL,
* envia diretamente ao banco.

Um atacante pode manipular essa query e injetar comandos SQL.

---

# 🗄️ Tipos de Banco de Dados

## 📚 Relacional

Usa SQL.

Exemplos:

* MySQL
* MariaDB
* PostgreSQL

---

## 📦 Não Relacional (NoSQL)

Não utiliza SQL tradicional.

Exemplos:

* MongoDB
* Redis

---

# 🧠 Linguagem SQL

SQL é utilizada para:

* recuperar dados,
* atualizar dados,
* excluir registros,
* criar tabelas,
* criar databases,
* adicionar usuários,
* controlar permissões.

---

# ⚙️ Sistemas Gerenciadores de Banco (SGBD)

São softwares que entendem SQL.

## Exemplos:

* MySQL
* MariaDB
* PostgreSQL

---

# 🐬 Instalando MySQL

## 📥 Instalação

```bash id="v9y1h4"
sudo apt install mysql-server -y
```

---

## 🔍 Verificar status

```bash id="z8vqmw"
sudo systemctl status mysql
```

---

## 🖥️ Acessar o banco

```bash id="8vkhru"
sudo mysql
```

---

## 🌐 Porta padrão

```text id="9lh8z0"
3306
```

### Opções:

* `-P` → alterar porta
* `-h` → alterar host

---

# 🏗️ Criando Database

## ➕ Criar banco

```sql id="7wgf2o"
CREATE DATABASE users;
```

---

## 📋 Mostrar databases

```sql id="p3p5pv"
SHOW DATABASES;
```

---

## 🚪 Entrar em um database

```sql id="tmx5hj"
USE users;
```

---

## 🔎 Descobrir database atual

```sql id="yqu3jg"
SELECT DATABASE();
```

---

# 🧱 Tabelas

As tabelas armazenam dados organizados em colunas.

Cada coluna possui um tipo específico:

* números,
* strings,
* datas,
* horas,
* dados binários.

---

# 🛠️ Criando tabela

```sql id="8gnbq0"
CREATE TABLE logins(
    id INT,
    username VARCHAR(100),
    password VARCHAR(100),
    date_of_joining DATETIME
);
```

---

# 📑 Mostrar tabelas

```sql id="s7i8ho"
SHOW TABLES;
```

---

# 🔬 Ver estrutura da tabela

```sql id="92igzv"
DESCRIBE logins;
```

---

# 🔐 Propriedades importantes

## 🚫 NOT NULL

Campo obrigatório.

```sql id="d7i3y2"
id INT NOT NULL
```

---

## 🔢 AUTO_INCREMENT

Incrementa automaticamente.

```sql id="fhtw1t"
id INT AUTO_INCREMENT
```

---

## 🆔 UNIQUE

Valor único.

```sql id="m4j11v"
username VARCHAR(100) UNIQUE
```

---

## 🕒 DEFAULT

Valor padrão.

```sql id="5pyd0o"
date_of_joining DATETIME DEFAULT NOW()
```

---

## 🔑 PRIMARY KEY

Identificador único.

```sql id="8c6g9m"
PRIMARY KEY(id)
```

---

# 🧩 Alterando tabelas

## ➕ Adicionar chave primária

```sql id="d6q1g4"
ALTER TABLE logins ADD PRIMARY KEY(id);
```

---

## ➕ Adicionar coluna

```sql id="c4r6fd"
ALTER TABLE logins ADD COLUMN cpf VARCHAR(11);
```

---

## ✏️ Modificar coluna

```sql id="28jk9z"
ALTER TABLE logins MODIFY COLUMN id INT AUTO_INCREMENT;
```

---

## 🏷️ Renomear coluna

```sql id="v5z7z0"
ALTER TABLE logins RENAME COLUMN username TO user;
```

---

# 📜 SQL Statements

---

# ➕ INSERT

Adicionar registros.

```sql id="bbrjzq"
INSERT INTO logins VALUES (1, 'admin', 'password', '2026-05-02');
```

---

## 🎯 Inserindo colunas específicas

```sql id="trgx59"
INSERT INTO logins(username,password)
VALUES ('admin','password');
```

---

## ⚠️ Importante

Senhas devem ser:

* criptografadas,
* armazenadas com hash.

---

# 🔍 SELECT

Recuperar dados.

---

## 📦 Todos os registros

```sql id="v2m2m5"
SELECT * FROM logins;
```

---

## 🎯 Colunas específicas

```sql id="9hwb3w"
SELECT username,id FROM logins;
```

---

## 🌐 Consultar tabela de outro database

```sql id="a2qmdv"
SELECT * FROM cliente.pedidos;
```

---

# ❌ DROP

Remove tabelas.

```sql id="d4w3ic"
DROP TABLE logins;
```

---

# 🔄 UPDATE vs ALTER

| Comando | Função         |
| ------- | -------------- |
| ALTER   | Muda estrutura |
| UPDATE  | Muda dados     |

---

## ✏️ UPDATE

```sql id="81vwk5"
UPDATE logins
SET username='linive cristine'
WHERE id=1;
```

---

# 📊 Ordenando resultados

## 🔽 ORDER BY

```sql id="9e2m3q"
SELECT * FROM logins ORDER BY password;
```

---

## ⬇️ Ordem decrescente

```sql id="p6dz3z"
SELECT * FROM logins ORDER BY id DESC;
```

---

# 🎚️ Limitando resultados

## 🔢 LIMIT

```sql id="7ax4jx"
SELECT * FROM logins LIMIT 2;
```

Retorna:

* os 2 primeiros registros.

---

## ⏭️ OFFSET + LIMIT

```sql id="qbm8p6"
SELECT * FROM logins LIMIT 1,2;
```

Pula:

* 1 registro

Retorna:

* os próximos 2.

---

# 🎯 Cláusula WHERE

Filtrar registros.

```sql id="3cbwqe"
SELECT username,id
FROM logins
WHERE id > 1;
```

---

# 🔎 Cláusula LIKE

Buscar padrões.

---

## 🧩 Começa com “admin”

```sql id="6d9x1f"
SELECT * FROM logins
WHERE username LIKE 'admin%';
```

`%` = curinga

---

## 🔤 Exatamente 3 caracteres

```sql id="tm58jk"
SELECT * FROM logins
WHERE username LIKE '___';
```

`_` = um caractere

---

# ⚡ Operadores SQL

## 🧠 Operadores lógicos

* AND
* OR
* NOT

Símbolos:

* `&&`
* `||`
* `!`

---

## 🧪 Exemplo

```sql id="v9h8o4"
SELECT * FROM logins
WHERE username != 'paulo'
AND id > 10;
```

---

# 🧮 Outros operadores

| Operador | Função        |
| -------- | ------------- |
| +        | soma          |
| -        | subtração     |
| *        | multiplicação |
| /        | divisão       |
| %        | módulo        |
| =        | igual         |
| > <      | comparação    |
| >= <=    | comparação    |
| !=       | diferente     |
| LIKE     | padrões       |

---

# 💉 Introdução ao SQL Injection

---

# 🌐 Como aplicações usam SQL

Depois que o MySQL é instalado:

* aplicações podem armazenar,
* recuperar dados do banco.

---

# 🐘 Exemplo em PHP

```php id="9v9hr2"
$conn = new mysql("localhost","root","password","users");

$query = "SELECT * FROM logins";

$result = $conn->query($query);
```

---

# 📥 Lendo resultados

```php id="f7tgqm"
while($row = $result->fetch_assoc()){
    echo $row["name"];
}
```

---

# 🧠 fetch_assoc()

Transforma uma linha em:

* array associativo.

Exemplo:

```php id="rqg6x4"
$row["username"]
```

---

# 📨 Recuperando dados do usuário

Aplicações frequentemente usam input do usuário:

```php id="f97sp0"
$searchInput = $_POST['findUser'];

$query = "SELECT * FROM logins
WHERE username LIKE '%$searchInput%'";

$result = $conn->query($query);
```

---

# 🚨 Problema

O input foi inserido diretamente na query.

Isso é perigoso.

---

# 🧬 Tipos de SQL Injection

---

# 📡 IN-BAND

A saída aparece no front-end.

---

## 🔗 UNION BASED

Injeta queries usando UNION.

---

## 💥 ERROR BASED

Força erros para obter informações.

---

# 🕶️ BLIND SQLi

Não vemos a saída diretamente.

---

## ✅ BOOLEAN BASED

Usa respostas TRUE/FALSE.

---

## ⏳ TIME BASED

Usa delays (`SLEEP()`).

---

# 📤 OUT-OF-BAND

A saída é enviada para:

* servidor remoto,
* DNS,
* HTTP externo.

---

# 🎯 Foco inicial

O tipo mais comum para aprendizado inicial:

## 🔗 UNION BASED SQL Injection

Porque:

* é visual,
* fácil de entender,
* mostra claramente como os dados são extraídos.
