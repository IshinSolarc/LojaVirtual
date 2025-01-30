<?php
include 'paginacao.php';

if(!isset($_GET['id'])) {
    header('Location: categorias.php');
}

$id = $_GET['id'];
$nome_categoria = pegarNomeCategoria($id);
$nome_categoria = ucwords($nome_categoria);

if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
    $nome = $_GET['nome'];
    $resultado = editarCategoria($id, $nome);
    if ($resultado) {
        header('Location: categorias.php');
    }
    else {
        header('Location: editar_categoria.php?id=' . $id . '&erro=1 . $id=' . $id);
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
            <h1>Editar Categoria</h1>
        </div>
        <div class="container">
            <form action="editar_categoria.php" method="GET">
                <div class="form-group">
                    <label for="nome">Nome atual da categoria: <?php echo $nome_categoria ?></label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Novo nome da categoria" required>
                </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="acao" value="editar">
                <button type="submit" class="btn color-green btn-primary">Salvar</button>
            </form>
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
