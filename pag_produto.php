<?php

include_once "configs/database.php";
include_once "objetos/ProdutoController";
include_once "objetos/produto.php";
include_once "topo.php";
include_once "session.php";
include_once "principal.php";



$controller = new ProdutoController();
$produtos = $controller->index();
global $produtos;

$p = null;

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    if(isset($_POST['pesquisa'])){
        $p = $controller->pesquisarProduto($_POST['pesquisa']);
    }       
}elseif($_SERVER['REQUEST_METHOD']=== "GET"){
    if(isset($_GET['excluir'])){
        $controller->excluirProduto($_GET['excluir']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto Cadastrados</title>    
</head>
<body>

<a href="cadastrarproduto.php">Cadastrar Produto</a>

 <h1>Produtos Cadastrados</h1>

    <table>
        <td>ID</td>
        <td>Nome</td>
        <td>Preco</td>
        <td>Descricao</td>
        <td>Imagem</td>

       
      <?php if ($produtos) : ?>
        <?php foreach ($produtos as $produto) :?>
            <tr>
                <td><?=$produto->id ?></td>
                <td><?=$produto->nome ?></td>
                <td><?=$produto->preco ?></td>
                <td><?=$produto->descricao ?></td>
                <td><?=$produto->imagem ?></td>
                <td><a href="atualizar.php?alterar=<?= $produto->id ?>">Atualizar</a></td>
                <td><a href="index.php?excluir=<?= $produto->id ?>">Excluir</a></td>
            </tr>
            <?php endforeach ?>
            <?php endif ?>
    </table>

    <form action="index.php" method="post">
        <label for="">Pesquisa</label>
        <input type="text" name="pesquisa">
        <button>Pesquisar</button>
    </form>

    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Preco</td>
            <td>Descricao</td>
            <td>Imagem</td>
        </tr>

        <?php if($p) : ?>
            <?php foreach($p as $linha): ?>
                <tr>
                    <td><?= $linha->id?></td>
                    <td><?= $linha->nome?></td>
                    <td><?= $linha->preco?></td>
                    <td><?= $linha->descricao?></td>
                    <td><?= $linha->imagem?></td>
                </tr>

                <?php endforeach ?>
                <?php endif ?>

    </table>
    
</body>
</html>