# 📑 Sumário

| Categoria | Conteúdo |
|---|---|
| 📂 Sistema de Arquivos | [🗂️ Hierarquia dos Sistemas de Arquivo](#️-hierarquia-dos-sistemas-de-arquivo-linux) • [🌳 Diretório raiz](#-diretório-raiz) |
| 📁 Diretórios Linux | [📁 Principais diretórios](#-principais-diretórios-e-suas-funções) |
| ⚙️ Sistema | [/bin](#️-diretórios-de-sistema) • [/boot](#️-diretórios-de-sistema) • [/sbin](#️-diretórios-de-sistema) |
| 🖥️ Hardware | [/dev](#️-hardware-e-configuração) • [/etc](#️-hardware-e-configuração) |
| 👤 Usuários | [/home](#-diretórios-de-usuários) • [/root](#-diretórios-de-usuários) |
| 💾 Programas | [/mnt](#-armazenamento-e-programas) • [/opt](#-armazenamento-e-programas) • [/usr](#-armazenamento-e-programas) |
| 🧹 Arquivos temporários | [/tmp](#-arquivos-temporários-e-variáveis) • [/var](#-arquivos-temporários-e-variáveis) |
| 🧠 Estrutura prática | [🧠 Exemplo prático da estrutura](#-exemplo-prático-da-estrutura) |
| 🐚 Shell | [🐚 Introdução ao Shell](#-introdução-ao-shell) |
| 🖥️ Terminal | [🖥️ Shell vs Terminal](#️-shell-vs-terminal) |
| ❓ Ajuda | [❓ Comandos de ajuda](#-comandos-de-ajuda) |
| 👤 Usuário | [👤 Informações do usuário](#-informações-do-usuário) |
| 🌐 Rede | [🌐 Informações de rede e máquina](#-informações-de-rede-e-máquina) |
| 🧠 Sistema | [🧠 Informações do sistema](#-informações-do-sistema) |
| 📁 Navegação | [📁 Diretórios e navegação](#-diretórios-e-navegação) |
| 🌐 Comandos de rede | [🌐 Comandos de rede](#-comandos-de-rede) |
| 🔌 Conexões | [🔌 Verificando conexões](#-verificando-conexões) |
| 🔍 Processos | [🔍 Alternativas e análise de processos](#-alternativas-e-análise-de-processos) |
| 🔌 Dispositivos | [🔌 Dispositivos e arquivos abertos](#-dispositivos-e-arquivos-abertos) |
| 🔍 Reconhecimento | [🔍 Coletando informações no sistema](#-coletando-informações-no-sistema) |
| 🧠 Sistema | [🧠 Descobrir hardware e versão](#-descobrir-hardware-e-versão-do-sistema) |
| 👤 Privilégios | [👤 Verificar privilégios](#-verificar-privilégios-do-usuário) |
| 📧 Email | [📧 Descobrir e-mails](#-descobrir-e-mails-do-usuário) |
| 🐚 Shell | [🐚 Descobrir o shell](#-descobrir-o-shell-do-usuário) |
| 🌐 Interfaces | [🌐 Interfaces de rede](#-verificar-interfaces-de-rede) |
| 🔄 Fluxos Linux | [💻 STDIN / STDOUT / STDERR](#-stdin--stdout--stderr) |
| 🚫 Erros | [🚫 Ocultando erros](#-ocultando-erros) |
| 💾 Redirecionamento | [💾 Salvando saída](#-salvando-saída-normal-stdout) |
| 📁 Logs | [📁 Salvando saída e erros](#-salvando-saída-e-erros-separadamente) |
| ➕ Append | [➕ Adicionando ao arquivo](#-adicionando-ao-arquivo-sem-apagar) |
| 📥 Entrada | [📥 Redirecionando entrada](#-redirecionando-entrada-stdin) |
| 🔗 Pipes | [🔗 Pipes](#-pipes) |
| 🔎 Filtros | [🔎 Filtrando Conteúdo](#-filtrando-conteúdo) |
| 📄 Navegação | [MORE](#-more) • [LESS](#-less) |
| 🔝 Linhas | [HEAD](#-head) • [TAIL](#-tail) |
| 🔤 Ordenação | [SORT](#-sort) |
| 🔍 Busca | [GREP](#-grep) |
| ✂️ Texto | [CUT](#-cut) • [TR](#-tr) |
| 📊 Formatação | [COLUMN](#-column) |
| 🧠 Processamento | [AWK](#-awk) |
| ✏️ Substituição | [SED](#️-sed) |
| 🔢 Contagem | [WC](#-wc) |
| 🧩 Regex | [🧩 Expressões Regulares](#-expressões-regulares) |
| 🧱 Estruturas | [Parênteses](#-agrupamentos) • [Colchetes](#-agrupamentos) • [Chaves](#-agrupamentos) |
| 🔀 Operadores | [🔀 Operadores Regex](#-operadores) |
| 📦 Pacotes | [📦 Gerenciamento de Pacotes](#-gerenciamento-de-pacotes) |
| 🛠️ Pacotes Linux | [APT](#️-apt) |
| 🐍 Python | [PIP](#-pip) |
| 🌱 Git | [GIT](#-git) |
| 🌐 Serviços | [🌐 Serviços de Rede](#-serviços-de-rede) |
| 🔐 Acesso remoto | [SSH](#-ssh) |
| 📂 Compartilhamento | [NFS](#-nfs) |
| 🌍 Web | [Servidor Web Apache](#-servidor-web-apache) |
| 🐍 Servidor rápido | [Servidor HTTP com Python](#-servidor-http-com-python) |
| 🔒 VPN | [VPN](#-vpn) |
| 🌐 Apache | [🌐 Servidor Apache](#-servidor-apache) |
| 🧩 Módulos | [MOD_SSL](#-mod_ssl) • [MOD_PROXY](#-mod_proxy) |
| 🧠 HTTP | [MOD_HEADERS e MOD_REWRITE](#-mod_headers-e-mod_rewrite) |
| 💻 Dinâmico | [Suporte a sites dinâmicos](#-suporte-a-sites-dinâmicos) |
| ⚙️ Instalação | [Instalar Apache](#️-instalando-e-iniciando-o-apache) |
| 🌐 Requisições | [🌐 CURL e WGET](#-curl-e-wget) |
| 🔎 Recon | [Reconhecimento Web](#-muito-usado-em-reconhecimento-recon) |
| 🛠️ CURL | [Principais flags do curl](#️-principais-flags-do-curl) |
| 🌐 Rede | [🌐 Configuração de Rede](#-configuração-de-rede) |
| 📡 Interfaces | [IFCONFIG](#-ifconfig) |
| 🔛 Interface | [Ativar ou desativar interface](#-ativar-ou-desativar-interface) |
| 🧾 IP | [Atribuir IP manualmente](#-atribuir-ip-manualmente) |
| 🌍 DNS | [Configuração de DNS](#-configuração-de-dns) |
| 📝 Permanente | [Configuração permanente](#-configuração-permanente) |
| 📊 Monitoramento | [📊 Monitoramento da Rede](#-monitoramento-da-rede) |
| 🛠️ Ferramentas | [Ferramentas importantes](#️-ferramentas-importantes) |
| 📡 Conectividade | [PING](#-ping) |
| 🔌 Portas | [NETSTAT](#-netstat) |


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

# 🌍 Servidor Apache

## 🧩 Módulos do Apache

O **Apache** funciona de forma modular 🧱.
Isso significa que podemos ativar apenas os recursos que precisamos, tornando o servidor mais leve e personalizado.

Cada módulo tem uma função específica.

### 🔐 MOD_SSL

- Permite comunicação segura via **HTTPS**.
- Criptografa os dados entre navegador e servidor.
- Essencial para sites que lidam com login, pagamentos e dados sensíveis.

---

### 🔀 MOD_PROXY

- Atua como intermediário.
- Controla e redireciona requisições.
- Muito usado em servidores proxy e balanceadores de carga.

---

### 🧠 MOD_HEADERS e MOD_REWRITE

Permitem maior controle sobre o tráfego HTTP.

- **MOD_HEADERS** → Manipula cabeçalhos HTTP.
- **MOD_REWRITE** → Reescreve URLs (muito usado para rotas amigáveis).

Exemplo prático:

- Transformar `/produto.php?id=10`
- Em `/produto/10`

---

## 💻 Suporte a sites dinâmicos

O Apache suporta linguagens como:

- PHP 🐘
- JavaScript ⚡
- Python 🐍

Isso permite criar **sites dinâmicos**, que interagem com banco de dados e usuários.

---

## ⚙️ Instalando e iniciando o Apache

### 📦 Instalar

```bash id="6rj4qt"
sudo apt install apache2
```

### ▶️ Iniciar servidor

```bash id="e0y7zn"
service apache2 start
```

Por padrão, usa a **porta 80 (HTTP)**.

Arquivo para alterar portas:

```bash id="1kq3mv"
/etc/apache2/ports.conf
```

---

# 🌐 CURL e WGET

São ferramentas de linha de comando para fazer requisições web.

Suportam:

- HTTP
- HTTPS
- FTP

Permitem:

- Testar conectividade
- Ver cabeçalhos HTTP
- Baixar arquivos
- Baixar código-fonte
- Fazer requisições GET, POST, PUT, DELETE

---

## 🔎 Muito usado em Reconhecimento (Recon)

Durante a fase de **content discovery**, podemos:

- Buscar endpoints
- Descobrir APIs
- Encontrar diretórios ocultos
- Extrair URLs e subdomínios

### 🕷️ Crawling

- Baixar página
- Extrair links
- Visitar links
- Repetir o processo

Spidering = crawling automatizado.

---

## 🛠️ Principais flags do curl

```bash id="0x4tkl"
curl -i http://site.com
```

- `-i` → mostra cabeçalhos HTTP.

```bash id="c7m92q"
curl -v http://site.com
```

- `-v` → modo detalhado (debug).

```bash id="x1q8ja"
curl -X POST http://site.com
```

- `-X` → define método HTTP.

```bash id="p3mw7b"
curl -d "usuario=admin" http://site.com
```

- `-d` → envia dados (POST).

---

# 🌐 Configuração de Rede

## 📡 IFCONFIG

Mostra interfaces de rede:

```bash id="c8b9rz"
ifconfig
```

Hoje está sendo substituído por:

```bash id="f1v6kx"
ip addr
```

---

## 🔛 Ativar ou desativar interface

Ativar:

```bash id="n7l2xy"
sudo ifconfig eth0 up
```

ou

```bash id="v8r3qt"
sudo ip link set eth0 up
```

Desativar:

```bash id="k2z5mu"
sudo ip link set eth0 down
```

Verificar status:

```bash id="s9t4ra"
ip a
```

---

## 🧾 Atribuir IP manualmente

```bash id="m1q8uz"
sudo ifconfig eth0 192.168.1.2
```

Máscara:

```bash id="h3w9pl"
sudo ifconfig eth0 netmask 255.255.255.0
```

Gateway:

```bash id="r7c2fn"
sudo route add default gw 192.168.1.1 eth0
```

Ver rotas:

```bash id="y8k4vd"
ip route
```

---

## 🌍 Configuração de DNS

Arquivo:

```bash id="u5b7nm"
/etc/resolv.conf
```

⚠️ Alterações aqui normalmente **não são permanentes**.

---

## 📝 Configuração permanente

Editar:

```bash id="d4t6zs"
sudo nano /etc/network/interfaces
```

Exemplo:

```text
auto eth0
iface eth0 inet static
address 192.168.1.2
netmask 255.255.255.0
gateway 192.168.1.1
dns-nameservers 8.8.8.8 8.8.4.4
```

Explicação:

- `auto` → ativa no boot.
- `inet` → IPv4.
- `static` → IP fixo.
- `dhcp` → IP automático.
- DNS → servidores públicos do Google.

Após alterar:

```bash id="w2p8rs"
sudo systemctl restart network
```

---

# 📊 Monitoramento da Rede

Envolve:

- Captura 📥
- Análise 🔎
- Interpretação 🧠

---

## 🛠️ Ferramentas importantes

- ping
- traceroute
- netstat
- tcpdump
- wireshark
- nmap

---

## 📡 PING

Testa conectividade.

```bash id="x7q1lt"
ping google.com
```

Define quantidade:

```bash id="c3r8pv"
ping -c 4 google.com
```

Ele envia pacotes ICMP e mede o tempo de resposta.

---

## 🔌 NETSTAT

Mostra conexões e portas abertas:

```bash id="p6t2zn"
netstat -tulnp4
```

Significado das flags:

- `-t` → TCP
- `-u` → UDP
- `-l` → portas escutando
- `-n` → IP numérico
- `-p` → programa responsável
- `4` → IPv4

---
