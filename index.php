<?php

include_once 'configs/database.php';
include_once 'objetos/usuario.php';

include_once 'objetos/UsuarioController.php';

$controller = new UsuarioController();
$Usuario = $controller->index();
global $Usuarios;

$u = "";

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    if(isset($_POST['pesquisa'])){
        $u = $controller->pesquisarUsuario($_POST['pesquisa']);
  }

} elseif($_SERVER['REQUEST_METHOD']=== "GET"){
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
        <td>E-mail</td>
        <td>Endereco</td>
        <td>Telefone</td>
</tr>

   <?php if($Usuarios) : ?>
    <?php foreach($usuarios as $Usuario) : ?>
        <tr>
            <td><?=$usuario->id ?></td>
            <td><?=$usuario->nome ?></td>
            <td><?=$usuario->email ?></td>
            <td><?=$usuario->endereco ?></td>
            <td><?=$usuario->telefone ?></td>

            <?php if($SESSION['usuario']->id == $usuario->id) : ?>

                <td><a href="atualizar.php?alterar=<?= $usuario->id ?>">Alterar</a></td>
                <td><a href="index.php?excluir=<?= $usuario->id ?>">Excluir</a></td>
                <?php endif; ?>

                <?php endforeach; ?>
                <?php endif; ?>

            </table>

            <table>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>E-mail</td>
                    <td>Endereco</td>
                    <td>Telefone</td>
            </tr>

        <?php if($u) : ?>
            <?php foreach ($u as $linha): ?>
                <tr>
                    <td><?= $linha->id ?></td>
                    <td><?= $linha->nome ?></td>
                    <td><?= $linha->email ?></td>
                    <td><?= $linha->endereco ?></td>
                    <td><?= $linha->telefone ?></td>
            </tr>
            
            <?php endforeach ?>
          <?php endif ?>
          
            
        </table>     
</body>
</html>