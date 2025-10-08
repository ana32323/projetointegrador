<?php

class Usuario {
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $endereco;
    public $telefone;

    private $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }

    public function LerTodos() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function LerUsuario($nome) {
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM usuarios WHERE nome LIKE :nome";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function cadastrar() {
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, endereco, telefone) VALUES (:nome, :email, :senha, :endereco, :telefone)";
        $stmt = $this->bd->prepare($sql);

        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $this->endereco, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR); // trocado de INT pra STR, telefones podem ter traços e parênteses

        return $stmt->execute();
    }

    public function excluir() {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function login() {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_OBJ);

        if ($resultado) {
            if (password_verify($this->senha, $resultado->senha)) {
                session_start();
                $_SESSION['usuario'] = $resultado;
                header('Location: index.php');
                exit;
            } else {
                header('Location: login.php?erro=senha');
                exit;
            }
        } else {
            header('Location: login.php?erro=email');
            exit;
        }
    }
}
?>
