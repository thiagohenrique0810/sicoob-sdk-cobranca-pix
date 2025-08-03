<?php
/**
 * Dados de teste reutilizáveis para o SDK Sicoob
 * 
 * @package SicoobSDK\Tests\Fixtures
 */

class TestData
{
    /**
     * Dados de teste para boleto válido
     */
    public static function getBoletoValido()
    {
        return [
            'numeroCliente' => 25546454,
            'codigoModalidade' => 1,
            'numeroContaCorrente' => 0,
            'codigoEspecieDocumento' => 'DM',
            'dataEmissao' => date('Y-m-d'),
            'seuNumero' => 'TEST-' . time(),
            'identificacaoBoletoEmpresa' => 'TEST-' . time(),
            'identificacaoEmissaoBoleto' => 1,
            'identificacaoDistribuicaoBoleto' => 1,
            'valor' => 156.23,
            'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
            'dataLimitePagamento' => date('Y-m-d', strtotime('+60 days')),
            'valorAbatimento' => 0,
            'tipoDesconto' => 0,
            'dataPrimeiroDesconto' => null,
            'valorPrimeiroDesconto' => 0,
            'dataSegundoDesconto' => null,
            'valorSegundoDesconto' => 0,
            'dataTerceiroDesconto' => null,
            'valorTerceiroDesconto' => 0,
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
            'pagador' => self::getPagadorValido(),
            'beneficiarioFinal' => [
                'numeroCpfCnpj' => '12345678901',
                'nome' => 'Empresa Teste LTDA'
            ],
            'mensagensInstrucao' => [
                'Após o vencimento pagar preferencialmente no Sicoob',
                'Não receber após 30 dias do vencimento'
            ],
            'gerarPdf' => false,
            'codigoCadastrarPIX' => 1,
            'numeroContratoCobranca' => 1
        ];
    }

    /**
     * Dados de teste para pagador válido
     */
    public static function getPagadorValido()
    {
        return [
            'numeroCpfCnpj' => '98765432185',
            'nome' => 'João da Silva Teste',
            'endereco' => 'Rua Teste, 123',
            'bairro' => 'Centro',
            'cidade' => 'Brasília',
            'cep' => '70000000',
            'uf' => 'DF',
            'email' => 'teste@exemplo.com'
        ];
    }

    /**
     * Dados de teste para webhook válido
     */
    public static function getWebhookValido()
    {
        return [
            'url' => 'https://webhook.site/test-sicoob',
            'codigoTipoMovimento' => 7,
            'codigoPeriodoMovimento' => 1,
            'email' => 'teste@exemplo.com'
        ];
    }

    /**
     * Dados de teste para configuração válida
     */
    public static function getConfigValida()
    {
        return [
            'environment' => 'sandbox',
            'client_id' => '9b5e603e428cc477a2841e2683c92d21',
            'client_secret' => 'test_secret',
            'certificate_path' => __DIR__ . '/../bootstrap.php',
            'private_key_path' => __DIR__ . '/../bootstrap.php',
            'timeout' => 30
        ];
    }

    /**
     * Dados de teste para boleto com CPF
     */
    public static function getBoletoComCpf()
    {
        $data = self::getBoletoValido();
        $data['pagador']['numeroCpfCnpj'] = '98765432185';
        return $data;
    }

    /**
     * Dados de teste para boleto com CNPJ
     */
    public static function getBoletoComCnpj()
    {
        $data = self::getBoletoValido();
        $data['pagador']['numeroCpfCnpj'] = '12345678000195';
        return $data;
    }

    /**
     * Dados de teste para boleto com desconto
     */
    public static function getBoletoComDesconto()
    {
        $data = self::getBoletoValido();
        $data['tipoDesconto'] = 1;
        $data['dataPrimeiroDesconto'] = date('Y-m-d', strtotime('+15 days'));
        $data['valorPrimeiroDesconto'] = 10.00;
        return $data;
    }

    /**
     * Dados de teste para boleto com multa
     */
    public static function getBoletoComMulta()
    {
        $data = self::getBoletoValido();
        $data['tipoMulta'] = 1;
        $data['dataMulta'] = date('Y-m-d', strtotime('+31 days'));
        $data['valorMulta'] = 5.00;
        return $data;
    }

    /**
     * Dados de teste para boleto com juros
     */
    public static function getBoletoComJuros()
    {
        $data = self::getBoletoValido();
        $data['tipoJurosMora'] = 1;
        $data['dataJurosMora'] = date('Y-m-d', strtotime('+31 days'));
        $data['valorJurosMora'] = 4.00;
        return $data;
    }

    /**
     * Dados de teste para boleto com negativação
     */
    public static function getBoletoComNegativacao()
    {
        $data = self::getBoletoValido();
        $data['codigoNegativacao'] = 2;
        $data['numeroDiasNegativacao'] = 60;
        return $data;
    }

    /**
     * Dados de teste para boleto com protesto
     */
    public static function getBoletoComProtesto()
    {
        $data = self::getBoletoValido();
        $data['codigoProtesto'] = 1;
        $data['numeroDiasProtesto'] = 30;
        return $data;
    }

    /**
     * Dados de teste para boleto com rateio
     */
    public static function getBoletoComRateio()
    {
        $data = self::getBoletoValido();
        $data['rateioCreditos'] = [
            [
                'numeroBanco' => 756,
                'numeroAgencia' => 4027,
                'numeroContaCorrente' => 0,
                'contaPrincipal' => true,
                'codigoTipoValorRateio' => 1,
                'valorRateio' => 100,
                'codigoTipoCalculoRateio' => 1,
                'numeroCpfCnpjTitular' => '98765432185',
                'nomeTitular' => 'João da Silva',
                'codigoFinalidadeTed' => 10,
                'codigoTipoContaDestinoTed' => 'CC',
                'quantidadeDiasFloat' => 1
            ]
        ];
        return $data;
    }

    /**
     * Dados de teste para pagador com CPF
     */
    public static function getPagadorComCpf()
    {
        return [
            'numeroCpfCnpj' => '98765432185',
            'nome' => 'João da Silva',
            'endereco' => 'Rua Teste, 123',
            'bairro' => 'Centro',
            'cidade' => 'Brasília',
            'cep' => '70000000',
            'uf' => 'DF',
            'email' => 'joao@exemplo.com'
        ];
    }

    /**
     * Dados de teste para pagador com CNPJ
     */
    public static function getPagadorComCnpj()
    {
        return [
            'numeroCpfCnpj' => '12345678000195',
            'nome' => 'Empresa Teste LTDA',
            'endereco' => 'Rua Empresarial, 456',
            'bairro' => 'Centro Empresarial',
            'cidade' => 'São Paulo',
            'cep' => '01234567',
            'uf' => 'SP',
            'email' => 'contato@empresa.com'
        ];
    }

    /**
     * Dados de teste para notificação de webhook
     */
    public static function getNotificacaoWebhook()
    {
        return [
            'idWebhook' => 214,
            'tipoMovimento' => 7,
            'dados' => [
                'numeroIdentificadorBaixa' => '2024102000741150823',
                'codigoBarrasBoleto' => '75692868200000405001434201006355000002443003',
                'codigoBarrasBaixa' => '75692868200000405001434201006355000002443003',
                'nossoNumero' => '0000002443',
                'seuNumero' => '00-03',
                'codigoBancoRecebedor' => '756',
                'codigoAgenciaRecebedora' => 3069,
                'numeroCliente' => 63550,
                'cpfCnpjBeneficiario' => '00500754977',
                'codigoTipoPessoaPagador' => 'F',
                'nomePagador' => 'João da Silva',
                'cpfCnpjPagador' => '98765432185',
                'nomeFantasiaPagador' => 'João da Silva',
                'codigoTipoPessoaPortador' => 'F',
                'nomePortador' => 'João',
                'cpfCnpjPortador' => '09197004979',
                'valorBoleto' => 405,
                'valorPagamento' => 407.41,
                'codigoCanalPagamento' => 3,
                'codigoMotivoCancelamento' => 2,
                'dataEmissao' => '2021-04-19',
                'dataVencimento' => '2021-07-15',
                'dataLimitePagamento' => '2022-01-10',
                'dataHoraSituacaoBaixa' => '2021-07-22T13:45:33.000Z',
                'baixaRealizadaEmContigencia' => false,
                'cancelamentoBaixa' => false
            ]
        ];
    }

    /**
     * Dados de teste para validação de webhook
     */
    public static function getValidacaoWebhook()
    {
        return [
            'idWebhook' => 990,
            'validacaoWebhook' => true
        ];
    }

    /**
     * Dados de teste para erro da API
     */
    public static function getErroApi()
    {
        return [
            'mensagens' => [
                [
                    'mensagem' => 'Dados inválidos',
                    'codigo' => 'VALIDATION_ERROR'
                ]
            ]
        ];
    }

    /**
     * Dados de teste para resposta de sucesso
     */
    public static function getRespostaSucesso()
    {
        return [
            'resultado' => [
                'numeroCliente' => 25546454,
                'codigoModalidade' => 1,
                'nossoNumero' => 123456,
                'seuNumero' => 'TEST-123',
                'valor' => 156.23,
                'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
                'situacaoBoleto' => 'Em Aberto'
            ]
        ];
    }
} 