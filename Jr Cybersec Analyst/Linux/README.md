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
