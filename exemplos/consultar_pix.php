<?php

/**
 * Exemplo de consulta de PIX
 * 
 * Este exemplo demonstra como consultar PIX recebidos usando a API PIX.
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
    
    echo "🔄 Consultando PIX recebidos...\n";
    
    // Consulta de PIX por período
    $params = array(
        'dataInicio' => date('Y-m-d', strtotime('-7 days')),
        'dataFim' => date('Y-m-d')
    );
    
    $response = $sdk->pix()->consultarPixRecebidos($params);
    
    echo "✅ Consulta de PIX realizada com sucesso!\n";
    echo "📋 Resposta da API:\n";
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
    // Exemplo de consulta de PIX por e2eid
    if (isset($response['pix']) && !empty($response['pix'])) {
        $primeiroPix = $response['pix'][0];
        $e2eid = $primeiroPix['endToEndId'];
        
        echo "\n🔄 Consultando PIX específico (E2E ID: {$e2eid})...\n";
        
        $pixEspecifico = $sdk->pix()->consultarPix($e2eid);
        
        echo "✅ PIX específico consultado com sucesso!\n";
        echo "📋 Detalhes do PIX:\n";
        echo json_encode($pixEspecifico, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    }
    
    // Exemplo de consulta de PIX por CPF/CNPJ
    echo "\n🔄 Consultando PIX por CPF/CNPJ...\n";
    
    $pixPorCpfCnpj = $sdk->pix()->consultarPixPorCpfCnpj('12345678901');
    
    echo "✅ PIX por CPF/CNPJ consultado com sucesso!\n";
    echo "📋 Resultado:\n";
    echo json_encode($pixPorCpfCnpj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
    // Exemplo de consulta de PIX por valor
    echo "\n🔄 Consultando PIX por valor...\n";
    
    $pixPorValor = $sdk->pix()->consultarPixPorValor(100.00);
    
    echo "✅ PIX por valor consultado com sucesso!\n";
    echo "📋 Resultado:\n";
    echo json_encode($pixPorValor, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
    // Exemplo de consulta de PIX por chave
    echo "\n🔄 Consultando PIX por chave...\n";
    
    $pixPorChave = $sdk->pix()->consultarPixPorChave('exemplo@email.com');
    
    echo "✅ PIX por chave consultado com sucesso!\n";
    echo "📋 Resultado:\n";
    echo json_encode($pixPorChave, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
} catch (ApiException $e) {
    echo "❌ Erro na API: " . $e->getMessage() . "\n";
    echo "Código HTTP: " . $e->getHttpCode() . "\n";
    if ($e->getErrors()) {
        echo "Erros detalhados: " . json_encode($e->getErrors()) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
}

echo "\n📝 Parâmetros de consulta PIX disponíveis:\n";
echo "- dataInicio: Data inicial (YYYY-MM-DD)\n";
echo "- dataFim: Data final (YYYY-MM-DD)\n";
echo "- e2eid: End-to-end ID do PIX\n";
echo "- txid: Transaction ID do PIX\n";
echo "- cpfCnpj: CPF/CNPJ do pagador\n";
echo "- valor: Valor do PIX\n";
echo "- chave: Chave PIX\n";
echo "- tipoChave: Tipo da chave PIX\n";
echo "- status: Status do PIX\n";
echo "- tipoPagamento: Tipo de pagamento\n";
echo "- tipoOperacao: Tipo de operação\n";
echo "- tipoConta: Tipo de conta\n";
echo "- banco: Código do banco\n";
echo "- agencia: Número da agência\n";
echo "- conta: Número da conta\n";
echo "- nome: Nome do pagador\n";
echo "- cidade: Cidade do pagador\n";
echo "- uf: UF do pagador\n";
echo "- cep: CEP do pagador\n";
echo "- bairro: Bairro do pagador\n";
echo "- endereco: Endereço do pagador\n";
echo "- email: Email do pagador\n";
echo "- telefone: Telefone do pagador\n"; 