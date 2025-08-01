<?php
/**
 * Exceção base do SDK Sicoob
 * 
 * Classe base para todas as exceções específicas do SDK
 * 
 * @package SicoobSDK\Exceptions
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Exceptions;

class SicoobException extends \Exception
{
    /**
     * @var array Dados adicionais do erro
     */
    protected $errorData;
    
    /**
     * @var int Código HTTP da resposta
     */
    protected $httpCode;
    
    /**
     * Construtor da exceção
     * 
     * @param string $message Mensagem de erro
     * @param int $code Código de erro
     * @param \Exception $previous Exceção anterior
     * @param array $errorData Dados adicionais do erro
     * @param int $httpCode Código HTTP
     */
    public function __construct($message = '', $code = 0, $previous = null, array $errorData = [], $httpCode = 0)
    {
        parent::__construct($message, $code, $previous);
        $this->errorData = $errorData;
        $this->httpCode = $httpCode;
    }
    
    /**
     * Obtém os dados adicionais do erro
     * 
     * @return array
     */
    public function getErrorData()
    {
        return $this->errorData;
    }
    
    /**
     * Obtém o código HTTP da resposta
     * 
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
    
    /**
     * Cria uma exceção a partir de uma resposta da API
     * 
     * @param array $response Resposta da API
     * @param int $httpCode Código HTTP
     * @return SicoobException
     */
    public static function fromApiResponse(array $response, $httpCode = 0)
    {
        $message = 'Erro na API do Sicoob';
        $errorData = [];
        
        if (isset($response['mensagens']) && is_array($response['mensagens'])) {
            $messages = [];
            foreach ($response['mensagens'] as $msg) {
                if (isset($msg['mensagem'])) {
                    $messages[] = $msg['mensagem'];
                }
                if (isset($msg['codigo'])) {
                    $errorData['codigo'] = $msg['codigo'];
                }
            }
            
            if (!empty($messages)) {
                $message = implode('; ', $messages);
            }
        }
        
        return new self($message, $httpCode, null, $errorData, $httpCode);
    }
} 