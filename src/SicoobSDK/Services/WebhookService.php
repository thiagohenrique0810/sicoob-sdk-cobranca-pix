<?php
/**
 * Serviço de Webhook do SDK Sicoob
 * 
 * Classe responsável por gerenciar webhooks para notificações
 * de eventos da API de cobrança bancária.
 * 
 * @package SicoobSDK\Services
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Services;

use SicoobSDK\Config\SicoobConfig;
use SicoobSDK\Client\HttpClient;
use SicoobSDK\Exceptions\SicoobException;

class WebhookService
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
     * Cadastra um webhook para receber notificações
     * 
     * @param string $url URL do webhook
     * @param int $codigoTipoMovimento Código do tipo de movimento
     * @param int $codigoPeriodoMovimento Código do período de movimento
     * @param string $email Email associado ao webhook
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function cadastrarWebhook($url, $codigoTipoMovimento, $codigoPeriodoMovimento, $email = null)
    {
        $data = [
            'url' => $url,
            'codigoTipoMovimento' => $codigoTipoMovimento,
            'codigoPeriodoMovimento' => $codigoPeriodoMovimento
        ];
        
        if ($email) {
            $data['email'] = $email;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/webhooks';
        
        try {
            $response = $this->httpClient->post($url, $data);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao cadastrar webhook: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Consulta os webhooks cadastrados
     * 
     * @param int $idWebhook ID do webhook (opcional)
     * @param int $codigoTipoMovimento Código do tipo de movimento (opcional)
     * @return array Lista de webhooks
     * @throws SicoobException
     */
    public function consultarWebhooks($idWebhook = null, $codigoTipoMovimento = null)
    {
        $params = [];
        
        if ($idWebhook) {
            $params['idWebhook'] = $idWebhook;
        }
        
        if ($codigoTipoMovimento) {
            $params['codigoTipoMovimento'] = $codigoTipoMovimento;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . '/webhooks';
        
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao consultar webhooks: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Atualiza um webhook cadastrado
     * 
     * @param int $idWebhook ID do webhook
     * @param string $url Nova URL do webhook
     * @param string $email Novo email (opcional)
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function atualizarWebhook($idWebhook, $url, $email = null)
    {
        $data = ['url' => $url];
        
        if ($email) {
            $data['email'] = $email;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . "/webhooks/{$idWebhook}";
        
        try {
            $response = $this->httpClient->patch($url, $data);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao atualizar webhook: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Exclui um webhook
     * 
     * @param int $idWebhook ID do webhook
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function excluirWebhook($idWebhook)
    {
        $url = $this->config->getBaseUrl('cobranca') . "/webhooks/{$idWebhook}";
        
        try {
            $response = $this->httpClient->delete($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao excluir webhook: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Reativa um webhook inativo
     * 
     * @param int $idWebhook ID do webhook
     * @return array Resposta da API
     * @throws SicoobException
     */
    public function reativarWebhook($idWebhook)
    {
        $url = $this->config->getBaseUrl('cobranca') . "/webhooks/{$idWebhook}/reativar";
        
        try {
            $response = $this->httpClient->patch($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao reativar webhook: ' . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * Consulta as solicitações de um webhook
     * 
     * @param int $idWebhook ID do webhook
     * @param string $dataSolicitacao Data da solicitação (YYYY-MM-DD)
     * @param int $pagina Número da página (opcional)
     * @param int $codigoSolicitacaoSituacao Código da situação da solicitação (opcional)
     * @return array Lista de solicitações
     * @throws SicoobException
     */
    public function consultarSolicitacoesWebhook($idWebhook, $dataSolicitacao, $pagina = null, $codigoSolicitacaoSituacao = null)
    {
        $params = ['dataSolicitacao' => $dataSolicitacao];
        
        if ($pagina) {
            $params['pagina'] = $pagina;
        }
        
        if ($codigoSolicitacaoSituacao) {
            $params['codigoSolicitacaoSituacao'] = $codigoSolicitacaoSituacao;
        }
        
        $url = $this->config->getBaseUrl('cobranca') . "/webhooks/{$idWebhook}/solicitacoes?" . http_build_query($params);
        
        try {
            $response = $this->httpClient->get($url);
            return $response;
        } catch (SicoobException $e) {
            throw new SicoobException('Erro ao consultar solicitações do webhook: ' . $e->getMessage(), 0, $e);
        }
    }
} 