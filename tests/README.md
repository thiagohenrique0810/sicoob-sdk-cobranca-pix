# 🧪 Testes do SDK Sicoob

Este diretório contém todos os testes automatizados para o SDK Sicoob, organizados por tipo e funcionalidade.

## 📁 Estrutura dos Testes

```
tests/
├── bootstrap.php                    # Configuração inicial dos testes
├── phpunit.xml                     # Configuração do PHPUnit
├── README.md                       # Esta documentação
├── Unit/                           # Testes unitários
│   ├── Config/
│   │   └── SicoobConfigTest.php   # Testes da configuração
│   ├── Models/
│   │   ├── BoletoTest.php         # Testes do modelo Boleto
│   │   └── PagadorTest.php        # Testes do modelo Pagador
│   └── Client/
│       └── HttpClientTest.php     # Testes do cliente HTTP
└── Integration/                    # Testes de integração
    └── Services/
        ├── CobrancaServiceTest.php # Testes do serviço de cobrança
        └── WebhookServiceTest.php  # Testes do serviço de webhook
```

## 🚀 Como Executar os Testes

### Pré-requisitos

1. **PHP 7.4+** instalado
2. **PHPUnit 9.5+** instalado
3. **Extensão cURL** habilitada
4. **Certificados válidos** na pasta `/certificados`

### Instalação do PHPUnit

```bash
# Via Composer (recomendado)
composer require --dev phpunit/phpunit

# Ou via PEAR
pear install phpunit/PHPUnit
```

### Executando os Testes

```bash
# Executar todos os testes
phpunit

# Executar apenas testes unitários
phpunit --testsuite "Unit Tests"

# Executar apenas testes de integração
phpunit --testsuite "Integration Tests"

# Executar um teste específico
phpunit tests/Unit/Config/SicoobConfigTest.php

# Executar com cobertura de código
phpunit --coverage-html coverage/

# Executar com relatório detalhado
phpunit --verbose --testdox
```

## 📋 Tipos de Testes

### 🔧 Testes Unitários

Testam componentes isolados do SDK:

- **SicoobConfig**: Configurações e validações
- **Boleto**: Modelo de dados e validações
- **Pagador**: Modelo de dados e validações
- **HttpClient**: Cliente HTTP e autenticação

### 🔗 Testes de Integração

Testam a integração com as APIs do Sicoob:

- **CobrancaService**: Operações de cobrança bancária
- **WebhookService**: Gestão de webhooks

## ⚙️ Configuração dos Testes

### Ambiente de Testes

Os testes utilizam o ambiente **sandbox** do Sicoob por padrão:

```php
// Configuração em bootstrap.php
define('TEST_CLIENT_ID', '9b5e603e428cc477a2841e2683c92d21');
define('TEST_ACCESS_TOKEN', '1301865f-c6bc-38f3-9f49-666dbcfc59c3');
```

### Certificados

Para executar os testes de integração, você precisa de certificados válidos:

1. **Certificado digital** (.pem)
2. **Chave privada** (.pem)
3. **Client ID** e **Client Secret** válidos

Coloque os certificados na pasta `/certificados/`:

```
certificados/
├── certificate.pem      # Certificado digital
├── private_key.pem     # Chave privada
└── client_id_sandbox.txt # Credenciais de teste
```

## 🧪 Dados de Teste

### Helpers de Teste

O arquivo `bootstrap.php` contém funções helper para criar dados de teste:

```php
// Criar configuração de teste
$config = createTestConfig();

// Criar dados de boleto de teste
$boletoData = createTestBoletoData();

// Criar dados de pagador de teste
$pagadorData = createTestPagadorData();

// Criar dados de webhook de teste
$webhookData = createTestWebhookData();
```

### Exemplos de Uso

```php
// Teste de inclusão de boleto
$boletoData = createTestBoletoData();
$boleto = new Boleto($boletoData);
$response = $service->incluirBoleto($boleto);

// Teste de consulta de boleto
$response = $service->consultarBoletoPorNossoNumero(
    25546454, // numeroCliente
    1,        // codigoModalidade
    123456    // nossoNumero
);
```

## 📊 Cobertura de Código

Para gerar relatórios de cobertura:

```bash
# Gerar relatório HTML
phpunit --coverage-html coverage/

# Gerar relatório de texto
phpunit --coverage-text

# Verificar cobertura mínima
phpunit --coverage-text --coverage-filter=../src
```

## 🚨 Testes de Integração

**⚠️ Importante**: Os testes de integração estão marcados como `skipped` por padrão porque requerem:

1. **Certificados válidos** do Sicoob
2. **Credenciais de sandbox** ativas
3. **Conexão com a internet** para acessar as APIs

Para executar os testes de integração:

1. Remova as linhas `$this->markTestSkipped()` dos testes
2. Configure certificados válidos
3. Execute: `phpunit --testsuite "Integration Tests"`

## 🔍 Debugging de Testes

### Logs Detalhados

```bash
# Executar com logs detalhados
phpunit --verbose --debug

# Executar um teste específico com debug
phpunit --verbose tests/Unit/Config/SicoobConfigTest.php
```

### Testes Faltantes

Se um teste falhar, verifique:

1. **Certificados válidos** na pasta `/certificados`
2. **Credenciais corretas** no arquivo `client_id_sandbox.txt`
3. **Conexão com a internet** para APIs externas
4. **Extensões PHP** necessárias (cURL, OpenSSL)

## 📈 Métricas de Qualidade

### Cobertura Mínima

- **Testes Unitários**: 90%+
- **Testes de Integração**: 80%+
- **Cobertura Total**: 85%+

### Tempo de Execução

- **Testes Unitários**: < 30 segundos
- **Testes de Integração**: < 5 minutos
- **Testes Totais**: < 6 minutos

## 🛠️ Comandos Úteis

```bash
# Executar testes em paralelo
phpunit --parallel

# Executar testes com timeout
phpunit --timeout-limit=300

# Executar testes com seed específico
phpunit --random-order-seed=12345

# Executar testes com filtro
phpunit --filter="testIncluirBoleto"

# Gerar relatório JUnit
phpunit --log-junit test-results.xml
```

## 📝 Contribuindo

Ao adicionar novos testes:

1. **Siga a nomenclatura**: `ClassNameTest.php`
2. **Use helpers**: Utilize as funções em `bootstrap.php`
3. **Documente**: Adicione comentários explicativos
4. **Teste isoladamente**: Cada teste deve ser independente
5. **Mantenha cobertura**: Adicione testes para novos métodos

## 🔗 Links Úteis

- [Documentação PHPUnit](https://phpunit.de/documentation.html)
- [API Sicoob Sandbox](https://sandbox.sicoob.com.br)
- [Documentação Sicoob](https://developers.sicoob.com.br)
- [Certificados Digitais](https://www.gov.br/iti/pt-br/assuntos/repositorio/certificados-das-acs-da-icp-brasil) 