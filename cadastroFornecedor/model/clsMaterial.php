<?php


class Material {
    
    private $id;
    private $nomeMaterial;
    private $valor;
    private $descricao;
    private $foto;
    
    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

        public function getId() {
        return $this->id;
    }

    public function getNomeMaterial() {
        return $this->nomeMaterial;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNomeMaterial($nomeMaterial) {
        $this->nomeMaterial = $nomeMaterial;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }


    
}
