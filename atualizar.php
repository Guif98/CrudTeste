<?php
    if (isset($_GET['atualizar'])) {
        Contato::atualizar();
    }
    
    print_r(Contato::selecionarPorId($_GET['id']));
    
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
    <form class="container-fluid w-50" action="index.php" method="post"> 
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input name="nome" type="text" class="form-control" id="nome" aria-describedby="emailHelp">
                </div>
            <div class="form-group col-md-6">
                <label for="sobrenome">Sobrenome</label>
                <input name="sobrenome" type="text" class="form-control" id="sobrenome">
            </div>
            <div class="form-group col-md-6">
                <label for="idade">Idade</label>
                <input name="idade" type="number" class="form-control" id="idade">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    </body>
</html>


