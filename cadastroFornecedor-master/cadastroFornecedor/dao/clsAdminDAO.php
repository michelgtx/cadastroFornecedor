<?php

include_once CAMINHO . 'dao/clsConexao.php';
include_once CAMINHO . 'model/clsAdmin.php';

class AdminDAO {

    public static function inserir($admin) {
        $sql = "INSERT INTO admins "
                . " ( nome, senha, foto ) VALUES "
                . " ( '" . $admin->getNome() . "' , "
                . "   '" . $admin->getSenha() . "' , "
                . "   '" . $admin->getFoto() . "'  "
                . "  ); ";

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function editar($admin) {
        $sql = "UPDATE admins SET "
                . " nome =  '" . $admin->getNome() . "' , "
                . " senha =  '" . $admin->getSenha() . "' , "
                . " foto  =  '" . $admin->getFoto() . "'  "
                . " WHERE id = " . $admin->getId();

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function excluir($admin) {
        $sql = "DELETE FROM admins "
                . " WHERE id =  " . $admin->getId();

        $conn = new Conexao();
        $retorno = $conn->executar($sql);
        return $retorno;
    }

    public static function getAdmins() {
        $sql = " SELECT id, nome, foto "
                . " FROM admins  "
        ;
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        $lista = new ArrayObject();

        while (list( $cod, $nome,$foto) = mysqli_fetch_row($result)) {

            $admin = new Admin();
            $admin->setId($cod);
            $admin->setNome($nome);
            $admin->setFoto($foto);

            $lista->append($admin);
        }

        return $lista;
    }

    public static function getAdminById($idAdmin) {

        $sql = " SELECT id, nome,foto "
                . " FROM admins  "
                . " WHERE id = ".$idAdmin;
        $conn = new Conexao();
        $result = $conn->consultar($sql);

        list( $cod, $nome,
                $foto) = mysqli_fetch_row($result);



        $admin = new Admin();

        $admin->setId($cod);
        $admin->setNome($nome);
        $admin->setFoto($foto);


        return $admin;
    }

    public static function getFotoByIdAdmin($idAdmin) {

        $sql = "SELECT foto FROM admins "
                . " WHERE id = " . $idAdmin;
        $conn = new Conexao();
        $result = $conn->consultar($sql);
        $dados = mysqli_fetch_assoc($result);
        return $dados['foto'];
    }

    public static function logar($login, $senha) {

        $senha = md5($senha);

        $sql = "SELECT id, nome, foto FROM admins "
                . " WHERE senha = '" . $senha . "' AND  nome = '" . $login . "'   ";
               
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
