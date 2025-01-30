<?php
	include 'paginacao.php';

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if($_SESSION['usuario'] == null)
	{
		header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Minha conta | Trabalho Back-end</title>

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

	<div class = "container">
		<div class = "row">
			<div class = "col-md-12">
				<h2>Minha conta</h2>
				<br>
				<p>Olá, <?php echo $_SESSION['usuario'] ?>!</p>
				<p>Seja bem-vindo à sua conta.</p>
				<p>Se deseja sair, clique <a href = "logout.php">aqui</a>.</p>
				<br>
				<h3>Seus pedidos</h3>
				<br>
				<?php
					$pedidos = listarVendasCompletaUsuario($_SESSION['id']);
					if($pedidos == null)
					{
						echo "<p>Você ainda não fez nenhum pedido.</p>";
					}
					else
					{
						echo "<table class = 'table'>";
						echo "<tr>";
						echo "<th>ID</th>";
						echo "<th>Produto</th>";
						echo "<th>Quantidade</th>";
						echo "<th>Valor total</th>";
						echo "<th>Pago com</th>";
						echo "<th>Endereço de entrega</th>";
						echo "</tr>";
						foreach($pedidos as $pedido)
						{
							echo "<tr>";
							echo "<td>".$pedido[0]."</td>";
							echo "<td>". encontrarProduto($pedido[2])[1]."</td>";
							echo "<td>".$pedido[3]."</td>";
							echo "<td>R$ ".$pedido[4]."</td>";
							echo "<td>".$pedido[5]."</td>";
							echo "<td>".$pedido[6]."</td>";
							echo "</tr>";
						}
						echo "</table>";
					}
				?>


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