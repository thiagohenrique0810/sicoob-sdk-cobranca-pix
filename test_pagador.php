<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TESTE PAGADOR ===\n";

require_once 'src/autoload.php';

echo "Autoloader carregado.\n";

try {
    $pagador = new SicoobSDK\Models\Pagador();
    echo "Classe Pagador instanciada com sucesso.\n";
    
    // Teste de validação
    $pagador->setNumeroCpfCnpj('52998224725');
    echo "CPF definido: 52998224725\n";
    
    $pagador->validate();
    echo "✅ Validação passou!\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}

echo "=== FIM TESTE ===\n"; 