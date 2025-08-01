<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "=== TESTE ALGORITMO CPF ===\n";

require_once 'src/autoload.php';

use SicoobSDK\Models\Pagador;

$pagador = new Pagador();

// CPFs válidos conhecidos
$cpfsValidos = [
    '52998224725',
    '11144477735',
    '12345678909',
    '529.982.247-25',
    '111.444.777-35',
    '123.456.789-09'
];

foreach ($cpfsValidos as $cpf) {
    echo "Testando CPF: $cpf\n";
    
    // Limpa o CPF
    $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);
    echo "CPF limpo: $cpfLimpo\n";
    
    // Verifica se tem 11 dígitos
    if (strlen($cpfLimpo) != 11) {
        echo "❌ CPF não tem 11 dígitos\n";
        continue;
    }
    
    // Verifica se todos os dígitos são iguais
    if (preg_match('/^(\d)\1+$/', $cpfLimpo)) {
        echo "❌ CPF com todos os dígitos iguais\n";
        continue;
    }
    
    // Calcula os dígitos verificadores
    $valido = true;
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) {
            $d += $cpfLimpo[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpfLimpo[$c] != $d) {
            echo "❌ CPF inválido - dígito verificador incorreto\n";
            $valido = false;
            break;
        }
    }
    
    if ($valido) {
        echo "✅ CPF válido\n";
    }
    
    echo "\n";
}

echo "=== FIM TESTE ===\n"; 