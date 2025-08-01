<?php
/**
 * Cliente HTTP do SDK Sicoob
 * 
 * Classe responsável por gerenciar as requisições HTTP para as APIs do Sicoob,
 * incluindo autenticação com certificados digitais.
 * 
 * @package SicoobSDK\Client
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Client;

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Exceptions\SicoobException;

class HttpClient
{
    /**
     * @var SicoobConfig Configuração do SDK
     */
    private $config;
    
    /**
     * @var resource Recurso cURL
     * @phpstan-ignore-next-line
     */
    private $curl;
    
    /**
     * @var string Token de acesso atual
     */
    private $accessToken;
    
    /**
     * @var int Timestamp de expiração do token
     */
    private $tokenExpiresAt;
    
    /**
     * Construtor da classe
     * 
     * @param SicoobConfig $config Configuração do SDK
     */
    public function __construct(SicoobConfig $config)
    {
        $this->config = $config;
        $this->initCurl();
    }
    
    /**
     * Inicializa o recurso cURL
     * 
     * @return void
     */
    private function initCurl()
    {
        if (!extension_loaded('curl')) {
            throw new SicoobException('Extensão cURL é obrigatória');
        }
        
        $this->curl = curl_init();
        
        // Configurações básicas do cURL
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->config->getTimeout());
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 10);
        
        // Configuração de certificados
        if ($this->config->getCertificatePath()) {
            curl_setopt($this->curl, CURLOPT_SSLCERT, $this->config->getCertificatePath());
        }
        
        if ($this->config->getPrivateKeyPath()) {
            curl_setopt($this->curl, CURLOPT_SSLKEY, $this->config->getPrivateKeyPath());
        }
        
        if ($this->config->getCertificatePassword()) {
            curl_setopt($this->curl, CURLOPT_SSLCERTPASSWD, $this->config->getCertificatePassword());
        }
        
        // Configuração de proxy (se aplicável)
        if ($this->config->getUseProxy() && $this->config->getProxyUrl()) {
            curl_setopt($this->curl, CURLOPT_PROXY, $this->config->getProxyUrl());
            
            if ($this->config->getProxyUser() && $this->config->getProxyPassword()) {
                curl_setopt($this->curl, CURLOPT_PROXYUSERPWD, 
                    $this->config->getProxyUser() . ':' . $this->config->getProxyPassword());
            }
        }
    }
    
    /**
     * Realiza uma requisição GET
     * 
     * @param string $url URL da requisição
     * @param array $headers Headers adicionais
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function get($url, array $headers = [])
    {
        return $this->request('GET', $url, null, $headers);
    }
    
    /**
     * Realiza uma requisição POST
     * 
     * @param string $url URL da requisição
     * @param array $data Dados a serem enviados
     * @param array $headers Headers adicionais
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function post($url, array $data = null, array $headers = [])
    {
        return $this->request('POST', $url, $data, $headers);
    }
    
    /**
     * Realiza uma requisição PUT
     * 
     * @param string $url URL da requisição
     * @param array $data Dados a serem enviados
     * @param array $headers Headers adicionais
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function put($url, array $data = null, array $headers = [])
    {
        return $this->request('PUT', $url, $data, $headers);
    }
    
    /**
     * Realiza uma requisição PATCH
     * 
     * @param string $url URL da requisição
     * @param array $data Dados a serem enviados
     * @param array $headers Headers adicionais
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function patch($url, array $data = null, array $headers = [])
    {
        return $this->request('PATCH', $url, $data, $headers);
    }
    
    /**
     * Realiza uma requisição DELETE
     * 
     * @param string $url URL da requisição
     * @param array $headers Headers adicionais
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function delete($url, array $headers = [])
    {
        return $this->request('DELETE', $url, null, $headers);
    }
    
    /**
     * Realiza uma requisição HTTP genérica
     * 
     * @param string $method Método HTTP
     * @param string $url URL da requisição
     * @param array $data Dados a serem enviados
     * @param array $headers Headers adicionais
     * @return array Resposta da API
     * @throws SicoobException
     */
    private function request($method, $url, array $data = null, array $headers = [])
    {
        // Garante que o token de acesso está válido
        $this->ensureValidToken();
        
        // Configura o método HTTP
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($this->curl, CURLOPT_URL, $url);
        
        // Configura os headers
        $defaultHeaders = [
            'Content-Type: application/json',
            'Accept: application/json',
            'client_id: ' . $this->config->getClientId()
        ];
        
        if ($this->accessToken) {
            $defaultHeaders[] = 'Authorization: Bearer ' . $this->accessToken;
        }
        
        $allHeaders = array_merge($defaultHeaders, $headers);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $allHeaders);
        
        // Configura os dados (se houver)
        if ($data !== null) {
            curl_setopt($this->curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        
        // Executa a requisição
        $response = curl_exec($this->curl);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $error = curl_error($this->curl);
        
        if ($error) {
            throw new SicoobException('Erro cURL: ' . $error);
        }
        
        // Processa a resposta
        return $this->processResponse($response, $httpCode);
    }
    
    /**
     * Processa a resposta da API
     * 
     * @param string $response Resposta bruta
     * @param int $httpCode Código HTTP
     * @return array Resposta processada
     * @throws SicoobException
     */
    private function processResponse($response, $httpCode)
    {
        // Para códigos 204 (No Content), retorna array vazio
        if ($httpCode === 204) {
            return [];
        }
        
        // Decodifica a resposta JSON
        $data = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new SicoobException('Erro ao decodificar resposta JSON: ' . json_last_error_msg());
        }
        
        // Verifica se houve erro na API
        if ($httpCode >= 400) {
            throw SicoobException::fromApiResponse($data, $httpCode);
        }
        
        return $data;
    }
    
    /**
     * Garante que o token de acesso está válido
     * 
     * @return void
     */
    private function ensureValidToken()
    {
        // Se não há token ou está expirado, obtém um novo
        if (!$this->accessToken || time() >= $this->tokenExpiresAt) {
            $this->authenticate();
        }
    }
    
    /**
     * Realiza a autenticação OAuth2
     * 
     * @return void
     * @throws SicoobException
     */
    private function authenticate()
    {
        $authUrl = $this->config->getBaseUrl('auth') . '/token';
        
        $data = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->config->getClientId(),
            'client_secret' => $this->config->getClientSecret()
        ];
        
        // Configura a requisição de autenticação
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->curl, CURLOPT_URL, $authUrl);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json'
        ]);
        
        // Executa a requisição de autenticação
        $response = curl_exec($this->curl);
        $httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $error = curl_error($this->curl);
        
        if ($error) {
            throw new SicoobException('Erro na autenticação: ' . $error);
        }
        
        // Processa a resposta de autenticação
        $authData = json_decode($response, true);
        
        if ($httpCode >= 400) {
            throw SicoobException::fromApiResponse($authData, $httpCode);
        }
        
        if (!isset($authData['access_token'])) {
            throw new SicoobException('Token de acesso não encontrado na resposta');
        }
        
        // Armazena o token e sua expiração
        $this->accessToken = $authData['access_token'];
        $this->tokenExpiresAt = time() + ($authData['expires_in'] ?? 3600) - 300; // 5 minutos de margem
    }
    
    /**
     * Destrutor da classe
     */
    public function __destruct()
    {
        if ($this->curl) {
            curl_close($this->curl);
        }
    }
} 