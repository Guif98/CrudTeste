<?php

class Usuario 
{
    public static function mostrarUsuarios() 
    {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT * FROM usuarios");
        $stmt->execute(array());
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public static function mostrarPorId($id) {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT usuario FROM usuarios WHERE id = ?");
        //$stmt->bindParam(':id', $id);
        $stmt->execute(array(
            $id
        ));
        $usuario = $stmt->fetch(PDO::FETCH_OBJ);
        return $usuario;
    }

    public static function pesquisar() {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $db = Conexao::connect();
            $str = explode(' ', $search);
            $query = '';
            $arr = array();
            foreach ($str as $value) {
                $arr[] = '%' . $value . '%';
                $query .= '(usuario LIKE ?) AND ';
            }
            $query .= '1 = 1';
            //$stmt = $db->prepare("SELECT contato.id, nome, sobrenome, idade, telefone FROM contato LEFT JOIN telefones ON contato.id = telefones.contato_id WHERE nome LIKE :search OR sobrenome LIKE :search OR idade LIKE :search OR telefone LIKE :search OR CONCAT(nome, SPACE(1), sobrenome) LIKE :search OR CONCAT(sobrenome, SPACE(1), nome) LIKE :search");
            $stmt = $db->prepare("SELECT id, usuario FROM usuarios WHERE $query");

            //$joker = '%' . $search . '%';
            //$stmt->bindParam(':search', $joker, PDO::PARAM_STR);
            $stmt->execute($arr);
            $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $usuarios;
            header('location:index.php');
        }
    }

    public static function salvarPermissoes() 
    {
        $db = Conexao::connect();
    }

    public static function criarUsuario() 
    {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $db = Conexao::connect();    
        $stmt = $db->prepare("INSERT INTO usuarios (usuario, senha) VALUES (?, md5(?))");
        $stmt->execute(array(
            $usuario, $senha
        ));
    }

    public static function excluirUsuario()
    {
        try {
            $id = $_GET['excluir'];
            $db = Conexao::connect();
            $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->execute(array($id));
        } catch (\PDOException $th) {
            echo "Error: " , $th->getMessage();
        }
        
    }
}