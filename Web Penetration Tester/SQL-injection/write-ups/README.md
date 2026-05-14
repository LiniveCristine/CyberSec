# 🧩 SQL Injections Incrementally with Isomorphic SQL Statements

Vulnerabilidades de SQL Injection podem ser difíceis de identificar manualmente.

Por isso, muitos pesquisadores dependem de ferramentas automatizadas como o sqlmap.

Porém, existem alguns problemas:

* WAFs conseguem detectar payloads comuns
* Cada contexto SQL exige payloads diferentes
* Filtros e higienizações mudam o comportamento da aplicação

---

# ⚠️ Problemas das Ferramentas Automatizadas

Ferramentas automáticas podem falhar quando:

* O payload é bloqueado pelo WAF
* O contexto SQL é diferente do esperado
* Caracteres especiais são tratados parcialmente
* A aplicação altera consultas dinamicamente

---

# 🧠 Diferentes Contextos de SQL Injection

Nem toda SQL Injection acontece no mesmo contexto.

Exemplos:

| Contexto   | Exemplo          |
| ---------- | ---------------- |
| `WHERE`    | `WHERE id=1`     |
| `LIKE`     | `LIKE '%teste%'` |
| `ORDER BY` | `ORDER BY name`  |
| `LIMIT`    | `LIMIT 1`        |

Cada cenário exige técnicas e payloads diferentes.

---

# 🎯 Desafio em Cenários Reais

Hunters e pentesters precisam equilibrar:

* Identificação de vulnerabilidades em múltiplos contextos
* Bypass de WAFs
* Contorno de higienizações
* Payloads discretos
* Testes incrementais sem quebrar a aplicação

---

# 🔄 Declarações Isomórficas

A ideia principal é:

> “Em vez de procurar vulnerabilidades diretamente, procuramos comportamentos interessantes.”

---

# 💡 Conceito de Isomorfismo

Uma declaração isomórfica produz o MESMO resultado lógico mesmo sendo escrita de forma diferente.

Ou seja:

* Mudamos a expressão
* O resultado continua igual
* Isso pode indicar que nossa entrada está sendo interpretada pelo SQL

---

# 🌐 Pensando em XSS

Em vez de pensar:

```text
"Esse payload vai gerar alert()?"
```

Devemos pensar:

```text
"A aplicação está higienizando aspas simples?"
```

O foco é entender o comportamento da aplicação.

---

# 🗄️ Pensando em SQL Injection

Em SQLi, fazemos pequenas alterações na entrada:

* Caracteres especiais
* Operações matemáticas
* Concatenações
* Strings vazias

Depois observamos:

* A resposta mudou?
* O comportamento foi igual?
* O sistema interpretou nossa expressão?

---

# 🧪 Exemplo de Banco de Dados

## Tabela

```sql
CREATE TABLE Users (
    ID int key auto_increment,
    LastName varchar(255),
    FirstName varchar(255),
    Address varchar(255),
    City varchar(255)
);
```

---

# 📝 Inserção de Dados

```sql
INSERT INTO Users (LastName, FirstName, Address, City)
VALUES ('Bird', 'Big', '123 Sesame Street', 'New York City');
```

---

# 🔍 Consulta Original

```sql
SELECT FirstName FROM Users WHERE ID = <USER INPUT>;
```

---

# 🧠 Testando Entradas Isomórficas

## Entrada normal

```text
id=1
```

## Entrada alterada

```text
id=2-1
```

## Outra variação

```text
id=1+''
```

---

# 📌 O Que Estamos Observando?

Se todas as entradas retornarem exatamente o mesmo resultado:

```text
id=1
id=2-1
id=1+''
```

Então provavelmente:

* Nossa entrada está sendo interpretada pelo SQL
* Caracteres especiais não estão sendo filtrados
* Operações matemáticas estão sendo avaliadas
* Existe potencial de SQL Injection

---

# 🔎 SQL Injection em LIKE

Campos de busca normalmente usam `LIKE`.

## Exemplo

```sql
SELECT Address
FROM Users
WHERE FirstName LIKE '%Big%'
ORDER BY Address DESC;
```

---

# 🧪 Testando Expressões Isomórficas

## Entrada original

```text
Big
```

## Entrada modificada

```text
Big%%
```

## Outra variação

```text
Big' ''
```

---

# 📊 O Que Comparar?

Devemos comparar:

| Entrada    | Resultado                  |
| ---------- | -------------------------- |
| Original   | Resposta padrão            |
| Modificada | Resposta alterada ou igual |

---

# 🚨 Possível Indicador de SQL Injection

Se a resposta da expressão modificada for igual à original:

```text
Big
Big%%
Big' ''
```

Isso pode indicar que:

* O input está sendo interpretado pelo SQL
* Caracteres especiais não foram filtrados corretamente
* Existe potencial de SQL Injection

---

# 🛡️ Vantagens da Abordagem Isomórfica

## Mais discreta

Payloads parecem entradas normais.

## Melhor contra WAFs

Evita payloads clássicos como:

```sql
' OR 1=1 --
```

## Funciona em múltiplos contextos

* WHERE
* LIKE
* ORDER BY
* LIMIT

## Ajuda na análise comportamental

O foco é observar diferenças sutis na aplicação.

---

# 📋 Resumo Geral

| Conceito                | Objetivo                                    |
| ----------------------- | ------------------------------------------- |
| Declarações Isomórficas | Gerar mesmo resultado com sintaxe diferente |
| Foco                    | Observar comportamento                      |
| Estratégia              | Pequenas modificações no input              |
| Benefício               | Detectar SQLi discretamente                 |
| Uso comum               | Bypass de WAF e análise manual              |

---

# ⚠️ Observações Importantes

* Nem toda resposta igual significa SQL Injection
* Alguns frameworks normalizam entradas automaticamente
* WAFs modernos analisam comportamento além do payload
* A técnica é útil principalmente em análise manual avançada

---

# 💥 Error-Based e Union-Based SQL Injection

Em alguns cenários reais, vulnerabilidades de SQL Injection são difíceis de detectar com ferramentas automatizadas.

Isso acontece porque:

* Existem mecanismos de autenticação adicionais
* Cada requisição pode exigir assinaturas dinâmicas
* WAFs bloqueiam payloads conhecidos
* O fluxo da aplicação exige lógica personalizada

Nesse caso, o pesquisador precisou criar seu próprio script para explorar a falha.

---

# 🔐 Assinatura em Cada Requisição

A aplicação exigia uma assinatura (`sig`) em todas as requisições.

## Exemplo

```text
?param=1&sig=MD5_HASH
```

A assinatura era usada para validar a integridade da requisição.

---

# 🧠 Descoberta Importante

O pesquisador encontrou na documentação vazada a fórmula usada pela aplicação.

## Fórmula

```text
assinatura = md5(param_value + SecretKey)
```

Ou seja:

* O parâmetro era concatenado com uma chave secreta
* Depois era aplicado MD5
* O resultado era enviado em `sig`

---

# 🔍 Criando Requisições Válidas

Após descobrir a lógica:

1. O hunter calculou hashes válidos
2. Gerou assinaturas corretas
3. Conseguiu enviar payloads SQL Injection aceitos pela aplicação

---

# 🚨 Primeiro Erro SQL

## Payload

```text
?param=1111"&sig=d2d0114df70a4485a8d836efa018b28d
```

A resposta gerou um erro SQL.

Isso indicava que:

* O input estava chegando na query
* Aspas não estavam sendo tratadas corretamente
* Existia potencial de SQL Injection

---

# ⚠️ Objetivo da Equipe

A equipe pediu uma prova mais forte da vulnerabilidade.

Objetivo:

```text
Gerar um atraso de 10 segundos na resposta do servidor
```

Isso serviria como confirmação prática da exploração.

---

# ⚙️ Automatizando a Exploração

Ferramentas automáticas como o sqlmap dificilmente conseguiriam explorar esse caso.

## Motivos

* Cada requisição precisava de assinatura válida
* O hash mudava conforme o parâmetro
* O fluxo exigia lógica personalizada

Por isso, o pesquisador criou um script em PHP para:

* Gerar assinaturas válidas
* Automatizar payloads
* Testar SQL Injection dinamicamente

---

# 🧠 SQLMap e Parâmetros Calculados

O SQLMap possui suporte para automatizar parâmetros calculados através da opção:

```bash
--eval
```

Essa funcionalidade permite executar código Python antes de cada requisição.

---

# 🔍 Porém Existe um Detalhe Importante

Antes de usar `--eval`, o pesquisador precisa:

1. Identificar manualmente que existe um parâmetro calculado
2. Descobrir como ele é gerado
3. Entender qual lógica deve ser reproduzida

O SQLMap NÃO descobre automaticamente a fórmula da assinatura.

---

# ⚙️ Exemplo com `--eval`

```bash
sqlmap -u "http://site.com/?id=1&sig=HASH" \
--eval="import hashlib; sig=hashlib.md5(id+SECRET).hexdigest()"
```

---

# 📌 O Que Isso Faz?

A cada payload:

1. O SQLMap altera o parâmetro `id`
2. O código Python executa
3. Um novo hash é gerado
4. A requisição é enviada com assinatura válida

---

# 🧪 Descobrindo Quantidade de Colunas

O pesquisador utilizou a técnica `ORDER BY`.

Essa técnica ajuda a descobrir quantas colunas existem na consulta original.

---

# 📋 Testes

## ORDER BY 1

```sql
id=10 ORDER BY 1--+-
```

✅ Funcionou

---

## ORDER BY 2

```sql
id=10 ORDER BY 2--+-
```

✅ Funcionou

---

## ORDER BY 3

```sql
id=10 ORDER BY 3--+-
```

✅ Funcionou

---

## ORDER BY 4

```sql
id=10 ORDER BY 4--+-
```

❌ Gerou erro

---

# 🧠 Conclusão

Se `ORDER BY 4` gera erro:

Então a query possui:

```text
3 colunas
```

Porque a quarta coluna não existe.

---

# 🔗 Explorando com UNION SELECT

Depois de descobrir a quantidade de colunas, ele utilizou `UNION SELECT`.

---

# ⏳ Payload com Delay

```sql
UNION SELECT 1,SLEEP(10),3--+-
```

---

# 📌 O Que Esse Payload Faz?

| Parte          | Função                            |
| -------------- | --------------------------------- |
| `UNION SELECT` | Junta resultados à query original |
| `1`            | Valor para coluna 1               |
| `SLEEP(10)`    | Pausa o banco por 10 segundos     |
| `3`            | Valor para coluna 3               |

---

# 🚨 Resultado

A resposta do servidor demorou aproximadamente:

```text
10 segundos
```

Isso confirmou:

* SQL Injection explorável
* Execução de funções SQL
* Controle parcial da query

---

# 🧩 Error-Based SQL Injection

O primeiro erro SQL foi um exemplo de:

## Error-Based SQLi

A aplicação revelou mensagens de erro úteis para exploração.

### Características

* Fácil enumeração
* Retornos visíveis
* Muito útil para reconhecimento inicial

---

# 🔗 Union-Based SQL Injection

A exploração final utilizou:

## Union-Based SQLi

A técnica usa `UNION SELECT` para:

* Inserir dados próprios
* Combinar resultados
* Executar funções SQL

---

# ⚠️ Por Que o SQLMap Teria Dificuldade?

Ferramentas automatizadas dependem de:

* Payloads padronizados
* Fluxos previsíveis
* Requisições simples

Neste caso:

* Cada payload precisava de hash válido
* O hash dependia do parâmetro
* Era necessário lógica customizada

---

# 💰 Impacto da Vulnerabilidade

A falha resultou em:

```text
Bug bounty de 2.000 dólares
```

---

# 📋 Fluxo Completo da Exploração

1. Encontrar documentação vazada
2. Descobrir fórmula da assinatura
3. Gerar hashes válidos
4. Detectar erro SQL
5. Automatizar requisições
6. Descobrir número de colunas (`ORDER BY`)
7. Explorar com `UNION SELECT`
8. Executar `SLEEP(10)`
9. Confirmar SQL Injection

---

# 🛡️ Lições Importantes

## Assinaturas não substituem queries parametrizadas

Mesmo com hash válido:

* SQL Injection ainda era possível

---

## Segurança obscura não é suficiente

Esconder lógica de assinatura não protege a aplicação.

---

## Ferramentas automáticas têm limitações

Muitos cenários reais exigem:

* Scripts customizados
* Análise manual
* Entendimento profundo da aplicação


---

# ☕ SQL Injection em Upload de XML — Caso Starbucks

## Relatório Original

[HackerOne Report #531051](https://hackerone.com/reports/531051?utm_source=chatgpt.com)

---

# 🎯 Visão Geral

Durante a enumeração de subdomínios da Starbucks, um pesquisador encontrou um formulário de upload de arquivos.

O pensamento inicial foi clássico:

```text
"Tentar obter RCE com shell PHP"
```

Porém, o comportamento da aplicação indicava algo diferente.

---

# 📂 Comportamento do Upload

O servidor:

* NÃO salvava o arquivo enviado
* Apenas processava e lia o conteúdo

Isso mudou completamente a direção da análise.

---

# 🔍 Identificando XML

As mensagens de erro mostravam que:

* O arquivo estava sendo tratado como XML
* O parser esperava uma estrutura específica
* Algumas tags obrigatórias eram necessárias

---

# 🧪 Construindo um XML Válido

Usando as mensagens de erro, o pesquisador conseguiu montar um XML aceito pela aplicação.

## Tags identificadas

```xml
<MainAccount>
<Credit>
<Debit>
<Invoice>
```

Isso indicava que o upload provavelmente fazia parte de algum sistema financeiro.

---

# 🏢 Referência ao Microsoft Dynamics AX

As mensagens também faziam referência ao:

Microsoft Dynamics AX

Uma plataforma ERP/financeira da Microsoft.

Isso ajudou o pesquisador a entender melhor o contexto da aplicação.

---

# 💥 Segunda Tentativa — XXE

O próximo teste foi:

## XXE (XML External Entity)

Ataques XXE tentam fazer o parser XML:

* Ler arquivos locais
* Fazer SSRF
* Executar consultas externas

---

# ❌ XXE Bloqueado

As entidades externas estavam sendo filtradas/desativadas.

Exemplo conceitual:

```xml
<!ENTITY xxe SYSTEM "file:///etc/passwd">
```

O parser não aceitava entidades externas.

---

# 🚶 Afastamento Temporário

Sem impacto evidente, o pesquisador decidiu focar em outros alvos.

Mais de um mês depois, ele voltou para revisar o caso.

A vulnerabilidade ainda existia.

---

# 🧠 Nova Hipótese — SQL Injection

O pesquisador começou a suspeitar que os dados XML eram armazenados em um banco de dados.

Se o XML fosse convertido em consultas SQL:

```text
Talvez fosse possível explorar SQL Injection
```

---

# 🔢 Campo Suspeito

A tag:

```xml
<MainAccount>123456</MainAccount>
```

recebia valores numéricos.

Isso sugeria algo como:

```sql
SELECT * FROM table WHERE account_id='123456'
```

---

# 🧪 Primeiro Teste

## Payload

```xml
<MainAccount>123456'</MainAccount>
```

---

# 📌 Resultado

O apóstrofo (`'`) parecia ser filtrado.

Inicialmente parecia seguro.

---

# 🔥 Bypass com Entidade HTML

O pesquisador tentou usar uma entidade HTML/XML:

```xml
&apos;
```

---

# 🧪 Novo Payload

```xml
<MainAccount>12345&apos;</MainAccount>
```

---

# 🚨 Resultado Importante

O servidor retornou:

```text
Database Error
```

Isso indicava que:

* O payload chegou ao banco
* O parser converteu `&apos;` para `'`
* Existia potencial de SQL Injection

---

# 🧩 Blind SQL Injection

O sistema NÃO retornava resultados SQL na tela.

Então não era:

* Error-Based
* Union-Based

O cenário indicava:

## Blind SQL Injection

---

# ⏳ Testando Time-Based SQLi

O pesquisador começou testes manuais usando delays.

A ideia era verificar:

```text
A resposta demora quando a condição é verdadeira?
```

---

# ⚙️ Uso do SQLMap

Somente depois de:

* Entender o fluxo
* Identificar o contexto XML
* Descobrir o bypass
* Confirmar comportamento time-based

o pesquisador utilizou o:

sqlmap

---

# 🛠️ Configurações Utilizadas

## Técnica Time-Based

```bash
--technique=T
```

---

## Bypass de Encoding HTML/XML

```bash
--tamper htmlencode
```

O tamper script ajudava a converter caracteres especiais em entidades HTML/XML.

---

# 🧠 Lógica da Exploração

A lógica da query vulnerável poderia ser semelhante a:

```sql
SELECT * FROM table
WHERE account_id='12345'
IF(1=1) WAITFOR DELAY '0:0:10'--'
```

---

# ⏳ Objetivo do Delay

Se a resposta demorasse 10 segundos:

✅ O payload estava sendo executado.

Isso confirmaria SQL Injection explorável.

---

# 📊 Avaliando o Impacto

Encontrar SQL Injection NÃO era suficiente.

O pesquisador precisava saber:

```text
Isso realmente impacta a empresa?
```

---

# 🔍 Três Pontos Avaliados

## 1. Tipo de Dados

Quais informações existiam?

* Financeiras?
* Clientes?
* Funcionários?

---

## 2. Quantidade de Dados

Era um banco vazio ou relevante?

---

## 3. Atualidade dos Dados

Os dados ainda eram utilizados pela empresa?

---

# 🚨 Conclusão

Após a análise:

✅ O banco possuía dados relevantes
✅ O sistema ainda era utilizado
✅ Existia impacto real

---

# 📈 Severidade

A vulnerabilidade recebeu severidade:

```text
Crítica — 9.3
```

---

# 🧠 Lições Importantes

## Não tenha visão restrita

Nem todo upload de arquivo serve apenas para:

* Webshell
* RCE
* Upload bypass

---

## XML não significa apenas XXE

Muitos pesquisadores param em:

```text
"XXE não funcionou"
```

Mas o XML ainda pode atingir:

* SQL Injection
* SSRF
* Command Injection
* Deserialização

---

## Revise alvos antigos

O pesquisador voltou depois de mais de um mês.

A falha ainda existia.

---

## Faça anotações detalhadas

As mensagens de erro foram essenciais para:

* Descobrir tags válidas
* Entender o parser
* Identificar o ERP utilizado

---

## Sempre avalie impacto

Nem toda SQL Injection gera risco real.

É importante avaliar:

* Sensibilidade dos dados
* Contexto do sistema
* Uso atual da aplicação

---

# 📋 Fluxo Completo da Exploração

1. Encontrar upload de arquivos
2. Identificar processamento XML
3. Construir XML válido
4. Identificar referência ao Dynamics AX
5. Testar XXE
6. Descobrir bloqueio de entidades externas
7. Revisitar o alvo semanas depois
8. Suspeitar de SQL Injection
9. Testar `'`
10. Bypass usando `&apos;`
11. Obter erro de banco
12. Identificar Blind SQLi
13. Explorar Time-Based
14. Automatizar com SQLMap
15. Avaliar impacto dos dados

---

# ⚠️ Observações Importantes

* Uploads XML podem esconder múltiplas vulnerabilidades
* Blind SQLi exige análise comportamental
* Entidades HTML/XML podem bypassar filtros
* Ferramentas automáticas funcionam melhor após análise manual
* SQLMap foi usado apenas depois do entendimento do contexto
* Testes devem ocorrer somente em ambientes autorizados
