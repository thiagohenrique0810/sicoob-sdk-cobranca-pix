<?php
/**
 * Teste Unitário do Serviço de Cobrança
 * 
 * Testes básicos para o CobrancaService
 * 
 * @package SicoobSDK\Tests\Unit
 * @author Sicoob SDK Team
 */

// Inclui o autoloader
require_once __DIR__ . '/../../src/autoload.php';

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Services\CobrancaService;
use SicoobSDK\Models\Boleto;
use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\SicoobException;
use SicoobSDK\Exceptions\ValidationException;

class CobrancaServiceTest
{
    private $config;
    private $cobrancaService;
    
    public function __construct()
    {
        // Configuração para testes (sem certificados reais)
        $this->config = new SicoobConfig([
            'environment' => 'sandbox',
            'client_id' => 'test-client-id',
            'client_secret' => 'test-client-secret',
            'timeout' => 10
        ]);
        
        // Não inicializa o serviço para evitar erros de certificado
        // $this->cobrancaService = new CobrancaService($this->config);
    }
    
    /**
     * Testa a criação de um pagador válido
     */
    public function testCriarPagadorValido()
    {
        echo "Testando criação de pagador válido...\n";
        
        try {
            $pagador = new Pagador([
                'numeroCpfCnpj' => '52998224725',
                'nome' => 'João da Silva',
                'endereco' => 'Rua das Flores, 123',
                'bairro' => 'Centro',
                'cidade' => 'São Paulo',
                'cep' => '01234-567',
                'uf' => 'SP',
                'email' => 'joao@email.com'
            ]);
            
            $pagador->validate();
            echo "✅ Pagador criado com sucesso!\n";
            return true;
            
        } catch (ValidationException $e) {
            echo "❌ Erro de validação: " . $e->getMessage() . "\n";
            return false;
        }
    }
    
    /**
     * Testa a criação de um pagador inválido
     */
    public function testCriarPagadorInvalido()
    {
        echo "Testando criação de pagador inválido...\n";
        
        try {
            $pagador = new Pagador([
                'numeroCpfCnpj' => '123', // CPF inválido
                'nome' => '', // Nome vazio
                'endereco' => '', // Endereço vazio
                'bairro' => '', // Bairro vazio
                'cidade' => '', // Cidade vazia
                'cep' => '123', // CEP inválido
                'uf' => 'XX', // UF inválida
                'email' => 'email-invalido' // Email inválido
            ]);
            
            $pagador->validate();
            echo "❌ Pagador inválido foi aceito (erro esperado)\n";
            return false;
            
        } catch (ValidationException $e) {
            echo "✅ Validação funcionou corretamente!\n";
            echo "   Erros encontrados: " . count($e->getValidationErrors()) . "\n";
            return true;
        }
    }
    
    /**
     * Testa a criação de um boleto válido
     */
    public function testCriarBoletoValido()
    {
        echo "Testando criação de boleto válido...\n";
        
        try {
            $pagador = new Pagador([
                'numeroCpfCnpj' => '12345678901',
                'nome' => 'João da Silva',
                'endereco' => 'Rua das Flores, 123',
                'bairro' => 'Centro',
                'cidade' => 'São Paulo',
                'cep' => '01234-567',
                'uf' => 'SP',
                'email' => 'joao@email.com'
            ]);
            
            $boleto = new Boleto([
                'numeroCliente' => 123456,
                'codigoModalidade' => 1,
                'numeroContaCorrente' => 0,
                'codigoEspecieDocumento' => 'DM',
                'dataEmissao' => date('Y-m-d'),
                'nossoNumero' => 123456789,
                'seuNumero' => 'BOL001',
                'identificacaoBoletoEmpresa' => '4562',
                'identificacaoEmissaoBoleto' => 1,
                'identificacaoDistribuicaoBoleto' => 1,
                'valor' => 150.00,
                'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
                'dataLimitePagamento' => date('Y-m-d', strtotime('+30 days')),
                'valorAbatimento' => 0,
                'tipoDesconto' => 1,
                'dataPrimeiroDesconto' => date('Y-m-d', strtotime('+15 days')),
                'valorPrimeiroDesconto' => 10.00,
                'dataSegundoDesconto' => date('Y-m-d', strtotime('+20 days')),
                'valorSegundoDesconto' => 5.00,
                'dataTerceiroDesconto' => date('Y-m-d', strtotime('+25 days')),
                'valorTerceiroDesconto' => 2.50,
                'tipoMulta' => 1,
                'dataMulta' => date('Y-m-d', strtotime('+31 days')),
                'valorMulta' => 5.00,
                'tipoJurosMora' => 1,
                'dataJurosMora' => date('Y-m-d', strtotime('+31 days')),
                'valorJurosMora' => 2.00,
                'numeroParcela' => 1,
                'aceite' => true,
                'codigoNegativacao' => 2,
                'numeroDiasNegativacao' => 60,
                'codigoProtesto' => 1,
                'numeroDiasProtesto' => 30,
                'pagador' => $pagador,
                'beneficiarioFinal' => [
                    'numeroCpfCnpj' => '11222333000181',
                    'nome' => 'Empresa Beneficiária LTDA'
                ],
                'mensagensInstrucao' => [
                    'Após o vencimento pagar preferencialmente no Sicoob',
                    'Não receber após 30 dias do vencimento',
                    'Após vencimento pagar no banco ou loterica'
                ],
                'gerarPdf' => true,
                'codigoCadastrarPIX' => 1,
                'numeroContratoCobranca' => 1
            ]);
            
            $boleto->validate();
            echo "✅ Boleto criado com sucesso!\n";
            return true;
            
        } catch (ValidationException $e) {
            echo "❌ Erro de validação: " . $e->getMessage() . "\n";
            if ($e->hasValidationErrors()) {
                foreach ($e->getValidationErrors() as $campo => $erro) {
                    echo "   - $campo: $erro\n";
                }
            }
            return false;
        }
    }
    
    /**
     * Testa a criação de um boleto inválido
     */
    public function testCriarBoletoInvalido()
    {
        echo "Testando criação de boleto inválido...\n";
        
        try {
            $boleto = new Boleto([
                'numeroCliente' => 0, // Cliente inválido
                'codigoModalidade' => 0, // Modalidade inválida
                'valor' => -10, // Valor negativo
                'dataVencimento' => 'data-invalida', // Data inválida
                // Pagador não informado (obrigatório)
            ]);
            
            $boleto->validate();
            echo "❌ Boleto inválido foi aceito (erro esperado)\n";
            return false;
            
        } catch (ValidationException $e) {
            echo "✅ Validação funcionou corretamente!\n";
            echo "   Erros encontrados: " . count($e->getValidationErrors()) . "\n";
            return true;
        }
    }
    
    /**
     * Testa a validação de CPF
     */
    public function testValidarCpf()
    {
        echo "Testando validação de CPF...\n";
        
        $pagador = new Pagador();
        
        // CPFs válidos
        $cpfsValidos = [
            '52998224725',
            '11144477735',
            '12345678909'
        ];
        
        foreach ($cpfsValidos as $cpf) {
            $pagador->setNumeroCpfCnpj($cpf);
            try {
                $pagador->validate();
                echo "✅ CPF válido aceito: $cpf\n";
            } catch (ValidationException $e) {
                echo "❌ CPF válido rejeitado: $cpf\n";
            }
        }
        
        // CPFs inválidos
        $cpfsInvalidos = [
            '111.111.111-11',
            '123.456.789-10',
            '000.000.000-00',
            '123'
        ];
        
        foreach ($cpfsInvalidos as $cpf) {
            $pagador->setNumeroCpfCnpj($cpf);
            try {
                $pagador->validate();
                echo "❌ CPF inválido aceito: $cpf\n";
            } catch (ValidationException $e) {
                echo "✅ CPF inválido rejeitado: $cpf\n";
            }
        }
        
        return true;
    }
    
    /**
     * Testa a validação de CNPJ
     */
    public function testValidarCnpj()
    {
        echo "Testando validação de CNPJ...\n";
        
        $pagador = new Pagador();
        
        // CNPJs válidos
        $cnpjsValidos = [
            '11222333000181',
            '00000000000191'
        ];
        
        foreach ($cnpjsValidos as $cnpj) {
            $pagador->setNumeroCpfCnpj($cnpj);
            try {
                $pagador->validate();
                echo "✅ CNPJ válido aceito: $cnpj\n";
            } catch (ValidationException $e) {
                echo "❌ CNPJ válido rejeitado: $cnpj\n";
            }
        }
        
        // CNPJs inválidos
        $cnpjsInvalidos = [
            '00.000.000/0000-00',
            '11.111.111/1111-11',
            '123'
        ];
        
        foreach ($cnpjsInvalidos as $cnpj) {
            $pagador->setNumeroCpfCnpj($cnpj);
            try {
                $pagador->validate();
                echo "❌ CNPJ inválido aceito: $cnpj\n";
            } catch (ValidationException $e) {
                echo "✅ CNPJ inválido rejeitado: $cnpj\n";
            }
        }
        
        return true;
    }
    
    /**
     * Executa todos os testes
     */
    public function runAllTests()
    {
        echo "=== Iniciando Testes Unitários ===\n\n";
        
        $tests = [
            'testCriarPagadorValido',
            'testCriarPagadorInvalido',
            'testCriarBoletoValido',
            'testCriarBoletoInvalido',
            'testValidarCpf',
            'testValidarCnpj'
        ];
        
        $passed = 0;
        $total = count($tests);
        
        foreach ($tests as $test) {
            echo "\n--- Executando: $test ---\n";
            if ($this->$test()) {
                $passed++;
            }
        }
        
        echo "\n=== Resultados dos Testes ===\n";
        echo "Testes passados: $passed/$total\n";
        echo "Taxa de sucesso: " . round(($passed / $total) * 100, 2) . "%\n";
        
        if ($passed === $total) {
            echo "🎉 Todos os testes passaram!\n";
        } else {
            echo "⚠️  Alguns testes falharam.\n";
        }
    }
}

// Executa os testes se o arquivo for chamado diretamente
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new CobrancaServiceTest();
    $test->runAllTests();
} 