<?php
/**
 * Testes unitários para HttpClient
 * 
 * @package SicoobSDK\Tests\Unit\Client
 */

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Client\HttpClient;
use SicoobSDK\Exceptions\SicoobException;

class HttpClientTest extends \PHPUnit\Framework\TestCase
{
    private $config;
    private $httpClient;

    protected function setUp(): void
    {
        $this->config = createTestConfig();
        $this->httpClient = new HttpClient($this->config);
    }

    public function testConstructorWithValidConfig()
    {
        $this->assertInstanceOf(HttpClient::class, $this->httpClient);
    }

    public function testConstructorWithInvalidConfig()
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $invalidConfig = new SicoobConfig();
        new HttpClient($invalidConfig);
    }

    public function testGetRequest()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        
        try {
            $response = $this->httpClient->get($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição GET: ' . $e->getMessage());
        }
    }

    public function testPostRequest()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        $data = ['test' => 'data'];
        
        try {
            $response = $this->httpClient->post($url, $data);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição POST: ' . $e->getMessage());
        }
    }

    public function testPutRequest()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/pagadores';
        $data = ['test' => 'data'];
        
        try {
            $response = $this->httpClient->put($url, $data);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição PUT: ' . $e->getMessage());
        }
    }

    public function testPatchRequest()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos/123';
        $data = ['test' => 'data'];
        
        try {
            $response = $this->httpClient->patch($url, $data);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição PATCH: ' . $e->getMessage());
        }
    }

    public function testDeleteRequest()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos/123';
        
        try {
            $response = $this->httpClient->delete($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição DELETE: ' . $e->getMessage());
        }
    }

    public function testRequestWithCustomHeaders()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        $headers = [
            'X-Custom-Header' => 'custom-value',
            'Accept' => 'application/json'
        ];
        
        try {
            $response = $this->httpClient->get($url, $headers);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição com headers customizados: ' . $e->getMessage());
        }
    }

    public function testRequestWithInvalidUrl()
    {
        $this->expectException(SicoobException::class);
        
        $url = 'https://invalid-url-that-does-not-exist.com';
        $this->httpClient->get($url);
    }

    public function testRequestWithTimeout()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Configura timeout baixo para testar
        $this->config->setTimeout(1);
        $httpClient = new HttpClient($this->config);
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        
        try {
            $response = $httpClient->get($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            // Timeout é esperado neste teste
            $this->assertStringContainsString('timeout', strtolower($e->getMessage()));
        }
    }

    public function testRequestWithProxy()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Configura proxy
        $this->config->setUseProxy(true);
        $this->config->setProxyUrl('http://proxy.example.com:8080');
        $this->config->setProxyUser('proxy_user');
        $this->config->setProxyPassword('proxy_password');
        
        $httpClient = new HttpClient($this->config);
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        
        try {
            $response = $httpClient->get($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição com proxy: ' . $e->getMessage());
        }
    }

    public function testAuthenticationFlow()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Testa o fluxo de autenticação
        $authUrl = $this->config->getBaseUrl('auth') . '/token';
        
        try {
            // Simula uma requisição que força a autenticação
            $response = $this->httpClient->get($authUrl);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            // Erro de autenticação é esperado se não houver certificados válidos
            $this->assertStringContainsString('auth', strtolower($e->getMessage()));
        }
    }

    public function testRequestWithCertificate()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Testa requisição com certificado
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        
        try {
            $response = $this->httpClient->get($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição com certificado: ' . $e->getMessage());
        }
    }

    public function testRequestWithCertificatePassword()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Configura senha do certificado
        $this->config->setCertificatePassword('test_password');
        $httpClient = new HttpClient($this->config);
        
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        
        try {
            $response = $httpClient->get($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            $this->fail('Erro na requisição com senha do certificado: ' . $e->getMessage());
        }
    }

    public function testErrorHandling()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Testa tratamento de erros
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/invalid-endpoint';
        
        try {
            $response = $this->httpClient->get($url);
            $this->assertIsArray($response);
        } catch (SicoobException $e) {
            // Erro 404 é esperado
            $this->assertStringContainsString('404', $e->getMessage());
        }
    }

    public function testResponseProcessing()
    {
        $this->markTestSkipped('Teste de integração requer certificados válidos');
        
        // Testa processamento de diferentes tipos de resposta
        $url = 'https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3/boletos';
        
        try {
            $response = $this->httpClient->get($url);
            $this->assertIsArray($response);
            
            // Verifica se a resposta tem a estrutura esperada
            if (isset($response['resultado'])) {
                $this->assertIsArray($response['resultado']);
            }
        } catch (SicoobException $e) {
            $this->fail('Erro no processamento da resposta: ' . $e->getMessage());
        }
    }
} 