<?php
echo "=== DEBUG TEST ===\n";
echo "PHP funcionando.\n";

// Teste de erro
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Configuração de erro ativada.\n";

// Teste de include
if (file_exists('src/autoload.php')) {
    echo "Arquivo autoload.php existe.\n";
    require_once 'src/autoload.php';
    echo "Autoloader incluído.\n";
} else {
    echo "ERRO: Arquivo autoload.php não encontrado.\n";
}

echo "=== FIM DEBUG ===\n"; 