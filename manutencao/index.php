<?php
include 'paginacao.php';

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['admin']) || !isset($_SESSION['senha_admin'])){
        header('Location: ./loginadmin.php');
}

$admin = $_SESSION['admin'];
$senha_admin = $_SESSION['senha_admin'];

if(!checarLoginAdmin($admin, $senha_admin)){
    header('Location: ./loginadmin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Página Inicial | Trabalho Back-end</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="../css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="../css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="../css/style.css"/>

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

		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Manutenção</h1>
                    <br>
                    <li><a href="./categorias.php">Categorias</a></li>
                    <li><a href="./produtos.php">Produtos</a></li>
                    <li><a href="./usuarios.php">Usuários</a></li>
                    <li><a href="./vendas.php">Vendas</a></li>
                    <li><a href="./relatorios.php">Relatorios</a></li>
                </div>
            </div>
        </div>
		

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
