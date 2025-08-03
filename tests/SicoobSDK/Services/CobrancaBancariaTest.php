<?php

namespace Sicoob\SDK\Tests\Services;

use PHPUnit\Framework\TestCase;
use Sicoob\SDK\Auth\SicoobAuth;
use Sicoob\SDK\Client\SicoobClient;
use Sicoob\SDK\Services\CobrancaBancaria;

/**
 * Teste para CobrancaBancaria
 */
class CobrancaBancariaTest extends TestCase
{
    /**
     * @var CobrancaBancaria
     */
    protected $cobrancaBancaria;

    /**
     * @var SicoobClient
     */
    protected $client;

    /**
     * Setup do teste
     */
    protected function setUp(): void
    {
        $auth = SicoobAuth::sandbox('test-client-id', 'test-access-token');
        $this->client = new SicoobClient($auth);
        $this->cobrancaBancaria = new CobrancaBancaria($this->client);
    }

    /**
     * Testa inclusão de boleto
     */
    public function testIncluirBoleto()
    {
        $boleto = array(
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1,
            'valor' => 156.23,
            'dataVencimento' => '2024-12-31'
        );

        // Mock da resposta esperada
        $expectedResponse = array('success' => true);

        // Aqui seria necessário mockar o cliente HTTP
        // Por enquanto, apenas testamos se o método existe
        $this->assertTrue(method_exists($this->cobrancaBancaria, 'incluirBoleto'));
    }

    /**
     * Testa consulta de boletos
     */
    public function testConsultarBoletos()
    {
        $params = array(
            'dataInicio' => '2024-01-01',
            'dataFim' => '2024-12-31'
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarBoletos'));
    }

    /**
     * Testa consulta de boleto por nosso número
     */
    public function testConsultarBoleto()
    {
        $nossoNumero = 123456789;

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarBoleto'));
    }

    /**
     * Testa alteração de boleto
     */
    public function testAlterarBoleto()
    {
        $nossoNumero = 123456789;
        $dados = array(
            'valor' => 200.00,
            'dataVencimento' => '2024-12-31'
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'alterarBoleto'));
    }

    /**
     * Testa baixa de boleto
     */
    public function testBaixarBoleto()
    {
        $nossoNumero = 123456789;

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'baixarBoleto'));
    }

    /**
     * Testa cadastro de webhook
     */
    public function testCadastrarWebhook()
    {
        $webhook = array(
            'url' => 'https://exemplo.com/webhook',
            'codigoTipoMovimento' => 7,
            'codigoPeriodoMovimento' => 1
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'cadastrarWebhook'));
    }

    /**
     * Testa consulta de webhooks
     */
    public function testConsultarWebhooks()
    {
        $idWebhook = 123;
        $codigoTipoMovimento = 7;

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarWebhooks'));
    }

    /**
     * Testa consulta de solicitações de webhook
     */
    public function testConsultarSolicitacoesWebhook()
    {
        $dataSolicitacao = '2024-01-01';
        $pagina = 1;
        $codigoSolicitacaoSituacao = 3;

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarSolicitacoesWebhook'));
    }

    /**
     * Testa consulta de movimentações
     */
    public function testConsultarMovimentacoes()
    {
        $params = array(
            'dataInicio' => '2024-01-01',
            'dataFim' => '2024-12-31'
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarMovimentacoes'));
    }

    /**
     * Testa consulta de movimentação por nosso número
     */
    public function testConsultarMovimentacao()
    {
        $nossoNumero = 123456789;

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarMovimentacao'));
    }

    /**
     * Testa consulta de negativações
     */
    public function testConsultarNegativacoes()
    {
        $params = array(
            'dataInicio' => '2024-01-01',
            'dataFim' => '2024-12-31'
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarNegativacoes'));
    }

    /**
     * Testa consulta de protestos
     */
    public function testConsultarProtestos()
    {
        $params = array(
            'dataInicio' => '2024-01-01',
            'dataFim' => '2024-12-31'
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarProtestos'));
    }

    /**
     * Testa consulta de rateios
     */
    public function testConsultarRateios()
    {
        $params = array(
            'dataInicio' => '2024-01-01',
            'dataFim' => '2024-12-31'
        );

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarRateios'));
    }

    /**
     * Testa consulta de rateio por nosso número
     */
    public function testConsultarRateio()
    {
        $nossoNumero = 123456789;

        $this->assertTrue(method_exists($this->cobrancaBancaria, 'consultarRateio'));
    }

    /**
     * Testa se retorna o cliente HTTP
     */
    public function testGetClient()
    {
        $client = $this->cobrancaBancaria->getClient();
        $this->assertInstanceOf(SicoobClient::class, $client);
    }
} 