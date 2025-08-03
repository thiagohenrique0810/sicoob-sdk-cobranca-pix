<?php

namespace Sicoob\SDK\Services;

use Sicoob\SDK\Client\SicoobClient;
use Sicoob\SDK\Exceptions\ApiException;

/**
 * Classe para API de Cobrança Bancária V3
 */
class CobrancaBancaria
{
    /**
     * @var SicoobClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseEndpoint = '/cobranca-bancaria/v3';

    /**
     * Construtor
     *
     * @param SicoobClient $client
     */
    public function __construct(SicoobClient $client)
    {
        $this->client = $client;
    }

    /**
     * Incluir boletos
     *
     * @param array $boleto
     * @return array
     * @throws ApiException
     */
    public function incluirBoleto($boleto)
    {
        return $this->client->post($this->baseEndpoint . '/boletos', $boleto);
    }

    /**
     * Consultar boletos
     *
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function consultarBoletos($params = array())
    {
        // Para listar boletos, precisamos usar o endpoint de pagadores
        // Se não houver CPF/CNPJ nos parâmetros, usamos um CPF fictício para sandbox
        $cpfCnpj = isset($params['cpfCnpj']) ? $params['cpfCnpj'] : '12345678901';
        
        // Remove cpfCnpj dos parâmetros pois ele vai na URL
        unset($params['cpfCnpj']);
        
        return $this->client->get($this->baseEndpoint . '/pagadores/' . $cpfCnpj . '/boletos', $params);
    }

    /**
     * Consultar boleto por nosso número
     *
     * @param int $nossoNumero
     * @return array
     * @throws ApiException
     */
    public function consultarBoleto($nossoNumero)
    {
        return $this->client->get($this->baseEndpoint . '/boletos/' . $nossoNumero);
    }

    /**
     * Alterar boleto
     *
     * @param int $nossoNumero
     * @param array $dados
     * @return array
     * @throws ApiException
     */
    public function alterarBoleto($nossoNumero, $dados)
    {
        return $this->client->put($this->baseEndpoint . '/boletos/' . $nossoNumero, $dados);
    }

    /**
     * Baixar boleto
     *
     * @param int $nossoNumero
     * @return array
     * @throws ApiException
     */
    public function baixarBoleto($nossoNumero)
    {
        return $this->client->delete($this->baseEndpoint . '/boletos/' . $nossoNumero);
    }

    /**
     * Cadastrar webhook
     *
     * @param array $webhook
     * @return array
     * @throws ApiException
     */
    public function cadastrarWebhook($webhook)
    {
        return $this->client->post($this->baseEndpoint . '/webhooks', $webhook);
    }

    /**
     * Consultar webhooks cadastrados
     *
     * @param int $idWebhook
     * @param int $codigoTipoMovimento
     * @return array
     * @throws ApiException
     */
    public function consultarWebhooks($idWebhook, $codigoTipoMovimento)
    {
        $params = array(
            'idWebhook' => $idWebhook,
            'codigoTipoMovimento' => $codigoTipoMovimento
        );
        
        return $this->client->get($this->baseEndpoint . '/webhooks', $params);
    }

    /**
     * Consultar solicitações de webhook
     *
     * @param string $dataSolicitacao
     * @param int $pagina
     * @param int $codigoSolicitacaoSituacao
     * @return array
     * @throws ApiException
     */
    public function consultarSolicitacoesWebhook($dataSolicitacao, $pagina, $codigoSolicitacaoSituacao)
    {
        $params = array(
            'dataSolicitacao' => $dataSolicitacao,
            'pagina' => $pagina,
            'codigoSolicitacaoSituacao' => $codigoSolicitacaoSituacao
        );
        
        return $this->client->get($this->baseEndpoint . '/webhooks/solicitacoes', $params);
    }

    /**
     * Consultar movimentações
     *
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function consultarMovimentacoes($params = array())
    {
        return $this->client->get($this->baseEndpoint . '/movimentacoes', $params);
    }

    /**
     * Consultar movimentação por nosso número
     *
     * @param int $nossoNumero
     * @return array
     * @throws ApiException
     */
    public function consultarMovimentacao($nossoNumero)
    {
        return $this->client->get($this->baseEndpoint . '/movimentacoes/' . $nossoNumero);
    }

    /**
     * Consultar negativações
     *
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function consultarNegativacoes($params = array())
    {
        return $this->client->get($this->baseEndpoint . '/negativacoes', $params);
    }

    /**
     * Consultar protestos
     *
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function consultarProtestos($params = array())
    {
        return $this->client->get($this->baseEndpoint . '/protestos', $params);
    }

    /**
     * Consultar rateios
     *
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function consultarRateios($params = array())
    {
        return $this->client->get($this->baseEndpoint . '/rateios', $params);
    }

    /**
     * Consultar rateio por nosso número
     *
     * @param int $nossoNumero
     * @return array
     * @throws ApiException
     */
    public function consultarRateio($nossoNumero)
    {
        return $this->client->get($this->baseEndpoint . '/rateios/' . $nossoNumero);
    }

    /**
     * Retorna o cliente HTTP
     *
     * @return SicoobClient
     */
    public function getClient()
    {
        return $this->client;
    }
} 