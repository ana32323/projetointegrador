<?php

include_once "configs/database.php";
include_once "objetos/usuarios.php";
include_once "objetos/UsuarioController.php";
include_once "session.php";

$controller = new UsuarioController();
$usuarios = $controller->index();
global $usuarios;

$u = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pesquisa'])) {
        $u = $controller->pesquisarUsuario($_POST['pesquisa']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['excluir'])) {
        $controller->excluirUsuario($_GET['excluir']);
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de alimento</title>
</head>
<body>

<h2>Usuario Cadastrados</h2>

<table>
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>E-mail</td>
        <td>Endereco</td>
        <td>Telefone</td>
    </tr>

<?php if($usuarios) : ?>
    <?php foreach($usuarios as $usuario) : ?>
        <tr>
            <td><?=$usuarios->id ?></td>
            <td><?=$usuarios->nome ?></td>
            <td><?=$usuarios->email ?></td>
            <td><?=$usuarios->endereco ?></td>
            <td><?=$usuarios->telefone ?></td>

            <?php if($_SESSION['usuarios']->id == $usuario->id): ?>
                <a href="AtualizarUsuario.php?alterar=<?= $usuario->id ?>">
                <a href="painelUsuario.php?excluir=<?= $usuario->id ?>"> 
                <?php elseif($_SESSION['usuarios']->Tipo == "ADM") : ?>
                <td><a href="AtualizarUsuario.php?alterar=<?= $usuario->id ?>">Alterar</a></td>   
                <td><a href="PainelUsuarios.php?excluir=<?= $usuario->id ?>">Excluir<a></td>
            <?php else : ?>

            <?php endif; ?>
                

        </tr>
        <?php endforeach ?>
        <? endif ?>  
        <br>      
</table>

<form action="painelUsuario.php" method="post">
    <label for="">Pesquisa</label>
     <input type="text" name="pesquisa">
     <button>Pesquisa</button>
</form>

<table>
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>E-mail</td>
        <td>Endereco</td>
        <td>Telefone</td>
    </tr>

    <?php if($u) : ?>
        <?php foreach($u as $linha) : ?>
        <tr>
            <td><?= $linha->id ?></td>
            <td><?= $linha->nome ?></td>
            <td><?= $linha->email ?></td>
            <td><?= $linnha->endereco ?></td>
            <td><?= $linha->telefone ?></td>
        </tr>

        <?php endforeach ?>
        <?php endif ?>
</table>   
</body>
</html>