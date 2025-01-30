<?php
include 'bancoSQL.php';
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha = md5($senha);
$conn = conectar();
$sql = "SELECT * FROM usuario WHERE usuario = :usuario AND senha = :senha";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':senha', $senha);
$stmt->execute();
$resultado = $stmt->fetchAll();
fecharConexao($conn);
if (count($resultado) > 0) {
    session_start();
    $_SESSION['usuario'] = $usuario;
    $_SESSION['nome'] = $resultado[0][2];
    $_SESSION['id'] = $resultado[0][0];
    header('Location: index.php');
} else {
    header('Location: login.php?erro=1');
}

