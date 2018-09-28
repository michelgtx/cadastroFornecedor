<?php
    define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/");
    
     
    include_once CAMINHO.'dao/clsAdminDAO.php';  
    
    
    $action = "inserir";
    
//    private $id;
//    private $nome;
//    private $senha;
//    private $foto;
    
    
    $nome = "";
   
    
    if( isset($_REQUEST['editar']) ){
        $idAdmin = $_REQUEST['idAdmin'];
        
        $admin = AdminDAO::getAdminById($idAdmin);
                
                    
        $nome = $admin->getNome();
       
        $foto = $admin->getFoto();
        
        $action = "editar&idAdmin=".$idAdmin;
        
        
    }
    
    
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Clínica Melhor Visão</title>
    </head>
    <body background="fundo_index/planoLiso.png">
        <?php
            require_once 'cabecalho.php';
        ?>
        <h1 align="center">Cadastrar Admin</h1>
        
        <br><br>
        
        <form action="controller/salvarAdmin.php?<?php echo $action; ?>" method="POST"
              enctype="multipart/form-data">
            <label>Nome: </label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" /> 
            
             <?php 
//                if( isset( $_SESSION['admin']) && $_SESSION['admin']  ){
//                    echo '<input type="checkbox" name="admin" />Administrador'; 
//                    
//                }
//            ?>
            
            
                   
            <br><br> 
               
            
            <label>Senha: </label>
            <input type="password" name="senha" /> <br><br>     
            
            <label>Confirme sua Senha: </label>
            <input type="password" name="senha2" /> <br><br>  
            
            <?php
                if( isset( $_REQUEST['editar'])){
                    echo '<img src="fotos_admins/'.$foto.'" width="50px" />';
                }
            ?>
            
            <label>Foto: </label>
            <input type="file" name="foto" /> <br><br>
            
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" />
            
        </form>
                              
        
        <?php
            require_once 'rodape.php';
        ?>
    </body>
</html>
