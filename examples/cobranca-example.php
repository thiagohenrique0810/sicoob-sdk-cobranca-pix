<?php
/**
 * Exemplo de uso do SDK Sicoob - Cobrança
 * 
 * Este exemplo demonstra como usar o SDK para:
 * - Criar um boleto
 * - Consultar um boleto
 * - Dar baixa em um boleto
 * 
 * @package SicoobSDK\Examples
 * @author Sicoob SDK Team
 */

// Inclui o autoloader
require_once __DIR__ . '/../src/autoload.php';

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Services\CobrancaService;
use SicoobSDK\Models\Boleto;
use SicoobSDK\Models\Pagador;
use SicoobSDK\Exceptions\SicoobException;
use SicoobSDK\Exceptions\ValidationException;

// Configuração do SDK
$config = new SicoobConfig([
    'environment' => 'sandbox', // Use 'production' para ambiente de produção
    'client_id' => 'seu-client-id',
    'client_secret' => 'seu-client-secret',
    'certificate_path' => '/path/to/certificate.pem',
    'private_key_path' => '/path/to/private-key.pem',
    'certificate_password' => 'senha-do-certificado', // Se necessário
    'timeout' => 30
]);

// Inicializa o serviço de cobrança
$cobrancaService = new CobrancaService($config);

echo "=== Exemplo de Uso do SDK Sicoob - Cobrança ===\n\n";

try {
    // Exemplo 1: Criar um boleto
    echo "1. Criando um boleto...\n";
    
    // Criar pagador
    $pagador = new Pagador([
        'numeroCpfCnpj' => '12345678901',
        'nome' => 'João da Silva',
        'endereco' => 'Rua das Flores, 123',
        'bairro' => 'Centro',
        'cidade' => 'São Paulo',
        'cep' => '01234-567',
        'uf' => 'SP',
        'email' => 'joao@email.com'
    ]);
    
    // Criar boleto
    $boleto = new Boleto([
        'numeroCliente' => 123456,
        'codigoModalidade' => 1, // SIMPLES COM REGISTRO
        'numeroContaCorrente' => 0,
        'codigoEspecieDocumento' => 'DM',
        'dataEmissao' => date('Y-m-d'),
        'nossoNumero' => 123456789,
        'seuNumero' => 'BOL001',
        'identificacaoBoletoEmpresa' => '4562',
        'identificacaoEmissaoBoleto' => 1,
        'identificacaoDistribuicaoBoleto' => 1,
        'valor' => 150.00,
        'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
        'dataLimitePagamento' => date('Y-m-d', strtotime('+30 days')),
        'valorAbatimento' => 0,
        'tipoDesconto' => 1,
        'dataPrimeiroDesconto' => date('Y-m-d', strtotime('+15 days')),
        'valorPrimeiroDesconto' => 10.00,
        'dataSegundoDesconto' => date('Y-m-d', strtotime('+20 days')),
        'valorSegundoDesconto' => 5.00,
        'dataTerceiroDesconto' => date('Y-m-d', strtotime('+25 days')),
        'valorTerceiroDesconto' => 2.50,
        'tipoMulta' => 1,
        'dataMulta' => date('Y-m-d', strtotime('+31 days')),
        'valorMulta' => 5.00,
        'tipoJurosMora' => 1,
        'dataJurosMora' => date('Y-m-d', strtotime('+31 days')),
        'valorJurosMora' => 2.00,
        'numeroParcela' => 1,
        'aceite' => true,
        'codigoNegativacao' => 2,
        'numeroDiasNegativacao' => 60,
        'codigoProtesto' => 1,
        'numeroDiasProtesto' => 30,
        'pagador' => $pagador,
        'beneficiarioFinal' => [
            'numeroCpfCnpj' => '98765432100',
            'nome' => 'Empresa Beneficiária LTDA'
        ],
        'mensagensInstrucao' => [
            'Após o vencimento pagar preferencialmente no Sicoob',
            'Não receber após 30 dias do vencimento',
            'Após vencimento pagar no banco ou loterica'
        ],
        'gerarPdf' => true,
        'codigoCadastrarPIX' => 1,
        'numeroContratoCobranca' => 1
    ]);
    
    // Incluir boleto
    $resultado = $cobrancaService->incluirBoleto($boleto);
    
    if (isset($resultado['resultado'])) {
        echo "✅ Boleto criado com sucesso!\n";
        echo "   Nosso Número: " . $resultado['resultado']['nossoNumero'] . "\n";
        echo "   Seu Número: " . $resultado['resultado']['seuNumero'] . "\n";
        echo "   Valor: R$ " . number_format($resultado['resultado']['valor'], 2, ',', '.') . "\n";
        echo "   Vencimento: " . $resultado['resultado']['dataVencimento'] . "\n";
        
        if (isset($resultado['resultado']['pdfBoleto'])) {
            echo "   PDF gerado com sucesso!\n";
        }
        
        if (isset($resultado['resultado']['qrCode'])) {
            echo "   QR Code PIX gerado!\n";
        }
        
        $nossoNumero = $resultado['resultado']['nossoNumero'];
        $numeroCliente = $resultado['resultado']['numeroCliente'];
        $codigoModalidade = $resultado['resultado']['codigoModalidade'];
        
    } else {
        echo "❌ Erro ao criar boleto\n";
        print_r($resultado);
    }
    
    echo "\n";
    
    // Exemplo 2: Consultar boleto
    echo "2. Consultando boleto...\n";
    
    try {
        $boletoConsultado = $cobrancaService->consultarBoletoPorNossoNumero(
            $numeroCliente,
            $codigoModalidade,
            $nossoNumero
        );
        
        if (isset($boletoConsultado['resultado'])) {
            echo "✅ Boleto consultado com sucesso!\n";
            echo "   Situação: " . $boletoConsultado['resultado']['situacaoBoleto'] . "\n";
            echo "   Pagador: " . $boletoConsultado['resultado']['pagador']['nome'] . "\n";
            echo "   Valor: R$ " . number_format($boletoConsultado['resultado']['valor'], 2, ',', '.') . "\n";
        } else {
            echo "❌ Erro ao consultar boleto\n";
            print_r($boletoConsultado);
        }
    } catch (SicoobException $e) {
        echo "❌ Erro ao consultar boleto: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
    
    // Exemplo 3: Listar boletos por pagador
    echo "3. Listando boletos por pagador...\n";
    
    try {
        $boletosPagador = $cobrancaService->listarBoletosPorPagador(
            $numeroCliente,
            $codigoModalidade,
            '12345678901'
        );
        
        if (isset($boletosPagador['resultado']) && is_array($boletosPagador['resultado'])) {
            echo "✅ Boletos encontrados: " . count($boletosPagador['resultado']) . "\n";
            foreach ($boletosPagador['resultado'] as $boleto) {
                echo "   - Nosso Número: " . $boleto['nossoNumero'] . " | Valor: R$ " . number_format($boleto['valor'], 2, ',', '.') . "\n";
            }
        } else {
            echo "ℹ️  Nenhum boleto encontrado para este pagador\n";
        }
    } catch (SicoobException $e) {
        echo "❌ Erro ao listar boletos: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
    
    // Exemplo 4: Emitir segunda via
    echo "4. Emitindo segunda via do boleto...\n";
    
    try {
        $segundaVia = $cobrancaService->emitirSegundaVia(
            $numeroCliente,
            $codigoModalidade,
            $nossoNumero
        );
        
        if (isset($segundaVia['resultado'])) {
            echo "✅ Segunda via emitida com sucesso!\n";
            if (isset($segundaVia['resultado']['pdfBoleto'])) {
                echo "   PDF da segunda via gerado!\n";
            }
        } else {
            echo "❌ Erro ao emitir segunda via\n";
            print_r($segundaVia);
        }
    } catch (SicoobException $e) {
        echo "❌ Erro ao emitir segunda via: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
    
    // Exemplo 5: Consultar faixas de nosso número
    echo "5. Consultando faixas de nosso número...\n";
    
    try {
        $faixas = $cobrancaService->consultarFaixasNossoNumero(
            $numeroCliente,
            $codigoModalidade
        );
        
        if (isset($faixas['resultado']) && is_array($faixas['resultado'])) {
            echo "✅ Faixas de nosso número encontradas:\n";
            foreach ($faixas['resultado'] as $faixa) {
                echo "   - Faixa: " . $faixa['faixaInicial'] . " a " . $faixa['faixaFinal'] . "\n";
            }
        } else {
            echo "ℹ️  Nenhuma faixa de nosso número encontrada\n";
        }
    } catch (SicoobException $e) {
        echo "❌ Erro ao consultar faixas: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
    
    // Exemplo 6: Dar baixa no boleto (comentado para não executar automaticamente)
    echo "6. Exemplo de como dar baixa no boleto (não executado):\n";
    echo "   // Para dar baixa, descomente as linhas abaixo:\n";
    echo "   // \$sucesso = \$cobrancaService->darBaixaBoleto(\$nossoNumero, \$numeroCliente, \$codigoModalidade);\n";
    echo "   // if (\$sucesso) {\n";
    echo "   //     echo '✅ Baixa realizada com sucesso!';\n";
    echo "   // }\n";
    
    /*
    // Descomente para executar a baixa
    try {
        $sucesso = $cobrancaService->darBaixaBoleto($nossoNumero, $numeroCliente, $codigoModalidade);
        if ($sucesso) {
            echo "✅ Baixa realizada com sucesso!\n";
        }
    } catch (SicoobException $e) {
        echo "❌ Erro ao dar baixa: " . $e->getMessage() . "\n";
    }
    */
    
    echo "\n";
    
    // Exemplo 7: Alterar pagador
    echo "7. Exemplo de como alterar dados do pagador:\n";
    echo "   \$dadosPagador = [\n";
    echo "       'numeroCpfCnpj' => '12345678901',\n";
    echo "       'nome' => 'João da Silva Atualizado',\n";
    echo "       'endereco' => 'Nova Rua, 456',\n";
    echo "       'bairro' => 'Novo Bairro',\n";
    echo "       'cidade' => 'São Paulo',\n";
    echo "       'cep' => '01234-567',\n";
    echo "       'uf' => 'SP',\n";
    echo "       'email' => 'joao.novo@email.com'\n";
    echo "   ];\n";
    echo "   \$resultado = \$cobrancaService->alterarPagador(\$dadosPagador);\n";
    
    echo "\n=== Exemplo concluído com sucesso! ===\n";
    
} catch (ValidationException $e) {
    echo "❌ Erro de validação: " . $e->getMessage() . "\n";
    if ($e->hasValidationErrors()) {
        echo "   Detalhes dos erros:\n";
        foreach ($e->getValidationErrors() as $campo => $erro) {
            echo "   - $campo: $erro\n";
        }
    }
} catch (SicoobException $e) {
    echo "❌ Erro do SDK: " . $e->getMessage() . "\n";
    if ($e->getHttpCode()) {
        echo "   Código HTTP: " . $e->getHttpCode() . "\n";
    }
    if ($e->getErrorData()) {
        echo "   Dados do erro: " . print_r($e->getErrorData(), true) . "\n";
    }
} catch (Exception $e) {
    echo "❌ Erro inesperado: " . $e->getMessage() . "\n";
} 