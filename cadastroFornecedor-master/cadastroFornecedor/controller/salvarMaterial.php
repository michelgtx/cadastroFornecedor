<?php

define("CAMINHO", $_SERVER['DOCUMENT_ROOT'] . "/cadastroFornecedor/");


include_once CAMINHO . 'model/clsMaterial.php';
include_once CAMINHO . 'dao/clsMaterialDAO.php';

function uploadFoto() {

    if (isset($_REQUEST['editar'])) {
        $foto_antiga = MaterialDAO::getFotoByIdMaterial
                        ($_REQUEST['idMaterial']);
    }

    if (isset($_FILES['foto']['name']) &&
            $_FILES['foto']['name'] != "") {

        $nome_arquivo = date("YmdHis") .
                basename($_FILES['foto']['name']);
        $diretorio = "../fotos_materiais/";
        $arquivo = $diretorio . $nome_arquivo;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo)) {
            if (isset($_REQUEST['editar'])) {

                if ($foto_antiga != "mat.png") {
                    unlink("../fotos_materiais/" . $foto_antiga);
                }
            }

            return $nome_arquivo;
        } else {
            if (isset($_REQUEST['editar'])) {
                return $foto_antiga;
            } else {
                return "mat.png";
            }
        }
    } else {
        if (isset($_REQUEST['editar'])) {
            return $foto_antiga;
        } else {
            return "mat.png";
        }
    }
}

if (isset($_REQUEST['excluir'])) {

    $id = $_GET['idMaterial'];
    $material = new Material();
    $material->setId($id);

    $foto_antiga = MaterialDAO::getFotoByIdMaterial($id);


    $retorno = MaterialDAO::excluir($material);

    if ($retorno) {
        if ($foto_antiga != "mat.png") {
            unlink("../fotos_materiais/" . $foto_antiga);
        }
        header("Location: ../materiais.php");
    } else {
        header("Location: ../materiais.php?erroExcluir");
    }
} else {


    $material = new Material();
    $material->setNomeMaterial($_POST['nome']);
    $material->setValor($_POST['valor']);
    $material->setDescricao($_POST['descricao']);

    $material->setFoto(uploadFoto());


   
    $erro = "";
    if (isset($_REQUEST["inserir"])) {
        $retorno = MaterialDAO::inserir($material);
               
        if (!$retorno) {
            $erro = "?erroInserir";
        }
    }

    if (isset($_REQUEST["editar"])) {
        $material->setId($_GET['idMaterial']);
        $retorno = MaterialDAO::editar($material);               
        
        if (!$retorno) {
            $erro = "?erroEditar";
        }
    }

    header("Location: ../materiais.php" . $erro);
}
    
    
    
    
    
    