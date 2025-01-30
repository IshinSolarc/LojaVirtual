<?php
include 'paginacao.php';

$categorias = listarCategorias();

if (! (isset($_POST['id']) || isset($_GET['id']))) {
    header('Location: ./produtos.php');
}


if (isset($_POST['id'])) {
    $id = $_POST['id'];
}
else {
    $id = $_GET['id'];
}

$produto = encontrarProduto($id);
$caminho_imagem = '.' . pegarCaminhoImagemProduto($id);


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
            <h1>Editando Produto - 
            <?php
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                }
                else {
                    $id = $_GET['id'];
                }
                $produto = encontrarProduto($id);
                echo $produto[1];
            ?>
            </h1>
        </div>
        <br>
        <div class="container">
            <h3>Editar Caracteristicas</h3>
        </div>
        <br>
        <div class="container">
            <form action="./comandoProduto.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="acao" value="editardados">
                <div class="form-group">
                    <label for="nome">Nome do produto</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produto[1]; ?>" required>

                    <label for="descricao">Descrição do produto</label>
                    <textarea class="form-control" id="descricao" name="descricao" required><?php echo $produto[2]; ?></textarea>

                    <label for="preco">Preço do produto</label>
                    <input type="number" class="form-control" id="preco" name="preco" step="0.01" value="<?php echo $produto[3]; ?>" required>

                    <label for="categoria">Categoria do produto</label>
                    <select class="form-control" id="categoria" name="categoria">
                        <?php
                        foreach ($categorias as $categoria) {
                            if ($categoria[0] == $produto[4]) {
                                echo '<option value="' . $categoria[0] . '" selected>' . $categoria[1] . '</option>';
                            }
                            else {
                                echo '<option value="' . $categoria[0] . '">' . $categoria[1] . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
        <br>

        <br>
        <div class="container">
            <h3>Editar Imagem</h3>
        </div>
        <div class="container d-inline-block">
            <div class="container">
                <h4>Imagem atual</h4>
                <img src="<?php echo $caminho_imagem; ?>" alt="Imagem do produto" class="img-thumbnail">
            </div>
            <br>
            <div class="container">
                <h4>Selecione uma nova imagem</h4>
            </div>
            <form action="./comandoProduto.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="acao" value="editarimagem">
                <div class="form-group">
                    <label for="imagemproduto">Nova imagem</label>
                    <input type="file" class="form-control-file" id="imagemproduto" name="imagemproduto" accept="image/*" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
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
