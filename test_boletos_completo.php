<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TESTE BOLETO COMPLETO ===\n";

require_once 'src/autoload.php';

use SicoobSDK\Models\Boleto;
use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\ValidationException;

echo "Autoloader carregado.\n";

try {
    $pagador = new Pagador([
        'numeroCpfCnpj' => '52998224725',
        'nome' => 'João da Silva',
        'endereco' => 'Rua das Flores, 123',
        'bairro' => 'Centro',
        'cidade' => 'São Paulo',
        'cep' => '01234567',
        'uf' => 'SP',
        'email' => 'joao@email.com'
    ]);
    
    echo "Pagador criado com sucesso.\n";
    
    $boleto = new Boleto([
        'numeroCliente' => 123456,
        'codigoModalidade' => 1,
        'numeroContaCorrente' => 0,
        'codigoEspecieDocumento' => 'DM',
        'dataEmissao' => date('Y-m-d'),
        'seuNumero' => 'BOL001',
        'identificacaoEmissaoBoleto' => 1,
        'identificacaoDistribuicaoBoleto' => 1,
        'valor' => 150.00,
        'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
        'numeroParcela' => 1,
        'tipoDesconto' => 1,
        'tipoMulta' => 1,
        'tipoJurosMora' => 1,
        'pagador' => $pagador
    ]);
    
    echo "Boleto criado com todos os campos obrigatórios.\n";
    
    $boleto->validate();
    echo "✅ Validação do boleto passou!\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    if ($e instanceof ValidationException) {
        foreach ($e->getValidationErrors() as $campo => $erro) {
            echo "   - $campo: $erro\n";
        }
    }
}

echo "=== FIM TESTE ===\n"; 