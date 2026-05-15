# 💉 COMMAND INJECTION (INJEÇÃO DE COMANDOS)

## ❓ O que é Injeção?

Vulnerabilidades de **injeção** ficaram entre as mais críticas do **OWASP Top 10**.
Esse tipo de falha acontece quando uma entrada fornecida pelo usuário é:

* mal interpretada pela aplicação;
* utilizada de forma insegura;
* ou permite alterar a lógica esperada do sistema.

O resultado final é um comportamento diferente do que a aplicação deveria executar.

---

# 🧩 Principais Tipos de Injeção

## 1. Injeção de Comando no SO (Command Injection)

Permite executar comandos diretamente no sistema operacional.

Exemplo:

```bash id="17lxb7"
; whoami
```

---

## 2. Injeção de Código

O atacante injeta código que será interpretado pela aplicação.

Exemplo:

```php id="jzp4c7"
<?php phpinfo(); ?>
```

---

## 3. SQL Injection

Permite manipular consultas ao banco de dados.

Exemplo:

```sql id="2c2pop"
' OR '1'='1
```

---

## 4. XSS / HTML Injection

Permite injetar código HTML ou JavaScript em páginas web.

Exemplo:

```html id="1eeyd6"
<script>alert(1)</script>
```

---

# 💻 Injeção de Comando no SO

## ❓ O que é?

A **Command Injection** ocorre quando a aplicação executa comandos do sistema operacional utilizando dados controlados pelo usuário.

Essa é considerada uma falha extremamente grave porque pode permitir:

* execução remota de comandos;
* leitura de arquivos sensíveis;
* controle total do servidor;
* movimentação lateral;
* escalada de privilégios.

---

# ⚠️ Por que essa vulnerabilidade existe?

Muitas linguagens possuem funções capazes de executar comandos diretamente no sistema operacional.

## Exemplos de funções perigosas

### C

```c id="gyf36l"
execve()
```

### PHP

```php id="8lpup4"
system()
```

### Python

```python id="eg1tj6"
os.system()
```

### Node.js

```javascript id="fmg8li"
child_process.exec()
child_process.spawn()
```

---

# 🔥 Como a vulnerabilidade acontece?

O problema ocorre quando a aplicação:

1. recebe um input do usuário;
2. concatena esse input em um comando do sistema;
3. executa o comando sem validação ou sanitização.

---

# 🐘 Exemplo Vulnerável em PHP

```php id="2rbve8"
<?php
if (isset($_GET['filename'])) {
    system("touch /tmp/" . $_GET['filename'] . ".pdf");
}
?>
```

## O que esse código faz?

Ele pega um parâmetro da URL:

```http id="ih122h"
?filename=teste
```

E executa:

```bash id="ilefw6"
touch /tmp/teste.pdf
```

---

## 🚨 Qual é o problema?

O valor enviado pelo usuário:

* não é higienizado;
* não é sanitizado;
* é concatenado diretamente no comando.

---

## 💣 Possível exploração

Se o atacante enviar:

```http id="pz33cq"
?filename=teste;whoami
```

O comando executado pode virar:

```bash id="z7uv9r"
touch /tmp/teste;whoami.pdf
```

Dependendo do ambiente e da forma de execução, isso pode permitir execução arbitrária de comandos.

---

# 🟩 Exemplo Vulnerável em Node.js

```javascript id="8eisqa"
app.get("/createfile", function(req, res){
    child_process.exec(`touch /tmp/${req.query.filename}.txt`);
})
```

---

## 🚨 Problema

O parâmetro:

```javascript id="a8mk0v"
req.query.filename
```

vem diretamente da URL e é inserido no comando sem validação.

---
