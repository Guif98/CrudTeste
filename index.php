<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    require_once('database/Conexao.php');
    require_once('modelo/inserir.php');
    require_once('controle/Contato.php');
    $contatos = Contato::selecionarTodos();

    
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
    <form class="container-fluid w-50" action="modelo/inserir.php" method="post"> 
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input name='nome' type="text" class="form-control" id="nome" aria-describedby="emailHelp">
            </div>
        <div class="form-group col-md-6">
            <label for="sobrenome">Sobrenome</label>
            <input name='sobrenome' type="text" class="form-control" id="sobrenome">
        </div>
        <div class="form-group col-md-6">
            <label for="idade">Idade</label>
            <input name='idade' type="number" class="form-control" id="idade">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Nome</th>
        <th scope="col">Sobrenome</th>
        <th scope="col">Idade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($contatos as $contato) { ?>
            <tr>
            <td><?=$contato->id ?></td>
            <td><?=$contato->nome ?></td>
            <td><?=$contato->sobrenome ?></td>
            <td><?=$contato->idade ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>     
    </body>
</html>