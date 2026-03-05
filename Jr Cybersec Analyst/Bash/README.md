# 🐚 Bash Script – Mini Resumo

# 📑 Sumário

| Categoria | Conteúdo |
|---|---|
| 🧠 Introdução | [📌 O que é Bash?](#-o-que-é-bash) • [💻 WSL (Windows Subsystem for Linux)](#-wsl-windows-subsystem-for-linux) |
| 🧱 Estrutura | [🧱 Estrutura do Bash](#-estrutura-do-bash) |
| ▶️ Execução | [▶️ Executando um Script](#️-executando-um-script) |
| 🔐 Permissões | [🔐 Permissão de Execução](#-permissão-de-execução) • [📌 Significado das permissões](#-significado-das-permissões) |
| 🏗️ Script | [🏗️ Estrutura de um Script](#️-estrutura-de-um-script) |
| 🔰 Configuração | [🔰 Shebang](#-shebang) • [💬 Comentários](#-comentários) |
| 🎯 Argumentos | [🎯 Analisando Argumentos do Usuário](#-analisando-argumentos-do-usuário) • [🔢 Ordem dos Argumentos](#-ordem-dos-argumentos) |
| 🚨 Erros | [🚨 Exibindo Erros](#-exibindo-erros) |
| ⚖️ Comparações | [⚖️ Operadores de Comparação](#️-operadores-de-comparação) |
| 📝 Strings | [📝 STRING](#-string) |
| 🔢 Inteiros | [🔢 INTEIROS](#-inteiros) |
| 📁 Arquivos | [📁 OPERADORES DE ARQUIVO](#-operadores-de-arquivo) |
| 🧠 Lógica | [🧠 Operadores Lógicos](#-operadores-lógicos) |
| ➕ Matemática | [➕ Operadores Aritméticos](#-operadores-aritméticos) |
| 📦 Estruturas | [📦 Argumentos, Variáveis e Arrays](#-argumentos-variáveis-e-arrays) |
| 🎯 Argumentos | [🎯 Argumentos](#-argumentos) |
| 🧠 Variáveis | [🧠 Variáveis Especiais](#-variáveis-especiais) • [📌 Variáveis](#-variáveis) |
| 🗂️ Arrays | [🗂️ Arrays](#️-arrays) |
| ⌨️ Entrada/Saída | [⌨️ Input e Output](#️-input-e-output) |
| 📥 Entrada | [📥 INPUT](#-input) |
| 📤 Saída | [📤 OUTPUT](#-output) |
| 🔀 Fluxo | [🔀 Controle de Fluxo em Bash](#-controle-de-fluxo-em-bash) |
| 🔁 Loops | [🔁 FOR](#-for) • [🔁 WHILE](#-while) • [🔁 UNTIL](#-until) |
| 🔀 Condições | [IF - ELSE](#-if---else) • [🔀 SWITCH - CASE](#-switch---case) |
| 🧩 Funções | [🧩 Funções](#-funções) |
| ⚙️ Funções | [Declarando funções](#declarando-funções) • [Chamando uma função](#chamando-uma-função) |
| 🎯 Parâmetros | [Passando argumentos](#passando-argumentos) • [Variáveis globais](#variáveis-globais) |
| 🔙 Retorno | [🔙 Retorno de função](#-retorno-de-função) |
| 🐞 Debug | [🐞 Debugging](#-debugging) |

---

# 🐚 Bash Script

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

# 🔀 Controle de Fluxo em Bash

O **controle de fluxo** define como o script será executado, permitindo criar **decisões, repetições e organização do código**.

---

# IF - ELSE

Estrutura condicional usada para executar comandos **com base em condições**.

## Estrutura

```bash
if [ condição ]
then
    comandos
else
    comandos
fi
````

Também podemos usar **elif** para múltiplas condições.

```bash
if [ condição ]
then
    comandos
elif [ condição ]
then
    comandos
else
    comandos
fi
```

⚠️ **Importante:** sempre colocar **espaço depois dos colchetes**

```bash
if [ $var -ne 35 ]
```

---

# 🔁 FOR

O `for` é utilizado para **percorrer listas de valores**.

## Exemplo

```bash
for ip in "10.10.10.170 10.10.10.174 10.10.10.175"
do
    ping -c 1 $ip
done
```

O script irá:

1. Percorrer cada IP da lista
2. Executar o `ping`
3. Repetir até terminar a lista

## Em uma única linha

Também podemos escrever o `for` em uma linha:

```bash
for ip in 10.10.10.170 10.10.10.174; do ping -c1 $ip; done
```

---

# 🔁 WHILE

O `while` executa comandos **enquanto uma condição for verdadeira**.

```bash
while [ $stat -eq 1 ]
do
    comandos
done
```

Enquanto `stat` for igual a **1**, o loop continuará executando.

---

# 🔁 UNTIL

O `until` é **o oposto do while**.

* `while` → executa enquanto for **true**
* `until` → executa enquanto for **false**

---

# 🔀 SWITCH - CASE

Estrutura usada para criar **menus de opções**.

```bash
read -p "Selecione a opção: " opt

case $opt in
1) network_range ;;
2) ping_host ;;
3) network_range && ping_host ;;
*) exit 0 ;;
esac
```

Explicação:

* `1)` executa `network_range`
* `2)` executa `ping_host`
* `3)` executa **as duas funções**
* `*` qualquer outra opção → encerra o script

`;;` indica o **fim do bloco** de cada opção.

---

# 🧩 FUNÇÕES

Funções permitem **organizar e reutilizar código** dentro do script.

---

# Declarando funções

Existem **duas formas**.

## Método 1

```bash
function minha_func {
    comandos
}
```

## Método 2

```bash
minha_func() {
    comandos
}
```

---

# Chamando uma função

Para executar a função basta usar o **nome dela**.

```bash
minha_func
```

---

# Passando argumentos

Podemos passar argumentos para funções.

```bash
minha_func "argumento"
```

Dentro da função podemos acessar usando:

```
$1
$2
$#
```

---

# Variáveis globais

No Bash, **todas as variáveis são globais por padrão**.

Isso significa que variáveis criadas no script **podem ser usadas dentro das funções** sem precisar passar argumentos.

---

# 🔙 Retorno de função

Funções retornam um **código de status**.

| Código | Significado |
| ------ | ----------- |
| 0      | Sucesso     |
| 1      | Erro        |

Podemos verificar usando:

```bash
$?
```

---

# 🐞 DEBUGGING

O debugging permite **identificar erros no script**.

Podemos usar:

| Flag | Função                          |
| ---- | ------------------------------- |
| `-x` | mostra execução linha por linha |
| `-v` | mostra o script sendo executado |

## Exemplo

```bash
bash -x teste.sh
```

ou

```bash
bash -x -v teste.sh
```

O Bash irá mostrar:

* fluxo de execução do script
* comandos executados
* ponto exato onde ocorreu o erro
