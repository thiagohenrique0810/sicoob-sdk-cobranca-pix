# 🏦 Sicoob SDK PHP - Cobrança Bancária e PIX

SDK PHP para integração com as APIs do Sicoob - Cobrança Bancária V3 e PIX.

## 📋 Características

- ✅ **Compatível com PHP 5.6+**
- ✅ **Suporte a ambiente Sandbox e Produção**
- ✅ **Autenticação OAuth2 com certificados**
- ✅ **API de Cobrança Bancária V3 completa**
- ✅ **API PIX para consultas**
- ✅ **Gerenciamento de Webhooks**
- ✅ **Tratamento de erros robusto**
- ✅ **Testes unitários com PHPUnit**
- ✅ **Exemplos práticos de uso**

## 🚀 Instalação

### Requisitos

- PHP 5.6 ou superior
- Extensões PHP: `curl`, `json`, `openssl`
- Composer

### Instalação via Composer

```bash
composer require sicoob/sdk-cobranca-pix
```

### Instalação Manual

1. Clone o repositório:
```bash
git clone https://github.com/seu-usuario/sicoob-sdk-cobranca-pix.git
cd sicoob-sdk-cobranca-pix
```

2. Instale as dependências:
```bash
composer install
```

## 🔧 Configuração

### Ambiente Sandbox (Desenvolvimento)

```php
<?php

require_once 'vendor/autoload.php';

use Sicoob\SDK\SicoobSDK;

// Credenciais de teste do sandbox
$clientId = '9b5e603e428cc477a2841e2683c92d21';
$accessToken = '1301865f-c6bc-38f3-9f49-666dbcfc59c3';

// Criando instância do SDK
$sdk = SicoobSDK::sandbox($clientId, $accessToken);
```

### Ambiente de Produção

```php
<?php

require_once 'vendor/autoload.php';

use Sicoob\SDK\SicoobSDK;

// Credenciais de produção
$clientId = 'seu-client-id-producao';
$certificatePath = '/caminho/para/seu/certificado.pem';

// Criando instância do SDK
$sdk = SicoobSDK::production($clientId, $certificatePath);

// Gerando token de acesso
$token = $sdk->generateToken();
```

## 📚 Exemplos de Uso

### Cobrança Bancária

#### Incluir Boleto

```php
<?php

$boleto = array(
    'numeroCliente' => 25546454,
    'codigoModalidade' => 1,
    'valor' => 156.23,
    'dataVencimento' => '2024-12-31',
    'pagador' => array(
        'numeroCpfCnpj' => '98765432185',
        'nome' => 'João da Silva Santos',
        'endereco' => 'Rua das Flores, 123',
        'bairro' => 'Centro',
        'cidade' => 'São Paulo',
        'cep' => '01234-567',
        'uf' => 'SP',
        'email' => 'joao.silva@email.com'
    )
);

$response = $sdk->cobrancaBancaria()->incluirBoleto($boleto);
```

#### Consultar Boletos

```php
<?php

$params = array(
    'dataInicio' => '2024-01-01',
    'dataFim' => '2024-12-31',
    'numeroCliente' => 25546454
);

$response = $sdk->cobrancaBancaria()->consultarBoletos($params);
```

#### Alterar Boleto

```php
<?php

$nossoNumero = 123456789;
$dados = array(
    'valor' => 200.00,
    'dataVencimento' => '2024-12-31'
);

$response = $sdk->cobrancaBancaria()->alterarBoleto($nossoNumero, $dados);
```

### PIX

#### Consultar PIX Recebidos

```php
<?php

$params = array(
    'dataInicio' => '2024-01-01',
    'dataFim' => '2024-12-31'
);

$response = $sdk->pix()->consultarPixRecebidos($params);
```

#### Consultar PIX por E2E ID

```php
<?php

$e2eid = 'E12345678202401011234567890123456';
$response = $sdk->pix()->consultarPix($e2eid);
```

### Webhooks

#### Cadastrar Webhook

```php
<?php

$webhook = array(
    'url' => 'https://sua-empresa.com/webhook/sicoob',
    'codigoTipoMovimento' => 7, // Pagamento
    'codigoPeriodoMovimento' => 1, // Movimento Atual
    'email' => 'webhook@sua-empresa.com'
);

$response = $sdk->cobrancaBancaria()->cadastrarWebhook($webhook);
```

#### Consultar Webhooks

```php
<?php

$idWebhook = 123;
$codigoTipoMovimento = 7;

$response = $sdk->cobrancaBancaria()->consultarWebhooks($idWebhook, $codigoTipoMovimento);
```

## 🧪 Testes

### Executar Testes

```bash
# Executar todos os testes
composer test

# Executar testes com cobertura
composer test-coverage

# Executar testes específicos
vendor/bin/phpunit tests/SicoobSDK/Auth/SicoobAuthTest.php
```

### Estrutura de Testes

```
tests/
├── SicoobSDK/
│   ├── Auth/
│   │   └── SicoobAuthTest.php
│   ├── Client/
│   │   └── SicoobClientTest.php
│   ├── Services/
│   │   ├── CobrancaBancariaTest.php
│   │   └── PixTest.php
│   └── Exceptions/
│       └── SicoobExceptionTest.php
```

## 📁 Exemplos

O projeto inclui exemplos práticos na pasta `exemplos/`:

- `autenticacao_sandbox.php` - Configuração para sandbox
- `autenticacao_producao.php` - Configuração para produção
- `incluir_boleto.php` - Inclusão de boleto
- `consultar_boletos.php` - Consulta de boletos
- `webhook.php` - Configuração de webhooks
- `consultar_pix.php` - Consulta de PIX

### Executar Exemplos

```bash
# Exemplo de autenticação sandbox
php exemplos/autenticacao_sandbox.php

# Exemplo de inclusão de boleto
php exemplos/incluir_boleto.php

# Exemplo de consulta de PIX
php exemplos/consultar_pix.php
```

## 🔐 Autenticação

### Sandbox

No ambiente sandbox, você precisa apenas do `client_id` e `access_token` fornecidos pelo Sicoob.

### Produção

No ambiente de produção, você precisa:

1. **Client ID** fornecido pelo Sicoob
2. **Certificado digital** (.pem) válido
3. **Token de acesso** gerado automaticamente

### Geração de Token

```php
<?php

// O token é gerado automaticamente quando necessário
$token = $sdk->generateToken();

// Ou você pode obter o token atual
$token = $sdk->getAccessToken();
```

## 📋 APIs Disponíveis

### Cobrança Bancária V3

- ✅ Incluir boletos
- ✅ Consultar boletos
- ✅ Alterar boletos
- ✅ Baixar boletos
- ✅ Consultar movimentações
- ✅ Consultar negativações
- ✅ Consultar protestos
- ✅ Consultar rateios
- ✅ Cadastrar webhooks
- ✅ Consultar webhooks

### PIX

- ✅ Consultar PIX recebidos
- ✅ Consultar PIX por E2E ID
- ✅ Consultar PIX por TXID
- ✅ Consultar PIX por período
- ✅ Consultar PIX por CPF/CNPJ
- ✅ Consultar PIX por valor
- ✅ Consultar PIX por chave
- ✅ Consultar PIX por status
- ✅ Consultar PIX por tipo de conta

## 🚨 Tratamento de Erros

O SDK inclui tratamento robusto de erros:

```php
<?php

use Sicoob\SDK\Exceptions\AuthenticationException;
use Sicoob\SDK\Exceptions\ApiException;

try {
    $response = $sdk->cobrancaBancaria()->incluirBoleto($boleto);
} catch (AuthenticationException $e) {
    echo "Erro de autenticação: " . $e->getMessage();
    echo "Código HTTP: " . $e->getHttpCode();
} catch (ApiException $e) {
    echo "Erro na API: " . $e->getMessage();
    echo "Erros detalhados: " . json_encode($e->getErrors());
} catch (Exception $e) {
    echo "Erro inesperado: " . $e->getMessage();
}
```

## 📖 Documentação

- [Documentação da API Cobrança V3](docs/doc-api-cobranca-v3.md)
- [Documentação Completa das APIs](docs/doc-api-sicoob.md)
- [URLs do Ambiente Sandbox](docs/urls-api-sandbox.md)
- [Dados de Acesso](docs/para_autenticacao/dados_acesso_api.txt)

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.

## 🆘 Suporte

- 📧 Email: suporte@sicoob.com.br
- 📞 Telefone: 0800 724 0504
- 🌐 Website: https://www.sicoob.com.br

## 📝 Changelog

### v1.0.0
- ✅ Implementação inicial do SDK
- ✅ Suporte a PHP 5.6+
- ✅ APIs de Cobrança Bancária V3
- ✅ API PIX
- ✅ Autenticação Sandbox e Produção
- ✅ Webhooks
- ✅ Testes unitários
- ✅ Exemplos práticos

---

**Desenvolvido com ❤️ para a comunidade Sicoob** 