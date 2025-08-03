<?php

/**
 * Exemplo de configuração de webhook
 * 
 * Este exemplo demonstra como configurar webhooks para receber notificações
 * automáticas de movimentações de boletos.
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
    
    echo "🔄 Configurando webhook...\n";
    
    // Dados do webhook
    $webhook = array(
        'url' => 'https://sua-empresa.com/webhook/sicoob',
        'codigoTipoMovimento' => 7, // 7 = Pagamento (baixa operacional)
        'codigoPeriodoMovimento' => 1, // 1 = Movimento Atual (D0)
        'email' => 'webhook@sua-empresa.com'
    );
    
    // Cadastrando webhook
    $response = $sdk->cobrancaBancaria()->cadastrarWebhook($webhook);
    
    echo "✅ Webhook cadastrado com sucesso!\n";
    echo "📋 Resposta da API:\n";
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
    // Exemplo de consulta de webhooks cadastrados
    if (isset($response['idWebhook'])) {
        $idWebhook = $response['idWebhook'];
        
        echo "\n🔄 Consultando webhook cadastrado...\n";
        
        $webhooks = $sdk->cobrancaBancaria()->consultarWebhooks($idWebhook, 7);
        
        echo "✅ Webhooks consultados com sucesso!\n";
        echo "📋 Lista de webhooks:\n";
        echo json_encode($webhooks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
        
        // Exemplo de consulta de solicitações de webhook
        echo "\n🔄 Consultando solicitações de webhook...\n";
        
        $solicitacoes = $sdk->cobrancaBancaria()->consultarSolicitacoesWebhook(
            date('Y-m-d'), // dataSolicitacao
            1, // pagina
            3  // codigoSolicitacaoSituacao (3 = Enviado com sucesso)
        );
        
        echo "✅ Solicitações consultadas com sucesso!\n";
        echo "📋 Lista de solicitações:\n";
        echo json_encode($solicitacoes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    }
    
} catch (ApiException $e) {
    echo "❌ Erro na API: " . $e->getMessage() . "\n";
    echo "Código HTTP: " . $e->getHttpCode() . "\n";
    if ($e->getErrors()) {
        echo "Erros detalhados: " . json_encode($e->getErrors()) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
}

echo "\n📝 Informações sobre webhooks:\n";
echo "- A URL deve ser HTTPS\n";
echo "- O servidor deve responder com status 200, 201 ou 204\n";
echo "- Códigos de movimento disponíveis:\n";
echo "  * 7 = Pagamento (baixa operacional)\n";
echo "- Períodos de movimento:\n";
echo "  * 1 = Movimento Atual (D0)\n";
echo "- Situações de solicitação:\n";
echo "  * 3 = Enviado com sucesso\n";
echo "  * 6 = Erro no envio\n";
echo "\n⚠️  IMPORTANTE: Configure seu servidor para receber as notificações!\n";
echo "Exemplo de endpoint para receber webhooks:\n";
echo "POST /webhook/sicoob\n";
echo "Content-Type: application/json\n";
echo "{\n";
echo "  \"idWebhook\": 123,\n";
echo "  \"tipoMovimento\": 7,\n";
echo "  \"dados\": { ... }\n";
echo "}\n"; 