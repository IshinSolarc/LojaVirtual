<?php
	include 'paginacao.php';

	if (isset($_GET['busca'])) {
		$busca = $_GET['busca'];
	};

	if (isset($_GET['categoria'])) {
		if ($_GET['categoria'] != -1) {
			$categoria = $_GET['categoria'];
		}
	}
	if (isset($busca) && $busca != '') {
		if(isset($categoria)) {
			$produtos = buscarProdutosPorCategoria($busca, $categoria);
		}
		else {
			$produtos = buscarProdutos($busca);
		}
	}
	else if (isset($categoria)) {
		$produtos = listarProdutosPorCategoria($categoria);
	}
	else {
		$produtos = listarProdutos();
	}


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Produtos | Trabalho Back-end</title>

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

		<style>
			#produto-nome {
				overflow: hidden;
				height: 1.2em;
				line-height: 1.2em;
				margin: 1em;
			}
			#produto-nome {
				overflow: hidden;
			}
		</style>

    </head>
	<body>
		<?php
			imprimirHeader();
			imprimirNav();

		?>
		<br>


		<div class="container">
			<div class="row row-centered">
				<div class="col-md-12">
					<div class="section-title">
						<?php
							if(isset($busca) && $busca != ''){
								echo '<h3 class="title">Resultados para: ' . $busca . '</h3>';
								echo '<br>';
							} 
							if(isset($categoria)){
								echo '<h3 class="title">Categoria: ' . pegarNomeCategoria($categoria) . '</h3>';
							}
							else {
								echo '<h3 class="title">Produtos</h3>';
							}
						?>
					</div>
				</div>
				<div class="row" id="lista-produtos">
				<?php
					echo imprimirListaDeProdutos($produtos);
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
