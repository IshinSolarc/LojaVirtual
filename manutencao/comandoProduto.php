<?php
include '../bancoSQL.php';

$acao = $_POST['acao'];

if ($acao == 'novoproduto') {
    if (isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['categoria']) && isset($_FILES['imagemproduto'])) {

        //check if the file was uploaded
        if ($_FILES['imagemproduto']['error'] != 0) {
            header('Location: ./novo_produto.php?erro=3');
        }
        
        $img = $_FILES['imagemproduto'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        $extensao = pathinfo($img['name'], PATHINFO_EXTENSION);
        $cachebuster = gerarCacheBuster();

        $id = inserirProduto($nome, $categoria, $preco, $descricao, $extensao, $cachebuster);

        $nomeImg = $id . '-' . $cachebuster . '.' . $extensao;
        $caminho = '../imgproduto/' . $nomeImg;
        move_uploaded_file($img['tmp_name'], $caminho);
    

        header('Location: ./produtos.php');
    }
    else {
        header('Location: ./novo_produto.php?erro=4');
    }
}

if ($acao == 'removerproduto') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $caminho = '.' . pegarCaminhoImagemProduto($id);

        if (file_exists($caminho)) {
            unlink($caminho);
        }

        removerProduto($id);
    }

    header('Location: ./produtos.php');
}

if ($acao == 'editardados') {
    if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['descricao']) && isset($_POST['preco']) && isset($_POST['categoria'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $categoria = $_POST['categoria'];
        editarProduto($id, $nome, $descricao, $preco, $categoria);
    }

    header('Location: ./editar_produto.php?id=' . $id);
}

if ($acao == 'editarimagem') {
    if (isset($_POST['id']) && isset($_FILES['imagemproduto'])) {
        $id = $_POST['id'];
        $img = $_FILES['imagemproduto'];
        $extensao = pathinfo($img['name'], PATHINFO_EXTENSION);
        $caminho_antigo = '.' . pegarCaminhoImagemProduto($id);

        $cachebuster = gerarCacheBuster();
        editarImagemProduto($id, $extensao, $cachebuster);

        $nomeImg = $id . '-' . $cachebuster . '.' . $extensao;
        $caminho = '../imgproduto/' . $nomeImg;
        move_uploaded_file($img['tmp_name'], $caminho);

        if (file_exists($caminho_antigo)) {
            unlink($caminho_antigo);
        }
        
    }

    header('Location: ./editar_produto.php?id=' . $id);
}