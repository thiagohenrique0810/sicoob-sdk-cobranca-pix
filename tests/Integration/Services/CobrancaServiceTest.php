<?php
/**
 * Testes de integração para CobrancaService
 * 
 * @package SicoobSDK\Tests\Integration\Services
 */

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Services\CobrancaService;
use SicoobSDK\Models\Boleto;
use SicoobSDK\Exceptions\SicoobException;

class CobrancaServiceTest extends \PHPUnit\Framework\TestCase
{
    private $config;
    private $service;

    protected function setUp(): void
    {
        // Configuração para testes de integração
        $this->config = createTestConfig();
        $this->service = new CobrancaService($this->config);
    }

    public function testConstructorWithValidConfig()
    {
        $this->assertInstanceOf(CobrancaService::class, $this->service);
    }

    public function testConstructorWithInvalidConfig()
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $invalidConfig = new SicoobConfig();
        new CobrancaService($invalidConfig);
    }

    public function testIncluirBoleto()
    {
        // Este teste requer certificados válidos e conexão com a API
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $boletoData = createTestBoletoData();
        $boleto = new Boleto($boletoData);
        
        try {
            $response = $this->service->incluirBoleto($boleto);
            $this->assertIsArray($response);
            $this->assertArrayHasKey('resultado', $response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao incluir boleto: ' . $e->getMessage());
        }
    }

    public function testConsultarBoletoPorNossoNumero()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        $nossoNumero = 123456;
        
        try {
            $response = $this->service->consultarBoletoPorNossoNumero(
                $numeroCliente,
                $codigoModalidade,
                $nossoNumero
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar boleto: ' . $e->getMessage());
        }
    }

    public function testConsultarBoletoPorLinhaDigitavel()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        $linhaDigitavel = '75692868200000405001434201006355000002443003';
        
        try {
            $response = $this->service->consultarBoletoPorLinhaDigitavel(
                $numeroCliente,
                $codigoModalidade,
                $linhaDigitavel
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar boleto por linha digitável: ' . $e->getMessage());
        }
    }

    public function testConsultarBoletoPorCodigoBarras()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        $codigoBarras = '75692868200000405001434201006355000002443003';
        
        try {
            $response = $this->service->consultarBoletoPorCodigoBarras(
                $numeroCliente,
                $codigoModalidade,
                $codigoBarras
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar boleto por código de barras: ' . $e->getMessage());
        }
    }

    public function testListarBoletosPorPagador()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        $numeroCpfCnpjPagador = '98765432185';
        
        try {
            $response = $this->service->listarBoletosPorPagador(
                $numeroCliente,
                $codigoModalidade,
                $numeroCpfCnpjPagador
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao listar boletos por pagador: ' . $e->getMessage());
        }
    }

    public function testEmitirSegundaVia()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        $nossoNumero = 123456;
        
        try {
            $response = $this->service->emitirSegundaVia(
                $numeroCliente,
                $codigoModalidade,
                $nossoNumero
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao emitir segunda via: ' . $e->getMessage());
        }
    }

    public function testConsultarFaixasNossoNumero()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        
        try {
            $response = $this->service->consultarFaixasNossoNumero(
                $numeroCliente,
                $codigoModalidade
            );
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao consultar faixas de nosso número: ' . $e->getMessage());
        }
    }

    public function testAlterarBoleto()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $nossoNumero = 123456;
        $dadosAlteracao = [
            'valor' => 200.00,
            'dataVencimento' => date('Y-m-d', strtotime('+45 days'))
        ];
        
        try {
            $response = $this->service->alterarBoleto($nossoNumero, $dadosAlteracao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao alterar boleto: ' . $e->getMessage());
        }
    }

    public function testDarBaixaBoleto()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $nossoNumero = 123456;
        $numeroCliente = 25546454;
        $codigoModalidade = 1;
        
        try {
            $result = $this->service->darBaixaBoleto(
                $nossoNumero,
                $numeroCliente,
                $codigoModalidade
            );
            $this->assertTrue($result);
        } catch (SicoobException $e) {
            $this->fail('Erro ao dar baixa no boleto: ' . $e->getMessage());
        }
    }

    public function testAlterarPagador()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosPagador = [
            'numeroCliente' => 25546454,
            'numeroCpfCnpj' => '98765432185',
            'nome' => 'João da Silva Atualizado',
            'endereco' => 'Rua Atualizada, 456',
            'bairro' => 'Novo Bairro',
            'cidade' => 'São Paulo',
            'cep' => '01234567',
            'uf' => 'SP',
            'email' => 'joao.atualizado@exemplo.com'
        ];
        
        try {
            $response = $this->service->alterarPagador($dadosPagador);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao alterar pagador: ' . $e->getMessage());
        }
    }

    public function testIncluirNegativacao()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosNegativacao = [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1
        ];
        
        try {
            $response = $this->service->incluirNegativacao($dadosNegativacao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao incluir negativação: ' . $e->getMessage());
        }
    }

    public function testAlterarNegativacao()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosNegativacao = [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1
        ];
        
        try {
            $response = $this->service->alterarNegativacao($dadosNegativacao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao alterar negativação: ' . $e->getMessage());
        }
    }

    public function testBaixarNegativacao()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosNegativacao = [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1
        ];
        
        try {
            $response = $this->service->baixarNegativacao($dadosNegativacao);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao baixar negativação: ' . $e->getMessage());
        }
    }

    public function testIncluirProtesto()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosProtesto = [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1
        ];
        
        try {
            $response = $this->service->incluirProtesto($dadosProtesto);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao incluir protesto: ' . $e->getMessage());
        }
    }

    public function testAlterarProtesto()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosProtesto = [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1
        ];
        
        try {
            $response = $this->service->alterarProtesto($dadosProtesto);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao alterar protesto: ' . $e->getMessage());
        }
    }

    public function testBaixarProtesto()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $dadosProtesto = [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1
        ];
        
        try {
            $response = $this->service->baixarProtesto($dadosProtesto);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro ao baixar protesto: ' . $e->getMessage());
        }
    }
} 