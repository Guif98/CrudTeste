<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telefones</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Cadastros</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Telefones <span class="sr-only">(current)</span></a>
      </li>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
  </div>
</nav>
<table class="table container-fluid w-50 table-dark">
    <thead>
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Id_Contato</th>
        <th scope="col">Telefone</th>
        <th scope="col" colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$contato->id ?></td>
        <td><?=$contato->nome ?></td>
        <td><?=$contato->sobrenome ?></td>
        <td><?=$contato->idade ?></td>
        <td><a href="telefone.php">Telefone</a></td>
        <td><a  class="btn btn-danger" onclick="return confirm('Você deseja excluir?')" href="?excluir=<?=$contato->id?>">Excluir</a></td>
        <td><a class="btn btn-warning" href="?editar=<?=$contato->id?>">Editar</a></td>
    </tr>
</body>
</html>