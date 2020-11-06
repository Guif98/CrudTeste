<?php
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    
    require_once('database/Conexao.php');
    require_once('controle/Contato.php');       
    session_start();

    if ($_SESSION['impedeF5'] != md5(implode('-',$_POST))) {
        $_SESSION['impedeF5'] = md5(implode('-',$_POST));
        if (isset($_POST['nome']) && isset($_POST['sobrenome']) && isset($_POST['idade'])) {
            if (strlen($_POST['id'] > 1)) {
                Contato::atualizar();
                $_SESSION['message'] = "Cadastro atualizado";
                $_SESSION['msg_type'] = "warning";
            } else {
                Contato::inserir();
                $_SESSION['message'] = "Cadastro concluído";
                $_SESSION['msg_type'] = "success";
            }
        }
    }     
    if (isset($_GET['excluir'])) {
        Contato::excluir();
        $_SESSION['message'] = "Cadastro Excluído";
        $_SESSION['msg_type'] = "danger";
        header('location:index.php');
    }
    if (isset($_GET['editar'])) {
        $contatoform = Contato::selecionarPorId($_GET['editar']);
        
    }
   
    if (isset($_GET['search']) && $_GET['search'] != NULL) {
        $contatos = Contato::pesquisar($_GET['search']);
    } else {
        $contatos = Contato::selecionarTodos();
    }
?>    
<!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    
    <body>
        <?php
            if (isset($_SESSION['message']) && strlen($_SESSION['message']) > 0): ?>
            <div class="alert alert-<?= $_SESSION['msg_type']; ?>">
                <p><?php echo $_SESSION['message'];
                ?></p>
            </div>
            <?php endif; ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="nav-link text-light" href="index.php">Cadastros</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="telefone.php">Telefones<span class="sr-only">(current)</span></a> 
    </ul>
    <form class="form-inline my-2 my-lg-0" action="#" method="GET">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Pesquisar" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" value="pesquisar" type="submit">Pesquisar</button>
    </form>
  </div>
</nav>
    <form class="container-fluid w-50" action="#" method="post"> 
    <div class="row">
    <input type="hidden" name="id" value="<?php echo(isset($contatoform->id))? $contatoform->id : NULL; ?>">

        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input name="nome"  value="<?php echo(isset($contatoform->nome))? $contatoform->nome : ''; ?>" type="text" class="form-control" id="nome" placeholder="Digite o seu nome">
            </div>
        <div class="form-group col-md-6">
            <label for="sobrenome">Sobrenome</label>
            <input name="sobrenome" value="<?php echo(isset($contatoform->sobrenome))? $contatoform->sobrenome : ''; ?>" type="text" class="form-control" id="sobrenome" placeholder="Digite o seu sobrenome">
        </div>
        <div class="form-group col-md-6">
            <label for="idade">Idade</label>
            <input name="idade" value="<?php echo(isset($contatoform->idade))? $contatoform->idade : ''; ?>" type="number" class="form-control" id="idade" placeholder="Digite sua idade">
        </div>
        <div class="form-group col-md-6">
            <label for="Telefone">Telefone</label>
            <input name="telefone" value="<?php echo(isset($contatoform->telefone))? $contatoform->telefone : ''; ?>" type="tel" class="form-control" id="telefone" placeholder="Digite seu telefone">
        </div>
    </div>
    <?php if (isset($_GET['editar'])): ?>
        <button type="submit" class="btn btn-info" name="atualizar">Atualizar</button> 
    <?php else: ?>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <?php endif; ?>
    </form>
    <hr>
    <table class="table container-fluid w-50 table-dark">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Sobrenome</th>
        <th scope="col">Idade</th>
        <th scope="col">Telefone</th>
        <th scope="col" colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($contatos as $contato) { ?>
            <tr>
            <td><?=$contato->id ?></td>
            <td><?=$contato->nome ?></td>
            <td><?=$contato->sobrenome ?></td>
            <td><?=$contato->idade ?></td>
            <td><?=$contato->telefone ?></td>
            <td><a  class="btn btn-danger" onclick="return confirm('Você deseja excluir?')" href="?excluir=<?=$contato->id?>">Excluir</a></td>
            <td><a class="btn btn-warning" href="?editar=<?=$contato->id?>">Editar</a></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>   
      
    </body>
    
</html>