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

* **Terminal**
  Interface gráfica onde digitamos comandos.
  É a **janela** que abre no sistema.

* **Shell**
  Programa que roda dentro do terminal e **processa os comandos** digitados.
  Exemplo comum:

  * **`bash`** (Bourne Again Shell)

---

## ❓ Comandos de ajuda

Servem para obter informações sobre ferramentas e comandos.

* **`man <ferramenta>`**
  Mostra o **manual completo** do comando.

* **`<ferramenta> --help`**
  Mostra ajuda com opções disponíveis.

* **`<ferramenta> -h`**
  Versão **resumida** da ajuda.

* **`apropos <palavra>`**
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

* **`whoami`**
  Mostra o **nome do usuário atual**.

* **`id`**
  Exibe a identidade do usuário:

  * UID
  * GID
  * Grupos

📌 Se o usuário estiver em grupos como **`adm`** ou **`sudo`**, ele possui **privilégios administrativos**.

---

### 🌐 Informações de rede e máquina

* **`hostname`**
  Nome da máquina na rede.

* **`hostname -i`**
  Mostra o **endereço IP** da máquina.

---

### 🧠 Informações do sistema

* **`uname`**
  Mostra informações básicas do sistema operacional.

* **`uname -a`**
  Mostra informações **detalhadas**:

  * Kernel
  * Arquitetura
  * Hostname
  * Data de compilação

---

### 📁 Diretórios e navegação

* **`pwd`**
  Mostra o **caminho do diretório atual**.

---

## 🌐 Comandos de rede

* **`ifconfig`**
  Visualiza ou configura interfaces de rede.

* **`ip`**
  Ferramenta moderna para:

  * Roteamento
  * Interfaces de rede
  * Dispositivos
  * Túneis

---

### 🔌 Verificando conexões

* **`netstat`**
  Mostra o estado da rede.

Opções importantes:

* **`-t`** → conexões TCP
* **`-u`** → conexões UDP
* **`-l`** → portas em escuta (listening)
* **`-n`** → mostra números (sem resolver nomes)
* **`-p`** → programa usando a porta
* **`-4`** → conexões IPv4

📌 Exemplo:

```
netstat -tulnp
```

---

### 🔍 Alternativas e análise de processos

* **`ss`**
  Alternativa moderna ao `netstat` para verificar portas e conexões.

* **`ps`**
  Mostra o status dos processos em execução.

---

### 🔌 Dispositivos e arquivos abertos

* **`lsusb`**
  Lista dispositivos USB conectados.

* **`lsof`**
  Lista **arquivos abertos** no sistema.

---

## 🔍 Coletando informações no sistema

Após obter acesso a uma máquina, é importante coletar informações básicas para entender o ambiente, privilégios e configurações do sistema.

---

### 🧠 Descobrir hardware e versão do sistema

* **`uname -a`**
  Mostra informações completas sobre o sistema operacional:

  * Nome do sistema
  * Versão do kernel
  * Arquitetura
  * Data de compilação

📌 **Exemplo:**

```
uname -a
```

---

### 👤 Verificar privilégios do usuário

* **`id`**
  Mostra a identidade do usuário atual:

  * UID (User ID)
  * GID (Group ID)
  * Grupos aos quais pertence

📌 Se o usuário estiver em grupos como **`sudo`** ou **`adm`**, pode ter **privilégios administrativos**.

---

### 📧 Descobrir e-mails do usuário

* Diretório:

```
/var/mail/usuario
```

Contém a caixa de entrada local do usuário, onde podem existir:

* Mensagens do sistema
* Alertas
* Informações importantes

---

### 🐚 Descobrir o shell do usuário

* **`echo $SHELL`**
  Mostra qual shell o usuário está utilizando.

📌 Exemplo de resultado:

```
/bin/bash
```

---

### 🌐 Verificar interfaces de rede

* **`ifconfig`**
  Mostra informações das interfaces de rede:

  * Endereço IP
  * Máscara de rede
  * Estado da interface

📌 Útil para entender:

* Conectividade
* Sub-redes
* Interfaces ativas

---
