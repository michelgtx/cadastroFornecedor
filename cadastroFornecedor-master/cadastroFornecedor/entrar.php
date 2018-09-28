<?php
$login = $_POST['login'];
$senha = $_POST['senha'];

define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/");

include_once CAMINHO.'model/clsAdmin.php'; 
include_once CAMINHO.'dao/clsAdminDAO.php'; 
include_once CAMINHO.'dao/clsFornecedorDAO.php'; 


$admin = FornecedorDAO::logar($login, $senha);
       

if( $admin == NULL ){
    echo '<body onload="window.history.back();">';
}  else {
    
    session_start();
    
    $_SESSION['logado'] = true;
    $_SESSION['idAdmin'] = $admin->getId();
    $_SESSION['nome'] = $admin->getNome();
    $_SESSION['foto'] = $admin->getFoto();
   
    
    
    header ( "Location: ".$_SERVER['HTTP_REFERER']);
    
}
        
        
        
        