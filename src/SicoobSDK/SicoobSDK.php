<?php

namespace Sicoob\SDK;

use Sicoob\SDK\Auth\SicoobAuth;
use Sicoob\SDK\Client\SicoobClient;
use Sicoob\SDK\Services\CobrancaBancaria;
use Sicoob\SDK\Services\Pix;

/**
 * Classe principal do SDK Sicoob
 */
class SicoobSDK
{
    /**
     * @var SicoobAuth
     */
    protected $auth;

    /**
     * @var SicoobClient
     */
    protected $client;

    /**
     * @var CobrancaBancaria
     */
    protected $cobrancaBancaria;

    /**
     * @var Pix
     */
    protected $pix;

    /**
     * Construtor
     *
     * @param SicoobAuth $auth
     * @param int $timeout
     * @param bool $verifySSL
     */
    public function __construct(SicoobAuth $auth, $timeout = 30, $verifySSL = true)
    {
        $this->auth = $auth;
        $this->client = new SicoobClient($auth, $timeout, $verifySSL);
        $this->cobrancaBancaria = new CobrancaBancaria($this->client);
        $this->pix = new Pix($this->client);
    }

    /**
     * Cria instância para ambiente sandbox
     *
     * @param string $clientId
     * @param string $accessToken
     * @return self
     */
    public static function sandbox($clientId, $accessToken)
    {
        $auth = SicoobAuth::sandbox($clientId, $accessToken);
        return new self($auth, 30, false); // Desabilita SSL para sandbox
    }

    /**
     * Cria instância para ambiente de produção
     *
     * @param string $clientId
     * @param string $certificatePath
     * @return self
     */
    public static function production($clientId, $certificatePath)
    {
        $auth = SicoobAuth::production($clientId, $certificatePath);
        return new self($auth);
    }

    /**
     * Retorna o serviço de Cobrança Bancária
     *
     * @return CobrancaBancaria
     */
    public function cobrancaBancaria()
    {
        return $this->cobrancaBancaria;
    }

    /**
     * Retorna o serviço de PIX
     *
     * @return Pix
     */
    public function pix()
    {
        return $this->pix;
    }

    /**
     * Retorna a instância de autenticação
     *
     * @return SicoobAuth
     */
    public function getAuth()
    {
        return $this->auth;
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

    /**
     * Gera token de acesso (apenas para produção)
     *
     * @return string
     */
    public function generateToken()
    {
        return $this->auth->generateToken();
    }

    /**
     * Retorna o token de acesso
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->auth->getAccessToken();
    }

    /**
     * Verifica se está no ambiente sandbox
     *
     * @return bool
     */
    public function isSandbox()
    {
        return $this->auth->isSandbox();
    }
} 