<?php
/**
 * Testes unitários para Pagador
 * 
 * @package SicoobSDK\Tests\Unit\Models
 */

use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\ValidationException;

class PagadorTest extends \PHPUnit\Framework\TestCase
{
    private $pagador;

    protected function setUp(): void
    {
        $this->pagador = new Pagador();
    }

    public function testConstructorWithEmptyArray()
    {
        $pagador = new Pagador([]);
        $this->assertInstanceOf(Pagador::class, $pagador);
    }

    public function testConstructorWithData()
    {
        $data = createTestPagadorData();
        $pagador = new Pagador($data);
        
        $this->assertEquals($data['numeroCpfCnpj'], $pagador->getNumeroCpfCnpj());
        $this->assertEquals($data['nome'], $pagador->getNome());
        $this->assertEquals($data['endereco'], $pagador->getEndereco());
    }

    public function testSetAndGetNumeroCpfCnpj()
    {
        $this->pagador->setNumeroCpfCnpj('98765432185');
        $this->assertEquals('98765432185', $this->pagador->getNumeroCpfCnpj());
    }

    public function testSetAndGetNome()
    {
        $this->pagador->setNome('João da Silva');
        $this->assertEquals('João da Silva', $this->pagador->getNome());
    }

    public function testSetAndGetEndereco()
    {
        $this->pagador->setEndereco('Rua Teste, 123');
        $this->assertEquals('Rua Teste, 123', $this->pagador->getEndereco());
    }

    public function testSetAndGetBairro()
    {
        $this->pagador->setBairro('Centro');
        $this->assertEquals('Centro', $this->pagador->getBairro());
    }

    public function testSetAndGetCidade()
    {
        $this->pagador->setCidade('Brasília');
        $this->assertEquals('Brasília', $this->pagador->getCidade());
    }

    public function testSetAndGetCep()
    {
        $this->pagador->setCep('70000000');
        $this->assertEquals('70000000', $this->pagador->getCep());
    }

    public function testSetAndGetUf()
    {
        $this->pagador->setUf('DF');
        $this->assertEquals('DF', $this->pagador->getUf());
    }

    public function testSetAndGetEmail()
    {
        $this->pagador->setEmail('teste@exemplo.com');
        $this->assertEquals('teste@exemplo.com', $this->pagador->getEmail());
    }

    public function testLoadFromArray()
    {
        $data = createTestPagadorData();
        $this->pagador->loadFromArray($data);
        
        $this->assertEquals($data['numeroCpfCnpj'], $this->pagador->getNumeroCpfCnpj());
        $this->assertEquals($data['nome'], $this->pagador->getNome());
        $this->assertEquals($data['endereco'], $this->pagador->getEndereco());
        $this->assertEquals($data['bairro'], $this->pagador->getBairro());
        $this->assertEquals($data['cidade'], $this->pagador->getCidade());
        $this->assertEquals($data['cep'], $this->pagador->getCep());
        $this->assertEquals($data['uf'], $this->pagador->getUf());
        $this->assertEquals($data['email'], $this->pagador->getEmail());
    }

    public function testValidateWithValidData()
    {
        $data = createTestPagadorData();
        $this->pagador->loadFromArray($data);
        
        $this->assertTrue($this->pagador->validate());
    }

    public function testValidateWithMissingRequiredFields()
    {
        $this->expectException(ValidationException::class);
        $this->pagador->validate();
    }

    public function testValidateWithInvalidCpf()
    {
        $data = createTestPagadorData();
        $data['numeroCpfCnpj'] = '12345678901'; // CPF inválido
        $this->pagador->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->pagador->validate();
    }

    public function testValidateWithInvalidCnpj()
    {
        $data = createTestPagadorData();
        $data['numeroCpfCnpj'] = '12345678901234'; // CNPJ inválido
        $this->pagador->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->pagador->validate();
    }

    public function testValidateWithInvalidCep()
    {
        $data = createTestPagadorData();
        $data['cep'] = '12345'; // CEP inválido
        $this->pagador->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->pagador->validate();
    }

    public function testValidateWithInvalidUf()
    {
        $data = createTestPagadorData();
        $data['uf'] = 'XX'; // UF inválida
        $this->pagador->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->pagador->validate();
    }

    public function testValidateWithInvalidEmail()
    {
        $data = createTestPagadorData();
        $data['email'] = 'invalid-email'; // Email inválido
        $this->pagador->loadFromArray($data);
        
        $this->expectException(ValidationException::class);
        $this->pagador->validate();
    }

    public function testValidateWithValidCpf()
    {
        $data = createTestPagadorData();
        $data['numeroCpfCnpj'] = '98765432185'; // CPF válido
        $this->pagador->loadFromArray($data);
        
        $this->assertTrue($this->pagador->validate());
    }

    public function testValidateWithValidCnpj()
    {
        $data = createTestPagadorData();
        $data['numeroCpfCnpj'] = '12345678000195'; // CNPJ válido
        $this->pagador->loadFromArray($data);
        
        $this->assertTrue($this->pagador->validate());
    }

    public function testToArray()
    {
        $data = createTestPagadorData();
        $this->pagador->loadFromArray($data);
        
        $array = $this->pagador->toArray();
        
        $this->assertIsArray($array);
        $this->assertEquals($data['numeroCpfCnpj'], $array['numeroCpfCnpj']);
        $this->assertEquals($data['nome'], $array['nome']);
        $this->assertEquals($data['endereco'], $array['endereco']);
        $this->assertEquals($data['bairro'], $array['bairro']);
        $this->assertEquals($data['cidade'], $array['cidade']);
        $this->assertEquals($data['cep'], $array['cep']);
        $this->assertEquals($data['uf'], $array['uf']);
        $this->assertEquals($data['email'], $array['email']);
    }

    public function testValidateCpfWithValidCpf()
    {
        $data = createTestPagadorData();
        $data['numeroCpfCnpj'] = '98765432185';
        $this->pagador->loadFromArray($data);
        
        $this->assertTrue($this->pagador->validate());
    }

    public function testValidateCnpjWithValidCnpj()
    {
        $data = createTestPagadorData();
        $data['numeroCpfCnpj'] = '12345678000195';
        $this->pagador->loadFromArray($data);
        
        $this->assertTrue($this->pagador->validate());
    }

    public function testValidateWithEmptyEmail()
    {
        $data = createTestPagadorData();
        $data['email'] = ''; // Email vazio é permitido
        $this->pagador->loadFromArray($data);
        
        $this->assertTrue($this->pagador->validate());
    }
} 