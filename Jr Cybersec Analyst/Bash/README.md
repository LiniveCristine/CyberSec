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

# 🐚 Bash Script – Argumentos, Operadores e Estruturas

Guia organizado para usar como **README no GitHub**, com foco prático e didático 🚀

---

# 🎯 Analisando Argumentos do Usuário

```bash
if [ $# -eq 0 ]
then
    echo "Nenhum argumento foi passado"
fi
```

## 🔎 Entendendo cada parte

* `$#` → Quantidade de argumentos passados ao script
* `-eq` → Igual (==)

### 📌 Exemplos

```bash
./CIDR.sh google.com   # $# = 1
./CIDR.sh              # $# = 0
```

Se for igual a 0 → significa que o usuário não passou argumentos.

⚠️ **Sempre colocar espaço depois do colchete**

```bash
if [ $# -eq 0 ]   # ✅ Correto
if [$# -eq 0]     # ❌ Errado
```

---

# 🚨 Exibindo Erros

```bash
echo -e "You need to specify the target domain.\n"
```

## 📌 O que faz o `-e`?

Permite caracteres especiais:

* `\n` → Nova linha
* `\t` → Tab

Exemplo:

```bash
echo -e "\t$0 <domain>"
```

### 🔎 Variáveis importantes

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

⚠️ Não pode ter espaço:

```bash
domain=$1   # ✅
domain = $1 # ❌
```

---

# 🔀 Condicionais

## Estruturas possíveis

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

⚠️ Sempre com espaço:

```bash
if [ $var -ne 35 ]
```

---

# ⚖️ Operadores de Comparação

Temos **4 categorias principais**:

* 📝 String
* 🔢 Inteiro
* 📁 Arquivo
* 🧠 Booleano

---

## 📝 STRING

| Operador | Significado              |
| -------- | ------------------------ |
| `==`     | Igual                    |
| `!=`     | Diferente                |
| `>`      | Maior (ordem alfabética) |
| `<`      | Menor                    |
| `-z`     | String vazia             |
| `-n`     | String NÃO vazia         |

### 📌 Exemplo

```bash
if [ "$1" != "HackTheBox" ]
```

Sempre usar aspas para evitar erros.

### ⚠️ Comparação com > ou <

Deve usar **duplo colchete**:

```bash
[[ "zebra" < "amaciante" ]]
```

✔️ Retorna falso
Porque "z" vem depois de "a" na ordem alfabética.

---

## 🔢 INTEIROS

| Operador | Significado    |
| -------- | -------------- |
| `-eq`    | Igual          |
| `-ne`    | Diferente      |
| `-gt`    | Maior que      |
| `-lt`    | Menor que      |
| `-ge`    | Maior ou igual |
| `-le`    | Menor ou igual |

### 📌 Exemplo

```bash
if [[ ${#texto} -gt 1000 ]]
```

`${#texto}` → quantidade de caracteres da variável.

---

## 📁 OPERADORES DE ARQUIVO

Usados para verificar existência e permissões:

| Operador | Verifica                              |
| -------- | ------------------------------------- |
| `-e`     | Se existe                             |
| `-f`     | Se é arquivo                          |
| `-d`     | Se é diretório                        |
| `-L`     | Se é link simbólico                   |
| `-s`     | Se tem tamanho > 0                    |
| `-r`     | Permissão de leitura                  |
| `-w`     | Permissão de escrita                  |
| `-x`     | Permissão de execução                 |
| `-O`     | Se usuário é proprietário             |
| `-G`     | Mesmo grupo do usuário                |
| `-N`     | Se foi modificado após última leitura |

### 📌 Exemplo

```bash
if [[ -e "$1" ]]
```

Se o arquivo existir → executa o bloco.

```bash
arquivo="text.txt"

if [[ -f "$arquivo" ]]
```

---

# 🧠 Operadores Lógicos

| Operador | Significado |   |    |
| -------- | ----------- | - | -- |
| `!`      | Negação     |   |    |
| `&&`     | E           |   |    |
| `        |             | ` | OU |

### 📌 Exemplo

```bash
if [[ ! -e "$1" || ! -r "$1" ]]
then
    echo "Arquivo não existe ou sem permissão de leitura"
fi
```

---

# ➕ Operadores Aritméticos

| Operador | Função        |
| -------- | ------------- |
| `+`      | Soma          |
| `-`      | Subtração     |
| `*`      | Multiplicação |
| `/`      | Divisão       |
| `%`      | Resto         |
| `++`     | Incremento    |
| `--`     | Decremento    |

### 📌 Exemplo

```bash
soma=$((10 + 10))
```

---

# 📦 Argumentos, Variáveis e Arrays

---

## 🎯 ARGUMENTOS

Podemos usar até 9 argumentos diretos:

```bash
$0 -> nome do script
$1 -> primeiro argumento
...
$9 -> nono argumento
```

---

## 🧠 VARIÁVEIS ESPECIAIS

| Variável | Função                          |
| -------- | ------------------------------- |
| `$#`     | Número de argumentos            |
| `$@`     | Lista de todos argumentos       |
| `$$`     | ID do processo                  |
| `$?`     | Código de retorno (0 = sucesso) |

---

## 📌 VARIÁVEIS

Declaração:

```bash
domain=$1
echo $domain
```

⚠️ Sem espaço entre nome e valor.

---

## 🗂️ ARRAY

```bash
domains=(google.com globo.com yahoo.com)
```

Acessando:

```bash
echo ${domains[0]}
```

### 📌 Observações

* Elementos separados por **espaço**
* Usa `()` para definir
* Usa `${}` para expandir

---

# ⌨️ Input e Output

---

## 📥 INPUT

```bash
read -p "Digite seu nome: " nome
```

* `-p` → Mantém texto e input na mesma linha
* `nome` → Variável que armazenará o valor digitado

---

## 📤 OUTPUT

### Salvar saída em arquivo

```bash
tree | tee resultado.txt
```

`tee` → Mostra na tela e salva no arquivo.

---

### 📌 Exemplo real

```bash
netrange=$(whois $ip | grep "NetRange\|CIDR" | tee -a CIDR.txt)
```

### 🔎 Explicação

* `whois $ip` → Consulta informações do IP
* `grep "NetRange\|CIDR"` → Filtra dados relevantes
* `tee -a CIDR.txt` → Salva no arquivo
* `-a` → Append (não sobrescreve, apenas adiciona)

---

