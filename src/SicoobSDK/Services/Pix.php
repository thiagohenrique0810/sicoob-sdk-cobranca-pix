<?php

namespace Sicoob\SDK\Services;

use Sicoob\SDK\Client\SicoobClient;
use Sicoob\SDK\Exceptions\ApiException;

/**
 * Classe para API PIX
 */
class Pix
{
    /**
     * @var SicoobClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseEndpoint = '/pix/api/v2';

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
     * Consultar PIX recebidos
     *
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function consultarPixRecebidos($params = array())
    {
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por e2eid
     *
     * @param string $e2eid
     * @return array
     * @throws ApiException
     */
    public function consultarPix($e2eid)
    {
        return $this->client->get($this->baseEndpoint . '/pix/' . $e2eid);
    }

    /**
     * Consultar PIX por txid
     *
     * @param string $txid
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTxid($txid)
    {
        return $this->client->get($this->baseEndpoint . '/pix/txid/' . $txid);
    }

    /**
     * Consultar PIX por data
     *
     * @param string $data
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorData($data)
    {
        $params = array('data' => $data);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por período
     *
     * @param string $dataInicio
     * @param string $dataFim
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorPeriodo($dataInicio, $dataFim)
    {
        $params = array(
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim
        );
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por CPF/CNPJ
     *
     * @param string $cpfCnpj
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorCpfCnpj($cpfCnpj)
    {
        $params = array('cpfCnpj' => $cpfCnpj);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por valor
     *
     * @param float $valor
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorValor($valor)
    {
        $params = array('valor' => $valor);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por chave
     *
     * @param string $chave
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorChave($chave)
    {
        $params = array('chave' => $chave);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por tipo de chave
     *
     * @param string $tipoChave
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTipoChave($tipoChave)
    {
        $params = array('tipoChave' => $tipoChave);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por status
     *
     * @param string $status
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorStatus($status)
    {
        $params = array('status' => $status);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por tipo de pagamento
     *
     * @param string $tipoPagamento
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTipoPagamento($tipoPagamento)
    {
        $params = array('tipoPagamento' => $tipoPagamento);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por tipo de operação
     *
     * @param string $tipoOperacao
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTipoOperacao($tipoOperacao)
    {
        $params = array('tipoOperacao' => $tipoOperacao);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por tipo de conta
     *
     * @param string $tipoConta
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTipoConta($tipoConta)
    {
        $params = array('tipoConta' => $tipoConta);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por banco
     *
     * @param int $banco
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorBanco($banco)
    {
        $params = array('banco' => $banco);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por agência
     *
     * @param int $agencia
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorAgencia($agencia)
    {
        $params = array('agencia' => $agencia);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por conta
     *
     * @param int $conta
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorConta($conta)
    {
        $params = array('conta' => $conta);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por nome
     *
     * @param string $nome
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorNome($nome)
    {
        $params = array('nome' => $nome);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por cidade
     *
     * @param string $cidade
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorCidade($cidade)
    {
        $params = array('cidade' => $cidade);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por UF
     *
     * @param string $uf
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorUf($uf)
    {
        $params = array('uf' => $uf);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por CEP
     *
     * @param string $cep
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorCep($cep)
    {
        $params = array('cep' => $cep);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por bairro
     *
     * @param string $bairro
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorBairro($bairro)
    {
        $params = array('bairro' => $bairro);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por endereço
     *
     * @param string $endereco
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorEndereco($endereco)
    {
        $params = array('endereco' => $endereco);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por email
     *
     * @param string $email
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorEmail($email)
    {
        $params = array('email' => $email);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por telefone
     *
     * @param string $telefone
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTelefone($telefone)
    {
        $params = array('telefone' => $telefone);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por CPF/CNPJ do beneficiário
     *
     * @param string $cpfCnpjBeneficiario
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorCpfCnpjBeneficiario($cpfCnpjBeneficiario)
    {
        $params = array('cpfCnpjBeneficiario' => $cpfCnpjBeneficiario);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por nome do beneficiário
     *
     * @param string $nomeBeneficiario
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorNomeBeneficiario($nomeBeneficiario)
    {
        $params = array('nomeBeneficiario' => $nomeBeneficiario);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por banco do beneficiário
     *
     * @param int $bancoBeneficiario
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorBancoBeneficiario($bancoBeneficiario)
    {
        $params = array('bancoBeneficiario' => $bancoBeneficiario);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por agência do beneficiário
     *
     * @param int $agenciaBeneficiario
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorAgenciaBeneficiario($agenciaBeneficiario)
    {
        $params = array('agenciaBeneficiario' => $agenciaBeneficiario);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por conta do beneficiário
     *
     * @param int $contaBeneficiario
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorContaBeneficiario($contaBeneficiario)
    {
        $params = array('contaBeneficiario' => $contaBeneficiario);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por tipo de conta do beneficiário
     *
     * @param string $tipoContaBeneficiario
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorTipoContaBeneficiario($tipoContaBeneficiario)
    {
        $params = array('tipoContaBeneficiario' => $tipoContaBeneficiario);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por nome do beneficiário final
     *
     * @param string $nomeBeneficiarioFinal
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorNomeBeneficiarioFinal($nomeBeneficiarioFinal)
    {
        $params = array('nomeBeneficiarioFinal' => $nomeBeneficiarioFinal);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
    }

    /**
     * Consultar PIX por CPF/CNPJ do beneficiário final
     *
     * @param string $cpfCnpjBeneficiarioFinal
     * @return array
     * @throws ApiException
     */
    public function consultarPixPorCpfCnpjBeneficiarioFinal($cpfCnpjBeneficiarioFinal)
    {
        $params = array('cpfCnpjBeneficiarioFinal' => $cpfCnpjBeneficiarioFinal);
        return $this->client->get($this->baseEndpoint . '/pix', $params);
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