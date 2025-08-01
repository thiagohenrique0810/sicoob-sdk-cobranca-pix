<?php
/**
 * Exemplo de uso do WebhookService
 * 
 * Este exemplo demonstra como usar o serviço de webhook
 * para gerenciar notificações de eventos da API de cobrança.
 */

require_once __DIR__ . '/../src/autoload.php';

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Services\WebhookService;
use SicoobSDK\Exceptions\SicoobException;

// Configuração do SDK
$config = new SicoobConfig([
    'environment' => 'sandbox',
    'client_id' => 'seu-client-id',
    'client_secret' => 'seu-client-secret',
    'certificate_path' => '/caminho/para/certificado.pem',
    'private_key_path' => '/caminho/para/chave-privada.pem',
    'certificate_password' => 'senha-do-certificado',
    'timeout' => 30
]);

// Cria o serviço de webhook
$webhookService = new WebhookService($config);

try {
    echo "=== Exemplo de Uso do WebhookService ===\n\n";
    
    // Exemplo 1: Cadastrar webhook
    echo "1. Cadastrando webhook...\n";
    $resultado = $webhookService->cadastrarWebhook(
        'https://sua-url.com/webhook',
        7, // Código do tipo de movimento (7 = Pagamento)
        1,  // Código do período de movimento (1 = Movimento atual)
        'webhook@email.com'
    );
    echo "✅ Webhook cadastrado com sucesso!\n";
    echo "ID do webhook: " . $resultado['resultado']['idWebhook'] . "\n\n";
    
    // Exemplo 2: Consultar webhooks
    echo "2. Consultando webhooks...\n";
    $webhooks = $webhookService->consultarWebhooks();
    echo "✅ Webhooks consultados com sucesso!\n";
    echo "Quantidade de webhooks: " . count($webhooks['resultado']) . "\n\n";
    
    // Exemplo 3: Atualizar webhook
    echo "3. Atualizando webhook...\n";
    $webhookService->atualizarWebhook(
        1234, // ID do webhook
        'https://nova-url.com/webhook',
        'novo-email@email.com'
    );
    echo "✅ Webhook atualizado com sucesso!\n\n";
    
    // Exemplo 4: Consultar solicitações de webhook
    echo "4. Consultando solicitações de webhook...\n";
    $solicitacoes = $webhookService->consultarSolicitacoesWebhook(
        1234, // ID do webhook
        date('Y-m-d'), // Data da solicitação
        1, // Página
        3   // Código da situação (3 = Enviado com sucesso)
    );
    echo "✅ Solicitações consultadas com sucesso!\n\n";
    
    // Exemplo 5: Reativar webhook
    echo "5. Reativando webhook...\n";
    $webhookService->reativarWebhook(1234);
    echo "✅ Webhook reativado com sucesso!\n\n";
    
    // Exemplo 6: Excluir webhook
    echo "6. Excluindo webhook...\n";
    $webhookService->excluirWebhook(1234);
    echo "✅ Webhook excluído com sucesso!\n\n";
    
    echo "=== Exemplo concluído com sucesso! ===\n";
    
} catch (SicoobException $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    if ($e->getErrorData()) {
        echo "Dados do erro: " . json_encode($e->getErrorData()) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
} 