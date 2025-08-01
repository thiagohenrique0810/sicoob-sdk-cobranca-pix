<?php
echo "Iniciando teste...\n";

require_once 'src/autoload.php';

echo "Autoloader carregado.\n";

// Teste simples de carregamento de classe
try {
    $pagador = new SicoobSDK\Models\Pagador();
    echo "Classe Pagador carregada com sucesso.\n";
} catch (Exception $e) {
    echo "Erro ao carregar classe Pagador: " . $e->getMessage() . "\n";
}

echo "Teste concluído.\n"; 