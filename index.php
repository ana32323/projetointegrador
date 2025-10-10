<?php

include_once 'configs/database.php';
include_once 'objetos/usuario.php';
include_once 'objetos/UsuarioController.php';
include_once 'session.php';

$controller = new UsuarioController();
$Usuario = $controller->index();
global $usuario;

$u = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['pesquisa'])){
        $u = $controller->pesquisarUsuario($_POST['pesquisa']);
  }

} elseif($_SERVER['REQUEST_METHOD'] === "GET"){
    if(isset($_GET['excluir'])){
        $controller->excluirUsuario($_GET['excluir']);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Integrador</title>
 </head>
 <body>

  <h2>Usuario Cadastrados</h2>

  <table>
    <tr>
        <td>ID</td>
        <td>Nome</td>
        <td>Email</td>
        <td>Endereco</td>
        <td>Telefone</td>
        <td>Senha</td>
    </tr>
 


   <?php if($Usuario) : ?>

        <?php foreach($Usuario as $u) : ?>

            <tr>
                <td><?=$u->id ?></td>
                <td><?=$u->nome ?></td>
                <td><?=$u->email ?></td>
                <td><?=$u->endereco ?></td>
                <td><?=$u->telefone ?></td>

                <?php if($_SESSION['usuario']->id == $u->id) : ?>

                    <td><a href="atualizar.php?alterar=<?= $u->id ?>">Alterar</a></td>
                    <td><a href="index.php?excluir=<?= $u->id ?>">Excluir</a></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>

    </table>

            

         
</body>
</html>