<?php
    
    session_start();
    
    if( ! isset( $_SESSION['logado']) ||  
            !$_SESSION['logado']  ) {
        header("Location: index.php");
    }  else {
        
    

    define("CAMINHO", $_SERVER['DOCUMENT_ROOT']."/cadastroFornecedor/" );
    
    include_once CAMINHO.'dao/clsCidadeDAO.php';
    include_once CAMINHO.'model/clsCidade.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Loja da N162 - Cidades</title>
    </head>
    <body>
        <?php
            require_once 'cabecalho.php';
       
        
        ?>

                    
            
        <?php
            foreach ($lista as $cidade) {
                echo '<tr>
                        <td>'.$cidade->getId().'</td>
                        <td>'.$cidade->getNome().'</td>
                        <td>
                            <a href="controller/salvarCidade.php?excluir&idCidade='.$cidade->getId().'">             
                            <button>Excluir</button></a>
                        </td>
                      </tr> ';     
            }

        ?>
        
        </table>
        
         <br><br><br>
        <?php
           }
        
            require_once 'rodape.php';
            
                      
            
        ?>
        
       
    </body>
</html>
<?php
    