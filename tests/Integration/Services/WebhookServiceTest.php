<?php
/**
 * Testes de integração para WebhookService
 * 
 * @package SicoobSDK\Tests\Integration\Services
 */

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Services\WebhookService;
use SicoobSDK\Exceptions\SicoobException;

class WebhookServiceTest extends \PHPUnit\Framework\TestCase
{
    private $config;
    private $service;

    protected function setUp(): void
    {
        // Configuração para testes de integração
        $this->config = createTestConfig();
        $this->service = new WebhookService($this->config);
    }

    public function testConstructorWithValidConfig()
    {
        $this->assertInstanceOf(WebhookService::class, $this->service);
    }

    public function testCadastrarWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $webhookData = createTestWebhookData();
        
        try {
            $response = $this->service->cadastrarWebhook($webhookData);
            $this->assertIsArray($response);
            $this->assertArrayHasKey('resultado', $response);
            $this->assertArrayHasKey('idWebhook', $response['resultado']);
        } catch (SicoobException $e) {
            $this->fail('Erro ao cadastrar webhook: ' . $e->getMessage());
        }
    }

    public function testConsultarWebhooksCadastrados()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        try {
            $response = $this->service->consultarWebhooksCadastrados();
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar webhooks cadastrados: ' . $e->getMessage());
        }
    }

    public function testConsultarWebhooksPorId()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $idWebhook = 123; // ID de exemplo
        
        try {
            $response = $this->service->consultarWebhooksCadastrados($idWebhook);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar webhook por ID: ' . $e->getMessage());
        }
    }

    public function testConsultarWebhooksPorTipoMovimento()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $codigoTipoMovimento = 7; // Pagamento (baixa operacional)
        
        try {
            $response = $this->service->consultarWebhooksCadastrados(null, $codigoTipoMovimento);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar webhooks por tipo de movimento: ' . $e->getMessage());
        }
    }

    public function testAtualizarWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $idWebhook = 123; // ID de exemplo
        $dadosAtualizacao = [
            'url' => 'https://webhook.site/test-sicoob-updated',
            'email' => 'teste.atualizado@exemplo.com'
        ];
        
        try {
            $response = $this->service->atualizarWebhook($idWebhook, $dadosAtualizacao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao atualizar webhook: ' . $e->getMessage());
        }
    }

    public function testExcluirWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $idWebhook = 123; // ID de exemplo
        
        try {
            $response = $this->service->excluirWebhook($idWebhook);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao excluir webhook: ' . $e->getMessage());
        }
    }

    public function testReativarWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $idWebhook = 123; // ID de exemplo
        
        try {
            $response = $this->service->reativarWebhook($idWebhook);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao reativar webhook: ' . $e->getMessage());
        }
    }

    public function testConsultarSolicitacoesWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $idWebhook = 123; // ID de exemplo
        $dataSolicitacao = date('Y-m-d');
        $pagina = 1;
        $codigoSolicitacaoSituacao = 3; // Enviado com sucesso
        
        try {
            $response = $this->service->consultarSolicitacoesWebhook(
                $idWebhook,
                $dataSolicitacao,
                $pagina,
                $codigoSolicitacaoSituacao
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar solicitações do webhook: ' . $e->getMessage());
        }
    }

    public function testValidarWebhookUrl()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://webhook.site/test-sicoob';
        
        try {
            $response = $this->service->validarWebhookUrl($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao validar URL do webhook: ' . $e->getMessage());
        }
    }

    public function testProcessarNotificacaoWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $notificacao = [
            'idWebhook' => 214,
            'tipoMovimento' => 7,
            'dados' => [
                'numeroIdentificadorBaixa' => '2024102000741150823',
                'codigoBarrasBoleto' => '75692868200000405001434201006355000002443003',
                'codigoBarrasBaixa' => '75692868200000405001434201006355000002443003',
                'nossoNumero' => '0000002443',
                'seuNumero' => '00-03',
                'codigoBancoRecebedor' => '756',
                'codigoAgenciaRecebedora' => 3069,
                'numeroCliente' => 63550,
                'cpfCnpjBeneficiario' => '00500754977',
                'codigoTipoPessoaPagador' => 'F',
                'nomePagador' => 'João da Silva',
                'cpfCnpjPagador' => '98765432185',
                'nomeFantasiaPagador' => 'João da Silva',
                'codigoTipoPessoaPortador' => 'F',
                'nomePortador' => 'João',
                'cpfCnpjPortador' => '09197004979',
                'valorBoleto' => 405,
                'valorPagamento' => 407.41,
                'codigoCanalPagamento' => 3,
                'codigoMotivoCancelamento' => 2,
                'dataEmissao' => '2021-04-19',
                'dataVencimento' => '2021-07-15',
                'dataLimitePagamento' => '2022-01-10',
                'dataHoraSituacaoBaixa' => '2021-07-22T13:45:33.000Z',
                'baixaRealizadaEmContigencia' => false,
                'cancelamentoBaixa' => false
            ]
        ];
        
        try {
            $response = $this->service->processarNotificacaoWebhook($notificacao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao processar notificação do webhook: ' . $e->getMessage());
        }
    }

    public function testValidarNotificacaoWebhook()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $notificacao = [
            'idWebhook' => 990,
            'validacaoWebhook' => true
        ];
        
        try {
            $response = $this->service->validarNotificacaoWebhook($notificacao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao validar notificação do webhook: ' . $e->getMessage());
        }
    }
} 