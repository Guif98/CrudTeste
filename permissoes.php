<?php 
require_once('database/Conexao.php');
require_once('controle/Contato.php'); 
require_once('controle/Login.php');
require_once('controle/Usuario.php');      
session_start();

if ($_SESSION['impedeF5'] != md5(implode('-',$_POST))) {
    $_SESSION['impedeF5'] = md5(implode('-',$_POST));
    if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    Login::autenticar();
    Usuario::criarUsuario();
    }
}

Login::permissao();

if (isset($_GET['excluir'])) {
    Usuario::excluirUsuario();
    header('location:permissoes.php');
}

if (isset($_GET['l']) && $_GET['l'] == 'sair') {
    $_SESSION['login'] = false;
}

if (isset($_SESSION['login']) && $_SESSION['login']) {
    
} else {
    header('location:login.php');
}

if (isset($_GET['search']) && $_GET['search'] != NULL) {
    $usuarios = Usuario::pesquisar($_GET['search']);
} else {
    $usuarios = Usuario::mostrarUsuarios();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissões</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="nav-link text-light" href="index.php">Cadastros</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <?php if ($_SESSION['permissao']->administrador) : ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="permissoes.php"><span class="sr-only">(current)</span>Permissões</a> 
        </ul>
    <?php endif; ?>
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link mr-4" href="?l=sair">Sair<span class="sr-only">(current)</span></a> 
        </ul>
    
    <form class="form-inline my-2 my-lg-0" action="#" method="GET">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Pesquisar" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" value="pesquisar" type="submit">Pesquisar</button>
    </form>
    </div>
    </nav>

    <!--Criação de usuário-->
    <div class="container-fluid w-50 mt-4 card-header bg-dark text-light">
        <div class="text-center"><h4>Criação de Usuário</h4></div>
        <form class="container-fluid w-50 mt-4 card-body" method="post" action="#">
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Crie um usuário">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha">
            </div>
            <button type="submit" class="btn btn-info">Criar</button>
        </form>
    </div>
    <div class="card container-fluid mt-4 w-50 bg-dark text-light">
        <div class="card-header card-title text-center">
            <h4>Permissões</h4>
        </div>
        <div class="card-body">
            <table class="table container-fluid table table-dark">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Usuário</th>
                    <?php if ($_SESSION['permissao']->editar || $_SESSION['permissao']->excluir): ?><th scope="col">Permissões</th>
                    <?php endif; ?>
                    <th scope="col" colspan="3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $usuario) { ?>
                        <tr>
                        <td><?=$usuario->id ?></td>
                        <td><?=$usuario->usuario ?></td>
                        <td> <div class="form-check">
                            <div>
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Inserir
                                </label>
                            </div>
                            <div>
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">
                                    Alterar
                                </label>
                            </div>   
                            <div> 
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">
                                    Editar
                                </label>
                            </div>    
                            <div>
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
                                <label class="form-check-label" for="defaultCheck4">
                                    Excluir
                                </label>
                            </div>
                            <div>    
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
                                <label class="form-check-label" for="defaultCheck5">
                                    Administrador
                                </label>
                            </div>
                        </div>
                        </td>
                        <td><a class="btn btn-info justify-content-center" name="salvar" href="?salvar=<?=$usuario->id?>">Salvar</a></td>
                        <td><a class="btn btn-warning justify-content-center" name="editar" href="?editar=<?=$usuario->id?>">Editar</a></td>
                        <td><a class="btn btn-danger justify-content-center" name="excluir" href="?excluir=<?=$usuario->id?>">Excluir</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>   
        </div>
    </div>
    
  
</body>
</html>