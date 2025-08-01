<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TESTE PAGADOR COMPLETO ===\n";

require_once 'src/autoload.php';

echo "Autoloader carregado.\n";

try {
    $pagador = new SicoobSDK\Models\Pagador([
        'numeroCpfCnpj' => '52998224725',
        'nome' => 'João da Silva',
        'endereco' => 'Rua das Flores, 123',
        'bairro' => 'Centro',
        'cidade' => 'São Paulo',
        'cep' => '01234567',
        'uf' => 'SP',
        'email' => 'joao@email.com'
    ]);
    
    echo "Pagador criado com todos os campos.\n";
    
    $pagador->validate();
    echo "✅ Validação passou!\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    if ($e instanceof SicoobSDK\Exceptions\ValidationException) {
        foreach ($e->getValidationErrors() as $campo => $erro) {
            echo "   - $campo: $erro\n";
        }
    }
}

echo "=== FIM TESTE ===\n"; 