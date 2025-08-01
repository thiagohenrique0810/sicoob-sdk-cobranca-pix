<?php
/**
 * Modelo Boleto do SDK Sicoob
 * 
 * Classe que representa os dados de um boleto bancário
 * 
 * @package SicoobSDK\Models
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Models;

use SicoobSDK\Exceptions\ValidationException;

class Boleto
{
    /**
     * @var int Número do cliente
     */
    private $numeroCliente;
    
    /**
     * @var int Código da modalidade
     */
    private $codigoModalidade;
    
    /**
     * @var int Número da conta corrente
     */
    private $numeroContaCorrente;
    
    /**
     * @var string Código da espécie do documento
     */
    private $codigoEspecieDocumento;
    
    /**
     * @var string Data de emissão (YYYY-MM-DD)
     */
    private $dataEmissao;
    
    /**
     * @var int Nosso número
     */
    private $nossoNumero;
    
    /**
     * @var string Seu número
     */
    private $seuNumero;
    
    /**
     * @var string Identificação do boleto na empresa
     */
    private $identificacaoBoletoEmpresa;
    
    /**
     * @var int Identificação da emissão do boleto
     */
    private $identificacaoEmissaoBoleto;
    
    /**
     * @var int Identificação da distribuição do boleto
     */
    private $identificacaoDistribuicaoBoleto;
    
    /**
     * @var float Valor do boleto
     */
    private $valor;
    
    /**
     * @var string Data de vencimento (YYYY-MM-DD)
     */
    private $dataVencimento;
    
    /**
     * @var string Data limite de pagamento (YYYY-MM-DD)
     */
    private $dataLimitePagamento;
    
    /**
     * @var float Valor do abatimento
     */
    private $valorAbatimento;
    
    /**
     * @var int Tipo de desconto
     */
    private $tipoDesconto;
    
    /**
     * @var string Data do primeiro desconto (YYYY-MM-DD)
     */
    private $dataPrimeiroDesconto;
    
    /**
     * @var float Valor do primeiro desconto
     */
    private $valorPrimeiroDesconto;
    
    /**
     * @var string Data do segundo desconto (YYYY-MM-DD)
     */
    private $dataSegundoDesconto;
    
    /**
     * @var float Valor do segundo desconto
     */
    private $valorSegundoDesconto;
    
    /**
     * @var string Data do terceiro desconto (YYYY-MM-DD)
     */
    private $dataTerceiroDesconto;
    
    /**
     * @var float Valor do terceiro desconto
     */
    private $valorTerceiroDesconto;
    
    /**
     * @var int Tipo de multa
     */
    private $tipoMulta;
    
    /**
     * @var string Data da multa (YYYY-MM-DD)
     */
    private $dataMulta;
    
    /**
     * @var float Valor da multa
     */
    private $valorMulta;
    
    /**
     * @var int Tipo de juros de mora
     */
    private $tipoJurosMora;
    
    /**
     * @var string Data dos juros de mora (YYYY-MM-DD)
     */
    private $dataJurosMora;
    
    /**
     * @var float Valor dos juros de mora
     */
    private $valorJurosMora;
    
    /**
     * @var int Número da parcela
     */
    private $numeroParcela;
    
    /**
     * @var bool Aceite
     */
    private $aceite;
    
    /**
     * @var int Código de negativação
     */
    private $codigoNegativacao;
    
    /**
     * @var int Número de dias para negativação
     */
    private $numeroDiasNegativacao;
    
    /**
     * @var int Código de protesto
     */
    private $codigoProtesto;
    
    /**
     * @var int Número de dias para protesto
     */
    private $numeroDiasProtesto;
    
    /**
     * @var Pagador Dados do pagador
     */
    private $pagador;
    
    /**
     * @var array Dados do beneficiário final
     */
    private $beneficiarioFinal;
    
    /**
     * @var array Mensagens de instrução
     */
    private $mensagensInstrucao;
    
    /**
     * @var bool Se deve gerar PDF
     */
    private $gerarPdf;
    
    /**
     * @var array Rateio de créditos
     */
    private $rateioCreditos;
    
    /**
     * @var int Código para cadastrar PIX
     */
    private $codigoCadastrarPIX;
    
    /**
     * @var int Número do contrato de cobrança
     */
    private $numeroContratoCobranca;
    
    /**
     * Construtor da classe
     * 
     * @param array $data Dados do boleto
     */
    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->loadFromArray($data);
        }
    }
    
    /**
     * Carrega dados a partir de um array
     * 
     * @param array $data Dados do boleto
     * @return void
     */
    public function loadFromArray(array $data)
    {
        if (isset($data['numeroCliente'])) {
            $this->setNumeroCliente($data['numeroCliente']);
        }
        
        if (isset($data['codigoModalidade'])) {
            $this->setCodigoModalidade($data['codigoModalidade']);
        }
        
        if (isset($data['numeroContaCorrente'])) {
            $this->setNumeroContaCorrente($data['numeroContaCorrente']);
        }
        
        if (isset($data['codigoEspecieDocumento'])) {
            $this->setCodigoEspecieDocumento($data['codigoEspecieDocumento']);
        }
        
        if (isset($data['dataEmissao'])) {
            $this->setDataEmissao($data['dataEmissao']);
        }
        
        if (isset($data['nossoNumero'])) {
            $this->setNossoNumero($data['nossoNumero']);
        }
        
        if (isset($data['seuNumero'])) {
            $this->setSeuNumero($data['seuNumero']);
        }
        
        if (isset($data['identificacaoBoletoEmpresa'])) {
            $this->setIdentificacaoBoletoEmpresa($data['identificacaoBoletoEmpresa']);
        }
        
        if (isset($data['identificacaoEmissaoBoleto'])) {
            $this->setIdentificacaoEmissaoBoleto($data['identificacaoEmissaoBoleto']);
        }
        
        if (isset($data['identificacaoDistribuicaoBoleto'])) {
            $this->setIdentificacaoDistribuicaoBoleto($data['identificacaoDistribuicaoBoleto']);
        }
        
        if (isset($data['valor'])) {
            $this->setValor($data['valor']);
        }
        
        if (isset($data['dataVencimento'])) {
            $this->setDataVencimento($data['dataVencimento']);
        }
        
        if (isset($data['dataLimitePagamento'])) {
            $this->setDataLimitePagamento($data['dataLimitePagamento']);
        }
        
        if (isset($data['valorAbatimento'])) {
            $this->setValorAbatimento($data['valorAbatimento']);
        }
        
        if (isset($data['tipoDesconto'])) {
            $this->setTipoDesconto($data['tipoDesconto']);
        }
        
        if (isset($data['dataPrimeiroDesconto'])) {
            $this->setDataPrimeiroDesconto($data['dataPrimeiroDesconto']);
        }
        
        if (isset($data['valorPrimeiroDesconto'])) {
            $this->setValorPrimeiroDesconto($data['valorPrimeiroDesconto']);
        }
        
        if (isset($data['dataSegundoDesconto'])) {
            $this->setDataSegundoDesconto($data['dataSegundoDesconto']);
        }
        
        if (isset($data['valorSegundoDesconto'])) {
            $this->setValorSegundoDesconto($data['valorSegundoDesconto']);
        }
        
        if (isset($data['dataTerceiroDesconto'])) {
            $this->setDataTerceiroDesconto($data['dataTerceiroDesconto']);
        }
        
        if (isset($data['valorTerceiroDesconto'])) {
            $this->setValorTerceiroDesconto($data['valorTerceiroDesconto']);
        }
        
        if (isset($data['tipoMulta'])) {
            $this->setTipoMulta($data['tipoMulta']);
        }
        
        if (isset($data['dataMulta'])) {
            $this->setDataMulta($data['dataMulta']);
        }
        
        if (isset($data['valorMulta'])) {
            $this->setValorMulta($data['valorMulta']);
        }
        
        if (isset($data['tipoJurosMora'])) {
            $this->setTipoJurosMora($data['tipoJurosMora']);
        }
        
        if (isset($data['dataJurosMora'])) {
            $this->setDataJurosMora($data['dataJurosMora']);
        }
        
        if (isset($data['valorJurosMora'])) {
            $this->setValorJurosMora($data['valorJurosMora']);
        }
        
        if (isset($data['numeroParcela'])) {
            $this->setNumeroParcela($data['numeroParcela']);
        }
        
        if (isset($data['aceite'])) {
            $this->setAceite($data['aceite']);
        }
        
        if (isset($data['codigoNegativacao'])) {
            $this->setCodigoNegativacao($data['codigoNegativacao']);
        }
        
        if (isset($data['numeroDiasNegativacao'])) {
            $this->setNumeroDiasNegativacao($data['numeroDiasNegativacao']);
        }
        
        if (isset($data['codigoProtesto'])) {
            $this->setCodigoProtesto($data['codigoProtesto']);
        }
        
        if (isset($data['numeroDiasProtesto'])) {
            $this->setNumeroDiasProtesto($data['numeroDiasProtesto']);
        }
        
        if (isset($data['pagador'])) {
            if ($data['pagador'] instanceof Pagador) {
                $this->setPagador($data['pagador']);
            } else {
                $this->setPagador(new Pagador($data['pagador']));
            }
        }
        
        if (isset($data['beneficiarioFinal'])) {
            $this->setBeneficiarioFinal($data['beneficiarioFinal']);
        }
        
        if (isset($data['mensagensInstrucao'])) {
            $this->setMensagensInstrucao($data['mensagensInstrucao']);
        }
        
        if (isset($data['gerarPdf'])) {
            $this->setGerarPdf($data['gerarPdf']);
        }
        
        if (isset($data['rateioCreditos'])) {
            $this->setRateioCreditos($data['rateioCreditos']);
        }
        
        if (isset($data['codigoCadastrarPIX'])) {
            $this->setCodigoCadastrarPIX($data['codigoCadastrarPIX']);
        }
        
        if (isset($data['numeroContratoCobranca'])) {
            $this->setNumeroContratoCobranca($data['numeroContratoCobranca']);
        }
    }
    
    // Getters e Setters para todos os campos
    
    public function setNumeroCliente($numeroCliente)
    {
        $this->numeroCliente = (int) $numeroCliente;
        return $this;
    }
    
    public function getNumeroCliente()
    {
        return $this->numeroCliente;
    }
    
    public function setCodigoModalidade($codigoModalidade)
    {
        $this->codigoModalidade = (int) $codigoModalidade;
        return $this;
    }
    
    public function getCodigoModalidade()
    {
        return $this->codigoModalidade;
    }
    
    public function setNumeroContaCorrente($numeroContaCorrente)
    {
        $this->numeroContaCorrente = (int) $numeroContaCorrente;
        return $this;
    }
    
    public function getNumeroContaCorrente()
    {
        return $this->numeroContaCorrente;
    }
    
    public function setCodigoEspecieDocumento($codigoEspecieDocumento)
    {
        $this->codigoEspecieDocumento = $codigoEspecieDocumento;
        return $this;
    }
    
    public function getCodigoEspecieDocumento()
    {
        return $this->codigoEspecieDocumento;
    }
    
    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;
        return $this;
    }
    
    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }
    
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = (int) $nossoNumero;
        return $this;
    }
    
    public function getNossoNumero()
    {
        return $this->nossoNumero;
    }
    
    public function setSeuNumero($seuNumero)
    {
        $this->seuNumero = $seuNumero;
        return $this;
    }
    
    public function getSeuNumero()
    {
        return $this->seuNumero;
    }
    
    public function setIdentificacaoBoletoEmpresa($identificacaoBoletoEmpresa)
    {
        $this->identificacaoBoletoEmpresa = $identificacaoBoletoEmpresa;
        return $this;
    }
    
    public function getIdentificacaoBoletoEmpresa()
    {
        return $this->identificacaoBoletoEmpresa;
    }
    
    public function setIdentificacaoEmissaoBoleto($identificacaoEmissaoBoleto)
    {
        $this->identificacaoEmissaoBoleto = (int) $identificacaoEmissaoBoleto;
        return $this;
    }
    
    public function getIdentificacaoEmissaoBoleto()
    {
        return $this->identificacaoEmissaoBoleto;
    }
    
    public function setIdentificacaoDistribuicaoBoleto($identificacaoDistribuicaoBoleto)
    {
        $this->identificacaoDistribuicaoBoleto = (int) $identificacaoDistribuicaoBoleto;
        return $this;
    }
    
    public function getIdentificacaoDistribuicaoBoleto()
    {
        return $this->identificacaoDistribuicaoBoleto;
    }
    
    public function setValor($valor)
    {
        $this->valor = (float) $valor;
        return $this;
    }
    
    public function getValor()
    {
        return $this->valor;
    }
    
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;
        return $this;
    }
    
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }
    
    public function setDataLimitePagamento($dataLimitePagamento)
    {
        $this->dataLimitePagamento = $dataLimitePagamento;
        return $this;
    }
    
    public function getDataLimitePagamento()
    {
        return $this->dataLimitePagamento;
    }
    
    public function setValorAbatimento($valorAbatimento)
    {
        $this->valorAbatimento = (float) $valorAbatimento;
        return $this;
    }
    
    public function getValorAbatimento()
    {
        return $this->valorAbatimento;
    }
    
    public function setTipoDesconto($tipoDesconto)
    {
        $this->tipoDesconto = (int) $tipoDesconto;
        return $this;
    }
    
    public function getTipoDesconto()
    {
        return $this->tipoDesconto;
    }
    
    public function setDataPrimeiroDesconto($dataPrimeiroDesconto)
    {
        $this->dataPrimeiroDesconto = $dataPrimeiroDesconto;
        return $this;
    }
    
    public function getDataPrimeiroDesconto()
    {
        return $this->dataPrimeiroDesconto;
    }
    
    public function setValorPrimeiroDesconto($valorPrimeiroDesconto)
    {
        $this->valorPrimeiroDesconto = (float) $valorPrimeiroDesconto;
        return $this;
    }
    
    public function getValorPrimeiroDesconto()
    {
        return $this->valorPrimeiroDesconto;
    }
    
    public function setDataSegundoDesconto($dataSegundoDesconto)
    {
        $this->dataSegundoDesconto = $dataSegundoDesconto;
        return $this;
    }
    
    public function getDataSegundoDesconto()
    {
        return $this->dataSegundoDesconto;
    }
    
    public function setValorSegundoDesconto($valorSegundoDesconto)
    {
        $this->valorSegundoDesconto = (float) $valorSegundoDesconto;
        return $this;
    }
    
    public function getValorSegundoDesconto()
    {
        return $this->valorSegundoDesconto;
    }
    
    public function setDataTerceiroDesconto($dataTerceiroDesconto)
    {
        $this->dataTerceiroDesconto = $dataTerceiroDesconto;
        return $this;
    }
    
    public function getDataTerceiroDesconto()
    {
        return $this->dataTerceiroDesconto;
    }
    
    public function setValorTerceiroDesconto($valorTerceiroDesconto)
    {
        $this->valorTerceiroDesconto = (float) $valorTerceiroDesconto;
        return $this;
    }
    
    public function getValorTerceiroDesconto()
    {
        return $this->valorTerceiroDesconto;
    }
    
    public function setTipoMulta($tipoMulta)
    {
        $this->tipoMulta = (int) $tipoMulta;
        return $this;
    }
    
    public function getTipoMulta()
    {
        return $this->tipoMulta;
    }
    
    public function setDataMulta($dataMulta)
    {
        $this->dataMulta = $dataMulta;
        return $this;
    }
    
    public function getDataMulta()
    {
        return $this->dataMulta;
    }
    
    public function setValorMulta($valorMulta)
    {
        $this->valorMulta = (float) $valorMulta;
        return $this;
    }
    
    public function getValorMulta()
    {
        return $this->valorMulta;
    }
    
    public function setTipoJurosMora($tipoJurosMora)
    {
        $this->tipoJurosMora = (int) $tipoJurosMora;
        return $this;
    }
    
    public function getTipoJurosMora()
    {
        return $this->tipoJurosMora;
    }
    
    public function setDataJurosMora($dataJurosMora)
    {
        $this->dataJurosMora = $dataJurosMora;
        return $this;
    }
    
    public function getDataJurosMora()
    {
        return $this->dataJurosMora;
    }
    
    public function setValorJurosMora($valorJurosMora)
    {
        $this->valorJurosMora = (float) $valorJurosMora;
        return $this;
    }
    
    public function getValorJurosMora()
    {
        return $this->valorJurosMora;
    }
    
    public function setNumeroParcela($numeroParcela)
    {
        $this->numeroParcela = (int) $numeroParcela;
        return $this;
    }
    
    public function getNumeroParcela()
    {
        return $this->numeroParcela;
    }
    
    public function setAceite($aceite)
    {
        $this->aceite = (bool) $aceite;
        return $this;
    }
    
    public function getAceite()
    {
        return $this->aceite;
    }
    
    public function setCodigoNegativacao($codigoNegativacao)
    {
        $this->codigoNegativacao = (int) $codigoNegativacao;
        return $this;
    }
    
    public function getCodigoNegativacao()
    {
        return $this->codigoNegativacao;
    }
    
    public function setNumeroDiasNegativacao($numeroDiasNegativacao)
    {
        $this->numeroDiasNegativacao = (int) $numeroDiasNegativacao;
        return $this;
    }
    
    public function getNumeroDiasNegativacao()
    {
        return $this->numeroDiasNegativacao;
    }
    
    public function setCodigoProtesto($codigoProtesto)
    {
        $this->codigoProtesto = (int) $codigoProtesto;
        return $this;
    }
    
    public function getCodigoProtesto()
    {
        return $this->codigoProtesto;
    }
    
    public function setNumeroDiasProtesto($numeroDiasProtesto)
    {
        $this->numeroDiasProtesto = (int) $numeroDiasProtesto;
        return $this;
    }
    
    public function getNumeroDiasProtesto()
    {
        return $this->numeroDiasProtesto;
    }
    
    public function setPagador(Pagador $pagador)
    {
        $this->pagador = $pagador;
        return $this;
    }
    
    public function getPagador()
    {
        return $this->pagador;
    }
    
    public function setBeneficiarioFinal(array $beneficiarioFinal)
    {
        $this->beneficiarioFinal = $beneficiarioFinal;
        return $this;
    }
    
    public function getBeneficiarioFinal()
    {
        return $this->beneficiarioFinal;
    }
    
    public function setMensagensInstrucao(array $mensagensInstrucao)
    {
        $this->mensagensInstrucao = $mensagensInstrucao;
        return $this;
    }
    
    public function getMensagensInstrucao()
    {
        return $this->mensagensInstrucao;
    }
    
    public function setGerarPdf($gerarPdf)
    {
        $this->gerarPdf = (bool) $gerarPdf;
        return $this;
    }
    
    public function getGerarPdf()
    {
        return $this->gerarPdf;
    }
    
    public function setRateioCreditos(array $rateioCreditos)
    {
        $this->rateioCreditos = $rateioCreditos;
        return $this;
    }
    
    public function getRateioCreditos()
    {
        return $this->rateioCreditos;
    }
    
    public function setCodigoCadastrarPIX($codigoCadastrarPIX)
    {
        $this->codigoCadastrarPIX = (int) $codigoCadastrarPIX;
        return $this;
    }
    
    public function getCodigoCadastrarPIX()
    {
        return $this->codigoCadastrarPIX;
    }
    
    public function setNumeroContratoCobranca($numeroContratoCobranca)
    {
        $this->numeroContratoCobranca = (int) $numeroContratoCobranca;
        return $this;
    }
    
    public function getNumeroContratoCobranca()
    {
        return $this->numeroContratoCobranca;
    }
    
    /**
     * Valida os dados do boleto
     * 
     * @return bool
     * @throws ValidationException
     */
    public function validate()
    {
        $errors = [];
        
        // Campos obrigatórios
        if (empty($this->numeroCliente)) {
            $errors['numeroCliente'] = 'Número do cliente é obrigatório';
        }
        
        if (empty($this->codigoModalidade)) {
            $errors['codigoModalidade'] = 'Código da modalidade é obrigatório';
        }
        
        if (empty($this->dataEmissao)) {
            $errors['dataEmissao'] = 'Data de emissão é obrigatória';
        } elseif (!$this->validarData($this->dataEmissao)) {
            $errors['dataEmissao'] = 'Data de emissão inválida';
        }
        
        if (empty($this->valor)) {
            $errors['valor'] = 'Valor é obrigatório';
        } elseif ($this->valor <= 0) {
            $errors['valor'] = 'Valor deve ser maior que zero';
        }
        
        if (empty($this->dataVencimento)) {
            $errors['dataVencimento'] = 'Data de vencimento é obrigatória';
        } elseif (!$this->validarData($this->dataVencimento)) {
            $errors['dataVencimento'] = 'Data de vencimento inválida';
        }
        
        if (empty($this->pagador)) {
            $errors['pagador'] = 'Dados do pagador são obrigatórios';
        } else {
            try {
                $this->pagador->validate();
            } catch (ValidationException $e) {
                $errors['pagador'] = $e->getMessage();
            }
        }
        
        // Validações de datas
        if (!empty($this->dataLimitePagamento) && !$this->validarData($this->dataLimitePagamento)) {
            $errors['dataLimitePagamento'] = 'Data limite de pagamento inválida';
        }
        
        if (!empty($this->dataPrimeiroDesconto) && !$this->validarData($this->dataPrimeiroDesconto)) {
            $errors['dataPrimeiroDesconto'] = 'Data do primeiro desconto inválida';
        }
        
        if (!empty($this->dataSegundoDesconto) && !$this->validarData($this->dataSegundoDesconto)) {
            $errors['dataSegundoDesconto'] = 'Data do segundo desconto inválida';
        }
        
        if (!empty($this->dataTerceiroDesconto) && !$this->validarData($this->dataTerceiroDesconto)) {
            $errors['dataTerceiroDesconto'] = 'Data do terceiro desconto inválida';
        }
        
        if (!empty($this->dataMulta) && !$this->validarData($this->dataMulta)) {
            $errors['dataMulta'] = 'Data da multa inválida';
        }
        
        if (!empty($this->dataJurosMora) && !$this->validarData($this->dataJurosMora)) {
            $errors['dataJurosMora'] = 'Data dos juros de mora inválida';
        }
        
        if (!empty($errors)) {
            throw new ValidationException('Dados do boleto inválidos', $errors);
        }
        
        return true;
    }
    
    /**
     * Valida formato de data
     * 
     * @param string $data
     * @return bool
     */
    private function validarData($data)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $data);
        return $date && $date->format('Y-m-d') === $data;
    }
    
    /**
     * Converte o objeto para array
     * 
     * @return array
     */
    public function toArray()
    {
        $data = [
            'numeroCliente' => $this->numeroCliente,
            'codigoModalidade' => $this->codigoModalidade,
            'numeroContaCorrente' => $this->numeroContaCorrente,
            'codigoEspecieDocumento' => $this->codigoEspecieDocumento,
            'dataEmissao' => $this->dataEmissao,
            'nossoNumero' => $this->nossoNumero,
            'seuNumero' => $this->seuNumero,
            'identificacaoBoletoEmpresa' => $this->identificacaoBoletoEmpresa,
            'identificacaoEmissaoBoleto' => $this->identificacaoEmissaoBoleto,
            'identificacaoDistribuicaoBoleto' => $this->identificacaoDistribuicaoBoleto,
            'valor' => $this->valor,
            'dataVencimento' => $this->dataVencimento,
            'dataLimitePagamento' => $this->dataLimitePagamento,
            'valorAbatimento' => $this->valorAbatimento,
            'tipoDesconto' => $this->tipoDesconto,
            'dataPrimeiroDesconto' => $this->dataPrimeiroDesconto,
            'valorPrimeiroDesconto' => $this->valorPrimeiroDesconto,
            'dataSegundoDesconto' => $this->dataSegundoDesconto,
            'valorSegundoDesconto' => $this->valorSegundoDesconto,
            'dataTerceiroDesconto' => $this->dataTerceiroDesconto,
            'valorTerceiroDesconto' => $this->valorTerceiroDesconto,
            'tipoMulta' => $this->tipoMulta,
            'dataMulta' => $this->dataMulta,
            'valorMulta' => $this->valorMulta,
            'tipoJurosMora' => $this->tipoJurosMora,
            'dataJurosMora' => $this->dataJurosMora,
            'valorJurosMora' => $this->valorJurosMora,
            'numeroParcela' => $this->numeroParcela,
            'aceite' => $this->aceite,
            'codigoNegativacao' => $this->codigoNegativacao,
            'numeroDiasNegativacao' => $this->numeroDiasNegativacao,
            'codigoProtesto' => $this->codigoProtesto,
            'numeroDiasProtesto' => $this->numeroDiasProtesto,
            'beneficiarioFinal' => $this->beneficiarioFinal,
            'mensagensInstrucao' => $this->mensagensInstrucao,
            'gerarPdf' => $this->gerarPdf,
            'rateioCreditos' => $this->rateioCreditos,
            'codigoCadastrarPIX' => $this->codigoCadastrarPIX,
            'numeroContratoCobranca' => $this->numeroContratoCobranca
        ];
        
        if ($this->pagador) {
            $data['pagador'] = $this->pagador->toArray();
        }
        
        return $data;
    }
} 