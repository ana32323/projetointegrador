<?php

include_once 'objetos/UsuarioController.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['email']) && isset($_POST['senha'])){

        $controller = new UsuarioController();
        $controller->login($_POST['email'], $_POST['senha']);
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de login</title>
</head>
<body>

    <form method="POST" action="login.php">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha">
        <button>Entrar</button> 
    </form>

<p>clique para se <a href="cadastro.php">Cadastrar</a></p>


                
</body>
</html>