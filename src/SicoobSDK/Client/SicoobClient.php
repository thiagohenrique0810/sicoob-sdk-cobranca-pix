<?php

namespace Sicoob\SDK\Client;

use Sicoob\SDK\Auth\SicoobAuth;
use Sicoob\SDK\Exceptions\ApiException;
use Sicoob\SDK\Exceptions\AuthenticationException;

/**
 * Cliente HTTP para comunicação com as APIs do Sicoob
 */
class SicoobClient
{
    /**
     * @var SicoobAuth
     */
    protected $auth;

    /**
     * @var int
     */
    protected $timeout;

    /**
     * @var bool
     */
    protected $verifySSL;

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
        $this->timeout = $timeout;
        $this->verifySSL = $verifySSL;
    }

    /**
     * Executa uma requisição GET
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function get($endpoint, $params = array())
    {
        return $this->request('GET', $endpoint, $params);
    }

    /**
     * Executa uma requisição POST
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws ApiException
     */
    public function post($endpoint, $data = array())
    {
        return $this->request('POST', $endpoint, $data);
    }

    /**
     * Executa uma requisição PUT
     *
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws ApiException
     */
    public function put($endpoint, $data = array())
    {
        return $this->request('PUT', $endpoint, $data);
    }

    /**
     * Executa uma requisição DELETE
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     * @throws ApiException
     */
    public function delete($endpoint, $params = array())
    {
        return $this->request('DELETE', $endpoint, $params);
    }

    /**
     * Executa uma requisição HTTP
     *
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws ApiException
     */
    protected function request($method, $endpoint, $data = array())
    {
        $url = $this->auth->getBaseUrl() . $endpoint;
        
        // Adiciona parâmetros na URL para GET
        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        }

        $ch = curl_init();
        
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_HTTPHEADER => $this->auth->getAuthHeaders(),
            CURLOPT_SSL_VERIFYPEER => $this->verifySSL,
            CURLOPT_SSL_VERIFYHOST => $this->verifySSL ? 2 : 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 5
        );

        // Configurações específicas para produção com certificado
        if (!$this->auth->isSandbox() && $this->auth->getCertificatePath()) {
            $options[CURLOPT_SSLCERT] = $this->auth->getCertificatePath();
            $options[CURLOPT_SSLKEY] = $this->auth->getCertificatePath();
        }

        switch ($method) {
            case 'POST':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
                break;
            case 'PUT':
                $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                $options[CURLOPT_POSTFIELDS] = json_encode($data);
                break;
            case 'DELETE':
                $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                if (!empty($data)) {
                    $options[CURLOPT_POSTFIELDS] = json_encode($data);
                }
                break;
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new ApiException('Erro na requisição cURL: ' . $error, 0, null, array(), 0);
        }

        // Decodifica a resposta JSON
        $responseData = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiException('Erro ao decodificar resposta JSON: ' . json_last_error_msg(), 0, null, array(), $httpCode);
        }

        // Verifica códigos de erro HTTP
        if ($httpCode >= 400) {
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Erro na API';
            $errors = isset($responseData['errors']) ? $responseData['errors'] : array();
            
            if ($httpCode === 401) {
                throw new AuthenticationException($errorMessage, $httpCode, null, $errors, $httpCode);
            } else {
                throw new ApiException($errorMessage, $httpCode, null, $errors, $httpCode);
            }
        }

        return $responseData;
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
} 