<?php

namespace Sicoob\SDK\Auth;

use Sicoob\SDK\Exceptions\AuthenticationException;

/**
 * Classe para autenticação com as APIs do Sicoob
 */
class SicoobAuth
{
    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $certificatePath;

    /**
     * @var bool
     */
    protected $isSandbox;

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * Construtor
     *
     * @param string $clientId
     * @param bool $isSandbox
     * @param string $accessToken
     * @param string $certificatePath
     */
    public function __construct($clientId, $isSandbox = true, $accessToken = null, $certificatePath = null)
    {
        $this->clientId = $clientId;
        $this->isSandbox = $isSandbox;
        $this->accessToken = $accessToken;
        $this->certificatePath = $certificatePath;

        // Define a URL base baseada no ambiente
        if ($isSandbox) {
            $this->baseUrl = 'https://sandbox.sicoob.com.br/sicoob/sandbox';
        } else {
            $this->baseUrl = 'https://api.sicoob.com.br';
        }
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
        return new self($clientId, true, $accessToken);
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
        if (!file_exists($certificatePath)) {
            throw new AuthenticationException('Certificado não encontrado: ' . $certificatePath);
        }

        return new self($clientId, false, null, $certificatePath);
    }

    /**
     * Gera token de acesso para produção
     *
     * @return string
     * @throws AuthenticationException
     */
    public function generateToken()
    {
        if ($this->isSandbox) {
            throw new AuthenticationException('Geração de token não é necessária no sandbox');
        }

        if (!$this->certificatePath) {
            throw new AuthenticationException('Certificado é obrigatório para geração de token');
        }

        // Implementação da geração de token OAuth2 com certificado
        $url = $this->baseUrl . '/oauth/token';
        
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_SSLCERT => $this->certificatePath,
            CURLOPT_SSLKEY => $this->certificatePath,
            CURLOPT_SSLCERTPASSWD => '',
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json'
            ),
            CURLOPT_POSTFIELDS => http_build_query(array(
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId
            ))
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new AuthenticationException('Erro na requisição: ' . $error);
        }

        if ($httpCode !== 200) {
            throw new AuthenticationException('Erro na geração do token. HTTP Code: ' . $httpCode);
        }

        $data = json_decode($response, true);
        
        if (!isset($data['access_token'])) {
            throw new AuthenticationException('Token não encontrado na resposta');
        }

        $this->accessToken = $data['access_token'];
        return $this->accessToken;
    }

    /**
     * Retorna o token de acesso
     *
     * @return string
     */
    public function getAccessToken()
    {
        if (!$this->accessToken && !$this->isSandbox) {
            $this->generateToken();
        }
        
        return $this->accessToken;
    }

    /**
     * Retorna o client ID
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Verifica se está no ambiente sandbox
     *
     * @return bool
     */
    public function isSandbox()
    {
        return $this->isSandbox;
    }

    /**
     * Retorna a URL base
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Retorna o caminho do certificado
     *
     * @return string|null
     */
    public function getCertificatePath()
    {
        return $this->certificatePath;
    }

    /**
     * Retorna os headers de autenticação
     *
     * @return array
     */
    public function getAuthHeaders()
    {
        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'client_id: ' . $this->clientId
        );

        if ($this->accessToken) {
            $headers[] = 'Authorization: Bearer ' . $this->accessToken;
        }

        return $headers;
    }
} 