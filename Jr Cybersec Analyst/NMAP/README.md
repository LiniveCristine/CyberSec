## 🔎 Enumeração e Introdução ao Nmap

---

### 1. 🧠 O que é Enumeração

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

### 2. 🛠️ Enumeração Manual vs Ferramentas

#### 👨‍💻 Enumeração manual

- Realizada pelo analista.
- Pode identificar detalhes que ferramentas automatizadas não encontram.

#### 🤖 Uso de ferramentas

- Mais rápidas e eficientes para grandes volumes de dados.
- Porém:
  - Podem não contornar medidas de segurança.
  - Podem gerar **falsos negativos**.

---

### 3. 🌐 Introdução ao Nmap

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

### 4. 📡 Tipos de Varredura no Nmap

O Nmap oferece diferentes técnicas de scan:

1. 🖥️ **Descoberta de hosts**
2. 🚪 **Varredura de portas**
3. 🔎 **Enumeração de serviços**
4. 🧾 **Detecção de sistema operacional**

---

### 5. ⌨️ Sintaxe básica do Nmap

```bash
nmap <tipo de scan> <opções> <alvo>
```

Ajuda do Nmap:

```bash
nmap --help
```

---

### 6. ⚡ Técnica de Scan: TCP SYN (-sS)

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

### 7. 🧪 Exemplo prático

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

### 8. 📍 Host Discovery (Descoberta de Hosts)

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

### 9. 💾 Salvando resultados

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

### 10. ⚖️ ICMP vs ARP

| Protocolo     | Uso                              |
| ------------- | -------------------------------- |
| 📡 ICMP (-PE) | Descoberta geral de hosts        |
| 🔗 ARP (-PR)  | Quando o alvo está na mesma rede |

Desabilitar ARP:

```bash
--disable-arp-ping
```

---

### 11. 👁️ Verificando o tráfego de rede

Para confirmar o protocolo usado:

#### 🦈 Com Wireshark

- Monitorar os pacotes na rede.

#### 🛠️ Com o próprio Nmap

```bash
--packet-trace
```

---

### 12. 📋 Varredura usando lista de IPs

Criar arquivo:

```
host.lst
```

Comando:

```bash
sudo nmap -sn -oA meu_arquivo -iL host.lst
```

---

### 13. 🌐 Analisando vários IPs

#### Listando IPs manualmente

```bash
sudo nmap -sn -oA meu_arquivo 10.129.2.18 10.129.2.19 10.129.2.120
```

#### Usando intervalo

```bash
sudo nmap -sn -oA meu_arquivo 10.129.2.18-20
```

---

### 14. 🎯 Analisando um único host

```bash
sudo nmap 10.129.2.18 -sn -oA host
```

#### Sem a flag -sn

O Nmap:

- 📡 Realiza **descoberta de host**.
- 🚪 Depois inicia **varredura de portas automaticamente**.
- Usa ICMP Echo Request para verificar se o host está ativo.

---

### 15. 💡 Dica importante

- Sempre **salve os resultados das varreduras**.
- Isso permite:
  - 📊 Comparações futuras.
  - 📝 Documentação.
  - 🔗 Integração com outras ferramentas.
