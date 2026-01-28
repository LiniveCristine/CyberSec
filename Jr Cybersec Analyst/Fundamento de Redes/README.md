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
