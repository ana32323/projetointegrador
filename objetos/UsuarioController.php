<?php

include_once "configs/database.php";
include_once 'usuario.php';


class UsuarioController {
     private $bd;

     private $usuarios;

     public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->usuarios = new Usuario($this->bd);
    }

     public function index() {
        return $this->usuarios->lerTodos();
    }

     public function pesquisarUsuario($nome) {
        return $this->usuarios->lerUsuario($nome);
    }

     public function localizarUsuario($id) {
      return $this->usuarios->pesquisarUsuario($id);
   
    }

     public function cadastrarUsuario($dados){
        $this->usuarios->nome = $dados['nome'];
        $this->usuarios->email = $dados['email'];
        $this->usuarios->senha = $dados['senha'];
        $this->usuarios->endereco = $dados['endereco'];
        $this->usuarios->telefone = $dados['telefone'];

        if($this->usuarios->cadastrar()){
            header("location: index.php");
            exit;
        }else{
            header("location: cadastro:php");
            exit;
        }

    }

     public function atualizarUsuario($dados){
        $this->usuarios->id = $dados['id'];
        $this->usuarios->nome = $dados['nome'];
        $this->usuarios->email = $dados['email'];
        $this->usuarios->senha = $dados['senha'];
        $this->usuarios->endereco = $dados['endereco'];
        $this->usuarios->telefone = $dados['telefone'];

        if($this->usuarios->atualizar()){
            header("locationa: listarUsuario");
            exit;
        }

    }

     public function excluirUsuario($id) {
        $this->usuarios->id = $id;

        if ($this->usuarios->excluir()) {
            header("Location: index.php?msg=excluido");
            exit;
        } else {
            header("Location: index.php?erro=excluir");
            exit;
        }
    }

     public function login($email, $senha) {
        $this->usuarios->email = $email;
        $this->usuarios->senha = $senha;
        $this->usuarios->login();

        if($this->usuarios->login()){

            header("Location: index.php");
        }
    }

}
    

?>
