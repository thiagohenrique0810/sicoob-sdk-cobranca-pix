<?php

/**
 * Exemplo SIMPLES de consulta de boletos
 * 
 * Este exemplo demonstra como consultar boletos de forma mais simples
 * para evitar erros 400 no ambiente sandbox.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Sicoob\SDK\SicoobSDK;
use Sicoob\SDK\Exceptions\ApiException;

// Credenciais de teste do sandbox
$clientId = '9b5e603e428cc477a2841e2683c92d21';
$accessToken = '1301865f-c6bc-38f3-9f49-666dbcfc59c3';

try {
    // Criando instância do SDK
    $sdk = SicoobSDK::sandbox($clientId, $accessToken);
    
    echo "🔄 Consultando boletos (versão simplificada)...\n";
    
    // Consulta MUITO simples - apenas com datas básicas
    $params = array(
        'dataInicio' => '2024-01-01',
        'dataFim' => '2024-12-31',
        'cpfCnpj' => '98765432185', // CPF do pagador do exemplo de inclusão
        'numeroCliente' => 25546454  // Número do cliente do exemplo de inclusão
    );
    
    echo "📋 Parâmetros enviados:\n";
    echo json_encode($params, JSON_PRETTY_PRINT) . "\n\n";
    
    $response = $sdk->cobrancaBancaria()->consultarBoletos($params);
    
    echo "✅ Consulta realizada com sucesso!\n";
    echo "📋 Resposta da API:\n";
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
} catch (ApiException $e) {
    echo "❌ Erro na API: " . $e->getMessage() . "\n";
    echo "Código HTTP: " . $e->getHttpCode() . "\n";
    if ($e->getErrors()) {
        echo "Erros detalhados: " . json_encode($e->getErrors()) . "\n";
    }
    
    echo "\n💡 Soluções possíveis:\n";
    echo "1. O sandbox pode não ter dados para o período solicitado\n";
    echo "2. Tente primeiro incluir um boleto e depois consultar\n";
    echo "3. Use datas mais recentes (últimos 7 dias)\n";
    echo "4. Verifique se o client_id e access_token estão corretos\n";
    
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
}

echo "\n📝 Informações sobre consulta de boletos:\n";
echo "- No sandbox, pode não haver dados para consulta\n";
echo "- Primeiro inclua um boleto usando 'incluir_boleto.php'\n";
echo "- Depois tente consultar com datas mais recentes\n";
echo "- O sandbox simula respostas, mas pode ter limitações\n"; 