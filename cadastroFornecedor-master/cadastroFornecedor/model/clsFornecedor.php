<?php


class Fornecedor {
    
    private $id;
    private $nomeFornecedor;
    private $cnpj;
    private $telefone;
    private $email;
    private $logradouro;
    private $numero;
    private $complemento;
    private $bairro;
    private $cep;
    private $foto;
    private $cidade;
    
    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

        
    public function getId() {
        return $this->id;
    }

    public function getNomeFornecedor() {
        return $this->nomeFornecedor;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLogradouro() {
        return $this->logradouro;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCep() {
        return $this->cep;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNomeFornecedor($nomeFornecedor) {
        $this->nomeFornecedor = $nomeFornecedor;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }


}
