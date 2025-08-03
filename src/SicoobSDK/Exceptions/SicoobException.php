<?php

namespace Sicoob\SDK\Exceptions;

/**
 * Classe base para exceções do SDK Sicoob
 */
class SicoobException extends \Exception
{
    /**
     * @var array
     */
    protected $errors;

    /**
     * @var int
     */
    protected $httpCode;

    /**
     * Construtor
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     * @param array $errors
     * @param int $httpCode
     */
    public function __construct($message = '', $code = 0, $previous = null, $errors = array(), $httpCode = 0)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
        $this->httpCode = $httpCode;
    }

    /**
     * Retorna os erros detalhados
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Retorna o código HTTP
     *
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }
} 