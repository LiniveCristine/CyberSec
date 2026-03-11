
# 🐘 PHP Básico

---

# 👋 Hello World

Um exemplo simples de código PHP:

```php
<?php

echo "Hello World";
```
````

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
