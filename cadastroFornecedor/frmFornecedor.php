<?php
define("CAMINHO", $_SERVER['DOCUMENT_ROOT'] . "/cadastroFornecedor/");

include_once CAMINHO . 'model/clsCidade.php';
include_once CAMINHO . 'dao/clsCidadeDAO.php';
include_once CAMINHO . 'dao/clsFornecedorDAO.php';


$action = "inserir";

$nomeFornecedor = "";
$cnpj = "";
$telefone = "";
$email = "";
$logradouro = "";
$numero = "";
$complemento = "";
$bairro = "";
$cep = "";
$idCidade = 0;

if (isset($_REQUEST['editar'])) {
    $idFornecedor = $_REQUEST['idFornecedor'];

    $fornecedor = FornecedorDAO::getFornecedorById($idFornecedor);


    $nomeFornecedor = $fornecedor->getNomeFornecedor();
    $cnpj = $fornecedor->getCnpj();
    $telefone = $fornecedor->getTelefone();
    $email = $fornecedor->getEmail();
    $logradouro = $fornecedor->getLogradouro();
    $numero = $fornecedor->getNumero();
    $complemento = $fornecedor->getComplemento();
    $bairro = $fornecedor->getBairro();
    $cep = $fornecedor->getCep();

    $idCidade = $fornecedor->getCidade()->getId();
    $foto = $fornecedor->getFoto();

    $action = "editar&idFornecedor=" . $idFornecedor;
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Clínica Melhor Visão</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="estilos_cadastro.css" rel="stylesheet" />
    </head>

    <body >
<!--        background="fundo_index/planoLiso.png"-->

        <div class="container">

            <?php
            require_once 'cabecalho.php';
            ?>
            <h1 align="center">Cadastrar Fornecedor</h1>

            <br><br>

            <form class="form-horizontal" action="controller/salvarFornecedor.php?<?php echo $action; ?>" method="POST"
                  enctype="multipart/form-data">

                <div class="control-group">
                    <label class="control-label">Nome: </label>
                    <input  type="text" name="nome" value="<?php echo $nomeFornecedor; ?>" /> 

                    <?php
//                if( isset( $_SESSION['admin']) && $_SESSION['admin']  ){
//                    echo '<input type="checkbox" name="admin" />Administrador'; 
//                    
//                }
//            
                    ?>

                    <br><br>

                    <label class="control-label">CNPJ: </label>
                    <input  type="text" name="cnpj" value="<?php echo $cnpj; ?>" /><br><br>     

                    <label class="control-label">Telefone: </label>
                    <input  type="tel" name="telefone" value="<?php echo $telefone; ?>" /> <br><br> 

                    <label class="control-label">Cidade:</label>

                    <select  name="cidade">
                        <option value="0">Selecione...</option>

                        <?php
                        $lista = CidadeDAO::getCidades();
                        foreach ($lista as $cidade) {
                            $selecionar = "";
                            if ($cidade->getId() == $idCidade) {
                                $selecionar = " selected ";
                            }
                            echo '<option ' . $selecionar . ' value="' . $cidade->getId() . '">'
                            . $cidade->getNome() . '</option>';
                        }
                        ?>
                    </select> 

                    <br><br> 

                    <label class="control-label">E-mail: </label>
                    <input  type="email" name="email" value="<?php echo $email; ?>" /> <br><br>     

                    <label class="control-label">Logradouro: </label>
                    <input type="text" name="logradouro" value="<?php echo $logradouro; ?>" /> <br><br>

                    <label class="control-label">Número: </label>
                    <input  type="text" name="numero" value="<?php echo $numero; ?>" /> <br><br>

                    <label class="control-label">Complemento: </label>
                    <input  type="text" name="complemento" value="<?php echo $complemento; ?>" /> <br><br>

                    <label class="control-label">Bairro: </label>
                    <input  type="text" name="bairro" value="<?php echo $bairro; ?>" /> <br><br>

                    <label class="control-label">Cep: </label>
                    <input  type="text" name="cep" value="<?php echo $cep; ?>" /> <br><br>


                    <!--            <label>Senha: </label>
                                <input type="password" name="senha" /> <br><br>     
                                
                                <label>Confirme sua Senha: </label>
                                <input type="password" name="senha2" /> <br><br>  -->

                    <?php
                    if (isset($_REQUEST['editar'])) {
                        echo '<img src="fotos_fornecedores/' . $foto . '" width="50px" />';
                    }
                    ?>

                    <label class="control-label">Foto: </label>
                    <input class="btn btn-navbar" type="file" name="foto" /> <br><br>

                    <input style="margin-left: 161px" class="btn btn-primary " type="submit" value="Salvar" />
                    <input  class="btn btn-warning " type="reset" value="Limpar" />


                </div>
            </form>
            
<!--            <br><br><br><br>-->

            <?php
require_once 'rodape.php';

            ?>

        </div>

        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
