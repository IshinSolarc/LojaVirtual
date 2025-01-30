<?php

include 'bancoSQL.php';

foreach ($_POST as $key => $value) {
    if (empty($value)) {
        header('Location: registrar.php?erro=2');
    }
}



if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['telefone']) && isset($_POST['primeironome']) &&
isset($_POST['sobrenome']) && isset($_POST['datanascimento']) && isset($_POST['cpf']) && isset($_POST['cidade']) && isset($_POST['bairro']) &&
 isset($_POST['endereco']) && isset($_POST['numero']) && isset($_POST['usuario'])) {
   $usuario = $_POST['usuario'];
   $email = $_POST['email'];
   $password = md5($_POST['senha']);
   $telefone = $_POST['telefone'];
   $primeironome = $_POST['primeironome'];
   $sobrenome = $_POST['sobrenome'];
   $datanascimento = $_POST['datanascimento'];
   $cpf = $_POST['cpf'];
   $cidade = $_POST['cidade'];
   $bairro = $_POST['bairro'];
   $endereco = $_POST['endereco'];
   $numero = $_POST['numero'];


   $resultado = registrarNovoUsuario($usuario, $password,$email,  $telefone, $primeironome, $sobrenome, $datanascimento, $cpf, $cidade, $bairro, $endereco, $numero);

    if ($resultado) {
         header('Location: login.php');
    } else {
         header('Location: registrar.php?erro=1');
    }
}
