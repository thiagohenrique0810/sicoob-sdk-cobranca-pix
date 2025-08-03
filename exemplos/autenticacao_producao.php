<?php

/**
 * Exemplo de autenticação no ambiente de produção
 * 
 * Este exemplo demonstra como configurar o SDK para usar o ambiente de produção
 * usando certificado digital para autenticação.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Sicoob\SDK\SicoobSDK;
use Sicoob\SDK\Exceptions\AuthenticationException;

// Credenciais de produção
$clientId = 'seu-client-id-producao';
$certificatePath = '/caminho/para/seu/certificado.pem';

try {
    // Criando instância do SDK para produção
    $sdk = SicoobSDK::production($clientId, $certificatePath);
    
    echo "✅ SDK configurado com sucesso para ambiente de produção!\n";
    echo "Client ID: " . $sdk->getAuth()->getClientId() . "\n";
    echo "Certificado: " . $sdk->getAuth()->getCertificatePath() . "\n";
    echo "Ambiente: " . ($sdk->isSandbox() ? 'Sandbox' : 'Produção') . "\n";
    echo "URL Base: " . $sdk->getAuth()->getBaseUrl() . "\n";
    
    // Gerando token de acesso
    echo "\n🔄 Gerando token de acesso...\n";
    $token = $sdk->generateToken();
    echo "✅ Token gerado com sucesso: " . $token . "\n";
    
    // Exemplo de headers de autenticação
    $headers = $sdk->getAuth()->getAuthHeaders();
    echo "\n📋 Headers de autenticação:\n";
    foreach ($headers as $header) {
        echo "  - " . $header . "\n";
    }
    
} catch (AuthenticationException $e) {
    echo "❌ Erro de autenticação: " . $e->getMessage() . "\n";
    echo "Código HTTP: " . $e->getHttpCode() . "\n";
    if ($e->getErrors()) {
        echo "Erros detalhados: " . json_encode($e->getErrors()) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erro na configuração: " . $e->getMessage() . "\n";
}

echo "\n📝 Notas importantes:\n";
echo "- Para produção, você precisa de um certificado digital válido\n";
echo "- O certificado deve estar no formato .pem\n";
echo "- O certificado deve ter permissões de leitura adequadas\n";
echo "- O token é gerado automaticamente quando necessário\n"; 