<?php

class Login
{
    public static function autenticar() 
    {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT usuario_id, inserir, alterar, editar, excluir FROM usuarios, permissao WHERE usuarios.id = permissao.usuario_id OR usuario = ? AND senha = md5(?)");
        $stmt->execute(array(
            $usuario, $senha
        ));
        if ($stmt->rowCount()==1) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $stmt->fetch(PDO::FETCH_OBJ)->usuario_id;
            $_SESSION['permissao'] = $stmt->fetch(PDO::FETCH_OBJ);
        }
    }

    public static function permissao() 
    {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT usuario_id, inserir, alterar, editar, excluir, administrador FROM usuarios, permissao WHERE usuarios.id = permissao.usuario_id AND usuarios.id = ?");
        $stmt->execute(array(
            $_SESSION['id']
        ));
        if ($stmt->rowCount()==1) {
            $_SESSION['permissao'] = $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
}