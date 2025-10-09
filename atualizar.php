<?php

 include_once "objetos/UsuarioController.php";
 include_once "sessio.php";
 

 $controller = new UsuarioController();

 if($_SERVER['REQUEST_METHOD']=== 'GET' && isset($_GET['alterar'])){
    $a = $controller->localizarUsuario($_GET['alterar']);

 }elseif ($_SERVER['REQUEST_METHOD']=== 'POST' && isset($_POST['usuario'])){
    $controller->atualizarUsuario($_POST['usuario']);
 }else{
    header("location: index.php");
 }

 ?>

 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo Alimentos</title>
 </head>
 <body>
   <?php include_once "topo.php" ?>

    <h1>atualizar Usuario</h1>

    <form action="atualizar.php" method="post">
    
    <input type="text" name="usuario[id]" id="id" value="<?= $a->id?>" hidden>

    <label for="nome">Nome</label>
    <input type="text" name="usuario[nome]" id="nome" value="<?= $u->nome?>" >

    <label for="email">E-mail</label>
    <input type="text" name="usuario[email]" id="email" value="<?= $u->email?>" >

    <label for="senha">Senha</label>
    <input type="password" name="usuario[senha]" id="senha" value="<?= $u->senha?>" >

    <label for="endereco">Endereco</label>
    <input type="text" name="usuario[endereco]" id="endereco" value="<?= $u->endereco?>" >

    <label for="telefone">Telefone</label>
    <input type="text" name="usuario[telefone]" id="telefone" value="<?= $u->telefone?>" >

    <select name="usuarios[tipo]">
       <option value="USR">Usuario</option>
       <option value="ADM">admin</option>
    </select>
    
    <button name="cadastrar">Cadastrar</button>

 </form>
 </body>
 </html>