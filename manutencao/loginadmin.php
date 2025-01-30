<?php
	include 'paginacao.php';

    if(!isset($_SESSION)){
        session_start();
    }

    if(isset($_POST['usuario']) && isset($_POST['senha'])){
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $senha = md5($senha);
        
        $resultado = checarLoginAdmin($usuario, $senha);
        if(!$resultado){
            header('Location: ./loginadmin.php');
        }
        else{
            $_SESSION['admin'] = $usuario;
            $_SESSION['senha_admin'] = $senha;
            header('Location: ./index.php');
        }
    }
    
    if(isset($_SESSION['admin']) && isset($_SESSION['senha_admin'])){
        $resultado = checarLoginAdmin($_SESSION['admin'], $_SESSION['senha_admin']);
        if($resultado == false){
            $_SESSION['admin'] = null;
            $_SESSION['senha_admin'] = null;
            header('Location: ./loginadmin.php');
        }
        else{
            header('Location: ./index.php');
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
    ?>

    <div class="container m-10">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login Admin</h3>
                    </div>
                    <div class="panel-body text-center">
                        <form method="post" action="loginadmin.php">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Usuário" name="usuario">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Senha" name="senha">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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