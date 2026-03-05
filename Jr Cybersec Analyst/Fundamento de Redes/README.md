# 📑 Sumário

| Seção | Conteúdo |
|------|----------|
| 🌐 Redes | [O que é uma Rede](#-o-que-é-uma-rede) |
| 📚 Conceitos | [Conceitos Iniciais](#-conceitos-iniciais) |
| 🏠 Tipos de Rede | [LAN](#-lan-local-area-network) • [MAN](#️-man-metropolitan-area-network) • [WAN](#-wan-wide-area-network) |
| 🔗 Conexão LAN/WAN | [LAN e WAN Funcionando Juntas](#-lan-e-wan-funcionando-juntas) |
| 🧩 Modelo OSI | [Modelo OSI](#-modelo-osi) |
| 📡 Camadas OSI | [Física](#1️⃣-camada-física) • [Enlace](#2️⃣-camada-de-enlace-data-link) • [Rede](#3️⃣-camada-de-rede) • [Transporte](#4️⃣-camada-de-transporte) • [Sessão](#5️⃣-camada-de-sessão) • [Apresentação](#6️⃣-camada-de-apresentação) • [Aplicação](#7️⃣-camada-de-aplicação) |
| 🔁 Exemplos | [Envio de Arquivo](#-exemplo-1-envio-de-um-arquivo) • [Acesso a Site](#-exemplo-2-acesso-a-um-site) |
| 🧱 Componentes de Rede | [Componentes de uma Rede](#-componentes-de-uma-rede) |
| 🖥️ Dispositivos | [End Devices](#️-end-devices-dispositivos-finais) • [Intermediary Devices](#-intermediary-devices-dispositivos-intermediários) |
| 🗄️ Servidores | [Servers](#️-servers-servidores) |
| 🧩 Hardware de Rede | [Placa de Rede](#-placa-de-rede) |
| 🚦 Roteamento | [Roteadores](#-roteadores) |
| 🔁 Switches e Hubs | [Switch](#-switch) • [Hub](#-hub) |
| 🏗️ Arquitetura da Internet | [Arquitetura da Internet](#️-arquitetura-da-internet) |
| 🔄 Modelos de Comunicação | [P2P](#-ponto-a-ponto-p2p) • [Cliente-Servidor](#-cliente-servidor) |
| 🧱 Arquitetura de Sistemas | [Single-tier](#1️⃣-camada-única-single-tier) • [Two-tier](#2️⃣-dois-níveis-two-tier) • [Three-tier](#3️⃣-três-níveis-three-tier) • [N-tier](#-n-camadas-n-tier) |
| 🔀 Arquitetura Híbrida | [Arquitetura Híbrida](#-arquitetura-híbrida) |
| ☁️ Cloud | [Arquitetura em Nuvem](#️-arquitetura-em-nuvem) |
| 🧠 SDN | [Arquitetura Definida por Software](#-arquitetura-definida-por-software-sdn) |
| 🔁 Fluxo de Dados | [Fluxo de Acesso a Site](#-exemplo-de-fluxo-de-dados-acesso-a-um-site) |
| 🧪 Ferramentas Linux | [Interfaces de Rede](#-interfaces-de-rede-linux) |
| 🕵️ Proxy | [Proxy](#️-proxy) |
| 🔀 Tipos de Proxy | [Forward Proxy](#-proxy-de-encaminhamento-forward-proxy) • [Reverse Proxy](#-proxy-reverso-reverse-proxy) |
| 📡 Protocolos | [Protocolos de Rede](#-terminologias-e-protocolos) |
| 🌐 Identificadores Web | [URI](#-uri-uniform-resource-identifier) • [URL](#-url-uniform-resource-locator) |
| ✅ Final | [Resumo Final](#-resumo-final) |




# 🌐 O que é uma Rede

Uma **rede** é o conjunto de dois ou mais dispositivos (_hosts_) ligados por qualquer meio (cabo coaxial, fibra óptica, wireless, etc.) que compartilham recursos entre si, como **informações** e **recursos de hardware**.

---

## 📌 Conceitos Iniciais

- **Nodes (Nós):** Dispositivos individuais conectados à rede
- **Links:** Caminhos de comunicação (com ou sem fio)
- **Data Sharing:** Troca de dados, principal objetivo da rede

---

## 🏠 Tipos de Rede

### 🔹 LAN (Local Area Network)

- Área de alcance pequena
- Alta velocidade
- Pode ser **com fio (Ethernet)** ou **sem fio (Wi-Fi)**
- Redes domésticas e de escritórios são exemplos de LAN

---

### 🏙️ MAN (Metropolitan Area Network)

- Abrange uma área metropolitana
- Interliga várias LANs dentro de uma cidade

---

### 🌍 WAN (Wide Area Network)

- Área de alcance muito maior
- Conecta várias LANs
- Pode abranger países e continentes
- Mais lenta que a LAN devido ao tamanho
- Utiliza **fibra óptica**, **satélites** e **linhas telefônicas**

📌 **Exemplo:**
A **Internet (rede mundial de computadores)** é um exemplo de WAN.

---

## 🔗 LAN e WAN Funcionando Juntas

- Uma **LAN** se conecta a uma **WAN** para ir além do seu escopo local
- Uma rede doméstica (LAN), ao acessar a **Internet**, precisa se conectar a um **Provedor de Internet (ISP)**, que é uma rede WAN
- O ISP concede acesso à Internet

### 📡 Modem e Roteador

- Como **LAN** e **WAN** utilizam padrões diferentes, entra o **modem**

🔧 **Modem**

- Realiza **modulação e demodulação** do sinal
- Converte sinais digitais vindos do roteador (LAN) para formatos adequados a linhas telefônicas, cabos ou fibra óptica

📶 **Roteador**

- Distribui a conexão (Wi-Fi ou cabo) para os dispositivos

### 🏡 Exemplo prático

Em casa, os dispositivos se conectam ao **roteador local**, formando uma **LAN**.
Esse roteador possui acesso ao **provedor de internet**.
O **modem** faz a modulação e demodulação do sinal para permitir a troca de dados.
Dessa forma, a rede local tem acesso a sites e serviços online.

---
---

# 🧩 Modelo OSI

**OSI (Open Systems Interconnection Model)**

O modelo OSI tem como objetivo criar um **padrão** para que softwares e dispositivos diferentes possam se comunicar entre si.
Ele é dividido em **7 camadas abstratas**:

1. Física
2. Enlace
3. Rede
4. Transporte
5. Sessão
6. Apresentação
7. Aplicação

---

## 1️⃣ Camada Física

- Camada mais baixa do modelo
- Não possui protocolos de rede
- **PDU:** bits
- **Hubs** funcionam nessa camada

---

## 2️⃣ Camada de Enlace (Data Link)

- Fornece transferência **ponto a ponto**
- Dois hosts estão conectados fisicamente
- **PDU:** frames
- Protocolo mais comum: **Ethernet**
- **Switches** e **bridges** atuam nessa camada
- Utiliza **endereço MAC** para identificar dispositivos

---

## 3️⃣ Camada de Rede

- Primeira camada onde o **TCP/IP** atua

- Responsável pelo **encaminhamento de pacotes IP**

- Os pacotes passam por diversos roteadores até chegar ao destino

- **PDU:** pacotes IP

- Protocolo principal: **IP**

- **Roteadores** atuam nessa camada

- Utiliza **endereço IP** para identificar dispositivos

---

## 4️⃣ Camada de Transporte

- Responsável pela entrega de dados:
  - **Confiável (TCP)**
  - **Não confiável (UDP)**

- **PDU:** segmentos

- Protocolos:
  - **TCP (Transmission Control Protocol)**
    - Confiável
    - Orientado à conexão
    - Usa _3-way handshake_

  - **UDP (User Datagram Protocol)**
    - Mais rápido
    - Sem conexão
    - Não garante entrega

---

## 5️⃣ Camada de Sessão

- Gerencia sessões das aplicações
- Estabelece, mantém e encerra conexões
- Permite comunicações contínuas (_sessões_)

📌 **Exemplo:**
Cookies de sessão mantêm o estado do usuário durante a navegação.
Ao encerrar a conexão, os dados da sessão são perdidos.

- APIs se comunicam nessa camada
- **PDU:** dados

---

## 6️⃣ Camada de Apresentação

- Atua como um **tradutor de dados**
- Garante que os dados enviados por um sistema sejam compreendidos por outro

🔐 Funções principais:

- Criptografia

- Descriptografia

- **PDU:** dados

---

## 7️⃣ Camada de Aplicação

- Camada mais externa do modelo
- Tem contato direto com o **usuário final**

📌 Exemplos de protocolos:

- **HTTP**
- **FTP**
- **SMTP**
- **DNS**

💡 Dica:

- Se o protocolo tem contato direto com o usuário, ele é da camada de aplicação
- Todos os protocolos encapsulados pelo **TCP ou UDP** são protocolos de aplicação

---

# 🔁 Exemplos de Funcionamento

## 📨 Exemplo 1: Envio de um Arquivo

1. **Aplicação:** solicitação de envio
2. **Apresentação:** criptografia do arquivo
3. **Sessão:** estabelecimento da conexão com destinatário
4. **Transporte:** fragmentação em segmentos (TCP ou UDP)
5. **Rede:** encapsulamento em pacotes IP
6. **Enlace:** encapsulamento em frames
7. **Física:** transmissão dos bits

---

## 🌐 Exemplo 2: Acesso a um Site

1. A requisição é feita via **HTTP** (camada de aplicação)
2. O HTTP é encapsulado pelo **TCP** (camada de transporte)
3. Os segmentos TCP são encapsulados pelo **IP** (camada de rede)
   - O endereço IP garante que os pacotes cheguem ao servidor web

4. Por fim, os dados passam pelas camadas de **enlace** e **física**, sendo transmitidos fisicamente

Perfeito — segue o **resumo em Markdown**, organizado, didático e no mesmo padrão que você pediu 👇

---
---

# 🌐 Componentes de uma Rede

## 🖥️ End Devices (Dispositivos Finais)

* Computadores, tablets, smartphones, dispositivos **IoT**
* Também chamados de **hosts**
* Ligados diretamente ao **usuário final**
* Origem e destino das informações na rede

---

## 🔀 Intermediary Devices (Dispositivos Intermediários)

* **Switches**
* **Roteadores**
* **Modems**

📌 Função:

* Facilitar o **fluxo de dados**
* **Encaminhar pacotes** até o destino correto

---

## 🔗 Network Media e Software Components

### 📡 Network Media

* Meios físicos ou sem fio por onde os dados trafegam:

  * **Com fio:** Ethernet, fibra óptica
  * **Sem fio:** Wi-Fi, Bluetooth

### 💻 Software Components

* Definem **regras e procedimentos** da rede

🔹 Protocolos:

* HTTP
* TCP/IP
* FTP

🔹 Softwares de gerenciamento:

* Monitoramento
* Configuração
* Administração da rede

---

## 🗄️ Servers (Servidores)

* Servidor Web
* Servidor de Arquivos
* Servidor de E-mail
* Servidor de Banco de Dados (BD)

📌 Fornecem serviços para clientes na rede

---

# 🧩 Placa de Rede

* Componente de **hardware**
* Permite a conexão do dispositivo à rede
* Fornece a **interface física**
* Possui um **endereço MAC único**

📌 Importância do MAC:

* Identificação dos dispositivos
* Comunicação na **camada de enlace (Data Link)**

🔹 Tipos:

* **Ethernet (com fio)**
* **Wi-Fi (sem fio)**

---

# 🚦 Roteadores

* **Encaminham pacotes** entre redes diferentes
* Redes distintas **não se comunicam sem roteamento**
* Operam na **camada de rede (Layer 3)**
* Utilizam **endereços IP**

📌 Utilizam:

* Tabelas de roteamento
* Protocolos de roteamento

### 🔹 Protocolos de Roteamento

#### OSPF (Open Shortest Path First)

* Protocolo **dinâmico**
* Usado em **gateways internos**
* Muito comum em redes corporativas

#### BGP (Border Gateway Protocol)

* Usado em **gateways externos**
* Responsável pela comunicação com **ISPs**
* Define rotas entre grandes redes (Internet)

---

# 🔁 Switches e Hubs

## 🔀 Switch

* Conecta dispositivos em uma **LAN**
* Opera na **camada 2 (Enlace)**
* Usa **endereços MAC** para encaminhar dados corretamente

## 🔌 Hub

* Opera na **camada 1 (Física)**
* Não entende endereços MAC
* Replica os dados para **todas as portas**

---
---

# 🏗️ Arquitetura da Internet

Define como os dados são **organizados, transmitidos e gerenciados**.

---

## 🔄 Ponto a Ponto (P2P)

* Cada nó atua como **cliente e servidor**
* Comunicação direta entre hosts
* Não há servidor central

📌 Exemplo:

* Torrent

---

## 🧑‍💻 Cliente-Servidor

* Arquitetura mais utilizada
* Cliente solicita serviços ao servidor
* Existem **servidores centrais**

📌 Exemplo:

* Browser acessando um site

---

# 🧱 Modelos de Camadas

## 1️⃣ Camada Única (Single-tier)

* Cliente, servidor e banco de dados em um único sistema
* Pouca escalabilidade e segurança
* Não usada em grandes sistemas

---

## 2️⃣ Dois Níveis (Two-tier)

* Cliente separado do servidor
* Cliente: apresentação
* Servidor: banco de dados

📌 Exemplo:

* Aplicações desktop

⚠️ Observação:

* Navegar em um site **não** caracteriza two-tier

---

## 3️⃣ Três Níveis (Three-tier)

* Introduz o **Servidor de Aplicação**

🔹 Camadas:

* Cliente: apresentação
* Servidor de aplicação: lógica de negócio
* Servidor de banco de dados: armazenamento

📌 Vantagem:

* Manutenção independente das camadas

---

## 🌐 N Camadas (N-tier)

* Expansão do modelo three-tier
* Ideal para **aplicações web grandes**

---

# 🔀 Arquitetura Híbrida

* Combina **P2P** e **Cliente-Servidor**
* Aproveita os pontos fortes de cada modelo

📌 Exemplo: Chamada de Vídeo

* Servidor central:

  * Login
  * Autenticação
* Transmissão de áudio e vídeo:

  * **P2P**

---

# ☁️ Arquitetura em Nuvem

* Infraestrutura hospedada por terceiros

📌 Provedores:

* AWS
* Azure
* Google Cloud

📌 Modelo:

* Cliente-servidor

🔹 Exemplo:

* Google Drive (SaaS)

---

# 🧠 Arquitetura Definida por Software (SDN)

* Separa:

  * **Decisão do tráfego**
  * **Encaminhamento dos dados**
* Configurações feitas via software
* Mais flexibilidade e controle

---
---

# 🔁 Exemplo de Fluxo de Dados (Acesso a um Site)

## 📡 1. Conexão à Rede

* Notebook em uma **LAN/WLAN**
* Ainda sem IP

### 🔹 DHCP

* Solicita:

  * Endereço IP
  * DNS
  * Gateway
  * Outras configurações
* Cliente: UDP porta **68**
* Servidor: UDP porta **67**
* Comunicação via **broadcast**

---

## 🌐 2. Resolução de Nome (DNS)

* Pesquisa URL no browser
* Envio de **DNS Query**
* Recebe **DNS Response** com IP do domínio

---

## 📦 3. Encapsulamento (Modelo OSI)

* **Aplicação:**  Solicitação HTTP
* **Transporte:** TCP (porta 80) encapsualar HTTP
* **Rede:** IP (origem e destino) encapsular segmentos TCP
* **Enlace:** Frame (Ethernet ou Wi-Fi) encapsular pacotes IP
    * Enlace utiliza endereço MAC

📌 MAC de destino:

* MAC do **roteador (gateway)**

🔹 Descoberto via **ARP**

---

## 🔄 4. NAT e Envio à Internet

* Roteador realiza **NAT**
* IP privado → IP público
* Pacotes seguem para o **ISP**

---

## 🖥️ 5. Servidor Web

* Firewall analisa a solicitação
* Servidor web (Apache/Nginx) processa
* Resposta enviada ao cliente

📌 Caminho de volta ocorre de forma inversa

---
---

# 🧪 Interfaces de Rede (Linux)

## 🔹 ifconfig -a

* Lista interfaces de rede
* Inclui interfaces inativas

📌 Exemplos:

* **ens3:** endereço público
* **lo:** loopback
* **tun0:** túnel (VPN)

---

## 🔹 netstat -tulnp4

📌 Função:

* Monitora conexões TCP/IP
* Mostra portas abertas e serviços

### Flags:

* **-t:** TCP
* **-u:** UDP
* **-l:** listening
* **-n:** numérico
* **-p:** programa
* **-4:** IPv4

---

# 🕵️ Proxy

## 📌 O que é Proxy

* Um **proxy** é um dispositivo ou serviço que atua como **intermediário** entre o cliente e o servidor
* Posiciona-se **no meio da conexão**
* Pode **inspecionar, filtrar e modificar** o tráfego
* Normalmente atua na **Camada 7 (Aplicação)** do modelo OSI

---

# 🔀 Tipos de Proxy

## 🔹 Proxy de Encaminhamento (Forward Proxy)

* As solicitações do **usuário passam pelo proxy**
* Utilizado para:

  * Inspeção de tráfego
  * Controle de acesso
  * Filtro de conteúdo

📌 Exemplo:

* **Burp Suite**

  * Pode atuar como proxy de encaminhamento
  * Muito usado em testes de segurança

---

## 🔹 Proxy Reverso (Reverse Proxy)

* Atua **do lado do servidor**
* Filtra as **requisições de entrada**
* O cliente não se comunica diretamente com o servidor final

📌 Exemplo:

* **WAF (Web Application Firewall)**

### 🔐 WAF

* Proxy reverso especializado
* Inspeciona requisições HTTP/HTTPS
* Bloqueia:

  * Ataques
  * Requisições maliciosas
  * Padrões suspeitos

---

## 🔹 Proxy Transparente e Não Transparente

### 🔸 Proxy Transparente

* O cliente **não sabe** que está passando por um proxy
* Comum em:

  * Redes corporativas
  * Provedores de internet

### 🔸 Proxy Não Transparente

* O cliente **sabe** que o proxy existe
* Configuração manual no navegador ou sistema

---

# 📚 Terminologias e Protocolos

## 📡 Protocolos de Rede

Protocolos definem **regras e padrões** para comunicação entre dispositivos.

---

### 🔐 SSH (Secure Shell)

* Acesso remoto **seguro**
* Execução de comandos remotamente
* Comunicação criptografada

---

### 🔓 RSH (Remote Shell)

* Execução remota de comandos em sistemas Unix
* **Inseguro** (sem criptografia)

---

### 📁 FTP (File Transfer Protocol)

* Transferência de arquivos
* Comunicação **não criptografada**

---

### 📧 SMTP (Simple Mail Transfer Protocol)

* Envio e recebimento de e-mails

---

### 🌐 HTTP (Hypertext Transfer Protocol)

* Modelo **cliente-servidor**
* Envio e recebimento de dados na internet
* Base da navegação web

---

### 🧭 OSPF (Open Shortest Path First)

* Protocolo de roteamento:

  * Interno
  * Dinâmico

---

### 🔒 VPN (Virtual Private Network)

* Cria um **túnel seguro e criptografado**
* Protege a comunicação entre redes

🔹 **IPsec**

* Conjunto de protocolos usado para segurança em VPNs

---

### 🔁 NAT (Network Address Translation)

* Traduz:

  * IPs privados → IPs públicos
* Permite acesso à internet por redes internas

---

### ⚙️ AJAX (Asynchronous JavaScript and XML)

* Conjunto de técnicas para carregamento dinâmico de conteúdo
* Evita recarregar a página inteira

📌 Exemplo:

* Atualização de comentários sem refresh da página

🔹 Tecnologias usadas:

* JavaScript
* XML / JSON

---

# 🌐 URI e URL

## 🔹 URI (Uniform Resource Identifier)

* Identificador genérico de recursos
* Define **a identidade** de um recurso

---

## 🔹 URL (Uniform Resource Locator)

* Tipo específico de URI
* Identifica:

  * O recurso
  * Sua **localização**

📌 Regra importante:

* Toda **URL é uma URI**
* Nem toda **URI é uma URL**

---

## ✅ Resumo Final

* Proxies atuam como **intermediários**
* Podem filtrar requisições ou respostas
* São fundamentais para **segurança, controle e análise**
* Protocolos definem como os dados trafegam
* URI e URL organizam o acesso a recursos na web



