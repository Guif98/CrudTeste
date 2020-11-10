<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
	<br>
	<div class="card container-fluid w-50 bg-secondary text-light">
	<article class="card-body">
		<h4 class="card-title text-center mb-4 mt-1">Login</h4>
		<hr>
		<form method="POST" action="index.php">
		<div class="form-group">
			<label for="usuario_login" class="font-weight-bold">Usuário</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="glyphicon glyphicon-user"></i></span>
			</div>
			<input name="usuario" class="form-control" placeholder="Digite seu usuário" type="text">
		</div> <!-- input-group.// -->
		</div> <!-- form-group// -->
		<div class="form-group">
			<label for="usuario_login" class="font-weight-bold">Senha</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
			<input class="form-control" name="senha" placeholder="Digite sua senha" type="password">
		</div> <!-- input-group.// -->
		</div> <!-- form-group// -->
		<div class="form-group">
		<button type="submit" class="btn btn-primary btn-block"> Entrar  </button>
		</div> <!-- form-group// -->
		<p class="text-center"><a href="#" class="btn text-light">Esqueceu sua senha?</a></p>
		</form>
	</article>
	</div> <!-- card.// -->
	</body>
</html>