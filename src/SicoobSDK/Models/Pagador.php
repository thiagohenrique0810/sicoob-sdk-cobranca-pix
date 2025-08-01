<?php
/**
 * Modelo Pagador do SDK Sicoob
 * 
 * Classe que representa os dados do pagador de um boleto
 * 
 * @package SicoobSDK\Models
 * @author Sicoob SDK Team
 */
namespace SicoobSDK\Models;

use SicoobSDK\Exceptions\ValidationException;

class Pagador
{
    /**
     * @var string Número do CPF/CNPJ do pagador
     */
    private $numeroCpfCnpj;
    
    /**
     * @var string Nome do pagador
     */
    private $nome;
    
    /**
     * @var string Endereço do pagador
     */
    private $endereco;
    
    /**
     * @var string Bairro do pagador
     */
    private $bairro;
    
    /**
     * @var string Cidade do pagador
     */
    private $cidade;
    
    /**
     * @var string CEP do pagador
     */
    private $cep;
    
    /**
     * @var string UF do pagador
     */
    private $uf;
    
    /**
     * @var string Email do pagador
     */
    private $email;
    
    /**
     * Construtor da classe
     * 
     * @param array $data Dados do pagador
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
     * @param array $data Dados do pagador
     * @return void
     */
    public function loadFromArray(array $data)
    {
        if (isset($data['numeroCpfCnpj'])) {
            $this->setNumeroCpfCnpj($data['numeroCpfCnpj']);
        }
        
        if (isset($data['nome'])) {
            $this->setNome($data['nome']);
        }
        
        if (isset($data['endereco'])) {
            $this->setEndereco($data['endereco']);
        }
        
        if (isset($data['bairro'])) {
            $this->setBairro($data['bairro']);
        }
        
        if (isset($data['cidade'])) {
            $this->setCidade($data['cidade']);
        }
        
        if (isset($data['cep'])) {
            $this->setCep($data['cep']);
        }
        
        if (isset($data['uf'])) {
            $this->setUf($data['uf']);
        }
        
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
    }
    
    /**
     * Define o número do CPF/CNPJ
     * 
     * @param string $numeroCpfCnpj
     * @return Pagador
     */
    public function setNumeroCpfCnpj($numeroCpfCnpj)
    {
        $this->numeroCpfCnpj = $numeroCpfCnpj;
        return $this;
    }
    
    /**
     * Obtém o número do CPF/CNPJ
     * 
     * @return string
     */
    public function getNumeroCpfCnpj()
    {
        return $this->numeroCpfCnpj;
    }
    
    /**
     * Define o nome do pagador
     * 
     * @param string $nome
     * @return Pagador
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    
    /**
     * Obtém o nome do pagador
     * 
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }
    
    /**
     * Define o endereço do pagador
     * 
     * @param string $endereco
     * @return Pagador
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }
    
    /**
     * Obtém o endereço do pagador
     * 
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }
    
    /**
     * Define o bairro do pagador
     * 
     * @param string $bairro
     * @return Pagador
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
        return $this;
    }
    
    /**
     * Obtém o bairro do pagador
     * 
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }
    
    /**
     * Define a cidade do pagador
     * 
     * @param string $cidade
     * @return Pagador
     */
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }
    
    /**
     * Obtém a cidade do pagador
     * 
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }
    
    /**
     * Define o CEP do pagador
     * 
     * @param string $cep
     * @return Pagador
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }
    
    /**
     * Obtém o CEP do pagador
     * 
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }
    
    /**
     * Define a UF do pagador
     * 
     * @param string $uf
     * @return Pagador
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }
    
    /**
     * Obtém a UF do pagador
     * 
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }
    
    /**
     * Define o email do pagador
     * 
     * @param string $email
     * @return Pagador
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * Obtém o email do pagador
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Valida os dados do pagador
     * 
     * @return bool
     * @throws ValidationException
     */
    public function validate()
    {
        $errors = [];
        
        if (empty($this->numeroCpfCnpj)) {
            $errors['numeroCpfCnpj'] = 'CPF/CNPJ é obrigatório';
        } elseif (!$this->validarCpfCnpj($this->numeroCpfCnpj)) {
            $errors['numeroCpfCnpj'] = 'CPF/CNPJ inválido';
        }
        
        if (empty($this->nome)) {
            $errors['nome'] = 'Nome é obrigatório';
        }
        
        if (empty($this->endereco)) {
            $errors['endereco'] = 'Endereço é obrigatório';
        }
        
        if (empty($this->bairro)) {
            $errors['bairro'] = 'Bairro é obrigatório';
        }
        
        if (empty($this->cidade)) {
            $errors['cidade'] = 'Cidade é obrigatória';
        }
        
        if (empty($this->cep)) {
            $errors['cep'] = 'CEP é obrigatório';
        } elseif (!$this->validarCep($this->cep)) {
            $errors['cep'] = 'CEP inválido';
        }
        
        if (empty($this->uf)) {
            $errors['uf'] = 'UF é obrigatória';
        } elseif (!$this->validarUf($this->uf)) {
            $errors['uf'] = 'UF inválida';
        }
        
        if (!empty($this->email) && !$this->validarEmail($this->email)) {
            $errors['email'] = 'Email inválido';
        }
        
        if (!empty($errors)) {
            throw new ValidationException('Dados do pagador inválidos', $errors);
        }
        
        return true;
    }
    
    /**
     * Valida CPF/CNPJ
     * 
     * @param string $cpfCnpj
     * @return bool
     */
    private function validarCpfCnpj($cpfCnpj)
    {
        $cpfCnpj = preg_replace('/[^0-9]/', '', $cpfCnpj);
        
        if (strlen($cpfCnpj) === 11) {
            return $this->validarCpf($cpfCnpj);
        } elseif (strlen($cpfCnpj) === 14) {
            return $this->validarCnpj($cpfCnpj);
        }
        
        return false;
    }
    
    /**
     * Valida CPF
     * 
     * @param string $cpf
     * @return bool
     */
    private function validarCpf($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/^(\d)\1+$/', $cpf)) {
            return false;
        }
        
        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Valida CNPJ
     * 
     * @param string $cnpj
     * @return bool
     */
    private function validarCnpj($cnpj)
    {
        // Remove caracteres não numéricos
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        
        // Verifica se tem 14 dígitos
        if (strlen($cnpj) != 14) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/^(\d)\1+$/', $cnpj)) {
            return false;
        }
        
        // Calcula os dígitos verificadores
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }
        
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        
        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
    
    /**
     * Valida CEP
     * 
     * @param string $cep
     * @return bool
     */
    private function validarCep($cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) === 8;
    }
    
    /**
     * Valida UF
     * 
     * @param string $uf
     * @return bool
     */
    private function validarUf($uf)
    {
        $ufs = [
            'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA',
            'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN',
            'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'
        ];
        
        return in_array(strtoupper($uf), $ufs);
    }
    
    /**
     * Valida email
     * 
     * @param string $email
     * @return bool
     */
    private function validarEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Converte o objeto para array
     * 
     * @return array
     */
    public function toArray()
    {
        return [
            'numeroCpfCnpj' => $this->numeroCpfCnpj,
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'cep' => $this->cep,
            'uf' => $this->uf,
            'email' => $this->email
        ];
    }
} 