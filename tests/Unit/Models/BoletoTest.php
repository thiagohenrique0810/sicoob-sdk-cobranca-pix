<?php
/**
 * Testes unitários para Boleto
 * 
 * @package SicoobSDK\Tests\Unit\Models
 */

use SicoobSDK\Models\Boleto;
use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\ValidationException;

class BoletoTest extends \PHPUnit\Framework\TestCase
{
    private $boleto;

    protected function setUp(): void
    {
        $this->boleto = new Boleto();
    }

    public function testConstructorWithEmptyArray()
    {
        $boleto = new Boleto([]);
        $this->assertInstanceOf(Boleto::class, $boleto);
    }

    public function testConstructorWithData()
    {
        $data = createTestBoletoData();
        $boleto = new Boleto($data);
        
        $this->assertEquals($data['numeroCliente'], $boleto->getNumeroCliente());
        $this->assertEquals($data['codigoModalidade'], $boleto->getCodigoModalidade());
        $this->assertEquals($data['valor'], $boleto->getValor());
    }

    public function testSetAndGetNumeroCliente()
    {
        $this->boleto->setNumeroCliente(25546454);
        $this->assertEquals(25546454, $this->boleto->getNumeroCliente());
    }

    public function testSetAndGetCodigoModalidade()
    {
        $this->boleto->setCodigoModalidade(1);
        $this->assertEquals(1, $this->boleto->getCodigoModalidade());
    }

    public function testSetAndGetValor()
    {
        $this->boleto->setValor(156.23);
        $this->assertEquals(156.23, $this->boleto->getValor());
    }

    public function testSetAndGetDataVencimento()
    {
        $data = '2024-12-31';
        $this->boleto->setDataVencimento($data);
        $this->assertEquals($data, $this->boleto->getDataVencimento());
    }

    public function testSetAndGetPagador()
    {
        $pagadorData = createTestPagadorData();
        $pagador = new Pagador($pagadorData);
        
        $this->boleto->setPagador($pagador);
        $this->assertInstanceOf(Pagador::class, $this->boleto->getPagador());
        $this->assertEquals($pagadorData['nome'], $this->boleto->getPagador()->getNome());
    }

    public function testLoadFromArray()
    {
        $data = createTestBoletoData();
        $this->boleto->loadFromArray($data);
        
        $this->assertEquals($data['numeroCliente'], $this->boleto->getNumeroCliente());
        $this->assertEquals($data['codigoModalidade'], $this->boleto->getCodigoModalidade());
        $this->assertEquals($data['valor'], $this->boleto->getValor());
        $this->assertEquals($data['dataVencimento'], $this->boleto->getDataVencimento());
    }

    public function testValidateWithValidData()
    {
        $data = createTestBoletoData();
        $this->boleto->loadFromArray($data);
        
        $this->assertTrue($this->boleto->validate());
    }

    public function testValidateWithMissingRequiredFields()
    {
        $this->expectException(ValidationException::class);
        $this->boleto->validate();
    }

    public function testValidateWithInvalidData()
    {
        $data = createTestBoletoData();
        $data['valor'] = 0; // Valor inválido
        $this->boleto->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->boleto->validate();
    }

    public function testValidateWithInvalidDate()
    {
        $data = createTestBoletoData();
        $data['dataVencimento'] = 'invalid-date';
        $this->boleto->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->boleto->validate();
    }

    public function testValidateWithInvalidPagador()
    {
        $data = createTestBoletoData();
        $data['pagador']['numeroCpfCnpj'] = 'invalid-cpf';
        $this->boleto->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->boleto->validate();
    }

    public function testToArray()
    {
        $data = createTestBoletoData();
        $this->boleto->loadFromArray($data);
        
        $array = $this->boleto->toArray();
        
        $this->assertIsArray($array);
        $this->assertEquals($data['numeroCliente'], $array['numeroCliente']);
        $this->assertEquals($data['codigoModalidade'], $array['codigoModalidade']);
        $this->assertEquals($data['valor'], $array['valor']);
        $this->assertArrayHasKey('pagador', $array);
    }

    public function testSetAndGetDescontos()
    {
        $this->boleto->setTipoDesconto(1);
        $this->boleto->setDataPrimeiroDesconto('2024-11-15');
        $this->boleto->setValorPrimeiroDesconto(10.00);
        
        $this->assertEquals(1, $this->boleto->getTipoDesconto());
        $this->assertEquals('2024-11-15', $this->boleto->getDataPrimeiroDesconto());
        $this->assertEquals(10.00, $this->boleto->getValorPrimeiroDesconto());
    }

    public function testSetAndGetMulta()
    {
        $this->boleto->setTipoMulta(1);
        $this->boleto->setDataMulta('2024-12-01');
        $this->boleto->setValorMulta(5.00);
        
        $this->assertEquals(1, $this->boleto->getTipoMulta());
        $this->assertEquals('2024-12-01', $this->boleto->getDataMulta());
        $this->assertEquals(5.00, $this->boleto->getValorMulta());
    }

    public function testSetAndGetJurosMora()
    {
        $this->boleto->setTipoJurosMora(1);
        $this->boleto->setDataJurosMora('2024-12-01');
        $this->boleto->setValorJurosMora(4.00);
        
        $this->assertEquals(1, $this->boleto->getTipoJurosMora());
        $this->assertEquals('2024-12-01', $this->boleto->getDataJurosMora());
        $this->assertEquals(4.00, $this->boleto->getValorJurosMora());
    }

    public function testSetAndGetNegativacao()
    {
        $this->boleto->setCodigoNegativacao(2);
        $this->boleto->setNumeroDiasNegativacao(60);
        
        $this->assertEquals(2, $this->boleto->getCodigoNegativacao());
        $this->assertEquals(60, $this->boleto->getNumeroDiasNegativacao());
    }

    public function testSetAndGetProtesto()
    {
        $this->boleto->setCodigoProtesto(1);
        $this->boleto->setNumeroDiasProtesto(30);
        
        $this->assertEquals(1, $this->boleto->getCodigoProtesto());
        $this->assertEquals(30, $this->boleto->getNumeroDiasProtesto());
    }

    public function testSetAndGetMensagensInstrucao()
    {
        $mensagens = [
            'Após o vencimento pagar preferencialmente no Sicoob',
            'Não receber após 30 dias do vencimento'
        ];
        
        $this->boleto->setMensagensInstrucao($mensagens);
        $this->assertEquals($mensagens, $this->boleto->getMensagensInstrucao());
    }

    public function testSetAndGetBeneficiarioFinal()
    {
        $beneficiario = [
            'numeroCpfCnpj' => '12345678901',
            'nome' => 'Empresa Teste LTDA'
        ];
        
        $this->boleto->setBeneficiarioFinal($beneficiario);
        $this->assertEquals($beneficiario, $this->boleto->getBeneficiarioFinal());
    }

    public function testSetAndGetRateioCreditos()
    {
        $rateio = [
            [
                'numeroBanco' => 756,
                'numeroAgencia' => 4027,
                'numeroContaCorrente' => 0,
                'contaPrincipal' => true,
                'codigoTipoValorRateio' => 1,
                'valorRateio' => 100,
                'codigoTipoCalculoRateio' => 1,
                'numeroCpfCnpjTitular' => '98765432185',
                'nomeTitular' => 'João da Silva',
                'codigoFinalidadeTed' => 10,
                'codigoTipoContaDestinoTed' => 'CC',
                'quantidadeDiasFloat' => 1
            ]
        ];
        
        $this->boleto->setRateioCreditos($rateio);
        $this->assertEquals($rateio, $this->boleto->getRateioCreditos());
    }
} 