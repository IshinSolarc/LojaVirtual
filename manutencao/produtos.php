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
            <h1>Produtos</h1>
        </div>
        <div class="container d-flex flex-row">
            <div class="p-2">
                <a href="novo_produto.php" class="d-inline-flex">
                    <button type="button" class="btn btn-primary d-inline-flex " data-toggle="modal" data-target="#modal-novacategoria">
                        Novo Produto
                    </button>
                </a>
            </div>
        </div>

        <br>

        <div class="container d-flex flex-row p-2">
            <div class="p-2">
                <select class="form-control" id="categoria" name="categoria" onchange="filtrarCategoria()">
                    <option value="-1">Todas as categorias</option>
                    <?php
                    $categorias = listarCategorias();
                    foreach ($categorias as $categoria) {
                        if (isset($_GET['categoria']) && $_GET['categoria'] == $categoria[0]) {
                            echo '<option value="' . $categoria[0] . '" selected>' . $categoria[1] . '</option>';
                        }
                        else
                            echo '<option value="' . $categoria[0] . '">' . $categoria[1] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        
        <br>

        <div class="container mt-5">
            <table id="tabela-produtos" class="table table-striped">  
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($_GET['categoria'])) {
                            $produtos = listarProdutosPorCategoria($_GET['categoria']);
                        }
                        else {
                            $produtos = listarTodosProdutos();
                        }

                        foreach ($produtos as $produto) {
                            echo '<tr>';
                            echo '<td>' . $produto[0] . '</td>';
                            echo '<td>' . $produto[1] . '</td>';
                            echo '<td>' . $produto[3] . '</td>';
                            echo '<td>' . pegarNomeCategoria($produto[4]) . '</td>';
                            echo '<td><form action="editar_produto.php" method="POST" class="d-inline-flex">
                                        <input type="hidden" name="id" value="' . $produto[0] . '">
                                        <button type="submit" class="btn btn-link">Editar</button>
                                        </form>
                                        <form action="comandoProduto.php" method="POST" class="d-inline-flex">
                                        <input type="hidden" name="id" value="' . $produto[0] . '">
                                        <input type="hidden" name="acao" value="removerproduto">
                                        <button type="submit" class="btn btn-link">Remover</button>
                                        </form>
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
