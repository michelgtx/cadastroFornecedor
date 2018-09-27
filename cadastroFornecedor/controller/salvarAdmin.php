<?php
    define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/" );
    
   
    include_once CAMINHO.'model/clsAdmin.php';
    include_once CAMINHO.'dao/clsAdminDAO.php';
    
    
    function uploadFoto(){
        
        if( isset( $_REQUEST['editar']) ){
            $foto_antiga = AdminDAO::getAdminById($idAdmin);
                    
                            ($_REQUEST['idAdmin']);
        }
        
        if ( isset($_FILES['foto']['name']) &&
                $_FILES['foto']['name'] != "" ){
            
            $nome_arquivo = date("YmdHis").
                basename($_FILES['foto']['name']);
            $diretorio = "../fotos_admins/";
            $arquivo = $diretorio.$nome_arquivo;
            if( move_uploaded_file($_FILES['foto']['tmp_name'], 
                    $arquivo) ){
                if( isset( $_REQUEST['editar']) ){
           
                    if( $foto_antiga != "logoAdm.png" ){
                       unlink( "../fotos_admins/".$foto_antiga ); 
                    }
                }
                
                return $nome_arquivo;
            }  else {
                if( isset($_REQUEST['editar']) ){
                    return $foto_antiga;
                }  else {
                    return "logoAdm.png";
                }
            }
        }  else {
            if( isset($_REQUEST['editar']) ){
                return $foto_antiga;
            }  else {
                return "logoAdm.png";
            }
            
        }
    }
    
    
    if( isset( $_REQUEST['excluir']) ){
        $id = $_GET['idAdmin'];
        
        $admin = new Admin();
        $admin->setId( $id );
        
        $foto_antiga = AdminDAO::getFotoByIdAdmin($id);
                
                $retorno = AdminDAO::excluir($admin); 
                
        
        if( $retorno ){
            if( $foto_antiga != "logoAdm.png"){
                unlink("../fotos_admins/".$foto_antiga);
            }
            header("Location: ../admins.php");
        }  else {
            header("Location: ../admins.php?erroExcluir");
        }
        
    }  else {
        
        $senha = $_POST['senha'];
        $senha2 = $_POST['senha2'];
        
        if( $senha != $senha2 ){
             echo "<body onload='window.history.back();'>";
        }  else {
            
            $admin = new Admin();
            
            $admin->setNome( $_POST['nome'] );
            $admin->setFoto( uploadFoto() );
            
//            if( isset($_POST['admin']) ){
//                $admin->setAdmin(1);
//            }  else {
//                $admin->setAdmin(0);
//            }
            
            $password = md5($senha);
            $admin->setSenha($password);
            
                              
            
            $erro = "";
            if( isset($_REQUEST["inserir"])){
               $retorno = AdminDAO::inserir($admin);
                       
               if ( !$retorno ){
                   $erro = "?erroInserir";
               }
            }
            
            if( isset($_REQUEST["editar"]) ){
                $admin->setId( $_GET['idAdmin'] );
                $retorno = AdminDAO::editar($admin);
                       
                if ( !$retorno ){
                   $erro = "?erroEditar";
               }
            }
            
            header("Location: ../admins.php".$erro);
            
        }
        
    }
    
    
    
    
    
    