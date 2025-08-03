<?php

/**
 * Exemplo de inclusão de boleto
 * 
 * Este exemplo demonstra como incluir um boleto usando a API de Cobrança Bancária V3.
 * Baseado na documentação oficial do Sicoob.
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
    
    // Dados do boleto conforme documentação
    $boleto = array(
        'numeroCliente' => 25546454,
        'codigoModalidade' => 1,
        'numeroContaCorrente' => 0,
        'codigoEspecieDocumento' => 'DM',
        'dataEmissao' => date('Y-m-d'),
        'nossoNumero' => 2588658,
        'seuNumero' => '1235512',
        'identificacaoBoletoEmpresa' => '4562',
        'identificacaoEmissaoBoleto' => 1,
        'identificacaoDistribuicaoBoleto' => 1,
        'valor' => 156.23,
        'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
        'dataLimitePagamento' => date('Y-m-d', strtotime('+30 days')),
        'valorAbatimento' => 0,
        'tipoDesconto' => 0,
        'dataPrimeiroDesconto' => date('Y-m-d', strtotime('+25 days')),
        'valorPrimeiroDesconto' => 10.00,
        'dataSegundoDesconto' => date('Y-m-d', strtotime('+28 days')),
        'valorSegundoDesconto' => 5.00,
        'dataTerceiroDesconto' => date('Y-m-d', strtotime('+29 days')),
        'valorTerceiroDesconto' => 2.00,
        'tipoMulta' => 1,
        'dataMulta' => date('Y-m-d', strtotime('+31 days')),
        'valorMulta' => 5.00,
        'tipoJurosMora' => 1,
        'dataJurosMora' => date('Y-m-d', strtotime('+31 days')),
        'valorJurosMora' => 4.00,
        'numeroParcela' => 1,
        'aceite' => true,
        'codigoNegativacao' => 2,
        'numeroDiasNegativacao' => 60,
        'codigoProtesto' => 1,
        'numeroDiasProtesto' => 30,
        'pagador' => array(
            'numeroCpfCnpj' => '98765432185',
            'nome' => 'João da Silva Santos',
            'endereco' => 'Rua das Flores, 123',
            'bairro' => 'Centro',
            'cidade' => 'São Paulo',
            'cep' => '01234-567',
            'uf' => 'SP',
            'email' => 'joao.silva@email.com'
        ),
        'beneficiarioFinal' => array(
            'numeroCpfCnpj' => '12345678901',
            'nome' => 'Empresa Exemplo LTDA'
        ),
        'mensagensInstrucao' => array(
            'Após o vencimento pagar preferencialmente no Sicoob',
            'Não receber após 30 dias do vencimento',
            'Após vencimento pagar no banco',
            'Não receber após 30 dias do vencimento',
            'Após vencimento pagar no banco'
        ),
        'gerarPdf' => false,
        'rateioCreditos' => array(
            array(
                'numeroBanco' => 756,
                'numeroAgencia' => 4027,
                'numeroContaCorrente' => 0,
                'contaPrincipal' => true,
                'codigoTipoValorRateio' => 1,
                'valorRateio' => 100,
                'codigoTipoCalculoRateio' => 1,
                'numeroCpfCnpjTitular' => '98765432185',
                'nomeTitular' => 'João da Silva Santos',
                'codigoFinalidadeTed' => 10,
                'codigoTipoContaDestinoTed' => 'CC',
                'quantidadeDiasFloat' => 1,
                'dataFloatCredito' => date('Y-m-d', strtotime('+1 day'))
            )
        ),
        'codigoCadastrarPIX' => 1,
        'numeroContratoCobranca' => 1
    );
    
    echo "🔄 Incluindo boleto...\n";
    
    // Incluindo o boleto
    $response = $sdk->cobrancaBancaria()->incluirBoleto($boleto);
    
    echo "✅ Boleto incluído com sucesso!\n";
    echo "📋 Resposta da API:\n";
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    
} catch (ApiException $e) {
    echo "❌ Erro na API: " . $e->getMessage() . "\n";
    echo "Código HTTP: " . $e->getHttpCode() . "\n";
    if ($e->getErrors()) {
        echo "Erros detalhados: " . json_encode($e->getErrors()) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
}

echo "\n📝 Informações sobre o exemplo:\n";
echo "- Este exemplo usa dados fictícios para demonstração\n";
echo "- No ambiente sandbox, os dados são simulados\n";
echo "- Todos os campos obrigatórios estão preenchidos conforme documentação\n";
echo "- O boleto inclui PIX automático (codigoCadastrarPIX: 1)\n";
echo "- Rateio de créditos está configurado para 100% na conta principal\n"; 