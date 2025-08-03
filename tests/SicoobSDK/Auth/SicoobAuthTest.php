<?php

namespace Sicoob\SDK\Tests\Auth;

use PHPUnit\Framework\TestCase;
use Sicoob\SDK\Auth\SicoobAuth;
use Sicoob\SDK\Exceptions\AuthenticationException;

/**
 * Teste para SicoobAuth
 */
class SicoobAuthTest extends TestCase
{
    /**
     * Testa criação de instância sandbox
     */
    public function testSandboxInstance()
    {
        $clientId = 'test-client-id';
        $accessToken = 'test-access-token';

        $auth = SicoobAuth::sandbox($clientId, $accessToken);

        $this->assertInstanceOf(SicoobAuth::class, $auth);
        $this->assertEquals($clientId, $auth->getClientId());
        $this->assertEquals($accessToken, $auth->getAccessToken());
        $this->assertTrue($auth->isSandbox());
        $this->assertStringContainsString('sandbox', $auth->getBaseUrl());
    }

    /**
     * Testa criação de instância produção
     */
    public function testProductionInstance()
    {
        $clientId = 'test-client-id';
        $certificatePath = __FILE__; // Usando este arquivo como certificado para teste

        $auth = SicoobAuth::production($clientId, $certificatePath);

        $this->assertInstanceOf(SicoobAuth::class, $auth);
        $this->assertEquals($clientId, $auth->getClientId());
        $this->assertEquals($certificatePath, $auth->getCertificatePath());
        $this->assertFalse($auth->isSandbox());
        $this->assertStringContainsString('api.sicoob.com.br', $auth->getBaseUrl());
    }

    /**
     * Testa erro quando certificado não existe
     */
    public function testProductionInstanceWithInvalidCertificate()
    {
        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Certificado não encontrado');

        SicoobAuth::production('test-client-id', '/path/to/nonexistent/certificate.pem');
    }

    /**
     * Testa headers de autenticação para sandbox
     */
    public function testAuthHeadersSandbox()
    {
        $auth = SicoobAuth::sandbox('test-client-id', 'test-access-token');
        $headers = $auth->getAuthHeaders();

        $this->assertContains('Content-Type: application/json', $headers);
        $this->assertContains('Accept: application/json', $headers);
        $this->assertContains('client_id: test-client-id', $headers);
        $this->assertContains('Authorization: Bearer test-access-token', $headers);
    }

    /**
     * Testa headers de autenticação para produção sem token
     */
    public function testAuthHeadersProductionWithoutToken()
    {
        $auth = SicoobAuth::production('test-client-id', __FILE__);
        $headers = $auth->getAuthHeaders();

        $this->assertContains('Content-Type: application/json', $headers);
        $this->assertContains('Accept: application/json', $headers);
        $this->assertContains('client_id: test-client-id', $headers);
        $this->assertNotContains('Authorization: Bearer', $headers);
    }

    /**
     * Testa geração de token em sandbox (deve falhar)
     */
    public function testGenerateTokenInSandbox()
    {
        $auth = SicoobAuth::sandbox('test-client-id', 'test-access-token');

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Geração de token não é necessária no sandbox');

        $auth->generateToken();
    }

    /**
     * Testa geração de token em produção sem certificado
     */
    public function testGenerateTokenInProductionWithoutCertificate()
    {
        $auth = new SicoobAuth('test-client-id', false);

        $this->expectException(AuthenticationException::class);
        $this->expectExceptionMessage('Certificado é obrigatório para geração de token');

        $auth->generateToken();
    }
} 