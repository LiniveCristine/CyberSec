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



