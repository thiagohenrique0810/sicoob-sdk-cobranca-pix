<?php

/**
 * Exemplo de consulta de boletos
 * 
 * Este exemplo demonstra como consultar boletos usando a API de Cobrança Bancária V3.
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
    
    echo "🔄 Consultando boletos...\n";
    
    // Consulta simples de boletos (sem filtros para evitar erro 400 no sandbox)
    $params = array(
        'dataInicio' => date('Y-m-d', strtotime('-7 days')),
        'dataFim' => date('Y-m-d'),
        'cpfCnpj' => '98765432185', // CPF do pagador do exemplo de inclusão
        'numeroCliente' => 25546454  // Número do cliente do exemplo de inclusão
    );
    
    $response = $sdk->cobrancaBancaria()->consultarBoletos($params);
    
    echo "✅ Consulta realizada com sucesso!\n";
    echo "📋 Resposta da API:\n";
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
    // Exemplo de consulta de boleto específico (usando um número fictício)
    echo "\n🔄 Consultando boleto específico (Nosso Número: 123456789)...\n";
    
    $boletoEspecifico = $sdk->cobrancaBancaria()->consultarBoleto(123456789);
    
    echo "✅ Boleto específico consultado com sucesso!\n";
    echo "📋 Detalhes do boleto:\n";
    echo json_encode($boletoEspecifico, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
} catch (ApiException $e) {
    echo "❌ Erro na API: " . $e->getMessage() . "\n";
    echo "Código HTTP: " . $e->getHttpCode() . "\n";
    if ($e->getErrors()) {
        echo "Erros detalhados: " . json_encode($e->getErrors()) . "\n";
    }
    
    echo "\n💡 Dicas para resolver o erro:\n";
    echo "- No sandbox, alguns parâmetros podem não ser aceitos\n";
    echo "- Tente usar apenas dataInicio e dataFim\n";
    echo "- Verifique se as datas estão no formato correto (YYYY-MM-DD)\n";
    echo "- O sandbox pode ter limitações de dados\n";
    
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
}

echo "\n📝 Parâmetros de consulta disponíveis:\n";
echo "- dataInicio: Data inicial (YYYY-MM-DD)\n";
echo "- dataFim: Data final (YYYY-MM-DD)\n";
echo "- numeroCliente: Número do cliente\n";
echo "- nossoNumero: Nosso número do boleto\n";
echo "- seuNumero: Seu número do boleto\n";
echo "- situacaoBoleto: Situação do boleto\n";
echo "- valor: Valor do boleto\n";
echo "- cpfCnpj: CPF/CNPJ do pagador\n";
echo "- nome: Nome do pagador\n"; 