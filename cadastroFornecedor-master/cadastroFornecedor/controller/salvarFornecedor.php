<?php
    define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/" );
    
    include_once CAMINHO.'model/clsCidade.php';
    include_once CAMINHO.'model/clsFornecedor.php';
    include_once CAMINHO.'dao/clsFornecedorDAO.php';
    
    
    function uploadFoto(){
        
        if( isset( $_REQUEST['editar']) ){
            $foto_antiga = ClienteDAO::getFotoByIdCliente
                            ($_REQUEST['idFornecedor']);
        }
        
        if ( isset($_FILES['foto']['name']) &&
                $_FILES['foto']['name'] != "" ){
            
            $nome_arquivo = date("YmdHis").
                basename($_FILES['foto']['name']);
            $diretorio = "../fotos_fornecedores/";
            $arquivo = $diretorio.$nome_arquivo;
            if( move_uploaded_file($_FILES['foto']['tmp_name'], 
                    $arquivo) ){
                if( isset( $_REQUEST['editar']) ){
           
                    if( $foto_antiga != "logo.png" ){
                       unlink( "../fotos_fornecedores/".$foto_antiga ); 
                    }
                }
                
                return $nome_arquivo;
            }  else {
                if( isset($_REQUEST['editar']) ){
                    return $foto_antiga;
                }  else {
                    return "logo.png";
                }
            }
        }  else {
            if( isset($_REQUEST['editar']) ){
                return $foto_antiga;
            }  else {
                return "logo.png";
            }
            
        }
    }
    
    
    if( isset( $_REQUEST['excluir']) ){
        $id = $_GET['idFornecedor'];
        
        $fornecedor = new Fornecedor();
        $fornecedor->setId( $id );
        
        $foto_antiga = 
                       FornecedorDAO::getFotoByIdFornecedor($id);
                
                
        
        $retorno = FornecedorDAO::excluir($fornecedor);
               
        
        if( $retorno ){
            if( $foto_antiga != "logo.png"){
                unlink("../fotos_fornecedores/".$foto_antiga);
            }
            header("Location: ../fornecedores.php");
        }  else {
            header("Location: ../fornecedores.php?erroExcluir");
        }
    
        
   }  else {
//        
//        $senha = $_POST['senha'];
//        $senha2 = $_POST['senha2'];
//        
//        if( $senha != $senha2 ){
//             echo "<body onload='window.history.back();'>";
//        }  else {
//            
//            $cliente = new Cliente();
//            $cliente->setNome( $_POST['nome'] );
//            $cliente->setTelefone( $_POST['telefone'] );
//            $cliente->setEmail( $_POST['email'] );
//            $cliente->setCpf( $_POST['cpf'] );
//            $cliente->setFoto( uploadFoto() );
//            
//            if( isset($_POST['admin']) ){
//                $cliente->setAdmin(1);
//            }  else {
//                $cliente->setAdmin(0);
//            }
//            
//            $password = md5($senha);
//            $cliente->setSenha($password);
            
            $cid = new Cidade();
            $cid->setId( $_POST['cidade'] );
            
            $fornecedor = new Fornecedor();
            
            
            $fornecedor->setCidade( $cid );
            
            $fornecedor->setNomeFornecedor($_POST['nome']);
            $fornecedor->setCnpj($_POST['cnpj']);
            $fornecedor->setTelefone($_POST['telefone']);
            $fornecedor->setEmail($_POST['email']);
            $fornecedor->setLogradouro($_POST['logradouro']);
            $fornecedor->setNumero($_POST['numero']);
            $fornecedor->setComplemento($_POST['complemento']);
            $fornecedor->setBairro($_POST['bairro']);
            $fornecedor->setCep($_POST['cep']);
            $fornecedor->setFoto( uploadFoto() );
            
            
            
            $erro = "";
            if( isset($_REQUEST["inserir"])){
               $retorno = FornecedorDAO::inserir($fornecedor);
               if ( !$retorno ){
                   $erro = "?erroInserir";
               }
            }
            
            if( isset($_REQUEST["editar"]) ){
                $fornecedor->setId( $_GET['idFornecedor'] );
                $retorno = FornecedorDAO::editar($fornecedor);
                if ( !$retorno ){
                   $erro = "?erroEditar";
               }
            }
            
           header("Location: ../fornecedores.php".$erro);
            
        }
        
    //}
    
    
    
    
    
    