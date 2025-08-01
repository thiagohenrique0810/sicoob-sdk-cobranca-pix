<?php
require_once 'src/autoload.php';

use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\ValidationException;

echo "=== Teste de Validação CPF/CNPJ ===\n\n";

$pagador = new Pagador();

// Teste CPF válido
echo "Testando CPF válido: 52998224725\n";
$pagador->setNumeroCpfCnpj('52998224725');
try {
    $pagador->validate();
    echo "✅ CPF válido aceito\n";
} catch (ValidationException $e) {
    echo "❌ CPF rejeitado: " . $e->getMessage() . "\n";
}

echo "\n";

// Teste CNPJ válido
echo "Testando CNPJ válido: 11222333000181\n";
$pagador->setNumeroCpfCnpj('11222333000181');
try {
    $pagador->validate();
    echo "✅ CNPJ válido aceito\n";
} catch (ValidationException $e) {
    echo "❌ CNPJ rejeitado: " . $e->getMessage() . "\n";
}

echo "\n=== Fim do Teste ===\n"; 