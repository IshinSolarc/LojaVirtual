<?php
	include 'paginacao.php';

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if (isset($_SESSION['usuario'])) {
		header('Location: ./minhaconta.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Log in | Trabalho Back-end</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
	<?php
    imprimirHeader();
    imprimirNav();
	?>

	<br>
	<br>

	<div id="login" class="container">
		<div class="card shadow p-4"></div>
			<h3 class="text-center mb-5">Login</h3>
			<br>
			<?php
			if (isset($_GET['erro'])) {
				if ($_GET['erro'] == 1) {
					echo '<div class="alert alert-danger" role="alert">Usuário ou senha inválidos</div>';
				}
			}
			?>
			<form id="loginForm" action="./conectar.php" method="POST">
				<div class="mb-3">
					<label for="usuario" class="form-label">Usuario</label>
					<input type="text" class="form-control" id="usuario" placeholder="Digite seu usuario" required name="usuario">
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Senha</label>
					<input type="password" class="form-control" id="password" placeholder="Digite sua senha" required name="senha">
				</div>
				<br>
				<button type="submit" class="btn btn-primary w-100">Login</button>
			</form>
			<br>
			<div class="text-center mt-3">
				<small>Não tem uma conta? <a href="./registrar.php">Registre-se</a></small>
			</div>
		</div>
	</div>



	<?php
    imprimirFooter();

    ?>
		

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/nouislider.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>