<?php

include_once CAMINHO . 'dao/clsConexao.php';
include_once CAMINHO . 'model/clsFornecedor.php';

include_once CAMINHO.'model/clsCidade.php';

class FornecedorDAO {

    public static function inserir($fornecedor) {

        $sql = "INSERT INTO fornecedores "
                . " ( nomeFornecedor, cnpj, telefone, email, logradouro, "
                . "   numero, foto, complemento, bairro, cep, codCidade) VALUES "
                . " ( '" . $fornecedor->getNomeFornecedor() . "' , "
                . "   '" . $fornecedor->getCnpj() . "' , "
                . "   '" . $fornecedor->getTelefone() . "' , "
                . "   '" . $fornecedor->getEmail() . "' , "
                . "   '" . $fornecedor->getLogradouro() . "' , "
                . "   '" . $fornecedor->getNumero() . "' , "
                . "   '" . $fornecedor->getFoto() . "' , "
                . "   '" . $fornecedor->getComplemento() . "' , "
                . "   '" . $fornecedor->getBairro() . "' , "
                . "   '" . $fornecedor->getCep() . "' , "
                . "    " . $fornecedor->getCidade()->getId() . "  "
                . "  ); ";

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function editar($fornecedor) {
        $sql = "UPDATE fornecedores SET "
                . " nome =  '" . $fornecedor->getNomeFornecedor() . "' , "
                . " telefone =  '" . $fornecedor->getTelefone() . "' , "
                . " email =  '" . $fornecedor->getEmail() . "' , "
                . " logradouro =  '" . $fornecedor->getLogradouro() . "' , "
                . " foto =  '" . $fornecedor->getFoto() . "' , "
                . " complemento =  '" . $fornecedor->getComplemento() . "' , "
                . " bairro =  '" . $fornecedor->getBairro() . "' , "
                . " cep =  '" . $fornecedor->getCep() . "' , "
                . " numero =  '" . $fornecedor->getNumero() . "' , "
                . " codCidade = " . $fornecedor->getCidade()->getId() . "  "
                . " WHERE id = " . $fornecedor->getId();

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function excluir($fornecedor) {
        $sql = "DELETE FROM fornecedores "
                . " WHERE id =  " . $fornecedor->getId();

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function getFornecedores() {

        $sql = " SELECT f.id, f.nomeFornecedor, f.cnpj, f.telefone, f.email,"
                . " f.logradouro, f.numero, f.complemento, f.bairro, f.cep, f.foto, d.id, d.nome "
                . " FROM fornecedores f "            // c = f      
                . " INNER JOIN cidades d "
                . " ON f.codCidade = d.id "
                . " ORDER BY f.nomeFornecedor ";
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        $lista = new ArrayObject();

        while (list( $cod, $nomeFornecedor, $cnpj, $telefone, $email, $logradouro,
        $numero, $complemento, $bairro, $cep, $foto, $codCid, $nomeCid) = mysqli_fetch_row($result)) {

            $cidade = new Cidade();
            $cidade->setId($codCid);
            $cidade->setNome($nomeCid);

            $fornecedor = new Fornecedor();
            $fornecedor->setId($cod);
            $fornecedor->setNomeFornecedor($nomeFornecedor);
            $fornecedor->setCnpj($cnpj);
            $fornecedor->setTelefone($telefone);
            $fornecedor->setEmail($email);
            $fornecedor->setLogradouro($logradouro);
            $fornecedor->setNumero($numero);
            $fornecedor->setComplemento($complemento);
            $fornecedor->setBairro($bairro);
            $fornecedor->setCep($cep);
            $fornecedor->setFoto($foto);
            $fornecedor->setCidade($cidade);


            $lista->append($fornecedor);
        }

        return $lista;
    }

    public static function getFornecedorById($idFornecedor) {

        $sql = " SELECT f.id, f.nomeFornecedor, f.cnpj, f.telefone, f.email,"
                . " f.logradouro, f.numero, f.complemento, f.bairro, f.cep, f.foto, d.id, d.nome "
                . " FROM fornecedores f "            // c = f
                . " INNER JOIN cidades d "
                . " ON f.codCidade = d.id "
                . " WHERE f.id = " . $idFornecedor;
        
     

        $conn = new Conexao();
        $result = $conn->consultar($sql);

        list( $cod, $nomeFornecedor, $cnpj, $telefone, $email, $logradouro,
                $numero, $complemento, $bairro, $cep, $foto, $codCid, $nomeCid) = mysqli_fetch_row($result);
       
        $cidade = new Cidade();
        $cidade->setId($codCid);
        $cidade->setNome($nomeCid);

        $fornecedor = new Fornecedor();
        $fornecedor->setId($cod);
        $fornecedor->setNomeFornecedor($nomeFornecedor);
        $fornecedor->setCnpj($cnpj);
        $fornecedor->setTelefone($telefone);
        $fornecedor->setEmail($email);
        $fornecedor->setLogradouro($logradouro);
        $fornecedor->setNumero($numero);
        $fornecedor->setComplemento($complemento);
        $fornecedor->setBairro($bairro);
        $fornecedor->setCep($cep);
        $fornecedor->setFoto($foto);
        $fornecedor->setCidade($cidade);
        

        return $fornecedor;
    }

    public static function getFotoByIdFornecedor($idFornecedor) {

        $sql = "SELECT foto FROM fornecedores "
                . " WHERE id = " . $idFornecedor;
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        $dados = mysqli_fetch_assoc($result);
        return $dados['foto'];
    }

    public static function logar($login, $senha) {

        $senha = md5($senha);

        $sql = "SELECT id, nome, foto FROM admins "
                . " WHERE senha = '" . $senha . "' AND  "
                . " nome = '" . $login . "'     "
               ;
        $conn = new Conexao();

        $result = $conn->consultar($sql);

        if (mysqli_num_rows($result) > 0) {
            $dados = mysqli_fetch_assoc($result);
           
            $admin = new Admin();
            $admin->setId($dados['id']);
            $admin->setNome($dados['nome']);
            $admin->setFoto($dados['foto']);
            
            return $admin;
        } else {
            return NULL;
        }
    }

}
