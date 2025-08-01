<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TESTE PAGADOR COMPLETO DEBUG ===\n";

require_once 'src/autoload.php';

use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\ValidationException;

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

echo "Pagador criado com todos os campos.\n";

try {
    $pagador->validate();
    echo "✅ Validação passou!\n";
} catch (ValidationException $e) {
    echo "❌ Erro de validação: " . $e->getMessage() . "\n";
    foreach ($e->getValidationErrors() as $campo => $erro) {
        echo "   - $campo: $erro\n";
    }
}

echo "\n=== FIM TESTE ===\n"; 