<?php
include 'paginacao.php';

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];
    if ($acao == 'novacategoria') {
        $resultado = 0;
        if (isset($_POST['nome'])) {
            $resultado = novaCategoria($_POST['nome']);
        }
        if (!$resultado) {
            header('Location: categorias.php?erro=1');
        }
        else 
        {
            header('Location: categorias.php');
        }
    }
    else if ($acao == 'removercategoria') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $resultado = removerCategoria($id);
            if (!$resultado) {
                header('Location: categorias.php?erro=2');
            }
        }
        else {
            header('Location: categorias.php');
        }
    }

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
            <h1>Categorias</h1>
        </div>
        <form class="container" method="post" action="categorias.php?acao=novacategoria">
            <div class="form-group">
                <label for="nome">Nome da categoria</label>
                <input type="text" class="form-control width-80p" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn color-green btn-primary">Adicionar</button>
        </form>
        <div class="container mt-5">
            <table id="tabela-categorias" class="table table-striped">  
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $categorias = listarCategorias();
                    //sort by Id
                    usort($categorias, function($a, $b) {
                        return $a[0] <=> $b[0];
                    });
                    foreach ($categorias as $categoria) {
                        echo '<tr>';
                        echo '<td>' . ucwords($categoria[1]) . '</td>';
                        echo '<td><a href="categorias.php?acao=removercategoria&id=' . $categoria[0] . '">Remover</a>
                                  <a href="editar_categoria.php?id=' . $categoria[0] . '">Editar</a>
                             </td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
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
