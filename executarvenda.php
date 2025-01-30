<?php

include 'paginacao.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}

if(!isset($_POST['endereco'])){
    header('Location: index.php');
}

$usuario = encontrarUsuario($_SESSION['id']);

$produto = encontrarProduto($_POST['produto']);

$endereco = $_POST['endereco'];

$valor_total = $_POST['valor_total'];

$metodo_pagamento = $_POST['pagamento'];

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Comprando | Trabalho Back-end</title>

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

        <script>
            document.getElementById("radio2").addEventListener('change', function(){
            document.getElementById("e2").required = this.checked ;
            });
        </script>
    </head>
	<body>
	<?php
    imprimirHeader();
    imprimirNav();
	?>

    <br>
    <div class="container">
        <h2>Pagando com <?php echo $metodo_pagamento; ?></h2>
        <div class="row">
            <div class="col-md-6">

            <h3>Imagine que aqui tem o metodo de pagamento do <?php echo $metodo_pagamento; ?></h3>

            <br>

            <form action="finalizarvenda.php" method="post">
                <input type="hidden" name="usuario" value="<?php echo $usuario[0]; ?>">
                <input type="hidden" name="produto" value="<?php echo $produto[0]; ?>">
                <input type="hidden" name="qtd" value="<?php echo $_POST['qtd']; ?>">
                <input type="hidden" name="valor_total" value="<?php echo $valor_total; ?>">
                <input type="hidden" name="endereco" value="<?php echo $endereco; ?>">
                <input type="hidden" name="pagamento" value="<?php echo $metodo_pagamento; ?>">
                <button type="submit" class="btn btn-primary">Finalizar compra</button>
            </form>
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
<st src="js/main.js"></script>

</body>
</html>