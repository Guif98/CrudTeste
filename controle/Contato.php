<?php

class Contato  
{

    public static function selecionarTodos() 
    {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT contato.id, nome, sobrenome, idade, telefone FROM contato LEFT JOIN telefones ON contato.id = telefones.contato_id ");
        $stmt->execute(array());
        $contatos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $contatos;
    }

    public static function selecionarPorId($id) {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT contato.id, nome, sobrenome, idade, telefone FROM contato LEFT JOIN telefones ON contato.id = telefones.contato_id  WHERE contato.id = ?");
        //$stmt->bindParam(':id', $id);
        $stmt->execute(array(
            $id
        ));
        $contato = $stmt->fetch(PDO::FETCH_OBJ);
        return $contato;
    }

    public static function inserir() {
        try {
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $idade = $_POST['idade'];
        $telefone = $_POST['telefone'];
        $db = Conexao::connect();
        $stmt = $db->prepare("INSERT INTO contato (nome, sobrenome, idade) VALUES ( ?, ?, ?)");
        $stmt->execute(array(
            $nome, $sobrenome, $idade,
        ));
        $contato_id = $db->lastInsertId();
        $stmt = $db->prepare("INSERT INTO telefones (contato_id, telefone) VALUES ( ?, ?)");
        $stmt->execute(array(
            $contato_id, $telefone
        ));
        } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
      }
    }

    public static function excluir() {
        $id = $_GET['excluir'];
        $contato_id = $id;
        $db = Conexao::connect();
        $stmt = $db->prepare("DELETE FROM telefones WHERE contato_id = ?");
        $stmt->execute(array($contato_id));
        $stmt = $db->prepare("DELETE FROM contato WHERE id = ?");
        $stmt->execute(array($id));
        return $stmt->rowCount();
        
    }

    public static function atualizar() {
        if (isset($_POST['atualizar'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $idade = $_POST['idade'];
            $telefone = $_POST['telefone'];
            $db = Conexao::connect();
            $stmt = $db->prepare("UPDATE contato SET nome=?, sobrenome=?, idade=? WHERE id=?");
            $stmt->execute(array(
                $nome,
                $sobrenome,
                $idade,
                $id
            ));
            $stmt = $db->prepare("UPDATE telefones SET telefone=? WHERE contato_id =?");
            $stmt->execute(array(
                $telefone, $id
            ));
            header('location: index.php');
        }
    }

    public static function pesquisar() {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $db = Conexao::connect();
            $stmt = $db->prepare("SELECT contato.id, nome, sobrenome, idade, telefone FROM contato LEFT JOIN telefones ON contato.id = telefones.contato_id WHERE nome LIKE :search OR sobrenome LIKE :search OR idade LIKE :search OR telefone LIKE :search");
            $joker = "%{$search}%";
            $stmt->bindParam(':search', $joker, PDO::PARAM_STR);
            $stmt->execute();
            $contatos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $contatos;
            header('location:index.php');
        }
    }
}