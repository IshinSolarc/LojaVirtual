<?php

//destruir a sessao e redirecionar para a pagina de login
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['usuario'] = null;
$_SESSION['nome'] = null;
$_SESSION['id'] = null;

header("Location: login.php");