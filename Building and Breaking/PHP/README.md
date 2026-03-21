# 🐘 PHP Básico

---

# 👋 Hello World

Um exemplo simples de código PHP:

```php
<?php

echo "Hello World";
```

O comando `echo` é utilizado para **exibir conteúdo na saída** (normalmente no navegador).

---

# 🏷️ Tag de Abertura do PHP

Para que o servidor interprete o código PHP, devemos iniciar com a **tag de abertura**:

```php
<?php
```

Essa tag indica que **a partir desse ponto o código será interpretado como PHP**.

---

## 🔹 Tag Curta

Existe também uma versão curta:

```php
<?= "Hello World" ?>
```

Essa sintaxe é equivalente a:

```php
<?php echo "Hello World"; ?>
```

Ou seja, a tag `<?=` é um **atalho para o comando `echo`**.

---

# 🔚 Fechamento do PHP

A tag de fechamento é:

```php
?>
```

### Quando usar

- ✅ **Opcional** se o arquivo tiver **apenas código PHP**
- ⚠️ **Obrigatória** quando misturamos **PHP com HTML**

Exemplo:

```php
<?php echo "Olá"; ?>

<h1>Site</h1>
```

---

# 🖥️ Output em PHP

Existem diferentes formas de exibir informações.

### 📤 echo

Exibe texto ou variáveis.

```php
echo "Hello World";
```

---

### 🔍 var_dump()

Muito usado para **debug**.

Mostra:

- tipo da variável
- valor
- tamanho

```php
var_dump($nome);
```

---

### 📋 print_r()

Exibe **arrays e objetos** de forma mais legível.

```php
print_r($array);
```

---

# ▶️ Executando Código PHP

Existem duas formas principais.

---

## 💻 Pelo Terminal

Podemos executar diretamente no terminal:

```bash
php index.php
```

O PHP interpreta o arquivo e exibe a saída no terminal.

---

## 🌐 Pelo Navegador

Também podemos subir um **servidor web embutido do PHP**.

```bash
php -S localhost:8080
```

O diretório onde o comando é executado se torna o **diretório raiz do servidor**.

Depois basta acessar no navegador:

```
http://localhost:8080
```

---

# 📦 Variáveis em PHP

Variáveis são utilizadas para **armazenar dados**.

Em PHP todas as variáveis começam com o símbolo **`$`**.

---

## 🧾 Declaração de Variáveis

```php
$nome = "Maria";

echo $nome;
```

⚠️ Sempre devemos usar o **`$` ao declarar e acessar variáveis**.

---

# 🧬 Tipos de Dados em PHP

Os principais tipos são:

| Tipo      | Descrição           |
| --------- | ------------------- |
| `string`  | Texto               |
| `int`     | Número inteiro      |
| `float`   | Número decimal      |
| `array`   | Lista de valores    |
| `boolean` | Verdadeiro ou falso |

Exemplo:

```php
$nome = "Maria";
$idade = 25;
$altura = 1.65;
$ativo = true;
```

---

# ➕ Operadores em PHP

Os operadores permitem **realizar operações com valores e variáveis**.

---

## 🔢 Operadores Aritméticos

| Operador | Função           |
| -------- | ---------------- |
| `+`      | Soma             |
| `-`      | Subtração        |
| `*`      | Multiplicação    |
| `/`      | Divisão          |
| `%`      | Resto da divisão |

Exemplo:

```php
$resultado = 10 + 5;
```

---

## ⚖️ Operadores Lógicos / Comparação

| Operador | Significado    |     |           |
| -------- | -------------- | --- | --------- |
| `==`     | Igual          |     |           |
| `!=`     | Diferente      |     |           |
| `>`      | Maior que      |     |           |
| `<`      | Menor que      |     |           |
| `>=`     | Maior ou igual |     |           |
| `<=`     | Menor ou igual |     |           |
| `&&`     | E lógico       |     |           |
| `        |                | `   | OU lógico |

Exemplo:

```php
if ($idade >= 18) {
    echo "Maior de idade";
}
```

---

# ⚙️ Funções, Closures e Loops em PHP

## 📌 Funções

Funções são blocos de código reutilizáveis que executam uma tarefa específica.

### Definindo uma função

```php
function minha_funcao() {
    echo "Olá mundo";
}
```

Para executar a função:

```php
minha_funcao();
```

---

## 📥 Parâmetros de Função

Funções podem receber **parâmetros**, que são valores enviados durante a chamada da função.

### Exemplo

```php
function exibir_mensagem($mensagem) {
    echo $mensagem;
}

exibir_mensagem("Olá mundo");
```

📌 Nesse caso:

- `$mensagem` → parâmetro da função
- `"Olá mundo"` → argumento passado na chamada

---

## 🔐 Closures (Funções Anônimas)

Closures são **funções sem nome**.

Em PHP, **closures são objetos**, e cada closure é uma instância da classe:

```
Closure
```

### Características

Closures podem:

- Ser armazenadas em **variáveis**
- Ser **passadas como argumentos**
- **Acessar variáveis externas**

---

## 📦 Exemplo de Função Tradicional

```php
function somar($a, $b) {
    return $a + $b;
}

echo somar(10, 15);
```

---

## 🧩 Exemplo com Closure

```php
$somar = function($a, $b) {
    return $a + $b;
};

echo $somar(10, 15);
```

📌 Aqui a função é armazenada dentro da variável `$somar`.

---

## 🔗 Acessando Variáveis Externas

Closures podem acessar variáveis externas utilizando a palavra **`use`**.

### Exemplo

```php
$num = 10;

$soma = function($a) use ($num) {
    return $a + $num;
};

echo $soma(5);
```

📌 A variável `$num` foi importada para dentro da closure.

---

## 🔄 Closure por Referência

Podemos modificar uma variável externa usando **referência (`&`)**.

### Exemplo

```php
$contador = 0;

$incremento = function() use (&$contador) {
    $contador++;
};

$incremento();
$incremento();

echo $contador;
```

📌 Nesse caso:

- `$contador` não é uma variável local
- A closure modifica a variável externa diretamente

---

# 🔁 Loops em PHP

Loops permitem executar um bloco de código **várias vezes**.

---

# 🔄 While

Executa o código **enquanto a condição for verdadeira**.

```php
while(true) {
    echo "Executando...";
}
```

⚠️ Se a condição nunca for falsa, o loop será **infinito**.

---

# 🔂 For

Loop usado quando sabemos **quantas vezes queremos repetir algo**.

```php
for ($i = 0; $i < 10; $i++) {
    echo $i;
}
```

### Estrutura do `for`

```php
for (inicialização; condição; incremento)
```

| Parte     | Função               |
| --------- | -------------------- |
| `$i = 0`  | variável de controle |
| `$i < 10` | condição do loop     |
| `$i++`    | incremento           |

---

# 🧠 Resumo

| Conceito      | Explicação                               |
| ------------- | ---------------------------------------- |
| **Função**    | Bloco de código reutilizável             |
| **Parâmetro** | Valor recebido pela função               |
| **Closure**   | Função anônima armazenada em variável    |
| **use**       | Permite acessar variáveis externas       |
| **&**         | Passagem por referência                  |
| **while**     | Executa enquanto condição for verdadeira |
| **for**       | Loop com controle de repetição           |

---

# 🧵 Manipulação de Strings e Arrays em PHP

## 🔤 Strings em PHP

Uma **string** é basicamente um **array de caracteres**.

### Exemplo

```php
$nome = "Marcos";

echo $nome[0]; // M
````

📌 O índice sempre começa em **0**.

---

# 🔗 Concatenação de Strings

Existem várias formas de juntar (concatenar) strings em PHP.

---

## 📌 Interpolação (forma recomendada)

```php
$nome = "Maria";
$idade = 25;

echo "{$nome} tem {$idade} anos";
```

---

## 📌 Usando operador `.`

```php
echo $nome . " tem " . $idade . " anos";
```

---

## 📌 Interpolação simples

```php
echo "$nome tem $idade anos";
```

---

# 🛠️ Funções de String

## 🔍 `str_contains()`

Verifica se uma string contém outra.

```php
str_contains("Hello World", "World"); // true
```

### 📌 Parâmetros:

* String principal
* Substring

### 📌 Retorno:

* `true` ou `false`

---

## 🔁 `str_replace()`

Substitui parte de uma string.

```php
echo str_replace("mundo", "PHP", "Olá mundo");
```

📌 Resultado:

```text
Olá PHP
```

### ⚠️ Importante:

* **Não altera a string original**
* Retorna uma **nova string**

---

# 📦 Arrays em PHP

Arrays são estruturas que armazenam múltiplos valores.

---

## 📋 Array simples

```php
$lista = ["maçã", "pera", "uva", "banana"];

echo $lista[0]; // maçã
```

📌 Índices começam em **0**

---

## 🔑 Array Associativo

Permite definir **chaves personalizadas**.

```php
$lista = [
    "item1" => "maçã",
    "item2" => "pera",
    "item3" => "banana"
];

echo $lista["item1"]; // maçã
```

---

## 🧩 Arrays multidimensionais

É possível ter arrays dentro de arrays:

```php
$dados = [
    "frutas" => ["maçã", "banana"],
    "cores" => ["azul", "verde"]
];
```

---

# 🔁 Loop com `foreach`

Usado para percorrer arrays.

---

## 📌 Percorrendo valores

```php
foreach ($lista as $item) {
    echo $item . "\n";
}
```

📌 Cada elemento do array é armazenado em `$item`.

---

## 🔑 Percorrendo chave e valor

```php
foreach ($lista as $chave => $item) {
    echo "$chave: $item\n";
}
```

📌 Permite acessar:

* **Chave**
* **Valor**

---

# 🧠 Resumo

| Conceito              | Explicação                          |
| --------------------- | ----------------------------------- |
| **String**            | Sequência de caracteres             |
| **Concatenação**      | Junta strings (`.` ou interpolação) |
| **str_contains()**    | Verifica substring                  |
| **str_replace()**     | Substitui texto                     |
| **Array**             | Lista de valores                    |
| **Array associativo** | Usa chaves personalizadas           |
| **foreach**           | Percorre arrays                     |

---


# 🔁 Callbacks e Manipulação de Arrays em PHP

## 📌 O que é Callback?

Um **callback** é uma **função passada como argumento para outra função**.

📌 Essa função será executada **dentro da função principal**.

---

## ⚙️ Exemplo de Callback

```php
function callback($nome) {
    return "Olá $nome, a função callback retornou";
}

function recebe_callback($callB) {
    $nome = readline("Digite seu nome: ");
    echo $callB($nome);
}

recebe_callback("callback");
````

### 📌 Explicação:

* `callback()` → função passada como argumento
* `recebe_callback()` → função que recebe e executa o callback
* `$callB($nome)` → executa a função recebida

---

# 🧩 Callback com Função Anônima

Também podemos passar uma **closure (função anônima)** como callback.

---

## 📦 Exemplo

```php
function recebe_callback($callB) {
    $nome = readline("Digite seu nome: ");
    echo $callB($nome);
}

recebe_callback(function($nome) {
    return "Olá $nome, callback com função anônima";
});
```

📌 Aqui:

* A função é criada **na hora**
* Não precisa de nome
* Muito usado em código moderno

---

# 📦 Manipulação de Arrays

PHP possui várias funções úteis para trabalhar com arrays.

---

## 🔍 `in_array()`

Verifica se um valor existe dentro de um array.

```php
$lista = ["maçã", "banana", "uva"];

var_dump(in_array("banana", $lista)); // true
```

### 📌 Parâmetros:

* Valor a buscar
* Array

---

## 🔑 `array_key_exists()`

Verifica se uma **chave existe** em um array associativo.

```php
$dados = ["nome" => "Maria", "idade" => 25];

var_dump(array_key_exists("nome", $dados)); // true
```

---

## ✅ `isset()`

Verifica se uma variável (ou chave) **existe e não é null**.

```php
isset($dados["nome"]); // true
```

📌 Muito usado para validar inputs:

```php
if (isset($_POST["user"])) {
    // variável existe
}
```

---

## 🔄 `array_values()`

Remove as **chaves** de um array associativo, mantendo apenas os valores.

```php
$dados = ["a" => 1, "b" => 2];

print_r(array_values($dados));
```

📌 Resultado:

```text
[1, 2]
```

---

## 🔁 `array_keys()`

Retorna apenas as **chaves** de um array.

```php
$dados = ["a" => 1, "b" => 2];

print_r(array_keys($dados));
```

📌 Resultado:

```text
["a", "b"]
```

---

# 🌐 Query String 

## 📌 O que é Query String?

A **Query String** é a parte da URL usada para enviar dados ao servidor.

```text
https://site.com/pagina?chave=valor
````

---

## 🧩 Estrutura

* Formato: `chave=valor`
* Múltiplos parâmetros: separados por `&`

```text
https://exemplo.com/busca?nome=linive&idade=29
```

---

## ⚠️ Segurança

> Dados da query string são **facilmente manipuláveis pelo usuário**

💡 Nunca confiar nesses dados sem validação.

---

# 🐘 Acessando Query String no PHP

## 📥 `$_GET`

```php
var_dump($_GET);

$nome = $_GET['nome'];   // linive
$idade = $_GET['idade']; // 29
```

📌 `$_GET` é um **array associativo**

---

# 📦 Dados no Request Body

## 📥 `$_POST`

Dados enviados no corpo da requisição (geralmente formulários):

```bash
curl http://localhost:8080/index.php -d "nome=linive&idade=29"
```

```php
$nome = $_POST['nome'];
```

📌 Estrutura igual à query string, mas:

* ❌ Não usa `?`
* ✅ Vai no corpo da requisição

---

# 📡 Headers da Requisição

## 📥 `$_SERVER`

Contém informações da requisição:

* Porta
* URI
* Método HTTP
* Headers
* Script executado

---

## 🧪 Exemplo com Header

```bash
curl http://localhost:8080/index.php -H "x-exemplo: teste"
```

```php
echo $_SERVER['HTTP_X_EXEMPLO'];
```

📌 Headers customizados viram:

* `HTTP_` + nome em maiúsculo

---

# 🔁 Método da Requisição

```php
echo $_SERVER['REQUEST_METHOD'];
```

## 📌 Exemplos:

```bash
curl -X GET http://localhost:8080
curl -X POST http://localhost:8080
curl -X PUT http://localhost:8080
```

---

# 🔗 URI

## 📌 O que é?

Tudo que vem após o domínio:

```text
http://localhost:8080/index.php/?nome=linive
```

* URI: `/index.php/?nome=linive`

---

## 📥 Acessando no PHP

```php
$_SERVER['REQUEST_URI'];  // inclui query string
$_SERVER['SCRIPT_NAME'];  // sem query string
```

---

# 🌐 Entendendo HTTP

## 📌 O que é HTTP?

Protocolo de comunicação entre:

* Cliente (browser, curl, etc.)
* Servidor

---

## 🔄 Fluxo básico

```text
Cliente → Request → Servidor → Response → Cliente
```

---

## 🔌 Conexão TCP

Antes do HTTP:

> É necessário estabelecer uma conexão **TCP**

---

# 📤 HTTP Request

## 🧾 Estrutura

```http
POST /perfil?id=5 HTTP/1.1

Host: site.com
User-Agent: Mozilla/5.0
Content-Type: application/json
Content-Length: 345

{
  "data": "ABC123"
}
```

---

## 🧩 Partes

### 🔹 Linha inicial

```text
POST /perfil?id=5 HTTP/1.1
```

* Método: `GET`, `POST`, `PUT`, `DELETE`
* Endpoint: `/perfil`
* Query: `?id=5`
* Versão: `HTTP/1.1`

---

### 🔹 Headers

* Informações extras
* Ex:

```text
Host
User-Agent
Content-Type
Content-Length
```

📌 `Content-Length`:

* Obrigatório em POST
* Define tamanho do corpo (bytes)

---

### 🔹 Body

* Presente em requisições como `POST`
* Contém os dados enviados

---

# 📥 HTTP Response

## 🧾 Estrutura

```http
HTTP/1.1 403 Forbidden

Server: Apache
Content-Length: 678
Content-Type: text/html

<html>...</html>
```

---

## 🧩 Partes

### 🔹 Linha inicial

```text
HTTP/1.1 403 Forbidden
```

* Status code
* Mensagem

---

### 🔹 Headers

* Informações da resposta

📌 `Content-Length`:

* Tamanho do corpo (não inclui headers)

---

### 🔹 Body

* Conteúdo retornado
* HTML, JSON, etc.

---

# 🛠️ Ferramentas

## 🔍 Burp Suite

* Interceptar requests
* Modificar parâmetros
* Testar vulnerabilidades

---

# 🎯 Importância para Cybersecurity

## 🔎 Onde isso entra?

* Manipulação de parâmetros (GET/POST)
* Testes de autenticação
* Exploração de APIs
* Análise de requisições

---

## 💥 Possíveis vulnerabilidades

* SQL Injection
* XSS
* Parameter Tampering
* Header Injection

---

# 🚀 Mentalidade

> Tudo que vem do cliente pode ser manipulado

💡 Se você controla a requisição:

* Você pode testar limites
* Você pode quebrar a lógica
* Você pode explorar falhas

---

# 🌐 Como o Servidor PHP Encontra um Arquivo?

## 📥 Requisição do Cliente

Exemplo de request HTTP:

```http
GET /teste.php HTTP/1.1
````

📌 O cliente solicita o arquivo `teste.php`.

---

## 🖥️ Interpretação pelo Servidor

O servidor traduz a URL em um caminho local:

* Recebe: `/teste.php`
* Procura: `./teste.php`

📌 `.` representa o **diretório atual (root do servidor)**

---

## 📁 Diretório Raiz no PHP

Ao iniciar um servidor PHP:

```bash
php -S localhost:8080
```

📌 O diretório atual automaticamente vira a raiz `/`

Exemplo:

```bash
cd /exercicio
php -S localhost:8080
```

✔️ `/exercicio` → vira a raiz do servidor

---

## ✅ Verificação do Arquivo

* Se o arquivo existir → **executa o código PHP**
* Se não existir → **404 Not Found**

---

## 📂 Subdiretórios

Exemplo:

```http
GET /api/user.php
```

Servidor procura:

```bash
./api/user.php
```

---

## 📄 Arquivos Não-PHP

* NÃO são executados
* Apenas retornados como resposta

---

# 💻 Execução de Código PHP

## ⚡ Comportamento

* Toda requisição → executa o arquivo PHP
* Não mantém em memória (sem cache por padrão)

---

## 💣 Shell Upload

Se um atacante conseguir enviar um arquivo `.php`:

✔️ Pode executar código remotamente via URL

Exemplo:

```bash
http://localhost:8080/shell.php
```

🚨 Isso pode levar a **RCE (Remote Code Execution)**

---

# 🧪 Mini Projeto: Leitura de Arquivos

## 🎯 Objetivo

Permitir que o usuário informe um arquivo para leitura.

---

## 📥 Recebendo Input do Usuário

Via query string:

```bash
?filename=teste.php
```

Em PHP:

```php
isset($_GET['filename'])
```

✔️ Verifica se o parâmetro foi enviado

---

## 📁 Verificando se o Arquivo Existe

```php
file_exists($filename)
```

✔️ Retorna true se o arquivo existir

---

## 📖 Lendo o Conteúdo

```php
$content = file_get_contents($filename);
echo $content;
```

---

## ⚠️ Importante

🔹 `file_get_contents()`:

* Lê arquivos locais
* Pode acessar URLs
* NÃO executa código PHP

---

### 🧠 Diferença Importante

| Método            | Comportamento      |
| ----------------- | ------------------ |
| Acesso via URL    | Executa o PHP      |
| file_get_contents | Retorna como texto |

---

### 💡 Exemplo

Arquivo:

```php
<?php system("whoami"); ?>
```

* Via navegador → EXECUTA
* Via `file_get_contents` → retorna texto

---

# 🚨 LFI (Local File Inclusion)

## 🧩 O que é?

Vulnerabilidade que permite:

* Ler arquivos locais do servidor
* Incluir arquivos arbitrários

---

## ⚠️ Quando ocorre?

* Falta de validação de input
* Usuário controla o caminho do arquivo
* Sem restrição de diretórios
* Sem restrição de tipo de arquivo

---

# 💥 Exploração (Path Traversal)

## 🧠 Conceito

Técnica para navegar entre diretórios usando:

```bash
../
```

---

## 📂 Exemplo de ataque

```bash
../../../../../../etc/passwd
```

📌 O servidor:

* Volta diretórios até a raiz
* Depois acessa arquivos sensíveis

---

## ⚠️ Importante

* Não há limite de `../`
* Quando chega na raiz (`/`), ele para

---

## 🧠 Conceito-chave

**Path Traversal NÃO é vulnerabilidade.**

✔️ É uma **técnica de exploração**

---

# 🔐 Mitigação de LFI

## 📌 Problema comum

```php
file_get_contents($filename);
```

🚨 Permite acessar qualquer arquivo do sistema

---

## ✅ Solução: Restringir Diretório

```php
file_get_contents(__DIR__ . "/files/" . $filename);
```

### 🧠 **DIR**

* Retorna o caminho do diretório atual
* Ajuda a evitar erros de caminho

---

## ⚠️ Ainda Vulnerável!

Mesmo com restrição:

```bash
?filename=../../../../etc/passwd
```

🚨 Ainda é possível sair do diretório

---

# 🧠 Ponto Crítico

## 🚨 Atenção máxima:

Se você ver:

```php
diretorio . input_usuario
```

🔥 Isso pode indicar:

* LFI
* Path Traversal
* Leitura de arquivos sensíveis

---

# 🚀 Resumo Estratégico

💡 Sempre teste:

* Input controlando arquivos
* Uso de `file_get_contents`
* Falta de validação
* Uso de concatenação de caminhos

---

🔥 **Regra de ouro:**
Se o usuário controla o caminho de um arquivo → **há risco de LFI**.

---

# 🧩 Include e Require

## 📌 O que são?

- NÃO são funções
- Funcionam como uma espécie de **"echo de código PHP"**

✔️ Servem para **incluir arquivos PHP dentro de outros arquivos**

---

## 📁 Exemplo básico

Estrutura:

```

index.php
func.php

````

Uso:

```php
include __DIR__ . "/func.php";
````

📌 O conteúdo de `func.php` será inserido e executado dentro do `index.php`

---

## ⚙️ Como funciona?

✔️ O PHP:

1. Lê o arquivo incluído
2. Insere o código no local
3. Executa como se estivesse no mesmo arquivo

---

# ⚠️ Diferença entre Include e Require

## 🔴 require

```php
require "arquivo.php";
```

* Se o arquivo NÃO existir → ❌ ERRO FATAL
* O script **para completamente**

---

## 🟡 include

```php
include "arquivo.php";
```

* Se o arquivo NÃO existir → ⚠️ WARNING
* O script **continua executando**

---

## 🧠 Resumo rápido

| Comportamento      | include | require     |
| ------------------ | ------- | ----------- |
| Arquivo existe     | Executa | Executa     |
| Arquivo não existe | Warning | Fatal Error |
| Execução continua  | ✅       | ❌           |

---

# 🌐 Inclusão Dinâmica com Query String

## 📥 Pegando valor do usuário

```php
$page = $_GET['page'];
```

Exemplo de URL:

```bash
?page=home
```

---

## 🏗️ Montando o caminho

```php
require "{$page_folder}/{$page}.php";
```

📌 Aqui estamos:

* Construindo dinamicamente o caminho
* Limitando para `.php` (boa prática parcial)

---

## ⚠️ Problema de Segurança

🚨 O usuário controla:

* Nome do arquivo
* Possivelmente o caminho

---

# 💥 Risco: LFI (Local File Inclusion)

Se não houver validação:

```bash
?page=../../../../etc/passwd
```

Ou:

```bash
?page=../../../../var/www/html/shell
```

🔥 Isso pode permitir:

* Leitura de arquivos sensíveis
* Execução de código malicioso

---

# ⚠️ Remover o ".php" PIORA TUDO

```php
require "{$page_folder}/{$page}";
```

🚨 Agora o atacante pode incluir:

* `.txt`
* `.log`
* Qualquer arquivo do sistema

---

# 💣 Execução de Código em Arquivos NÃO PHP

## 🧠 Comportamento importante

Se um arquivo tiver código PHP dentro:

```php
<?php system("whoami"); ?>
```

Mesmo que seja:

* `.txt`
* `.log`
* `.bak`

✔️ O PHP **VAI EXECUTAR** se for incluído com `include` ou `require`

---

## 🚨 Impacto

Isso pode levar a:

* RCE (Remote Code Execution)
* Execução de payloads escondidos
* Escalada de ataque

---

# 🔐 Boas Práticas (Mitigação)

## ✅ 1. Nunca confiar no input do usuário

Evite:

```php
require "{$page_folder}/{$page}.php";
```

---

## ✅ 2. Use lista branca (whitelist)

```php
$pages = ['home', 'about', 'contact'];

if (in_array($page, $pages)) {
    require __DIR__ . "/pages/{$page}.php";
}
```

---

## ✅ 3. Evitar concatenação direta

🚨 Cuidado com:

```php
diretorio . input_usuario
```

---

## ✅ 4. Validar e sanitizar input

* Remover `../`
* Bloquear caminhos absolutos
* Restringir caracteres

---

# 🧠 Ponto Crítico

## 🚨 Sempre desconfie quando ver:

* `include($_GET[...])`
* `require($_GET[...])`
* Construção dinâmica de caminhos

---



