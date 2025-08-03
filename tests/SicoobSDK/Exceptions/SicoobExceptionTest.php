<?php

namespace Sicoob\SDK\Tests\Exceptions;

use PHPUnit\Framework\TestCase;
use Sicoob\SDK\Exceptions\SicoobException;

/**
 * Teste para SicoobException
 */
class SicoobExceptionTest extends TestCase
{
    /**
     * Testa o construtor da exceção
     */
    public function testConstructor()
    {
        $message = 'Erro de teste';
        $code = 500;
        $errors = array('erro1', 'erro2');
        $httpCode = 400;

        $exception = new SicoobException($message, $code, null, $errors, $httpCode);

        $this->assertEquals($message, $exception->getMessage());
        $this->assertEquals($code, $exception->getCode());
        $this->assertEquals($errors, $exception->getErrors());
        $this->assertEquals($httpCode, $exception->getHttpCode());
    }

    /**
     * Testa getters com valores padrão
     */
    public function testDefaultValues()
    {
        $exception = new SicoobException();

        $this->assertEquals('', $exception->getMessage());
        $this->assertEquals(0, $exception->getCode());
        $this->assertEquals(array(), $exception->getErrors());
        $this->assertEquals(0, $exception->getHttpCode());
    }

    /**
     * Testa herança de Exception
     */
    public function testInheritance()
    {
        $exception = new SicoobException('Teste');
        
        $this->assertInstanceOf('\Exception', $exception);
    }
} 