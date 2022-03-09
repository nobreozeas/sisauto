<?php 
session_start();
$loginError = '';
if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
	include 'admin/Invoice.php';
	$invoice = new Invoice();
	$user = $invoice->loginUsers($_POST['usuario'], $_POST['password']); 
	if(!empty($user)) {
		$_SESSION['usuario'] = $user[0]['usuario'];
		$_SESSION['id_usuario'] = $user[0]['id_usuario'];

		header("Location:admin/dash.php");
	} else {
		$loginError = "Usuario ou Senha Incorretos";
	}
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>


    

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="POST" action="">
    <img class="mb-4" src="imagens/logocar.png" alt="" width="200">
    <h1 class="h1 mb-3 fw-normal">Login</h1>
      <div class="form-group">
          <?php if($loginError){ ?>
            <div class="alert alert-warning"><?php echo $loginError;?></div>
            <?php } ?>
      </div>
    <div class="form-floating">
      <input type="text" class="form-control" name="usuario" id="usuario" placeholder="usuario" autofocus="on" required>
      <label >Usuário</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
      <label>Senha</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Entrar</button>
    <p class="mt-5 mb-3 text-muted">&copy; Nobre</p>
  </form>
</main>


    
  </body>
</html>

