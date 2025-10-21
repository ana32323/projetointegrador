<?php

include_once "objetos/ProdutoController.php";


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controller = new ProdutoController();

    if(isset($_POST['cadastrar'])){
        $controller->cadastrarProduto($_POST['produto'], $_FILES);
    }
}

?>





<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <?php include_once "topo.php" ?>
    
    
    
    <h1>Cadastro de Produtos</h1>

   <form action="cadastrarProduto.php" method="post" enctype="multipart/form-data">
    <label for="nome">Nome</label>
    <input type="text" name="produto[nome]" id="nome" required>

    <label for="preco">Preço</label>
    <input type="text" name="produto[preco]" id="preco" required>

    <label for="descricao">Descrição</label>
    <input type="text" name="produto[descricao]" id="descricao">

    <label for="fileToUpload">Imagem</label>
    <input type="file" name="fileToUpload" id="fileToUpload" required>

    <button name="cadastrar">Cadastrar</button>
</form>

</body>
</html>