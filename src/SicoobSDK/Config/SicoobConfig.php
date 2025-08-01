<?php
/**
 * Configuração do SDK Sicoob
 * 
 * Classe responsável por gerenciar as configurações de conexão
 * com as APIs do Sicoob, incluindo autenticação e certificados.
 * 
 * @package SicoobSDK\Config
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Config;

class SicoobConfig
{
    /**
     * @var string Ambiente de execução (sandbox ou production)
     */
    private $environment = 'sandbox';
    
    /**
     * @var string Client ID para autenticação
     */
    private $clientId;
    
    /**
     * @var string Client Secret para autenticação
     */
    private $clientSecret;
    
    /**
     * @var string Caminho para o certificado digital
     */
    private $certificatePath;
    
    /**
     * @var string Caminho para a chave privada
     */
    private $privateKeyPath;
    
    /**
     * @var string Senha do certificado (se necessário)
     */
    private $certificatePassword;
    
    /**
     * @var int Timeout para requisições HTTP (em segundos)
     */
    private $timeout = 30;
    
    /**
     * @var bool Se deve usar proxy
     */
    private $useProxy = false;
    
    /**
     * @var string URL do proxy (se aplicável)
     */
    private $proxyUrl;
    
    /**
     * @var string Usuário do proxy (se aplicável)
     */
    private $proxyUser;
    
    /**
     * @var string Senha do proxy (se aplicável)
     */
    private $proxyPassword;
    
    /**
     * URLs base das APIs
     */
    private $baseUrls = [
        'sandbox' => [
            'cobranca' => 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3',
            'pix' => 'https://sandbox.sicoob.com.br/sicoob/sandbox/pix/api/v2',
            'auth' => 'https://sandbox.sicoob.com.br/sicoob/sandbox/oauth2'
        ],
        'production' => [
            'cobranca' => 'https://api.sicoob.com.br/cobranca-bancaria/v3',
            'pix' => 'https://api.sicoob.com.br/pix/api/v2',
            'auth' => 'https://api.sicoob.com.br/oauth2'
        ]
    ];
    
    /**
     * Construtor da classe
     * 
     * @param array $config Array com as configurações iniciais
     */
    public function __construct(array $config = [])
    {
        if (!empty($config)) {
            $this->loadFromArray($config);
        }
    }
    
    /**
     * Carrega configurações a partir de um array
     * 
     * @param array $config Array com as configurações
     * @return void
     */
    public function loadFromArray(array $config)
    {
        if (isset($config['environment'])) {
            $this->setEnvironment($config['environment']);
        }
        
        if (isset($config['client_id'])) {
            $this->setClientId($config['client_id']);
        }
        
        if (isset($config['client_secret'])) {
            $this->setClientSecret($config['client_secret']);
        }
        
        if (isset($config['certificate_path'])) {
            $this->setCertificatePath($config['certificate_path']);
        }
        
        if (isset($config['private_key_path'])) {
            $this->setPrivateKeyPath($config['private_key_path']);
        }
        
        if (isset($config['certificate_password'])) {
            $this->setCertificatePassword($config['certificate_password']);
        }
        
        if (isset($config['timeout'])) {
            $this->setTimeout($config['timeout']);
        }
        
        if (isset($config['use_proxy'])) {
            $this->setUseProxy($config['use_proxy']);
        }
        
        if (isset($config['proxy_url'])) {
            $this->setProxyUrl($config['proxy_url']);
        }
        
        if (isset($config['proxy_user'])) {
            $this->setProxyUser($config['proxy_user']);
        }
        
        if (isset($config['proxy_password'])) {
            $this->setProxyPassword($config['proxy_password']);
        }
    }
    
    /**
     * Define o ambiente de execução
     * 
     * @param string $environment Ambiente (sandbox ou production)
     * @return SicoobConfig
     */
    public function setEnvironment($environment)
    {
        if (!in_array($environment, ['sandbox', 'production'])) {
            throw new \InvalidArgumentException('Ambiente deve ser "sandbox" ou "production"');
        }
        
        $this->environment = $environment;
        return $this;
    }
    
    /**
     * Obtém o ambiente atual
     * 
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
    
    /**
     * Define o Client ID
     * 
     * @param string $clientId
     * @return SicoobConfig
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    /**
     * Obtém o Client ID
     * 
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    
    /**
     * Define o Client Secret
     * 
     * @param string $clientSecret
     * @return SicoobConfig
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }
    
    /**
     * Obtém o Client Secret
     * 
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }
    
    /**
     * Define o caminho do certificado
     * 
     * @param string $certificatePath
     * @return SicoobConfig
     */
    public function setCertificatePath($certificatePath)
    {
        if (!file_exists($certificatePath)) {
            throw new \InvalidArgumentException('Certificado não encontrado: ' . $certificatePath);
        }
        
        $this->certificatePath = $certificatePath;
        return $this;
    }
    
    /**
     * Obtém o caminho do certificado
     * 
     * @return string
     */
    public function getCertificatePath()
    {
        return $this->certificatePath;
    }
    
    /**
     * Define o caminho da chave privada
     * 
     * @param string $privateKeyPath
     * @return SicoobConfig
     */
    public function setPrivateKeyPath($privateKeyPath)
    {
        if (!file_exists($privateKeyPath)) {
            throw new \InvalidArgumentException('Chave privada não encontrada: ' . $privateKeyPath);
        }
        
        $this->privateKeyPath = $privateKeyPath;
        return $this;
    }
    
    /**
     * Obtém o caminho da chave privada
     * 
     * @return string
     */
    public function getPrivateKeyPath()
    {
        return $this->privateKeyPath;
    }
    
    /**
     * Define a senha do certificado
     * 
     * @param string $password
     * @return SicoobConfig
     */
    public function setCertificatePassword($password)
    {
        $this->certificatePassword = $password;
        return $this;
    }
    
    /**
     * Obtém a senha do certificado
     * 
     * @return string
     */
    public function getCertificatePassword()
    {
        return $this->certificatePassword;
    }
    
    /**
     * Define o timeout das requisições
     * 
     * @param int $timeout Timeout em segundos
     * @return SicoobConfig
     */
    public function setTimeout($timeout)
    {
        $this->timeout = (int) $timeout;
        return $this;
    }
    
    /**
     * Obtém o timeout das requisições
     * 
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
    
    /**
     * Define se deve usar proxy
     * 
     * @param bool $useProxy
     * @return SicoobConfig
     */
    public function setUseProxy($useProxy)
    {
        $this->useProxy = (bool) $useProxy;
        return $this;
    }
    
    /**
     * Verifica se deve usar proxy
     * 
     * @return bool
     */
    public function getUseProxy()
    {
        return $this->useProxy;
    }
    
    /**
     * Define a URL do proxy
     * 
     * @param string $proxyUrl
     * @return SicoobConfig
     */
    public function setProxyUrl($proxyUrl)
    {
        $this->proxyUrl = $proxyUrl;
        return $this;
    }
    
    /**
     * Obtém a URL do proxy
     * 
     * @return string
     */
    public function getProxyUrl()
    {
        return $this->proxyUrl;
    }
    
    /**
     * Define o usuário do proxy
     * 
     * @param string $proxyUser
     * @return SicoobConfig
     */
    public function setProxyUser($proxyUser)
    {
        $this->proxyUser = $proxyUser;
        return $this;
    }
    
    /**
     * Obtém o usuário do proxy
     * 
     * @return string
     */
    public function getProxyUser()
    {
        return $this->proxyUser;
    }
    
    /**
     * Define a senha do proxy
     * 
     * @param string $proxyPassword
     * @return SicoobConfig
     */
    public function setProxyPassword($proxyPassword)
    {
        $this->proxyPassword = $proxyPassword;
        return $this;
    }
    
    /**
     * Obtém a senha do proxy
     * 
     * @return string
     */
    public function getProxyPassword()
    {
        return $this->proxyPassword;
    }
    
    /**
     * Obtém a URL base para um serviço específico
     * 
     * @param string $service Nome do serviço (cobranca, pix, auth)
     * @return string
     */
    public function getBaseUrl($service)
    {
        if (!isset($this->baseUrls[$this->environment][$service])) {
            throw new \InvalidArgumentException('Serviço não encontrado: ' . $service);
        }
        
        return $this->baseUrls[$this->environment][$service];
    }
    
    /**
     * Obtém todas as URLs base do ambiente atual
     * 
     * @return array
     */
    public function getBaseUrls()
    {
        return $this->baseUrls[$this->environment];
    }
    
    /**
     * Valida se as configurações obrigatórias estão presentes
     * 
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function validate()
    {
        if (empty($this->clientId)) {
            throw new \InvalidArgumentException('Client ID é obrigatório');
        }
        
        if (empty($this->clientSecret)) {
            throw new \InvalidArgumentException('Client Secret é obrigatório');
        }
        
        if (empty($this->certificatePath)) {
            throw new \InvalidArgumentException('Caminho do certificado é obrigatório');
        }
        
        if (empty($this->privateKeyPath)) {
            throw new \InvalidArgumentException('Caminho da chave privada é obrigatório');
        }
        
        return true;
    }
} 