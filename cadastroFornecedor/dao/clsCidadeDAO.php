<?php


include_once CAMINHO.'dao/clsConexao.php';
include_once CAMINHO.'model/clsCidade.php';

class CidadeDAO {
    
    
    public static function getCidades(){
        $sql = "SELECT id, nome FROM cidades "
             . " ORDER BY nome ";
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        
        $lista = new ArrayObject();
        
        while( list( $cod, $nome) = mysqli_fetch_row($result) ){
            $cidade = new Cidade();
            $cidade->setId( $cod );
            $cidade->setNome( $nome );
            $lista->append($cidade);
        }
        
        return $lista;
    }
    
    
}





