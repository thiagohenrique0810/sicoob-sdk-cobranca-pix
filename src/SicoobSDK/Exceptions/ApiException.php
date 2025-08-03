<?php

namespace Sicoob\SDK\Exceptions;

/**
 * Exceção para erros da API
 */
class ApiException extends SicoobException
{
    /**
     * Construtor
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     * @param array $errors
     * @param int $httpCode
     */
    public function __construct($message = 'Erro na API', $code = 0, $previous = null, $errors = array(), $httpCode = 0)
    {
        parent::__construct($message, $code, $previous, $errors, $httpCode);
    }
} 