<?php

include_once 'objetos/ProdutoController.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controller = new ProdutoController();

  if(isset($_POST['cadastrar'])){
    $controller->cadastrarProduto($_POST['produto'], $_FILES['produto']);
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

    <form action="cadastrarProduto.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="produto[nome]" id="nome">

        <label for="preco">Preco</label>
        <input type="text" name="produto[preco]" id="preco">

        <label for="descricao">Descricao</label>
        <input type="text" name="produto[descricao]" id="descricao">

        <label for="fileToUpload">img</label>
        <input type="file" name="produto[fileToUpload]" id="fileToUpload">

    
        <button name="cadastrar">Cadastrar</button>

        <br>

        

</form>       
</body>
</html>