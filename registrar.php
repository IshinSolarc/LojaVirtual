<?php
	include 'paginacao.php';

    if(!isset($_SESSION))
    {
        session_start();
    }

    if(isset($_SESSION['usuario']))
    {
        header('Location: minhaconta.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Registrar | Trabalho Back-end</title>

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

    <div id="login" class="container">
        <div class="card shadow p-4">
            <h3 class="text-center mb-5">Registrar</h3>
            <br>
        </div>
        <?php
        if (isset($_GET['erro'])) {
            if ($_GET['erro'] == 1) {
                echo '<div class="alert alert-danger" role="alert">Erro ao registrar usuário. Tente novamente.</div>';
            }
        }
        ?>
            <form id="loginForm" action="./fazerRegistro.php" method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Digite seu usuário" required name="usuario">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Digite seu email" required name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required name="senha">
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" placeholder="Digite seu telefone" required name="telefone">
                </div>
                <div class="mb-3">
                    <label for="primeironome" class="form-label">Primeiro Nome</label>
                    <input type="text" class="form-control" id="primeironome" placeholder="Digite seu primeiro nome" required name="primeironome">
                </div>
                <div class="mb-3">
                    <label for="sobrenome" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control" id="sobrenome" placeholder="Digite seu sobrenome" required name="sobrenome">
                </div>
                <div class="mb-3">
                    <label for="datanascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="datanascimento" placeholder="Digite sua data de nascimento" required name="datanascimento">
                </div>
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="Digite seu CPF" required name="cpf">
                </div>
                <div class="mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" placeholder="Digite sua cidade" required name="cidade">
                </div>
                <div class="mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" placeholder="Digite seu bairro" required name="bairro">
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" placeholder="Digite seu endereço" required name="endereco">
                </div>
                <div class="mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="number" class="form-control" id="numero" placeholder="Digite seu número" required name="numero">
                </div>
                <br>
                <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </form>
            <br>
            <div class="text-center mt-3">
                <small>Já tem uma conta? <a href="./login.php">Login</a></small>
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