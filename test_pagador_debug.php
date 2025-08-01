<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TESTE PAGADOR DEBUG ===\n";

require_once 'src/autoload.php';

use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\ValidationException;

$pagador = new Pagador();

// Teste com CPF válido
echo "Testando CPF: 52998224725\n";
$pagador->setNumeroCpfCnpj('52998224725');

// Verifica se o CPF foi definido corretamente
echo "CPF definido: " . $pagador->getNumeroCpfCnpj() . "\n";

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