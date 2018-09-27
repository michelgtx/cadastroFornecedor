<?php

    session_start();
    
    if( ! isset( $_SESSION['logado']) ||  
            !$_SESSION['logado']  ) {
        header("Location: index.php");
    }  else {
        

    define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/");
    
    include_once CAMINHO.'model/clsCidade.php';
    include_once CAMINHO.'model/clsFornecedor.php';
    include_once CAMINHO.'dao/clsFornecedorDAO.php';  
    
    
?>

<!DOCTYPE html>

<html>
    <head>
        
        <title>Clínica Melhor Visão - Fornecedores</title>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="estilos_cadastro.css" rel="stylesheet" />
    </head>
    <body onload="erro()" >
       
        <div class="container">
        
        <?php
            require_once 'cabecalho.php';
            
            if( isset($_REQUEST['erroInserir'])){
                echo '<script> '
                   . '    function erro(){'
                   . '       alert("Erro ao inserir"); '
                   . '    } '
                   . '</script>  ';
            }
            
            if( isset($_REQUEST['erroEditar'])){
                echo '<script> '
                   . '    function erro(){'
                   . '       alert("Erro ao editar"); '
                   . '    } '
                   . '</script>  ';
            }
            
        ?>
        
        
        <h1 align="center">Fornecedores</h1>
        

        
        <a href="frmFornecedor.php">
            <button style="margin-left: 10px; " class="btn btn-success" >Cadastrar Fornecedor</button></a>
        
        <br>
        <br>
        
        <?php
        
        $lista = FornecedorDAO::getFornecedores(); 
                
         
        if( $lista->count() == 0 ){
            echo '<h2><b>Nenhum fornecedor cadastrado</b></h2>';
        }  else {
            
          
        ?>
        
        
        <table  style="width: 100% " class="table-striped" >

            
            <tr>
                
                <th style="width: 1%; text-align: center;" >Cód</th>
                <th style="width: 5%" >Foto</th>
                <th style="width: 10%; text-align: center;" >Nome</th>
                <th style="width: 10%; text-align: center;">CNPJ</th>
                <th style="width: 10%; text-align: center;">Telefone</th>
                <th style="width: 10%; text-align: center;">E-mail</th>
                <th style="width: 10%; text-align: center;">Logradouro</th>
                <th style="width: 5%; text-align: center;">Número</th>
                <th style="width: 5%; text-align: center;">Complemento</th>
                <th style="width: 10%; text-align: center;">Bairro</th>
                <th style="width: 5%; text-align: center;">Cep</th>
                <th style="width: 10%; text-align: center;">Cidade</th>
                <th></th>
                <th></th>
            </tr>
            
            <?php
            
            foreach ($lista as $fornecedor) {  
            ?>
            <tr>
                <td style="width: 1%; text-align: center;"><?php echo $fornecedor->getId();?></td>
                <td style="padding: 5px;" > 
                    <img src="fotos_fornecedores/<?php echo $fornecedor->getFoto(); ?>" 
                         width="100%"  /> </td>
                <td style=" text-align: center;" ><?php echo $fornecedor->getNomeFornecedor(); ?></td>
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getCnpj(); ?></td>
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getTelefone(); ?></td>
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getEmail(); ?></td>
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getLogradouro(); ?></td>
                <td style="width: 5%; text-align: center;"><?php echo $fornecedor->getNumero(); ?></td>
                <td style="width: 5%; text-align: center;"><?php echo $fornecedor->getComplemento(); ?></td>
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getBairro(); ?></td>
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getCep(); ?></td>
                
                <td style="width: 10%; text-align: center;"><?php echo $fornecedor->getCidade()->getNome(); ?></td>
                <td > <a  href="frmFornecedor.php?editar&idFornecedor=<?php echo $fornecedor->getId(); ?>"><button  class="btn-small btn-warning">Editar</button></a>  </td>
                <td> <a  href="controller/salvarFornecedor.php?excluir&idFornecedor=<?php echo $fornecedor->getId(); ?>"><button style="margin-right: 10px;"  class="btn-small btn-danger" name="excluir">Excluir</button></a> </td>
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

<?php
    }