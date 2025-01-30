<?php

include 'paginacao.php';

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}

if(!isset($_POST['endereco'])){
    header('Location: index.php');
}

$usuario = encontrarUsuario($_SESSION['id']);
$produto = encontrarProduto($_POST['idproduto']);

if($_POST['endereco'] == 1){
    $endereco = $usuario[9] . ', ' . $usuario[11] . ', ' . $usuario[10] . ', ' . $usuario[12];
}
if($_POST['endereco'] == 2){
    $endereco = $_POST['numero'] . ', ' . $_POST['rua'] . ', ' . $_POST['bairro'] . ', ' . $_POST['cidade'];
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Pagamento | Trabalho Back-end</title>

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
    <div class="container">
        <h1>Pagamento da compra</h1>
        <br>
        <h2>Confira os dados da sua compra</h2>
        <br>
        <h3>Produto</h3>
        <p><?php echo $produto[1]; ?></p>
        <br>
        <h3>Quantidade</h3>
        <p><?php echo $_POST['qtd']; ?></p>
        <br>
        <h3>Valor total</h3>
        <p>R$ <?php echo $_POST['valor_total']; ?></p>
        <br>
        <h3>Endereço de entrega</h3>
        <p><?php echo $endereco; ?></p>
        <br>
        <br>
        <h3>Forma de pagamento</h3>
        <form action="executarvenda.php" method="post">
            <input type="radio" name="pagamento" value="MercadoPago" required> Mercado Pago
            <br>
            <input type="radio" name="pagamento" value="Pix" required> Pix
            <br>
            <input type="radio" name="pagamento" value="Boleto" required> Boleto
            <br>
            <br>
            <input type="hidden" name="endereco" value="<?php echo $endereco; ?>">
            <input type="hidden" name="produto" value="<?php echo $_POST['idproduto']; ?>">
            <input type="hidden" name="qtd" value="<?php echo $_POST['qtd']; ?>">
            <input type="hidden" name="valor_total" value="<?php echo $_POST['valor_total']; ?>">            

            <button type="submit" class="btn btn-primary">Finalizar compra</button>
        </form>

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