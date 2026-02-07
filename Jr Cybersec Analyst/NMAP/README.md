## 🔎 Enumeração e Introdução ao Nmap

---

### 🧠 O que é Enumeração

A **enumeração** é a fase de **coleta de informações** durante um teste de segurança ou análise de rede.

**🎯 Objetivo principal:**

- Identificar **todas as formas possíveis de ataque**.
- Descobrir:
  - Funções ou recursos que permitem interação com o alvo.
  - Informações que possam facilitar o acesso ao sistema.

**⭐ Importância:**

- Quanto mais informações, **mais fácil identificar vetores de ataque**.
- Entender o funcionamento do serviço alvo **economiza tempo** nas próximas etapas.

---

### 🛠️ Enumeração Manual vs Ferramentas

#### 👨‍💻 Enumeração manual

- Realizada pelo analista.
- Pode identificar detalhes que ferramentas automatizadas não encontram.

#### 🤖 Uso de ferramentas

- Mais rápidas e eficientes para grandes volumes de dados.
- Porém:
  - Podem não contornar medidas de segurança.
  - Podem gerar **falsos negativos**.

---

### 🌐 Introdução ao Nmap

O **Nmap (Network Mapper)** é uma ferramenta de código aberto usada para:

- 🔍 Análise de redes.
- 🛡️ Auditoria de segurança.
- 💻 Descoberta de hosts.
- 🚪 Identificação de portas abertas.
- 🧾 Detecção de sistema operacional.
- ⚙️ Identificação de versões de serviços.

Também pode:

- Detectar presença de **firewalls**.
- Verificar sistemas de **detecção de intrusão (IDS)**.

---

### 📡 Tipos de Varredura no Nmap

O Nmap oferece diferentes técnicas de scan:

1. 🖥️ **Descoberta de hosts**
2. 🚪 **Varredura de portas**
3. 🔎 **Enumeração de serviços**
4. 🧾 **Detecção de sistema operacional**

---

### ⌨️ Sintaxe básica do Nmap

```bash
nmap <tipo de scan> <opções> <alvo>
```

Ajuda do Nmap:

```bash
nmap --help
```

---

### ⚡ Técnica de Scan: TCP SYN (-sS)

#### 🧩 O que é

- Conhecido como **SYN scan** ou **Half-open scan**.
- É o **scan padrão** do Nmap quando executado com privilégios.

#### ⚙️ Funcionamento

1. O Nmap envia um pacote **SYN**.
2. O alvo responde:

| Resposta do alvo | Significado    |
| ---------------- | -------------- |
| 🟢 SYN-ACK       | Porta aberta   |
| 🔴 RST           | Porta fechada  |
| ⚪ Sem resposta  | Porta filtrada |

- O Nmap **não completa o handshake TCP**.
- Isso torna o scan:
  - ⚡ Mais rápido.
  - 🕶️ Mais discreto.

---

### 🧪 Exemplo prático

#### Teste sem serviços ativos

```bash
nmap -sS localhost
```

Resultado esperado:

- ❌ Nenhuma porta aberta.

#### Iniciando um servidor Apache

```bash
service apache2 start
```

Executando o scan novamente:

```bash
nmap -sS localhost
```

Resultado:

- 🟢 Porta **80/TCP aberta**.

---

### 📍 Host Discovery (Descoberta de Hosts)

Antes de escanear portas, é necessário verificar se o host está ativo.

#### Métodos principais

##### 📡 ICMP Echo Request

- Semelhante ao comando **ping**.
- Flag:

```bash
-PE
```

**⚠️ Problema:**

- Firewalls podem bloquear ICMP.
- Pode gerar **falsos negativos**.

---

##### 🔗 ARP Request

- Usado quando o alvo está **na mesma rede local**.
- Método padrão nesses casos.
- Contorna bloqueios de ICMP.

Flag:

```bash
-PR
```

---

### 💾 Salvando resultados

Comando:

```bash
sudo nmap 10.129.2.0/24 -sn -oA meu_arquivo
```

#### 📖 Explicação

| Parte           | Função                                               |
| --------------- | ---------------------------------------------------- |
| 10.129.2.0/24   | Rede alvo                                            |
| -sn             | Desativa scan de portas (apenas descoberta de hosts) |
| -oA meu_arquivo | Salva o resultado em todos os formatos               |

Arquivos gerados:

- 📄 `meu_arquivo.nmap` → formato padrão
- 🧾 `meu_arquivo.xml` → para importar em ferramentas
- 🔎 `meu_arquivo.gnmap` → formato pesquisável (grep)

---

### ⚖️ ICMP vs ARP

| Protocolo     | Uso                              |
| ------------- | -------------------------------- |
| 📡 ICMP (-PE) | Descoberta geral de hosts        |
| 🔗 ARP (-PR)  | Quando o alvo está na mesma rede |

Desabilitar ARP:

```bash
--disable-arp-ping
```

---

### 👁️ Verificando o tráfego de rede

Para confirmar o protocolo usado:

#### 🦈 Com Wireshark

- Monitorar os pacotes na rede.

#### 🛠️ Com o próprio Nmap

```bash
--packet-trace
```

---

### 📋 Varredura usando lista de IPs

Criar arquivo:

```
host.lst
```

Comando:

```bash
sudo nmap -sn -oA meu_arquivo -iL host.lst
```

---

### 🌐 Analisando vários IPs

#### Listando IPs manualmente

```bash
sudo nmap -sn -oA meu_arquivo 10.129.2.18 10.129.2.19 10.129.2.120
```

#### Usando intervalo

```bash
sudo nmap -sn -oA meu_arquivo 10.129.2.18-20
```

---

### 🎯 Analisando um único host

```bash
sudo nmap 10.129.2.18 -sn -oA host
```

#### Sem a flag -sn

O Nmap:

- 📡 Realiza **descoberta de host**.
- 🚪 Depois inicia **varredura de portas automaticamente**.
- Usa ICMP Echo Request para verificar se o host está ativo.

---

### 💡 Dica importante

- Sempre **salve os resultados das varreduras**.
- Isso permite:
  - 📊 Comparações futuras.
  - 📝 Documentação.
  - 🔗 Integração com outras ferramentas.

  ## 🚪 Estados de Portas e Varredura com Nmap

---

### 📊 Estados de uma porta

Durante um scan, o **Nmap** classifica o estado das portas de acordo com a resposta recebida.

| Estado                 | Significado                                                                                  |
| ---------------------- | -------------------------------------------------------------------------------------------- |
| 🟢 **OPEN**            | A conexão foi estabelecida (TCP ou UDP).                                                     |
| 🔴 **CLOSED**          | A porta está fechada. Recebemos pacote **RST**.                                              |
| 🟡 **FILTERED**        | O Nmap não recebeu resposta. Pode haver firewall.                                            |
| 🔵 **UNFILTERED**      | Porta acessível, mas não é possível saber se está aberta ou fechada. Ocorre no scan **-sA**. |
| 🟠 **OPEN/FILTERED**   | Não é possível saber se a porta está aberta ou filtrada.                                     |
| ⚫ **CLOSED/FILTERED** | Não é possível saber se está fechada ou filtrada. Ocorre em IP ocioso.                       |

---

### 🔍 Descobrindo portas TCP abertas

#### 🔹 Comportamento padrão

- O Nmap varre as **1000 portas TCP mais comuns**.
- Tipo padrão:
  - 👑 **Root:** `-sS` (TCP SYN scan)
  - 👤 **Usuário comum:** `-sT` (TCP connect scan)

#### Diferença entre os scans

| Tipo  | Descrição                      | Discrição          |
| ----- | ------------------------------ | ------------------ |
| `-sS` | Não completa o 3-way handshake | 🕵️ Mais discreto   |
| `-sT` | Conexão TCP completa           | 🚨 Mais detectável |

---

### 🎯 Definindo quais portas escanear

#### 🔹 Portas específicas

```bash
-p 22,25,80,139,445
```

#### 🔹 Intervalo de portas

```bash
-p 22-445
```

#### 🔹 Portas mais frequentes

```bash
--top-ports 10
```

- Escaneia as **10 portas mais comuns**.
- Pode usar qualquer número.

#### 🔹 Todas as portas

```bash
-p-
```

#### 🔹 Varredura rápida

```bash
-F
```

- Escaneia as **100 portas mais frequentes**.

---

### ⚙️ Outras flags importantes

| Flag       | Função                                |
| ---------- | ------------------------------------- |
| `-n`       | Desativa resolução DNS                |
| `-Pn`      | Desativa ICMP (ignora host discovery) |
| `--reason` | Mostra o motivo do estado da porta    |
| `-sV`      | Detecta versão dos serviços           |
| `-sC`      | Executa scripts padrão do Nmap        |

---

### 🔥 Identificando bloqueios por firewall

Alguns indícios de firewall:

- ⏱️ **Tempo de scan muito rápido**
  - Exemplo: `0.05s`
  - Pode indicar bloqueio de pacotes.

- 📡 **Port unreachable**
  - Host ativo.
  - Recebe ICMP tipo 3.
  - Indica porta inacessível.

---

### 📡 Descobrindo portas UDP

#### Características do UDP

- Não usa **3-way handshake**.
- Processo mais lento.
- Timeout maior.

#### Comando

```bash
-sU
```

#### Comparação

| Scan        | Velocidade     |
| ----------- | -------------- |
| `-sS` (TCP) | ⚡ Mais rápido |
| `-sU` (UDP) | 🐢 Mais lento  |

#### Comportamento comum

- Muitas vezes **não há resposta**.
- Nmap não consegue determinar o estado.

| Resposta         | Estado        |
| ---------------- | ------------- |
| Sem resposta     | Open/Filtered |
| ICMP unreachable | Closed        |

---

### 💾 Salvando resultados do scan

#### Três formatos principais

| Opção | Arquivo  | Uso                        |
| ----- | -------- | -------------------------- |
| `-oN` | `.nmap`  | Saída normal               |
| `-oG` | `.gnmap` | Saída pesquisável          |
| `-oX` | `.xml`   | Integração com ferramentas |

#### Salvar nos três formatos

```bash
-oA nome_do_arquivo
```

---

### 📄 Convertendo XML para HTML

Para gerar relatórios visuais:

```bash
xsltproc arquivo.xml -o arquivo.html
```

- Converte o XML em **relatório HTML**.
- Fica organizado e fácil de ler.

---
