<?php

/**
 * Exemplo de autenticação no ambiente sandbox
 * 
 * Este exemplo demonstra como configurar o SDK para usar o ambiente sandbox
 * usando as credenciais de teste fornecidas pelo Sicoob.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Sicoob\SDK\SicoobSDK;

// Credenciais de teste do sandbox
$clientId = '9b5e603e428cc477a2841e2683c92d21';
$accessToken = '1301865f-c6bc-38f3-9f49-666dbcfc59c3';

try {
    // Criando instância do SDK para sandbox
    $sdk = SicoobSDK::sandbox($clientId, $accessToken);
    
    echo "✅ SDK configurado com sucesso para ambiente sandbox!\n";
    echo "Client ID: " . $sdk->getAuth()->getClientId() . "\n";
    echo "Access Token: " . $sdk->getAuth()->getAccessToken() . "\n";
    echo "Ambiente: " . ($sdk->isSandbox() ? 'Sandbox' : 'Produção') . "\n";
    echo "URL Base: " . $sdk->getAuth()->getBaseUrl() . "\n";
    
    // Exemplo de headers de autenticação
    $headers = $sdk->getAuth()->getAuthHeaders();
    echo "\n📋 Headers de autenticação:\n";
    foreach ($headers as $header) {
        echo "  - " . $header . "\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro na configuração: " . $e->getMessage() . "\n";
} 