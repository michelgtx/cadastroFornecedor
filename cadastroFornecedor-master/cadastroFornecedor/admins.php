<?php

    session_start();
    
    if( ! isset( $_SESSION['logado']) ||  
            !$_SESSION['logado']  ) {
        header("Location: index.php");
    }  else {
        

    define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/");
   
    
    include_once CAMINHO.'model/clsAdmin.php';
    include_once CAMINHO.'dao/clsAdminDAO.php';  
    
    
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Clínica Melhor Visão - Admins</title>
    </head>
    <body onload="erro()">
        
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
        <h1 align="center">Admins</h1>
        
        <a href="frmAdmin.php">
            <button>Cadastrar Admin</button></a>
        
        <br>
        <br>
        
        <?php
        
        $lista = AdminDAO::getAdmins();
               
         
        if( $lista->count() == 0 ){
            echo '<h2><b>Nenhum Administrador cadastrado</b></h2>';
        }  else {
            

          
        ?>
        
        <table border="1" width="100%">
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Nome</th>
              
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            
            <?php
            
            foreach ($lista as $admin) {  
            ?>
            <tr>
                <td><?php echo $admin>getId();?></td>
                <td> 
                    <img src="fotos_admins/<?php echo $admin->getFoto(); ?>" 
                         width="50px"  /> </td>
                <td><?php echo $admin->getNome(); ?></td>
               
                <td> <a href="frmAdmin.php?editar&idAdmin=<?php echo $admin->getId(); ?>"><button>Editar</button></a>  </td>
                <td> <a href="controller/salvarAdmin.php?excluir&idAdmin=<?php echo $admin->getId(); ?>"><button>Excluir</button></a> </td>
            </tr>
            <?php  
            }
            ?>
           
            
            
        </table>
        
       
        <?php
        }
                
                
            require_once 'rodape.php';
        ?>
    </body>
</html>

<?php
    }