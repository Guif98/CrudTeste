<?php

require_once('database/Conexao.php');

class Contato  
{
    public static function selecionarTodos() 
    {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT * FROM contato");
        $stmt->execute(array());
        $contatos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $contatos;
    }

    public static function selecionarPorId($id) {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT * FROM contato WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $contato = $stmt->fetch(PDO::FETCH_OBJ);
        return $contato;
    }

    public static function inserir() {
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $idade = $_POST['idade'];
        $db = Conexao::connect();
        $stmt = $db->prepare("INSERT INTO contato (nome, sobrenome, idade) VALUES (? ,? ,?)");
        $stmt->execute(array(
            ':nome' => $nome,
            ':sobrenome' => $sobrenome,
            ':idade' => $idade
        ));
        echo $stmt->rowCount();
    }
}