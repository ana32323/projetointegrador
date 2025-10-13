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

    public function lerTodos() {
        $sql = "SELECT * FROM usuarios";
        $resultado = $this->bd->query($sql);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function lerUsuario($nome) {
        $nome = "%" . $nome . "%";
        $sql = "SELECT * FROM usuarios WHERE nome LIKE :nome";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':nome', $nome);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function pesquisarUsuario($id){
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $resultado = $this->bd->prepare($sql);
        $resultado->bindParam(':id', $id);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_OBJ);
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

    public function atualizar(){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, endereco = :endereco, telefone = :telefone WHERE id = :id";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
        $stmt->bindParam(':endereco', $this->endereco, PDO::PARAM_INT);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        
     if($stmt->execute()){
            return true;
        }else{
            return false;
        }

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
