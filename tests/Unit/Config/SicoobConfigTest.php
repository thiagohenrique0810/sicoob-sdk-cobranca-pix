<?php
/**
 * Testes unitários para SicoobConfig
 * 
 * @package SicoobSDK\Tests\Unit\Config
 */

use PHPUnit\Framework\TestCase;
use SicoobSDK\Config\SicoobConfig;

class SicoobConfigTest extends TestCase
{
    private $config;

    protected function setUp(): void
    {
        $this->config = new SicoobConfig();
    }

    public function testConstructorWithEmptyArray()
    {
        $config = new SicoobConfig([]);
        $this->assertInstanceOf(SicoobConfig::class, $config);
        $this->assertEquals('sandbox', $config->getEnvironment());
    }

    public function testConstructorWithConfigArray()
    {
        $configData = [
            'environment' => 'production',
            'client_id' => 'test_client_id',
            'client_secret' => 'test_client_secret',
            'timeout' => 60
        ];

        $config = new SicoobConfig($configData);
        
        $this->assertEquals('production', $config->getEnvironment());
        $this->assertEquals('test_client_id', $config->getClientId());
        $this->assertEquals('test_client_secret', $config->getClientSecret());
        $this->assertEquals(60, $config->getTimeout());
    }

    public function testSetAndGetEnvironment()
    {
        $this->config->setEnvironment('production');
        $this->assertEquals('production', $this->config->getEnvironment());
    }

    public function testSetInvalidEnvironment()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->config->setEnvironment('invalid');
    }

    public function testSetAndGetClientId()
    {
        $this->config->setClientId('test_client_id');
        $this->assertEquals('test_client_id', $this->config->getClientId());
    }

    public function testSetAndGetClientSecret()
    {
        $this->config->setClientSecret('test_client_secret');
        $this->assertEquals('test_client_secret', $this->config->getClientSecret());
    }

    public function testSetAndGetCertificatePath()
    {
        $certPath = __DIR__ . '/../../bootstrap.php';
        $this->config->setCertificatePath($certPath);
        $this->assertEquals($certPath, $this->config->getCertificatePath());
    }

    public function testSetInvalidCertificatePath()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->config->setCertificatePath('/invalid/path/certificate.pem');
    }

    public function testSetAndGetPrivateKeyPath()
    {
        $keyPath = __DIR__ . '/../../bootstrap.php';
        $this->config->setPrivateKeyPath($keyPath);
        $this->assertEquals($keyPath, $this->config->getPrivateKeyPath());
    }

    public function testSetInvalidPrivateKeyPath()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->config->setPrivateKeyPath('/invalid/path/private_key.pem');
    }

    public function testSetAndGetCertificatePassword()
    {
        $this->config->setCertificatePassword('test_password');
        $this->assertEquals('test_password', $this->config->getCertificatePassword());
    }

    public function testSetAndGetTimeout()
    {
        $this->config->setTimeout(45);
        $this->assertEquals(45, $this->config->getTimeout());
    }

    public function testSetAndGetProxySettings()
    {
        $this->config->setUseProxy(true);
        $this->config->setProxyUrl('http://proxy.example.com:8080');
        $this->config->setProxyUser('proxy_user');
        $this->config->setProxyPassword('proxy_password');

        $this->assertTrue($this->config->getUseProxy());
        $this->assertEquals('http://proxy.example.com:8080', $this->config->getProxyUrl());
        $this->assertEquals('proxy_user', $this->config->getProxyUser());
        $this->assertEquals('proxy_password', $this->config->getProxyPassword());
    }

    public function testGetBaseUrl()
    {
        $this->config->setEnvironment('sandbox');
        
        $cobrancaUrl = $this->config->getBaseUrl('cobranca');
        $this->assertEquals('https://sandbox.sicoob.com.br/sicoob/sandbox/cobranca-bancaria/v3', $cobrancaUrl);
        
        $pixUrl = $this->config->getBaseUrl('pix');
        $this->assertEquals('https://sandbox.sicoob.com.br/sicoob/sandbox/pix/api/v2', $pixUrl);
        
        $authUrl = $this->config->getBaseUrl('auth');
        $this->assertEquals('https://sandbox.sicoob.com.br/sicoob/sandbox/oauth2', $authUrl);
    }

    public function testGetBaseUrlWithInvalidService()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->config->getBaseUrl('invalid_service');
    }

    public function testGetBaseUrls()
    {
        $this->config->setEnvironment('production');
        $urls = $this->config->getBaseUrls();
        
        $this->assertIsArray($urls);
        $this->assertArrayHasKey('cobranca', $urls);
        $this->assertArrayHasKey('pix', $urls);
        $this->assertArrayHasKey('auth', $urls);
    }

    public function testValidateWithMissingRequiredFields()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->config->validate();
    }

    public function testValidateWithValidConfiguration()
    {
        $this->config->setClientId('test_client_id');
        $this->config->setClientSecret('test_client_secret');
        $this->config->setCertificatePath(__DIR__ . '/../../bootstrap.php');
        $this->config->setPrivateKeyPath(__DIR__ . '/../../bootstrap.php');
        
        $this->assertTrue($this->config->validate());
    }

    public function testLoadFromArray()
    {
        $configData = [
            'environment' => 'production',
            'client_id' => 'test_client_id',
            'client_secret' => 'test_client_secret',
            'timeout' => 60,
            'use_proxy' => true,
            'proxy_url' => 'http://proxy.example.com:8080'
        ];

        $this->config->loadFromArray($configData);
        
        $this->assertEquals('production', $this->config->getEnvironment());
        $this->assertEquals('test_client_id', $this->config->getClientId());
        $this->assertEquals('test_client_secret', $this->config->getClientSecret());
        $this->assertEquals(60, $this->config->getTimeout());
        $this->assertTrue($this->config->getUseProxy());
        $this->assertEquals('http://proxy.example.com:8080', $this->config->getProxyUrl());
    }
} 