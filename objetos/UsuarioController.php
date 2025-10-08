<?php

include_once 'configs/database.php';
include_once 'usuario.php';

class UsuarioController {
    private $bd;
    private $usuario;

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->usuario = new Usuario($this->bd);
    }

    public function index() {
        return $this->usuario->LerTodos();
    }

    public function pesquisarUsuario($nome) {
        return $this->usuario->LerUsuario($nome);
    }

    public function localizarUsuario($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrarUsuario($dados) {
        $this->usuario->nome = $dados['nome'];
        $this->usuario->email = $dados['email'];
        $this->usuario->senha = $dados['senha'];
        $this->usuario->endereco = $dados['endereco'];
        $this->usuario->telefone = $dados['telefone'];

        if ($this->usuario->cadastrar()) {
            header("Location: index.php?msg=cadastrado");
            exit;
        } else {
            header("Location: cadastro.php?erro=1");
            exit;
        }
    }

    public function excluirUsuario($id) {
        $this->usuario->id = $id;

        if ($this->usuario->excluir()) {
            header("Location: index.php?msg=excluido");
            exit;
        } else {
            header("Location: index.php?erro=excluir");
            exit;
        }
    }

    public function login($email, $senha) {
        $this->usuario->email = $email;
        $this->usuario->senha = $senha;
        $this->usuario->login();
    }
}

?>
