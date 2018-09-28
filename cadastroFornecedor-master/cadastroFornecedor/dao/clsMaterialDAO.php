<?php

include_once CAMINHO . 'dao/clsConexao.php';
include_once CAMINHO . 'dao/clsMaterialDAO.php';
include_once CAMINHO . 'model/clsMaterial.php';

class MaterialDAO {

    public static function inserir($material) {
        $sql = "INSERT INTO materiais "
                . " ( nomeMaterial, valor, descricao, foto ) VALUES "
                . " ( '" . $material->getNomeMaterial() . "' , "
                . "    " . $material->getValor() . " , "
                . "   '" . $material->getDescricao() . "' , "
                . "   '" . $material->getFoto() . "'  "
                . "  ); ";

        echo $sql;

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function editar($material) {
        $sql = "UPDATE materiais SET "
                . " nomeMaterial =  '" . $material->getNomeMaterial() . "' , "
                . " valor =  " . $material->getValor() . " , "
                . " descricao =  " . $material->getDescricao() . " , "
                . " foto  =  '" . $material->getFoto() . "'  "
                . " WHERE id = " . $material->getId();

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function excluir($material) {
        $sql = "DELETE FROM materiais "
                . " WHERE id =  " . $material->getId();

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function getMateriais() {
        $sql = " SELECT id, nomeMaterial, valor, descricao, foto FROM materiais  ";
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        $lista = new ArrayObject();

        while (list( $cod, $nomeMat, $valor, $descricao, $foto ) = mysqli_fetch_row($result)) {


            $material = new Material();
            $material->setId($cod);
            $material->setNomeMaterial($nomeMat);
            $material->setValor($valor);
            $material->setDescricao($descricao);
            $material->setFoto($foto);


            $lista->append($material);
        }

        return $lista;
    }

    public static function getMaterialById($idMaterial) {

        $sql = " SELECT id, nomeMaterial, valor, descricao, foto FROM materiais Where id = ".$idMaterial;

        $conn = new Conexao();
        $result = $conn->consultar($sql);

        list( $cod, $nomeMat, $valor, $descricao, $foto ) = mysqli_fetch_row($result);


        $material = new Material();
        $material->setId($cod);
        $material->setNomeMaterial($nomeMat);
        $material->setValor($valor);
        $material->setDescricao($descricao);
        $material->setFoto($foto);

        return $material;
    }

    public static function getFotoByIdMaterial($idMaterial) {

        $sql = "SELECT foto FROM materiais "
                . " WHERE id = " . $idMaterial;
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        $dados = mysqli_fetch_assoc($result);
        return $dados['foto'];
    }

}
