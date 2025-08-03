<?php
/**
 * Bootstrap para testes do SDK Sicoob
 * 
 * Configura o ambiente de testes e carrega o autoloader
 * 
 * @package SicoobSDK\Tests
 */

// Carrega o autoloader do SDK
require_once __DIR__ . '/../src/autoload.php';

// Configura o ambiente de testes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define constantes para testes
define('TEST_CERTIFICATE_PATH', __DIR__ . '/../certificados/certificate.pem');
define('TEST_PRIVATE_KEY_PATH', __DIR__ . '/../certificados/private_key.pem');
define('TEST_CLIENT_ID', '9b5e603e428cc477a2841e2683c92d21');
define('TEST_ACCESS_TOKEN', '1301865f-c6bc-38f3-9f49-666dbcfc59c3');

// Função helper para criar configuração de teste
function createTestConfig() {
    return new \SicoobSDK\Config\SicoobConfig([
        'environment' => 'sandbox',
        'client_id' => TEST_CLIENT_ID,
        'client_secret' => 'test_secret',
        'certificate_path' => TEST_CERTIFICATE_PATH,
        'private_key_path' => TEST_PRIVATE_KEY_PATH,
        'timeout' => 30
    ]);
}

// Função helper para criar dados de teste de boleto
function createTestBoletoData() {
    return [
        'numeroCliente' => 25546454,
        'codigoModalidade' => 1,
        'numeroContaCorrente' => 0,
        'codigoEspecieDocumento' => 'DM',
        'dataEmissao' => date('Y-m-d'),
        'seuNumero' => 'TEST-' . time(),
        'identificacaoBoletoEmpresa' => 'TEST-' . time(),
        'identificacaoEmissaoBoleto' => 1,
        'identificacaoDistribuicaoBoleto' => 1,
        'valor' => 156.23,
        'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
        'dataLimitePagamento' => date('Y-m-d', strtotime('+60 days')),
        'valorAbatimento' => 0,
        'tipoDesconto' => 0,
        'dataPrimeiroDesconto' => null,
        'valorPrimeiroDesconto' => 0,
        'dataSegundoDesconto' => null,
        'valorSegundoDesconto' => 0,
        'dataTerceiroDesconto' => null,
        'valorTerceiroDesconto' => 0,
        'tipoMulta' => 1,
        'dataMulta' => date('Y-m-d', strtotime('+31 days')),
        'valorMulta' => 5.00,
        'tipoJurosMora' => 1,
        'dataJurosMora' => date('Y-m-d', strtotime('+31 days')),
        'valorJurosMora' => 4.00,
        'numeroParcela' => 1,
        'aceite' => true,
        'codigoNegativacao' => 2,
        'numeroDiasNegativacao' => 60,
        'codigoProtesto' => 1,
        'numeroDiasProtesto' => 30,
        'pagador' => [
            'numeroCpfCnpj' => '98765432185',
            'nome' => 'João da Silva Teste',
            'endereco' => 'Rua Teste, 123',
            'bairro' => 'Centro',
            'cidade' => 'Brasília',
            'cep' => '70000000',
            'uf' => 'DF',
            'email' => 'teste@exemplo.com'
        ],
        'beneficiarioFinal' => [
            'numeroCpfCnpj' => '12345678901',
            'nome' => 'Empresa Teste LTDA'
        ],
        'mensagensInstrucao' => [
            'Após o vencimento pagar preferencialmente no Sicoob',
            'Não receber após 30 dias do vencimento'
        ],
        'gerarPdf' => false,
        'codigoCadastrarPIX' => 1,
        'numeroContratoCobranca' => 1
    ];
}

// Função helper para criar dados de teste de pagador
function createTestPagadorData() {
    return [
        'numeroCpfCnpj' => '98765432185',
        'nome' => 'João da Silva Teste',
        'endereco' => 'Rua Teste, 123',
        'bairro' => 'Centro',
        'cidade' => 'Brasília',
        'cep' => '70000000',
        'uf' => 'DF',
        'email' => 'teste@exemplo.com'
    ];
}

// Função helper para criar dados de teste de webhook
function createTestWebhookData() {
    return [
        'url' => 'https://webhook.site/test-sicoob',
        'codigoTipoMovimento' => 7,
        'codigoPeriodoMovimento' => 1,
        'email' => 'teste@exemplo.com'
    ];
} 