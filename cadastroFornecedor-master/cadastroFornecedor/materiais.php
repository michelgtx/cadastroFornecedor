<?php
define("CAMINHO", $_SERVER['DOCUMENT_ROOT'] . "/cadastroFornecedor/");

include_once CAMINHO . 'dao/clsMaterialDAO.php';
include_once CAMINHO . 'model/clsMaterial.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Clínica Melhor Visão - Materiais</title>
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="est" rel="stylesheet" />
    </head>
    <body onload="erro()" >

        <div class="container">

            <?php
            require_once 'cabecalho.php';

            if (isset($_REQUEST['erroInserir'])) {
                echo '<script> '
                . '    function erro(){'
                . '       alert("Erro ao inserir"); '
                . '    } '
                . '</script>  ';
            }

            if (isset($_REQUEST['erroEditar'])) {
                echo '<script> '
                . '    function erro(){'
                . '       alert("Erro ao editar"); '
                . '    } '
                . '</script>  ';
            }
            ?>
            <h1 align="center">Materiais</h1>

            <a href="frmMaterial.php">
                <button style="margin-left: 10px; " class="btn btn-success">Cadastrar Materiais</button></a>

            <br>
            <br>

            <?php
            $lista = MaterialDAO::getMateriais();


            if ($lista->count() == 0) {
                echo '<h2><b>Nenhum material cadastrado</b></h2>';
            } else {
                ?>

                <table  style="width: 100%" class="table-striped" >

                    <tr>

                        <th style="width: 1%; text-align: center;">Cód</th>
                        <th style="width: 5%">Foto</th>
                        <th style="width: 15%; text-align: center;">Nome</th>
                        <th style="width: 8%; text-align: center;">Valor</th>
                        <th style="width: 15%; text-align: center;">Descrição</th>

                        <th></th>
                        <th></th>

                    </tr>

                    <?php
                    foreach ($lista as $material) {
                        ?>
                        <tr>
                            <td style="width: 1%; text-align: center;"><?php echo $material->getId(); ?></td>
                            <td style="padding: 5px;"> 
                                <img src="fotos_materiais/<?php echo $material->getFoto(); ?>" 
                                     width="30%"  /> </td>
                            <td style="width: 15%; text-align: center;"><?php echo $material->getNomeMaterial(); ?></td>
                            <td style="width: 8%; text-align: center;"><?php echo str_replace(".", ",", $material->getValor()); ?></td>
                            <td style="width: 15%; text-align: center;"><?php echo $material->getDescricao(); ?></td>

                            <td style="width: 5%; text-align: center;"> <a href="frmMaterial.php?editar&idMaterial=<?php echo $material->getId(); ?>"><button class="btn-small btn-warning">Editar</button></a>  </td>
                            <td style="width: 5%; text-align: center;"> <a href="controller/salvarMaterial.php?excluir&idMaterial=<?php echo $material->getId(); ?>"><button  class="btn-small btn-danger">Excluir</button></a> </td>

                        </tr>
                        <?php
                    }
                    ?>


                </table>


                <?php
            }

            require_once 'rodape.php';
            ?>

        </div>
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
