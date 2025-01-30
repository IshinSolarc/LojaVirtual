<?php
include 'paginacao.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header('Location: login.php');
}

if (isset($_GET['id']) && isset($_GET['qtd'])){
    $id = $_GET['id'];
    $qtd = $_GET['qtd'];
    $produto = encontrarProduto($id);
}
else{
    return;
}
//to number
$qtd = (int)$qtd;
$preco = $produto[3];
$valor_total = $qtd * $preco; 
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
        <h2>Comprando</h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h3>Produto</h3>
                <p>Nome: <?php echo $produto[1]; ?></p>
                <p>Preço: R$ <?php echo $preco; ?></p>
                <p>Quantidade: <?php echo $qtd; ?></p>
                <p>Valor total: R$ <?php echo $valor_total; ?></p>
            </div>
            <div class="col-md-6">
                <h3>Endereço de entrega</h3>
                <form method="POST" action="pagamento.php" class="form-group">
                    <input type="hidden" name="idusuario" value="<?php echo $_SESSION['id']; ?>">
                    <input type="hidden" name="idproduto" value="<?php echo $id; ?>">
                    <input type="hidden" name="qtd" value="<?php echo $qtd; ?>">
                    <input type="hidden" name="valor_total" value="<?php echo $valor_total; ?>">
                    <input type="radio" name="endereco" value="1" checked>Endereço Cadastrado<br>
                    <h6>
                        <?php
                        $usuario = encontrarUsuario($_SESSION['id']);
                        echo $usuario[9] . ', ' . $usuario[11] . ', ' . $usuario[10] . ', ' . $usuario[12];
                        ?>
                    </h6>
                    <input type="radio" name="endereco" value="2" id="radio2">Outro Endereço<br>

                    <input type="text" name="cidade" placeholder="Cidade" class="form-control" id="e2"><br>
                    <input type="text" name="bairro" placeholder="Bairro" class="form-control" id="e2"><br>                    
                    <input type="text" name="rua" placeholder="Rua" class="form-control" id="e2"><br>
                    <input type="text" name="numero" placeholder="Número" class="form-control" id="e2"><br>

                    <button class="btn btn-primary" type="submit">Finalizar Compra</button>
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