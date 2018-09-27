<?php
session_start();
/*
  if (!isset($_SESSION['logado']) ||
  !$_SESSION['logado']) {
  header("Location: index.php");
  } else {
 */

define("CAMINHO", $_SERVER['DOCUMENT_ROOT'] . "/cadastroFornecedor/");

include_once CAMINHO . 'model/clsMaterial.php';
include_once CAMINHO . 'dao/clsMaterialDAO.php';


$action = "inserir";

$nomeMaterial = "";
$valor = "";
$descricao = "";


if (isset($_REQUEST['editar'])) {
    $idMaterial = $_REQUEST['idMaterial'];

    $material = MaterialDAO::getMaterialById($idMaterial);


    $nomeMaterial = $material->getNomeMaterial();
    $valor = $material->getValor();
    $descricao = $material->getDescricao();

    $foto = $material->getFoto();

    $action = "editar&idMaterial=" . $idMaterial;
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Clínica Melhor Visão - Cadastrar Material</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="estilos_cadastro.css" rel="stylesheet" />
    </head>
    <body >

        <div class="container">

            <?php
            require_once 'cabecalho.php';
            ?>
            <h1 align="center">Cadastrar Material</h1>

            <br><br>

            <form class="form-horizontal" action="controller/salvarMaterial.php?<?php echo $action; ?>" method="POST"
                  enctype="multipart/form-data">
                
                <div class="control-group"> 
                    <label class="control-label">Nome: </label>
                <input type="text" name="nome" value="<?php echo $nomeMaterial; ?>"  /> <br><br>

                <label class="control-label">Valor: </label>
                <input type="number" name="valor" step="any" value="<?php echo $valor; ?>"  /> <br><br>     

                <label class="control-label">Descrição: </label>
                <input type="text" name="descricao" value="<?php echo $descricao; ?>"  /> <br><br> 


                <?php
                if (isset($_REQUEST['editar'])) {
                    echo '<img src="fotos_materiais/' . $foto . '" width="50px" />';
                }
                ?>

                <label class="control-label">Foto: </label>
                <input class="btn btn-navbar" type="file" name="foto" /> <br><br>

                <input style="margin-left: 161px" class="btn btn-primary" type="submit" name="salvar" value="Salvar" />
                <input class="btn btn-warning" type="reset" value="Limpar" />

                
                </div>
            </form>



            <?php
            require_once 'rodape.php';
            ?>

            <script src="http://code.jquery.com/jquery-latest.js"></script>
            <script src="js/bootstrap.min.js"></script>


        </div>
    </body>
</html>

            <?php
  //      }