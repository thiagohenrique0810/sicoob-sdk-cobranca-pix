# Sicoob SDK - Cobrança e PIX

SDK em PHP 5.6 para integração com as APIs do banco Sicoob, focado em cobranças bancárias (boletos) e pagamentos PIX.

## 📋 Visão Geral

Este SDK fornece uma interface simples e intuitiva para integração com as APIs do Sicoob, permitindo:

- **Criação e gerenciamento de boletos bancários**
- **Processamento de pagamentos PIX**
- **Gestão de carteira de cobrança**
- **Sistema de webhooks para notificações**
- **Negativação e protesto de títulos**

## 🏗️ Estrutura do Projeto

```
sicoob-sdk-cobranca-pix/
├── src/
│   ├── SicoobSDK/
│   │   ├── Client/
│   │   │   ├── HttpClient.php
│   │   │   └── AuthClient.php
│   │   ├── Services/
│   │   │   ├── CobrancaService.php
│   │   │   ├── PixService.php
│   │   │   └── WebhookService.php
│   │   ├── Models/
│   │   │   ├── Boleto.php
│   │   │   ├── Pagador.php
│   │   │   ├── Beneficiario.php
│   │   │   └── Webhook.php
│   │   ├── Config/
│   │   │   └── SicoobConfig.php
│   │   └── Exceptions/
│   │       ├── SicoobException.php
│   │       └── ValidationException.php
│   └── autoload.php
├── examples/
│   ├── cobranca-example.php
│   ├── pix-example.php
│   └── webhook-example.php
├── tests/
│   ├── Unit/
│   └── Integration/
├── docs/
│   ├── sandbox.md
│   ├── cobranca-v3.md
│   └── doc-api-sicoob.md
├── composer.json
├── .gitignore
└── README.md
```

## 🚀 Instalação

### Requisitos
- PHP 5.6 ou superior
- cURL extension
- JSON extension
- OpenSSL extension

### Instalação Manual
```bash
# Clone o repositório
git clone https://github.com/seu-usuario/sicoob-sdk-cobranca-pix.git

# Navegue para o diretório
cd sicoob-sdk-cobranca-pix

# Inclua o autoloader
require_once 'src/autoload.php';
```

### Composer (Recomendado)
```bash
composer require seu-usuario/sicoob-sdk-cobranca-pix
```

## ⚙️ Configuração

### Configuração Básica
```php
<?php
require_once 'src/autoload.php';

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Services\CobrancaService;

// Configuração do ambiente
$config = new SicoobConfig();
$config->setEnvironment('sandbox'); // ou 'production'
$config->setClientId('seu-client-id');
$config->setClientSecret('seu-client-secret');
$config->setCertificatePath('/path/to/certificate.pem');
$config->setPrivateKeyPath('/path/to/private-key.pem');

// Inicializar serviço
$cobrancaService = new CobrancaService($config);
```

## 📖 Exemplos de Uso

### Criando um Boleto
```php
<?php
use SicoobSDK\Models\Boleto;
use SicoobSDK\Models\Pagador;

// Criar pagador
$pagador = new Pagador();
$pagador->setNumeroCpfCnpj('12345678901');
$pagador->setNome('João da Silva');
$pagador->setEndereco('Rua das Flores, 123');
$pagador->setBairro('Centro');
$pagador->setCidade('São Paulo');
$pagador->setCep('01234-567');
$pagador->setUf('SP');
$pagador->setEmail('joao@email.com');

// Criar boleto
$boleto = new Boleto();
$boleto->setNumeroCliente(123456);
$boleto->setValor(150.00);
$boleto->setDataVencimento('2024-02-15');
$boleto->setNossoNumero(123456789);
$boleto->setSeuNumero('BOL001');
$boleto->setPagador($pagador);

// Incluir boleto
try {
    $resultado = $cobrancaService->incluirBoleto($boleto);
    echo "Boleto criado com sucesso! ID: " . $resultado->getId();
} catch (SicoobException $e) {
    echo "Erro ao criar boleto: " . $e->getMessage();
}
```

### Processando Pagamento PIX
```php
<?php
use SicoobSDK\Services\PixService;

$pixService = new PixService($config);

// Criar cobrança PIX
$cobrancaPix = [
    'valor' => 100.00,
    'chavePix' => '12345678901',
    'descricao' => 'Pagamento de serviço',
    'dataVencimento' => '2024-02-15'
];

try {
    $resultado = $pixService->criarCobranca($cobrancaPix);
    echo "Cobrança PIX criada: " . $resultado->getQrCode();
} catch (SicoobException $e) {
    echo "Erro ao criar cobrança PIX: " . $e->getMessage();
}
```

### Configurando Webhook
```php
<?php
use SicoobSDK\Services\WebhookService;

$webhookService = new WebhookService($config);

// Cadastrar webhook
$webhook = [
    'url' => 'https://seu-site.com/webhook',
    'codigoTipoMovimento' => 7, // Pagamento
    'codigoPeriodoMovimento' => 1, // Movimento Atual
    'email' => 'webhook@seu-site.com'
];

try {
    $resultado = $webhookService->cadastrarWebhook($webhook);
    echo "Webhook cadastrado com ID: " . $resultado->getIdWebhook();
} catch (SicoobException $e) {
    echo "Erro ao cadastrar webhook: " . $e->getMessage();
}
```

## 🔧 Funcionalidades Principais

### Cobrança Bancária
- ✅ Inclusão de boletos
- ✅ Consulta de boletos
- ✅ Alteração de informações
- ✅ Baixa de boletos
- ✅ Negativação de pagadores
- ✅ Protesto de títulos

### PIX
- ✅ Criação de cobranças PIX
- ✅ Consulta de cobranças
- ✅ Geração de QR Code
- ✅ Processamento de pagamentos

### Webhooks
- ✅ Cadastro de webhooks
- ✅ Consulta de webhooks
- ✅ Validação de URLs
- ✅ Notificações automáticas

## 🧪 Testes

### Ambiente de Sandbox
Para testes, utilize o ambiente de sandbox configurado:

```php
$config->setEnvironment('sandbox');
```

### Executando Testes
```bash
# Testes unitários
php tests/Unit/CobrancaServiceTest.php

# Testes de integração
php tests/Integration/SicoobAPITest.php
```

## 📚 Documentação

- [Documentação da API Sicoob](docs/doc-api-sicoob.md)
- [Guia de Cobrança V3](docs/cobranca-v3.md)
- [Ambiente de Sandbox](docs/sandbox.md)

## 🔒 Segurança

- **Certificados digitais**: O SDK utiliza certificados digitais para autenticação
- **HTTPS obrigatório**: Todas as comunicações são feitas via HTTPS
- **Validação de dados**: Validação rigorosa de todos os dados de entrada
- **Tratamento de erros**: Sistema robusto de tratamento de exceções

## 🤝 Contribuição

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🆘 Suporte

- **Issues**: [GitHub Issues](https://github.com/seu-usuario/sicoob-sdk-cobranca-pix/issues)
- **Documentação**: [Wiki do Projeto](https://github.com/seu-usuario/sicoob-sdk-cobranca-pix/wiki)
- **Email**: suporte@seu-dominio.com

## 📈 Roadmap

- [ ] Implementação completa do SDK
- [ ] Suporte a PHP 7.x e 8.x
- [ ] Cache de tokens de autenticação
- [ ] Logs detalhados de requisições
- [ ] Métricas de performance
- [ ] Integração com frameworks populares (Laravel, Symfony)
- [ ] Documentação em inglês
- [ ] Exemplos para diferentes casos de uso

---

**Desenvolvido com ❤️ para a comunidade PHP brasileira**
