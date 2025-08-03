<?php

namespace Sicoob\SDK\Exceptions;

/**
 * Exceção para problemas de autenticação
 */
class AuthenticationException extends SicoobException
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
    public function __construct($message = 'Erro de autenticação', $code = 401, $previous = null, $errors = array(), $httpCode = 401)
    {
        parent::__construct($message, $code, $previous, $errors, $httpCode);
    }
} 