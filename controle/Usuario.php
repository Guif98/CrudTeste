<?php

class Usuario
{
    public static function mostrarUsuarios()
    {
        $db = Conexao::connect();
        $stmt = $db->prepare("SELECT usuarios.id, usuario, inserir, alterar, editar, excluir, administrador FROM usuarios LEFT JOIN permissao ON usuarios.id = permissao.usuario_id ");
        $stmt->execute(array());
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $usuarios;
    }

    public static function mostrarPorId($id)
    {
        try {
            $db = Conexao::connect();
            $stmt = $db->prepare("SELECT usuarios.id, usuario, senha, inserir, alterar, editar, excluir, administrador FROM usuarios LEFT JOIN permissao ON usuarios.id = permissao.usuario_id WHERE usuarios.id = ?");
            //$stmt->bindParam(':id', $id);
            $stmt->execute(array(
                $id
            ));
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            return $usuario;
        } catch (\PDOException $th) {
            echo $th->getMessage();
        }
    }

    public static function pesquisar()
    {
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
            $stmt = $db->prepare("DELETE FROM permissao WHERE usuario_id = ?");
            $stmt->execute(array($id));
        } catch (\PDOException $th) {
            echo "Error: ", $th->getMessage();
        }
    }

    public static function atualizar()
    {
        $id = $_POST['id'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $opcoes = $_POST['opcao'];
        $permissoes = ['inserir' => 0, 'alterar' => 0, 'editar' => 0, 'excluir' => 0, 'administrador' => 0];
        $db = Conexao::connect();
        $parametros = array();

        if (strlen($id) > 1) {
            $stmt = $db->prepare("UPDATE usuarios SET usuario=?, senha=md5(?) WHERE id = ?");
            $stmt->execute(array(
                $usuario, $senha, $id
            ));
            foreach ($permissoes as $key => $value) {
                if (in_array($key, $opcoes)) {
                    $permissoes[$key] = 1;
                }
            }
            $stmt = $db->prepare("UPDATE permissao SET inserir=?, alterar=?, editar=?, excluir=?, administrador=? WHERE usuario_id = ?");
            $permissoes[] = $id;
            foreach ($permissoes as $key => $value) {
                $parametros[] = $value;
            }
            $stmt->execute(
                $parametros
            );

        } else {
            $stmt = $db->prepare("INSERT INTO  usuarios(usuario, senha) VALUES (?,md5(?))");
            $stmt->execute(array(
                $usuario, $senha
            ));
            $parametros[] = $db->lastInsertId();
            
            foreach ($permissoes as $key => $value) {
                if (in_array($key, $opcoes)) {
                    $permissoes[$key] = 1;
                }
            }
            foreach ($permissoes as $key => $value) {
                $parametros[] = $value;
            }
            $stmt = $db->prepare("INSERT INTO  permissao(usuario_id, inserir, alterar, editar, excluir, administrador) VALUES (?,?,?,?,?,?)");
            $stmt->execute(
                $parametros
            );
        }
    }

    public static function salvar()
    {
        try {
            $id = $_POST['id'];
            $inserir = $_POST['opcao'];
            $alterar = $_POST['opcao'];
            $editar = $_POST['opcao'];
            $excluir = $_POST['opcao'];
            $administrador = $_POST['opcao'];
            $db = Conexao::connect();
            $stmt = $db->prepare("UPDATE permissao SET inserir=?, alterar=?, editar=?, excluir=?, administrador=? WHERE usuario_id=?");
            $stmt->execute(array(
                $inserir, $alterar, $editar, $excluir, $administrador, $id
            ));
        } catch (\PDOException $th) {
            echo "Error: ", $th->getMessage();
        }
    }
}
