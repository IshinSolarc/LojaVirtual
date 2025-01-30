<?php
include 'paginacao.php';

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

        <script>
            function filtrarCategoria() {
                var categoria = document.getElementById('categoria').value;
                if (categoria == -1) {
                    window.location.href = 'produtos.php';
                }
                else {
                    window.location.href = 'produtos.php?categoria=' + categoria;
                }
        }
        </script>

    </head>
	<body>
		<?php
			imprimirHeader();
			imprimirNav();
		?>
        <br>
        <div class="container">
        <?php
        if (isset($_GET['erro'])) {
            if ($_GET['erro'] == 1) {
                echo '<div class="alert alert-danger" role="alert">Erro ao adicionar categoria, ela já existe</div>';
            }
            else if ($_GET['erro'] == 2) {
                echo '<div class="alert alert-danger" role="alert">Erro ao remover categoria, existe um produto nela</div>';
            }
        }
        ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Relatórios</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>Produtos mais vendidos(ultimos 30 dias)</h3>
                    <table class="table">  
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Total Vendido(R$)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $produtos = listarProdutosMaisVendidos30Dias(5);
                            foreach ($produtos as $produto) {
                                echo '<tr>';
                                echo '<td>' . $produto[1] . '</td>';
                                echo '<td>' . $produto[7] . '</td>';
                                echo '<td>' . $produto[8] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3>Produtos menos vendidos(ultimos 30 dias)</h3>
                    <table class="table">  
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Total Vendido(R$)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $produtos = listarProdutosMenosVendidos30Dias(5);
                            foreach ($produtos as $produto) {
                                echo '<tr>';
                                echo '<td>' . $produto[1] . '</td>';
                                echo '<td>' . $produto[7] . '</td>';
                                echo '<td>' . $produto[8] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Produtos mais vendidos</h3>
                    <table class="table">  
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $produtos = listarProdutosMaisVendidos(5);
                            foreach ($produtos as $produto) {
                                echo '<tr>';
                                echo '<td>' . $produto[1] . '</td>';
                                echo '<td>' . $produto[7] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <h3>Produtos menos vendidos</h3>
                    <table class="table">  
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $produtos = listarProdutosMenosVendidos(5);
                            foreach ($produtos as $produto) {
                                echo '<tr>';
                                echo '<td>' . $produto[1] . '</td>';
                                echo '<td>' . $produto[7] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h3>Usuarios com maiores gastos</h3>
                    <table class="table">  
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Total Gasto(R$)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $usuarios = listarUsuariosComMaioresGastos30Dias(5);
                            foreach ($usuarios as $usuario) {
                                echo '<tr>';
                                echo '<td>' . $usuario[0] . '</td>';
                                echo '<td>' . $usuario[1] . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <br>
        




		

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
