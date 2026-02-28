## 🗂️ Hierarquia dos Sistemas de Arquivo (Linux)

O sistema de arquivos do Linux é organizado em uma **estrutura de árvore**, onde tudo começa a partir de um diretório principal chamado **raiz** (`/`).
A partir dele, surgem vários subdiretórios com funções específicas no sistema.

---

### 🌳 Diretório raiz

- **`/`** → Diretório principal do sistema.
- Todos os outros diretórios estão dentro dele.

---

### 📁 Principais diretórios e suas funções

#### ⚙️ Diretórios de sistema

- **`/bin`**
  Contém **comandos essenciais** do sistema (ex: `ls`, `cp`, `mv`).

- **`/boot`**
  Arquivos necessários para a **inicialização do sistema operacional**.

- **`/sbin`**
  Executáveis usados para **administração do sistema** (geralmente para o root).

---

#### 🖥️ Hardware e configuração

- **`/dev`** (devices)
  Contém arquivos que representam os **dispositivos de hardware**.

- **`/etc`**
  Arquivos de **configuração do sistema e de aplicativos**.

---

#### 👤 Diretórios de usuários

- **`/home`**
  Cada usuário possui um subdiretório para **armazenar seus arquivos pessoais**.

- **`/root`**
  Diretório pessoal do **usuário administrador (root)**.

---

#### 💾 Armazenamento e programas

- **`/mnt`**
  **Ponto de montagem** para dispositivos temporários:
  - Pendrives
  - HDs
  - Partições
  - Mídias removíveis

- **`/opt`**
  Arquivos de **programas opcionais** ou de terceiros.

- **`/usr`**
  Contém:
  - Executáveis
  - Bibliotecas
  - Manuais do sistema

---

#### 🧹 Arquivos temporários e variáveis

- **`/tmp`**
  Armazena **arquivos temporários**.
  Normalmente é **apagado na inicialização**.

- **`/var`**
  Arquivos de **dados variáveis**, como:
  - Logs do sistema
  - Emails
  - Arquivos de servidores web

---

### 🧠 Exemplo prático da estrutura

```
/
├── bin
├── boot
├── dev
├── etc
├── home
│   └── usuario
├── mnt
├── opt
├── root
├── sbin
├── tmp
├── usr
└── var
```

---

---

## 🐚 Introdução ao Shell

No Linux, a interação com o sistema acontece por meio do **terminal** e do **shell**, que possuem funções diferentes.

---

### 🖥️ Shell vs Terminal

- **Terminal**
  Interface gráfica onde digitamos comandos.
  É a **janela** que abre no sistema.

- **Shell**
  Programa que roda dentro do terminal e **processa os comandos** digitados.
  Exemplo comum:
  - **`bash`** (Bourne Again Shell)

---

## ❓ Comandos de ajuda

Servem para obter informações sobre ferramentas e comandos.

- **`man <ferramenta>`**
  Mostra o **manual completo** do comando.

- **`<ferramenta> --help`**
  Mostra ajuda com opções disponíveis.

- **`<ferramenta> -h`**
  Versão **resumida** da ajuda.

- **`apropos <palavra>`**
  Procura a palavra nos **manuais do sistema**.

📌 **Exemplo:**

```
man ls
ls --help
apropos network
```

---

## 💻 Comandos básicos do sistema

### 👤 Informações do usuário

- **`whoami`**
  Mostra o **nome do usuário atual**.

- **`id`**
  Exibe a identidade do usuário:
  - UID
  - GID
  - Grupos

📌 Se o usuário estiver em grupos como **`adm`** ou **`sudo`**, ele possui **privilégios administrativos**.

---

### 🌐 Informações de rede e máquina

- **`hostname`**
  Nome da máquina na rede.

- **`hostname -i`**
  Mostra o **endereço IP** da máquina.

---

### 🧠 Informações do sistema

- **`uname`**
  Mostra informações básicas do sistema operacional.

- **`uname -a`**
  Mostra informações **detalhadas**:
  - Kernel
  - Arquitetura
  - Hostname
  - Data de compilação

---

### 📁 Diretórios e navegação

- **`pwd`**
  Mostra o **caminho do diretório atual**.

---

## 🌐 Comandos de rede

- **`ifconfig`**
  Visualiza ou configura interfaces de rede.

- **`ip`**
  Ferramenta moderna para:
  - Roteamento
  - Interfaces de rede
  - Dispositivos
  - Túneis

---

### 🔌 Verificando conexões

- **`netstat`**
  Mostra o estado da rede.

Opções importantes:

- **`-t`** → conexões TCP
- **`-u`** → conexões UDP
- **`-l`** → portas em escuta (listening)
- **`-n`** → mostra números (sem resolver nomes)
- **`-p`** → programa usando a porta
- **`-4`** → conexões IPv4

📌 Exemplo:

```
netstat -tulnp
```

---

### 🔍 Alternativas e análise de processos

- **`ss`**
  Alternativa moderna ao `netstat` para verificar portas e conexões.

- **`ps`**
  Mostra o status dos processos em execução.

---

### 🔌 Dispositivos e arquivos abertos

- **`lsusb`**
  Lista dispositivos USB conectados.

- **`lsof`**
  Lista **arquivos abertos** no sistema.

---

## 🔍 Coletando informações no sistema

Após obter acesso a uma máquina, é importante coletar informações básicas para entender o ambiente, privilégios e configurações do sistema.

---

### 🧠 Descobrir hardware e versão do sistema

- **`uname -a`**
  Mostra informações completas sobre o sistema operacional:
  - Nome do sistema
  - Versão do kernel
  - Arquitetura
  - Data de compilação

📌 **Exemplo:**

```
uname -a
```

---

### 👤 Verificar privilégios do usuário

- **`id`**
  Mostra a identidade do usuário atual:
  - UID (User ID)
  - GID (Group ID)
  - Grupos aos quais pertence

📌 Se o usuário estiver em grupos como **`sudo`** ou **`adm`**, pode ter **privilégios administrativos**.

---

### 📧 Descobrir e-mails do usuário

- Diretório:

```
/var/mail/usuario
```

Contém a caixa de entrada local do usuário, onde podem existir:

- Mensagens do sistema
- Alertas
- Informações importantes

---

### 🐚 Descobrir o shell do usuário

- **`echo $SHELL`**
  Mostra qual shell o usuário está utilizando.

📌 Exemplo de resultado:

```
/bin/bash
```

---

### 🌐 Verificar interfaces de rede

- **`ifconfig`**
  Mostra informações das interfaces de rede:
  - Endereço IP
  - Máscara de rede
  - Estado da interface

📌 Útil para entender:

- Conectividade
- Sub-redes
- Interfaces ativas

---

# 💻 STDIN / STDOUT / STDERR

## 🔄 Conceitos básicos

Quando executamos um comando no Linux, ele trabalha com **3 fluxos padrão**:

- **STDIN (0)** → Entrada de dados (ex: teclado).
- **STDOUT (1)** → Saída normal do comando (resultado esperado).
- **STDERR (2)** → Saída de erro (mensagens de falha).

📌 Pense assim:

- Você digita algo → **STDIN**
- O sistema responde → **STDOUT**
- Algo dá errado → **STDERR**

Esses fluxos podem ser **redirecionados** para arquivos ou outros comandos.

---

## 🚫 Ocultando erros

```bash
2>/dev/null
```

- `2>` → estamos redirecionando o fluxo de erro (STDERR).
- `/dev/null` → é como uma “lixeira”, tudo enviado para lá desaparece.

✅ Usamos isso quando queremos limpar a tela e ignorar erros irrelevantes.

Exemplo:

```bash
find /etc/ -name teste 2>/dev/null
```

---

## 💾 Salvando saída normal (STDOUT)

```bash
> resultado.txt
```

- `>` salva a saída normal em um arquivo.
- Se o arquivo já existir, ele será **sobrescrito**.

Exemplo:

```bash
ls > arquivos.txt
```

---

## 📁 Salvando saída e erros separadamente

```bash
1> stdout.txt 2> stderr.txt
```

- `1>` → saída normal.
- `2>` → erros.

Isso é útil para analisar depois o que deu certo e o que deu errado.

---

## ➕ Adicionando ao arquivo (sem apagar)

- `>` → sobrescreve.
- `>>` → adiciona ao final.

Exemplo:

```bash
echo "novo texto" >> arquivo.txt
```

Isso mantém o conteúdo antigo e adiciona o novo no final.

---

## 📥 Redirecionando entrada (STDIN)

- `<` indica que estamos usando um arquivo como entrada.

Exemplo:

```bash
cat < arquivo.txt
```

### Criando conteúdo manualmente:

```bash
cat << EOF > entrada.txt
Olá mundo
EOF
```

O sistema espera você digitar `EOF` para finalizar.

---

# 🔗 Pipes

O pipe (`|`) conecta comandos.

Ele pega a **saída (STDOUT)** de um comando e envia como **entrada (STDIN)** para outro.

Exemplo:

```bash
cat /etc/passwd | grep bash
```

Aqui:

- `cat` mostra o conteúdo.
- `grep` filtra apenas as linhas com “bash”.

Podemos encadear vários:

```bash
cat /etc/passwd | grep bash | wc -l
```

Isso conta quantas linhas possuem “bash”.

---

# 🔎 Filtrando Conteúdo

## 📄 MORE

```bash
cat /etc/passwd | more
```

- Mostra o conteúdo página por página.
- Começa do início.
- `q` → sair.
- O texto permanece na tela.

---

## 📜 LESS

Semelhante ao `more`, mas mais avançado.

- Permite navegar para cima e para baixo.
- O conteúdo desaparece ao sair.

---

## 🔝 HEAD

Mostra as 10 primeiras linhas:

```bash
head /etc/passwd
```

Podemos alterar a quantidade:

```bash
head -n 5 arquivo.txt
```

---

## 🔚 TAIL

Mostra as 10 últimas linhas:

```bash
tail /etc/passwd
```

Muito usado para acompanhar logs:

```bash
tail -f /var/log/syslog
```

---

## 🔤 SORT

Organiza linhas:

```bash
sort arquivo.txt
```

Pode ordenar:

- Alfabeticamente
- Numericamente (`-n`)

---

## 🔍 GREP

Busca padrões dentro do texto:

```bash
grep "bash" /etc/passwd
```

### Expressões úteis

- Começa com:

```bash
grep "^root"
```

- Termina com:

```bash
grep "bash$"
```

- Excluir padrão:

```bash
grep -v "nologin"
```

---

## ✂️ CUT

Extrai partes específicas do texto.

```bash
cut -d":" -f1 /etc/passwd
```

- `-d` → delimitador.
- `-f` → campo desejado.

---

## 🔄 TR

Substitui caracteres:

```bash
tr ":" " "
```

Exemplo:

```bash
cat /etc/passwd | tr ":" " "
```

---

## 📊 COLUMN

Organiza o texto em colunas:

```bash
column -t
```

Funciona melhor quando há espaços separando os dados.

---

## 🧠 AWK

Ferramenta poderosa para trabalhar com colunas.

```bash
awk '{print $1, $NF}'
```

- `$1` → primeira coluna.
- `$NF` → última coluna.

---

## ✏️ SED

Editor para substituir texto em massa.

```bash
sed 's/bin/HTB/g'
```

- `s` → substituir.
- `g` → todas as ocorrências.

Salvar em arquivo:

```bash
sed 's/bin/HTB/g' arquivo.txt > novo.txt
```

---

## 🔢 WC

Conta informações:

```bash
wc -l arquivo.txt
```

- `-l` → linhas.
- `-w` → palavras.
- `-c` → caracteres.

---

# 🧩 Expressões Regulares

São padrões usados para buscas avançadas.

Ativar modo estendido:

```bash
grep -E
```

---

## 🧱 Agrupamentos

### ( ) Parênteses

Agrupam expressões.

### [ ] Colchetes

Classe de caracteres:

- `[a-z]`
- `[A-Za-z0-9]`
- `[^0-9]`

### { } Chaves

Quantidade de repetição:

- `a{2,5}`
- `.{0,3}`

---

## 🔀 Operadores

- `|` → OU
- `.*` → qualquer sequência

Exemplo:

```bash
grep -E "(Password.*yes)"
```

---

# 📦 Gerenciamento de Pacotes

## 🛠️ APT

Gerencia pacotes no Debian/Ubuntu:

```bash
apt list --installed
```

Instalar:

```bash
sudo apt install nome-do-pacote
```

---

## 🐍 PIP

Gerenciador de pacotes Python:

```bash
pip install scapy
```

---

## 🌱 GIT

Clonar repositórios:

```bash
git clone https://github.com/samratashok/nishang
```

---

# 🌐 Serviços de Rede

## 🔐 SSH

Permite acessar máquinas remotamente com segurança.

Instalar:

```bash
sudo apt install openssh-server -y
```

Arquivo de configuração:

```
/etc/ssh/sshd_config
```

📌 SSH protege apenas aquela conexão específica.

---

## 📂 NFS

Compartilha arquivos na rede como se fossem locais.

```bash
sudo apt install nfs-kernel-server -y
```

Configuração:

```
/etc/exports
```

---

## 🌍 Servidor Web (Apache)

Instalar:

```bash
sudo apt install apache2 -y
```

Configuração:

```
/etc/apache2/apache2.conf
```

Diretório padrão:

```
/var/www
```

---

## 🐍 Servidor HTTP com Python

Forma rápida de subir um servidor:

```bash
python3 -m http.server
```

Porta personalizada:

```bash
python3 -m http.server 443
```

---

## 🔒 VPN

Cria um túnel criptografado entre você e uma rede remota.

Instalar OpenVPN:

```bash
sudo apt install openvpn
```

Configuração:

```
/etc/openvpn/update-resolv-conf
```

📌 Diferença importante:

- **VPN** → protege todo o tráfego do dispositivo.
- **SSH** → protege apenas a conexão entre cliente e servidor.

---
