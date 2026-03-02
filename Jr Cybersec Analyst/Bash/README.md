# 🐚 Bash Script – Conceitos Fundamentais

## 📌 O que é?

**Bash** é uma **linguagem de script**, ou seja:

- ✅ **Não precisa ser compilada**
- ✅ É interpretada diretamente pelo sistema
- ✅ Muito utilizada em sistemas Linux para automação

### 💻 WSL (Windows Subsystem for Linux)

O **WSL** permite rodar **Linux dentro do Windows**, possibilitando executar comandos Bash mesmo usando Windows.

---

## 🧱 Estrutura da Linguagem

Bash é semelhante a outras linguagens de programação e possui:

- 📥 Entrada e saída (input/output)
- 📦 Argumentos
- 🧠 Variáveis e arrays
- 🔀 Condicionais
- 🔁 Loops
- ⚖️ Operadores lógicos
- 🛠️ Funções

Ou seja, é totalmente capaz de criar scripts automatizados e inteligentes.

---

# ▶️ Executando um Script

Antes de executar um script, precisamos definir **qual interpretador irá processá-lo**.

### Formas de executar:

```bash
bash script.sh
sh script.sh
./script.sh
```

### 🔎 Diferenças:

- `bash script.sh` → Executa usando o interpretador Bash
- `sh script.sh` → Executa usando o shell padrão (geralmente aponta para Bash)
- `./script.sh` → Executa o script que está na pasta atual

⚠️ Para usar `./script.sh`, o arquivo precisa ter permissão de execução:

```bash
chmod +x script.sh
```

---

# 🏗️ Estrutura de um Script

Exemplo básico:

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

### 📌 O que é?

- Sempre começa com `#!`
- Indica **qual interpretador executará o script**

Exemplos:

```bash
#!/bin/bash
#!/usr/bin/env python
```

✔️ No primeiro caso, usamos o Bash
✔️ No segundo, o Python será o interpretador

---

# 💬 Comentários

Em Bash, usamos:

```bash
# Comentário aqui
```

Comentários ajudam na organização e documentação do código.

---

# 🎯 Analisando Argumentos do Usuário

### Verificando se argumentos foram passados:

```bash
if [ $# -eq 0 ]
```

### 📌 Importante:

⚠️ **Sempre colocar espaço depois do colchete**

```bash
if [ $# -eq 0 ]   # ✅ Correto
if [$# -eq 0]     # ❌ Errado
```

### 🔎 O que significa?

- `$#` → Quantidade de argumentos passados
- `-eq` → Igual (==)

Exemplos:

```bash
./CIDR.sh google.com   # $# = 1
./CIDR.sh              # $# = 0
```

Se for igual a 0, o script exibe erro e encerra.

---

# 🚨 Exibindo Mensagens de Erro

```bash
echo -e "You need to specify the target domain.\n"
```

### 📌 O que faz o `-e`?

Permite usar caracteres especiais:

- `\n` → Nova linha
- `\t` → Tabulação

Exemplo:

```bash
echo -e "\t$0 <domain>"
```

---

# 🔢 Ordem dos Argumentos

| Variável | Significado              |
| -------- | ------------------------ |
| `$0`     | Nome do script           |
| `$1`     | Primeiro argumento       |
| `$2`     | Segundo argumento        |
| `$#`     | Quantidade de argumentos |

Exemplo:

```bash
domain=$1
```

Aqui estamos dizendo:

👉 A variável `domain` recebe o **primeiro argumento passado pelo usuário**.

---

# 🔀 Condicionais

### Estrutura básica:

```bash
if ... then
...
else
...
fi
```

### Com múltiplas condições:

```bash
if ... then
...
elif ... then
...
else
...
fi
```

⚠️ Sempre lembrar do espaço:

```bash
if [ $var -ne 35 ]   # ✅ Correto
```

---

# ⚖️ Operadores de Comparação

| Operador | Significado         |
| -------- | ------------------- |
| `-eq`    | Igual (==)          |
| `-ne`    | Diferente (!=)      |
| `-gt`    | Maior que (>)       |
| `-lt`    | Menor que (<)       |
| `-ge`    | Maior ou igual (>=) |
| `-le`    | Menor ou igual (<=) |

---
