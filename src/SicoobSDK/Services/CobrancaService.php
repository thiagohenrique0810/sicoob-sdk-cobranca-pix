<?php
/**
 * Serviço de Cobrança do SDK Sicoob
 * 
 * Classe responsável por gerenciar operações de cobrança bancária,
 * incluindo inclusão, consulta e baixa de boletos.
 * 
 * @package SicoobSDK\Services
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Services;

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Client\HttpClient;
use SicoobSDK\Models\Boleto;
use SicoobSDK\Exceptions\SicoobException;
use SicoobSDK\Exceptions\ValidationException;

class CobrancaService
{
    /**
     * @var SicoobConfig Configuração do SDK
     */
    private $config;
    
    /**
     * @var HttpClient Cliente HTTP
     */
    private $httpClient;
    
    /**
     * Construtor da classe
     * 
     * @param SicoobConfig $config Configuração do SDK
     */
    public function __construct(SicoobConfig $config)
    {
        $this->config = $config;
        $this->config->validate();
        $this->httpClient = new HttpClient($config);
    }
    
    /**
     * Inclui um novo boleto
     * 
     * @param Boleto $boleto Dados do boleto
     * @return array Resposta da API
     * @throws SicoobException
     * @throws ValidationException
     */
    public function incluirBoleto(Boleto $boleto)
    {
        // Valida os dados do boleto
        $boleto->validate();
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos';
        $data = ['boleto' => $boleto->toArray()];
        
        try {
            $response = $this->httpClient->post($url, $data);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao incluir boleto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Consulta um boleto pelo nosso número
     * 
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @param int $nossoNumero Nosso número
     * @param int $numeroContratoCobranca Número do contrato de cobrança (opcional)
     * @return array Dados do boleto
     * @throws SicoobException
     */
    public function consultarBoletoPorNossoNumero($numeroCliente, $codigoModalidade, $nossoNumero, $numeroContratoCobranca = null)
    {
        $params = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade,
            'nossoNumero' => $nossoNumero
        ];
        
        if ($numeroContratoCobranca) {
            $params['numeroContratoCobranca'] = $numeroContratoCobranca;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos?' . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao consultar boleto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Consulta um boleto pela linha digitável
     * 
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @param string $linhaDigitavel Linha digitável do boleto
     * @param int $numeroContratoCobranca Número do contrato de cobrança (opcional)
     * @return array Dados do boleto
     * @throws SicoobException
     */
    public function consultarBoletoPorLinhaDigitavel($numeroCliente, $codigoModalidade, $linhaDigitavel, $numeroContratoCobranca = null)
    {
        $params = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade,
            'linhaDigitavel' => $linhaDigitavel
        ];
        
        if ($numeroContratoCobranca) {
            $params['numeroContratoCobranca'] = $numeroContratoCobranca;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos?' . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao consultar boleto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Consulta um boleto pelo código de barras
     * 
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @param string $codigoBarras Código de barras do boleto
     * @param int $numeroContratoCobranca Número do contrato de cobrança (opcional)
     * @return array Dados do boleto
     * @throws SicoobException
     */
    public function consultarBoletoPorCodigoBarras($numeroCliente, $codigoModalidade, $codigoBarras, $numeroContratoCobranca = null)
    {
        $params = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade,
            'codigoBarras' => $codigoBarras
        ];
        
        if ($numeroContratoCobranca) {
            $params['numeroContratoCobranca'] = $numeroContratoCobranca;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos?' . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao consultar boleto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Lista boletos por pagador
     * 
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @param string $numeroCpfCnpjPagador CPF/CNPJ do pagador
     * @param int $numeroContratoCobranca Número do contrato de cobrança (opcional)
     * @return array Lista de boletos
     * @throws SicoobException
     */
    public function listarBoletosPorPagador($numeroCliente, $codigoModalidade, $numeroCpfCnpjPagador, $numeroContratoCobranca = null)
    {
        $params = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade,
            'numeroCpfCnpjPagador' => $numeroCpfCnpjPagador
        ];
        
        if ($numeroContratoCobranca) {
            $params['numeroContratoCobranca'] = $numeroContratoCobranca;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/pagador?' . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao listar boletos por pagador: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Emite segunda via de um boleto
     * 
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @param int $nossoNumero Nosso número
     * @param int $numeroContratoCobranca Número do contrato de cobrança (opcional)
     * @return array Dados do boleto com PDF
     * @throws SicoobException
     */
    public function emitirSegundaVia($numeroCliente, $codigoModalidade, $nossoNumero, $numeroContratoCobranca = null)
    {
        $params = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade,
            'nossoNumero' => $nossoNumero
        ];
        
        if ($numeroContratoCobranca) {
            $params['numeroContratoCobranca'] = $numeroContratoCobranca;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/segunda-via?' . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao emitir segunda via: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Consulta faixas de nosso número disponíveis
     * 
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @param int $numeroContratoCobranca Número do contrato de cobrança (opcional)
     * @return array Faixas disponíveis
     * @throws SicoobException
     */
    public function consultarFaixasNossoNumero($numeroCliente, $codigoModalidade, $numeroContratoCobranca = null)
    {
        $params = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade
        ];
        
        if ($numeroContratoCobranca) {
            $params['numeroContratoCobranca'] = $numeroContratoCobranca;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/faixas-nosso-numero?' . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao consultar faixas de nosso número: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Altera informações de um boleto
     * 
     * @param Boleto $boleto Dados atualizados do boleto
     * @return array Resposta da API
     * @throws SicoobException
     * @throws ValidationException
     */
    public function alterarBoleto($nossoNumero, array $dadosAlteracao)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/' . $nossoNumero;
        
        try {
            $response = $this->httpClient->patch($url, $dadosAlteracao);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao alterar boleto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Dá baixa em um boleto
     * 
     * @param int $nossoNumero Nosso número do boleto
     * @param int $numeroCliente Número do cliente
     * @param int $codigoModalidade Código da modalidade
     * @return bool Sucesso da operação
     * @throws SicoobException
     */
    public function darBaixaBoleto($nossoNumero, $numeroCliente, $codigoModalidade)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/' . $nossoNumero . '/baixar';
        $data = [
            'numeroCliente' => $numeroCliente,
            'codigoModalidade' => $codigoModalidade
        ];
        
        try {
            $response = $this->httpClient->post($url, $data);
            return true; // Se chegou aqui, a operação foi bem-sucedida
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao dar baixa no boleto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Altera informações do pagador
     * 
     * @param array $dadosPagador Dados atualizados do pagador
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function alterarPagador(array $dadosPagador)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/pagadores';
        
        try {
            $response = $this->httpClient->put($url, $dadosPagador);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao alterar pagador: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Inclui pagador na negativação
     * 
     * @param array $dadosNegativacao Dados da negativação
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function incluirNegativacao(array $dadosNegativacao)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/negativacoes';
        
        try {
            $response = $this->httpClient->post($url, $dadosNegativacao);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao incluir negativação: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Altera negativação
     * 
     * @param array $dadosNegativacao Dados atualizados da negativação
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function alterarNegativacao(array $dadosNegativacao)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/negativacoes';
        
        try {
            $response = $this->httpClient->put($url, $dadosNegativacao);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao alterar negativação: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Baixa negativação
     * 
     * @param array $dadosNegativacao Dados da negativação para baixa
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function baixarNegativacao(array $dadosNegativacao)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/negativacoes/baixar';
        
        try {
            $response = $this->httpClient->post($url, $dadosNegativacao);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao baixar negativação: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Inclui protesto
     * 
     * @param array $dadosProtesto Dados do protesto
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function incluirProtesto(array $dadosProtesto)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/protestos';
        
        try {
            $response = $this->httpClient->post($url, $dadosProtesto);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao incluir protesto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Altera protesto
     * 
     * @param array $dadosProtesto Dados atualizados do protesto
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function alterarProtesto(array $dadosProtesto)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/protestos';
        
        try {
            $response = $this->httpClient->put($url, $dadosProtesto);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao alterar protesto: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Baixa protesto
     * 
     * @param array $dadosProtesto Dados do protesto para baixa
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function baixarProtesto(array $dadosProtesto)
    {
        $url = $this->config->getBaseUrl('cobranca') . '/boletos/protestos/baixar';
        
        try {
            $response = $this->httpClient->post($url, $dadosProtesto);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao baixar protesto: ' . $e->getMessage(), 0, $e);
        }
    }
} 