<?php

use function PHPSTORM_META\type;

$host = "localhost";
$port = "3306";
$username = "root";
$password = "";
$dbname = "trabalho";
$dsn = "mysql:host=$host;port=$port;dbname=$dbname";

function conectar(){
    global $dsn, $username, $password;
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    return null;
}

function fecharConexao(&$conn){
    $conn = null;
}

function listarUltimosProdutos($quantidade) {
    $conn = conectar();
    $sql = "SELECT * FROM produto ORDER BY id DESC LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function listarProdutosPorCategoria($categoria) {
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE categoriaId = :categoria";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function listarCategorias() {
    $categorias = array();
    $conn = conectar();
    $sql = "SELECT * FROM categoria";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categorias = $stmt->fetchAll();
    fecharConexao($conn);
    usort($categorias, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $categorias;
}

function listarProdutosMaisVendidos($quantidade) {
    $conn = conectar();
    $sql = "SELECT ProdutoId, SUM(Quantidade) as total FROM venda GROUP BY ProdutoId ORDER BY total DESC LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();

    $produtos_completos = array();
    foreach ($produtos as $produto) {
        $sql = "SELECT * FROM produto WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $produto[0]);
        $stmt->execute();
        $produtos_completos[] = $stmt->fetch();
    }

    for($i = 0; $i < count($produtos_completos); $i++){
        $produtos_completos[$i][] = $produtos[$i][1];
    }


    fecharConexao($conn);
    return $produtos_completos;
}

function listarProdutosMenosVendidos($quantidade) {
    $conn = conectar();
    $sql = "SELECT ProdutoId, SUM(Quantidade) as total FROM venda GROUP BY ProdutoId ORDER BY total ASC LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();

    $sql = "SELECT * FROM produto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos_completos = $stmt->fetchAll();

    for($i = 0; $i < count($produtos_completos); $i++){
        $produtos_completos[$i][] = 0;
        for($j = 0; $j < count($produtos); $j++){
            if($produtos_completos[$i][0] == $produtos[$j][0]){
                $produtos_completos[$i][7] = $produtos[$j][1];
                break;
            }
        }
    }

    usort($produtos_completos, function($a, $b) {
        return $a[7] <=> $b[7];
    });

    $produtos_completos = array_slice($produtos_completos, 0, $quantidade);




    fecharConexao($conn);
    return $produtos_completos;
}

function venderProduto($id_usuario, $id_produto, $quantidade, $valor_total, $metodo_pagamento, $endereco){
    $conn = conectar();
    $sql = "INSERT INTO venda (UsuarioId, ProdutoId, Quantidade, Valor, Metodo_Pagamento, Endereco) VALUES (:id_usuario, :id_produto, :quantidade, :valor_total, :metodo_pagamento, :endereco)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':valor_total', $valor_total);
    $stmt->bindParam(':metodo_pagamento', $metodo_pagamento);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->execute();



    fecharConexao($conn);
    return $stmt->errorCode();

    if ($stmt->errorCode() == 0) {
        return true;
    }
    else {
        return false;
    }
}
  


function inserirProduto($nome, $categoria, $preco, $descricao, $imagemext, $cachebuster) {
    $descricao = str_replace("\n", "<br>", $descricao);
    $descricao = str_replace("\r", "", $descricao);
    $descricao = str_replace("\r\n", "<br>", $descricao);
    
    $conn = conectar();
    $sql = "INSERT INTO produto (nome, categoriaId, preco, descricao, imagemext, cachebuster) VALUES (:nome, :categoria, :preco, :descricao, :imagemext, :cachebuster)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':imagemext', $imagemext);
    $stmt->bindParam(':cachebuster', $cachebuster);
    echo $stmt->queryString;
    $stmt->execute();
    $id = $conn->lastInsertId();
    fecharConexao($conn);
    // pegar o id do produto inserido e retornar
    return $id;
}

function pegarNomeCategoria($id) {
    $conn = conectar();
    $sql = "SELECT * FROM categoria WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        return "Categoria não encontrada";
    }

    $categoria = $stmt->fetch();
    fecharConexao($conn);
    $nome = $categoria[1];

    return $nome;
}

function removerProduto($id) {
    $conn = conectar();
    $sql = "DELETE FROM produto WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    fecharConexao($conn);
}

function encontrarProduto($id) {
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch();
    fecharConexao($conn);
    return $produto;
}

function listarVendas() {
    $conn = conectar();
    $sql = "SELECT * FROM venda";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $vendas = $stmt->fetchAll();
    fecharConexao($conn);
    return $vendas;
}

function checarLoginAdmin($usuario, $senha) {
    $conn = conectar();
    $sql = "SELECT * FROM admin WHERE username = :usuario AND senha = :senha";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $admin = $stmt->fetch();
    fecharConexao($conn);
    return $admin;
}

function adicionarNovoAdmin($usuario, $senha) {
    $conn = conectar();
    $sql = "INSERT INTO admin (username, senha) VALUES (:usuario, :senha)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    fecharConexao($conn);
}

function listarAdmins() {
    $conn = conectar();
    $sql = "SELECT * FROM admin";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $admins = $stmt->fetchAll();
    fecharConexao($conn);
    return $admins;
}

function novaCategoria($nome) {
    $conn = conectar();

    $sql = "SELECT * FROM categoria WHERE nome = :nome";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return false;
    }

    $sql = "INSERT INTO categoria (nome) VALUES (:nome)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->execute();
    $idretorno = $conn->lastInsertId();
    fecharConexao($conn);
    return $idretorno;
}

function removerCategoria($id) {
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE categoriaId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return false;
    }
    

    $sql = "DELETE FROM categoria WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    fecharConexao($conn);

    return true;
}

function editarCategoria($id, $nome) {
    $conn = conectar();
    $sql = "UPDATE categoria SET nome = :nome WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    fecharConexao($conn);

    if ($stmt->rowCount() > 0) {
        return true;
    }
    else {
        return false;
    }
}

function listarTodosProdutos() {
    $conn = conectar();
    $sql = "SELECT * FROM produto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function editarProduto($id, $nome, $descricao, $preco, $categoria) {
    $descricao = str_replace("\n", "<br>", $descricao);
    $descricao = str_replace("\r", "", $descricao);
    $descricao = str_replace("\r\n", "<br>", $descricao);
    
    $conn = conectar();
    $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco, categoriaId = :categoria WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    fecharConexao($conn);
}

function editarImagemProduto($id, $extensao, $cachebuster) {
    $conn = conectar();
    $sql = "UPDATE produto SET imagemext = :extensao, cachebuster = :cachebuster WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':extensao', $extensao);
    $stmt->bindParam(':cachebuster', $cachebuster);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    fecharConexao($conn);
}

function gerarCacheBuster() {
    return time();
}

function pegarCaminhoImagemProduto($id){
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch();
    fecharConexao($conn);
    $caminho = './imgproduto/' . $produto[0] . '-' . $produto[6] . '.' . $produto[5];
    return $caminho;
}

function listarProdutosRelacionados($id, $quantidade) {
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE categoriaId = (SELECT categoriaId FROM produto WHERE id = :id) AND id != :id LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function buscarProdutos($busca) {
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE nome LIKE :busca";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':busca', '%' . $busca . '%');
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function buscarProdutosPorCategoria($busca, $categoria) {
    $conn = conectar();
    $sql = "SELECT * FROM produto WHERE nome LIKE :busca AND categoriaId = :categoria";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':busca', '%' . $busca . '%');
    $stmt->bindParam(':categoria', $categoria);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function listarProdutos() {
    $conn = conectar();
    $sql = "SELECT * FROM produto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    fecharConexao($conn);
    return $produtos;
}

function registrarNovoUsuario($usuario, $senha, $email, $telefone, $primeironome, $sobrenome, $datanascimento, $cpf, $cidade, $bairro, $endereco, $numero) {

    $conn =  new PDO("mysql:host=localhost;dbname=trabalho", "root", "");

    //checar se o usuario ja existe
    $sql = "SELECT * FROM usuario WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return false;
    }

    $sql = "INSERT INTO usuario (usuario, senha, email, telefone, primeiro_nome, sobrenome, nascimento, cpf, cidade, bairro, endereco, numero) VALUES (:usuario, :senha, :email, :telefone, :primeironome, :sobrenome, :datanascimento, :cpf, :cidade, :bairro, :endereco, :numero)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':primeironome', $primeironome);
    $stmt->bindParam(':sobrenome', $sobrenome);
    $stmt->bindParam(':datanascimento', $datanascimento);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':numero', $numero);
    $stmt->execute();
    fecharConexao($conn);

    if ($stmt->errorCode() == 0) {
        return true;
    }
    else {
        return false;
    }
}

function listarUsuarios() {
    $conn = conectar();
    $sql = "SELECT * FROM usuario";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll();
    fecharConexao($conn);
    usort($usuarios, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    
    return $usuarios;
}

function encontrarUsuario($id) {
    $conn = conectar();
    $sql = "SELECT * FROM usuario WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch();
    fecharConexao($conn);
    return $usuario;
}

function listarVendasCompletaUsuario($id) {
    //lista todas as vendas de um usuario, com join em ProductID e produtos
    $conn = conectar();
    $sql = "SELECT * FROM venda WHERE UsuarioId = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $vendas = $stmt->fetchAll();

    $sql = "SELECT * FROM produto WHERE id = :id";
    $stmt = $conn->prepare($sql);

    foreach ($vendas as $venda) {
        $stmt->bindParam(':id', $venda[2]);
        $stmt->execute();
        $produto = $stmt->fetch();
        $venda = array_merge($venda, $produto);
    }

    fecharConexao($conn);

    return $vendas;
}

function listarProdutosMaisVendidos30Dias ($quantidade) {
    $conn = conectar();
    //querry lista os produtos mais vendidos nos ultimos 30 dias, com coluna que soma a quantidade vendida total, e valor total, ordenado por quantidade
    $sql = "SELECT ProdutoId, SUM(Quantidade) as total, SUM(Valor) as valortotal FROM venda WHERE timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY ProdutoId ORDER BY total DESC LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    $produtos_completos = array();
    foreach ($produtos as $produto) {
        $sql = "SELECT * FROM produto WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $produto[0]);
        $stmt->execute();
        $produto_completo = $stmt->fetch();
        $produto_completo[] = $produto[1];
        $produto_completo[] = $produto[2];
        $produtos_completos[] = $produto_completo;
    }

    


    fecharConexao($conn);
    return $produtos_completos;
}
 
function listarProdutosMenosVendidos30Dias ($quantidade) {
    $conn = conectar();
    //querry lista os produtos menos vendidos nos ultimos 30 dias, com coluna que soma a quantidade vendida total, e valor total, ordenado por quantidade
    $sql = "SELECT ProdutoId, SUM(Quantidade) as total, SUM(Valor) as valortotal FROM venda WHERE timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY ProdutoId ORDER BY total ASC LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
    $produtos_completos = array();
    foreach ($produtos as $produto) {
        $sql = "SELECT * FROM produto WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $produto[0]);
        $stmt->execute();
        $produto_completo = $stmt->fetch();
        $produto_completo[] = $produto[1];
        $produto_completo[] = $produto[2];
        $produtos_completos[] = $produto_completo;
    }

    fecharConexao($conn);
    return $produtos_completos;
}

function listarUsuariosComMaioresGastos30Dias ($quantidade) {
    $conn = conectar();
    //querry lista os usuarios com maiores gastos nos ultimos 30 dias, com coluna que soma o valor total gasto, ordenado por valor total
    $sql = "SELECT UsuarioId, SUM(Valor) as valortotal FROM venda WHERE timestamp > DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY UsuarioId ORDER BY valortotal DESC LIMIT $quantidade";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll();
    $usuarios_completos = array();
    foreach ($usuarios as $usuario) {
        //select apenas para pegar o nome do usuario
        $sql = "SELECT usuario FROM usuario WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $usuario[0]);
        $stmt->execute();
        $usuario_completo = $stmt->fetch();
        $usuario_completo[] = $usuario[1];
        $usuarios_completos[] = $usuario_completo;
    }

    fecharConexao($conn);
    return $usuarios_completos;
}