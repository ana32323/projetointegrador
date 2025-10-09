<?php

include_once 'configs/database.php';
include_once 'objetos/usuario.php';

$banco = new database();
$bd = $banco->conectar();
$u = new Usuario($bd);
$usuarios = null;
$usuario = null;

function index(){
    global $usuario;
    $banco = new database();
    $bd = $banco->conectar();
    $u = new Usuario ($bd);
    $usuarios = $u->lerTodos();
    
}

if(isset($_POST['cadastrar'])){
    $u->nome = $_POST['nome'];
    $u->email = $_POST['email'];
    $u->senha = $_POST['senha'];
    $u->endereco = $_POST['endereco'];
    $u->telefone = $_POST['telefone'];

    if($u->cadastrar()){
        header("location: index.php");
    }
}

