<?php
/**
 * Exceção de validação do SDK Sicoob
 * 
 * Classe para exceções relacionadas à validação de dados
 * 
 * @package SicoobSDK\Exceptions
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Exceptions;

class ValidationException extends SicoobException
{
    /**
     * @var array Campos com erro de validação
     */
    protected $validationErrors;
    
    /**
     * Construtor da exceção
     * 
     * @param string $message Mensagem de erro
     * @param array $validationErrors Erros de validação por campo
     * @param int $code Código de erro
     * @param \Exception $previous Exceção anterior
     */
    public function __construct($message = 'Erro de validação', array $validationErrors = [], $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->validationErrors = $validationErrors;
    }
    
    /**
     * Obtém os erros de validação
     * 
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->validationErrors;
    }
    
    /**
     * Adiciona um erro de validação para um campo
     * 
     * @param string $field Campo com erro
     * @param string $message Mensagem de erro
     * @return ValidationException
     */
    public function addValidationError($field, $message)
    {
        $this->validationErrors[$field] = $message;
        return $this;
    }
    
    /**
     * Verifica se há erros de validação
     * 
     * @return bool
     */
    public function hasValidationErrors()
    {
        return !empty($this->validationErrors);
    }
} 