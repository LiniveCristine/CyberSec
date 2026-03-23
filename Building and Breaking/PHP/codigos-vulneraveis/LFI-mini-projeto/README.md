
# 📝 LFR + Mini Aplicação de Notas (PHP)

Este guia explica a criação de uma **mini aplicação de notas em PHP** e como ela pode introduzir vulnerabilidades como:

- **LFR (Local File Read)**
- **LFI (Local File Inclusion)**
- **RCE (Remote Code Execution)**

🎯 **Objetivo:**
Aprender o fluxo completo (frontend + backend) e identificar **pontos críticos de segurança**.

---

# 🌐 Fluxo da Aplicação

## 🧠 Funcionamento geral

1. Usuário escreve uma nota
2. Clica em "Salvar"
3. O conteúdo é enviado para `/index.php`
4. O backend salva a nota em um arquivo
5. As notas são listadas
6. Usuário pode clicar e visualizar o conteúdo

---

# 🧾 HTML Básico

## 🏗️ Estrutura

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Notas</title>
</head>
<body>
````

---

## 📥 Formulário

```html
<form action="/index.php" method="POST">
    <label for="note">Digite sua nota:</label>
    <textarea name="note" id="note"></textarea>
    <button type="submit">Salvar</button>
</form>
```

---

## 📌 Conceitos importantes

* `method="POST"` → envia dados no corpo da requisição
* `name="note"` → usado no backend (`$_POST['note']`)
* `id` → usado para label, CSS e JS

---

# 🔀 HTML + PHP

Podemos misturar PHP dentro do HTML:

```php
<?php foreach($arquivos as $arquivo): ?>
    <li><?= $arquivo ?></li>
<?php endforeach; ?>
```

📌 Observações:

* `<?=` é equivalente a `echo`
* `:` substitui `{`
* `endforeach` fecha o loop

---

# ⚙️ Backend (PHP)

## 🔍 Verificando método

```php
$_SERVER['REQUEST_METHOD'] === 'POST'
```

✔️ Garante que o formulário foi enviado corretamente

---

## 📥 Pegando a nota

```php
$texto_nota = $_POST['note'];
```

---

## 💾 Salvando a nota

```php
file_put_contents($file_path, $texto_nota, FILE_APPEND);
```

### 📌 Parâmetros:

* Caminho do arquivo
* Conteúdo
* `FILE_APPEND` → não sobrescreve

---

## 📁 Caminho do arquivo

```php
$file_path = "./notas/anotacao_{$random}.txt";
```

```php
$random = rand(1000, 9999);
```

✔️ Cada nota terá um arquivo único

---

# 📂 Listando Arquivos

## 🔍 Usando scandir()

```php
$arquivos = scandir("./notas");
$arquivos = array_slice($arquivos, 2);
```

### 📌 Explicação:

* `.` → diretório atual
* `..` → diretório anterior
* `array_slice` remove esses dois

---

## 📋 Exibindo lista

```html
<ul>
    <?php foreach($arquivos as $arquivo): ?>
        <li><?= $arquivo ?></li>
    <?php endforeach; ?>
</ul>
```

---

# 🔗 Tornando as Notas Clicáveis

## 🧠 Fluxo

1. Usuário clica na nota
2. Nome vai para a URL
3. Backend lê o arquivo

---

## 🔗 Link dinâmico

```html
<a href="/index.php?filename=<?= $arquivo ?>">
```

---

## 📥 Pegando o arquivo

```php
if(isset($_GET['filename'])){
    $nome_nota = $_GET['filename'];
}
```

---

## 📁 Caminho seguro

```php
$file_path = __DIR__ . "/notas/{$nome_nota}";
```

---

# ⚠️ LFR (Local File Read)

## 🧩 O que é?

Permite ao atacante:

* Ler arquivos locais do servidor

---

## 💥 Exploração (Path Traversal)

```bash
../../../../../../etc/passwd
```

🚨 O atacante pode acessar arquivos fora da pasta `notas`

---

# 🚨 LFI (Local File Inclusion)

## 💣 Problema crítico

```php
require($file_path);
```

⚠️ Se o usuário controla o arquivo → pode executar código

---

## 🧪 Teste de exploração

Inserir na nota:

```php
<?php var_dump(true); ?>
```

✔️ Será executado ao abrir a nota

---

# 💥 RCE (Execução Remota)

## ⚡ Função perigosa

```php
system("id & ls -la");
```

📌 Executa comandos no sistema operacional

---

## 🚨 Cenário real

* Usuário insere código PHP na nota
* Aplicação usa `require`
* Código é executado

🔥 Resultado: **RCE**

---

## 🖼️ Upload de imagem maliciosa

Mesmo imagens podem conter:

```php
<?php system("whoami"); ?>
```

🚨 Se interpretadas → execução de código

---

# ⚠️ LFI vs LFR

| Tipo | Impacto            |
| ---- | ------------------ |
| LFR  | Apenas leitura     |
| LFI  | Execução de código |

📌 LFI é mais grave → pode levar a RCE

---

# ❗ Limitação do LFI

Mesmo com Path Traversal:

* NÃO é possível ler código PHP como texto
* Apenas executar ou controlar entrada

---

# 🔐 Correções (Mitigação)

## ❌ Evitar require com input do usuário

```php
require($file_path);
```

---

## ✅ Usar file_get_contents

```php
echo file_get_contents($file_path);
```

✔️ Apenas lê → NÃO executa código

---

## ✅ Usar basename()

```php
$nome_nota = basename($_GET['filename']);
```

✔️ Remove `../` (path traversal)

---

## ✅ Restringir diretório

```php
$file_path = __DIR__ . "/notas/" . $nome_nota;
```

✔️ Garante acesso apenas à pasta correta

---

## ✅ Validar entrada

* Bloquear caracteres suspeitos
* Permitir apenas `.txt`
* Usar whitelist

---

# 🧠 Ponto Crítico

🚨 Sempre desconfie de:

* `require($_GET[...])`
* `include($_GET[...])`
* Leitura de arquivos baseada em input

---


## 🧠 Mentalidade de Ataque

Pergunte-se:

* Posso controlar o nome do arquivo?
* Posso usar `../`?
* Posso injetar código PHP?
* O sistema usa `require` ou `file_get_contents`?

---

🔥 **Regra de ouro:**
Se o usuário controla o arquivo → você pode ter **LFR, LFI e até RCE**.


