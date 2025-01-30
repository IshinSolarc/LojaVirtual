<?php
include 'bancoSQL.php';

function imprimirHeader() {
    $categorias = listarCategorias();

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $selectCategorias = [];
    foreach ($categorias as $categoria) {
        $id = $categoria[0];
        $nome = $categoria[1];
        //to title case
        $nome = ucwords($nome);
        $selectCategorias[] = '<option value="' . $id . '">' . $nome . '</option>';
    }

    $html = file_get_contents('./template/header.php');
    $html = str_replace('{InserirOutrasCategorias}', implode('', $selectCategorias), $html);

    if (isset($_SESSION['usuario'])) {
        $html = str_replace('{InserirEstadoSessao}', 'Minha Conta', $html);
    } else {
        $html = str_replace('{InserirEstadoSessao}', 'Login', $html);
    }


    echo $html;
}

function imprimirNav(){
    $html = file_get_contents('./template/navbar.php');
    echo $html;
}

function imprimirMaisRecentes(){
    $conjuntoProdutos = '';
    $maisRecentes = listarUltimosProdutos(10);
    //Nome, Id, Preço, Imagem, Categoria
    foreach ($maisRecentes as $produto) {
        $html_produto = file_get_contents('./template/produto.php');
        //index 0 = id, 1 = nome, 2 = descricao, 4 = preço, 5 = categoria
        $html_produto = str_replace('{InserirNomeProduto}', $produto[1], $html_produto);
        $html_produto = str_replace('{InserirIdProduto}', $produto[0], $html_produto);
        $html_produto = str_replace('{InserirPrecoProduto}', $produto[3], $html_produto);
        $html_produto = str_replace('{InserirCategoriaProduto}', pegarNomeCategoria($produto[4]), $html_produto);
        $caminho_imagem = pegarCaminhoImagemProduto($produto[0]);
        $html_produto = str_replace('{InserirImagemProduto}', $caminho_imagem, $html_produto);

        $conjuntoProdutos .= $html_produto;
    }

    $html = file_get_contents('./template/maisrecentes.php');
    $html = str_replace('{InserirProdutos}', $conjuntoProdutos, subject: $html);
    
    echo $html;
}

function imprimirMaisVendidos(){
    $conjuntoProdutos = '';
    $maisVendidos = listarProdutosMaisVendidos(5);
    //Nome, Id, Preço, Imagem, Categoria
    foreach ($maisVendidos as $produto) {
        $html_produto = file_get_contents('./template/produto.php');
        $html_produto = str_replace('{InserirNomeProduto}', $produto[1], $html_produto);
        $html_produto = str_replace('{InserirIdProduto}', $produto[0], $html_produto);
        $html_produto = str_replace('{InserirPrecoProduto}', $produto[3], $html_produto);
        $caminho_imagem = pegarCaminhoImagemProduto($produto[0]);
        $html_produto = str_replace('{InserirImagemProduto}', $caminho_imagem, $html_produto);
        $html_produto = str_replace('{InserirCategoriaProduto}', pegarNomeCategoria($produto[4]), $html_produto);
        $conjuntoProdutos .= $html_produto;
    }

    $html = file_get_contents('./template/maisvendidos.php');
    $html = str_replace('{InserirProdutos}', $conjuntoProdutos, $html);

    echo $html;
}

function pegarProdutosRelacionados($id) {
    $conjuntoProdutos = '';
    $relacionados = listarProdutosRelacionados($id, 5);
    foreach ($relacionados as $produto) {
        $conjuntoProdutos .= '<div class="col-md-3 col-xs-6">';
        $html_produto = file_get_contents('./template/produto.php');
        $html_produto = str_replace('{InserirNomeProduto}', $produto[1], $html_produto);
        $html_produto = str_replace('{InserirIdProduto}', $produto[0], $html_produto);
        $html_produto = str_replace('{InserirPrecoProduto}', $produto[3], $html_produto);
        $caminho_imagem = pegarCaminhoImagemProduto($produto[0]);
        $html_produto = str_replace('{InserirImagemProduto}', $caminho_imagem, $html_produto);
        $html_produto = str_replace('{InserirCategoriaProduto}', pegarNomeCategoria($produto[4]), $html_produto);
        $conjuntoProdutos .= $html_produto;
        $conjuntoProdutos .= '</div>';
    }

    return $conjuntoProdutos;
}

function imprimirFooter(){
    $html = file_get_contents('./template/footer.php');
    echo $html;
}

function imprimirLogin(){
    $html = file_get_contents('./template/tlogin.php');
    echo $html;
}

function imprimirPaginaProduto($id){
    $produto = encontrarProduto($id);
    $html = file_get_contents('./template/paginaproduto.php');
    $html = str_replace('{InserirIdProduto}', $produto[0], $html);
    $html = str_replace('{InserirNomeProduto}', $produto[1], $html);
    $html = str_replace('{InserirPrecoProduto}', $produto[3], $html);
    $html = str_replace('{InserirDescricaoProduto}', $produto[2], $html);
    $html = str_replace('{InserirCategoriaProduto}', pegarNomeCategoria($produto[4]), $html);
    $caminho_imagem = pegarCaminhoImagemProduto($produto[0]);
    $html = str_replace('{InserirImagemProduto}', $caminho_imagem, $html);
    $html = str_replace('{InserirIdCategoria}', $produto[4], $html);
    $produtos_relacionados = pegarProdutosRelacionados($id);
    $html = str_replace('{InserirProdutosRelacionados}', $produtos_relacionados, $html);
    echo $html;
}

function imprimirListaDeProdutos($produtos) {
    $conjuntoProdutos = '';
    foreach ($produtos as $produto) {
        if ($produto[0] == null) {
            continue;
        }
        $conjuntoProdutos .= '<div class="col-md-4">';
        $html_produto = file_get_contents('./template/produto.php');
        $html_produto = str_replace('{InserirNomeProduto}', $produto[1], $html_produto);
        $html_produto = str_replace('{InserirIdProduto}', $produto[0], $html_produto);
        $html_produto = str_replace('{InserirPrecoProduto}', $produto[3], $html_produto);
        $caminho_imagem = pegarCaminhoImagemProduto($produto[0]);
        $html_produto = str_replace('{InserirImagemProduto}', $caminho_imagem, $html_produto);
        $html_produto = str_replace('{InserirCategoriaProduto}', pegarNomeCategoria($produto[4]), $html_produto);
        $conjuntoProdutos .= $html_produto;
        $conjuntoProdutos .= '</div>';
    }

    return $conjuntoProdutos;
}

?>