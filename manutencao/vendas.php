<?php
include 'paginacao.php';

$vendas = listarVendas();
usort($vendas, function($a, $b) {
    return $b[7] <=> $a[7];
});


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
            <h1>Vendas</h1>
        </div>

        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor total</th>
                    <th>Pago com</th>
                    <th>Usuário</th>
                    <th>Data</th>
                </tr>
                </thead>
                <?php
                $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
                $registros = 10;
                $total_paginas = ceil(count($vendas)/$registros);
                $inicio = ($registros*$pagina)-$registros;
                $vendas = array_slice($vendas, $inicio, $registros);
                foreach ($vendas as $venda) {
                    echo '<tr>';
                    echo '<td>' . encontrarProduto($venda[2])[1] . '</td>';
                    echo '<td>' . $venda[3] . '</td>';
                    echo '<td>R$ ' . $venda[4] . '</td>';
                    echo '<td>' . $venda[5] . '</td>';
                    echo '<td>' . encontrarUsuario($venda[1])[1] . '</td>';
                    echo '<td>' . $venda[7] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </div>
        <div class="container">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    if($pagina > 1){
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pagina-1).'">Anterior</a></li>';
                    }
                    for($i = 0; $i < $total_paginas; $i++){
                        if($pagina == $i+1){
                            echo '<li class="page-item active"><a class="page-link" href="?pagina='.($i+1).'">'.($i+1).'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" href="?pagina='.($i+1).'">'.($i+1).'</a></li>';
                        }
                    }
                    if($pagina < $total_paginas){
                        echo '<li class="page-item"><a class="page-link" href="?pagina='.($pagina+1).'">Próximo</a></li>';
                    }


                    ?>
                </ul>
            </nav>
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
