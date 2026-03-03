# 🐚 Bash Script – Guia Completo para README

Material organizado para usar como **README no GitHub**, com explicações claras e progressivas 🚀

---

# 📌 O que é Bash?

Bash é uma **linguagem de script**, ou seja:

* ✅ Não precisa ser compilada
* ✅ É interpretada diretamente pelo sistema
* ✅ Muito usada em Linux para automação

## 💻 WSL (Windows Subsystem for Linux)

Permite rodar **Linux dentro do Windows**, possibilitando usar Bash mesmo no Windows.

---

# 🧱 Estrutura do Bash

Bash possui elementos semelhantes a outras linguagens:

* 📥 Input e Output
* 📦 Argumentos
* 🧠 Variáveis e Arrays
* 🔀 Condicionais
* 🔁 Loops
* ⚖️ Operadores Lógicos
* 🛠️ Funções

---

# ▶️ Executando um Script

Para executar um script, precisamos definir o **interpretador**.

```bash
bash script.sh
sh script.sh
./script.sh
```

### 🔎 Diferenças

* `bash script.sh` → Executa usando Bash
* `sh script.sh` → Executa com shell padrão
* `./script.sh` → Executa script na pasta atual

⚠️ Para usar `./`, o arquivo precisa ter **permissão de execução**.

---

# 🔐 Permissão de Execução

Se aparecer:

```bash
Permission denied
```

Significa que o arquivo **não tem privilégio de execução**.

Você pode rodar assim:

```bash
bash ./cidr.sh
```

Ou adicionar permissão:

```bash
chmod +x cidr.sh
```

Ver permissões:

```bash
ls -l cidr.sh
```

### 📌 Significado das permissões

* `r` → read (leitura)
* `w` → write (escrita)
* `x` → execute (execução)

Ordem dos usuários:

```
dono | grupo | outros
```

---

# 🏗️ Estrutura de um Script

```bash
#!/bin/bash

# Check for given arguments
if [ $# -eq 0 ]
then
	echo -e "You need to specify the target domain.\n"
	echo -e "Usage:"
	echo -e "\t$0 <domain>"
	exit 1
else
	domain=$1
fi
```

---

# 🔰 Shebang

```bash
#!/bin/bash
```

* Sempre começa com `#!`
* Define qual interpretador executará o script

Exemplo:

```bash
#!/usr/bin/env python
```

---

# 💬 Comentários

```bash
# Isso é um comentário
```

---

# 🎯 Analisando Argumentos do Usuário

```bash
if [ $# -eq 0 ]
```

### 📌 Explicação

* `$#` → Quantidade de argumentos
* `-eq` → Igual

Exemplos:

```bash
./CIDR.sh google.com   # $# = 1
./CIDR.sh              # $# = 0
```

⚠️ Sempre colocar espaço:

```bash
if [ $# -eq 0 ]   # ✅
if [$# -eq 0]     # ❌
```

---

# 🚨 Exibindo Erros

```bash
echo -e "You need to specify the target domain.\n"
```

`-e` permite usar:

* `\n` → Nova linha
* `\t` → Tab

```bash
echo -e "\t$0 <domain>"
```

---

# 🔢 Ordem dos Argumentos

| Variável | Função                   |
| -------- | ------------------------ |
| `$0`     | Nome do script           |
| `$1`     | Primeiro argumento       |
| `$2`     | Segundo argumento        |
| `$#`     | Quantidade de argumentos |

```bash
domain=$1
```

⚠️ Não usar espaço:

```bash
domain=$1   # ✅
domain = $1 # ❌
```

---

# 🔀 Condicionais

```bash
if ... then
...
else
...
fi
```

```bash
if ... then
...
elif ... then
...
else
...
fi
```

---

# ⚖️ Operadores de Comparação

## 📝 STRING

| Operador | Significado      |
| -------- | ---------------- |
| `==`     | Igual            |
| `!=`     | Diferente        |
| `-z`     | String vazia     |
| `-n`     | String não vazia |

```bash
if [ "$1" != "HackTheBox" ]
```

### ⚠️ Para usar > ou <

```bash
[[ "zebra" < "amaciante" ]]
```

Comparação alfabética.

---

## 🔢 INTEIROS

| Operador | Significado    |
| -------- | -------------- |
| `-eq`    | Igual          |
| `-ne`    | Diferente      |
| `-gt`    | Maior          |
| `-lt`    | Menor          |
| `-ge`    | Maior ou igual |
| `-le`    | Menor ou igual |

```bash
if [[ ${#texto} -gt 1000 ]]
```

---

## 📁 OPERADORES DE ARQUIVO

| Operador | Verifica            |
| -------- | ------------------- |
| `-e`     | Se existe           |
| `-f`     | Se é arquivo        |
| `-d`     | Se é diretório      |
| `-L`     | Se é link simbólico |
| `-s`     | Tamanho > 0         |
| `-r`     | Permissão leitura   |
| `-w`     | Permissão escrita   |
| `-x`     | Permissão execução  |

```bash
if [[ -e "$1" ]]
```

---

# 🧠 Operadores Lógicos

| Operador | Função  |   |    |
| -------- | ------- | - | -- |
| `!`      | Negação |   |    |
| `&&`     | E       |   |    |
| `        |         | ` | OU |

```bash
if [[ ! -e "$1" || ! -r "$1" ]]
then
    echo "Arquivo não existe ou sem permissão"
fi
```

---

# ➕ Operadores Aritméticos

```bash
soma=$((10 + 10))
```

Operadores:

```
+  -  *  /  %  ++  --
```

---

# 📦 Argumentos, Variáveis e Arrays

## 🎯 Argumentos

```bash
$0 -> nome script
$1 ... $9 -> argumentos
```

---

## 🧠 Variáveis Especiais

| Variável | Função               |
| -------- | -------------------- |
| `$#`     | Número de argumentos |
| `$@`     | Lista de argumentos  |
| `$$`     | ID do processo       |
| `$?`     | Código de retorno    |

---

## 📌 Variáveis

```bash
domain=$1
echo $domain
```

Sem espaço entre nome e valor.

---

## 🗂️ Arrays

```bash
domains=(google.com globo.com yahoo.com)
```

Acessando:

```bash
echo ${domains[0]}
```

* Valores separados por espaço
* Usa `()` para definir
* Usa `${}` para expandir

---

# ⌨️ Input e Output

## 📥 INPUT

```bash
read -p "Digite seu nome: " nome
```

---

## 📤 OUTPUT

### Mostrar e salvar ao mesmo tempo:

```bash
tree | tee resultado.txt
```

### Exemplo prático:

```bash
netrange=$(whois $ip | grep "NetRange\|CIDR" | tee -a CIDR.txt)
```

### 🔎 Explicação

* `whois $ip` → Consulta informações
* `grep` → Filtra
* `tee -a` → Adiciona ao arquivo sem sobrescrever

---
