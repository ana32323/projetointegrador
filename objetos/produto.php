<?php

class produto{

    public $id;
    public $nome;
    public $preco;
    public $descricao;
    public $imagem;
    private $bd;


public function __construct($bd){
    $this->bd = $bd;
}

public function lerTodos(){
    $sql = "SELECT * FROM produtos";
    $resultado = $this->bd->query($sql);
    $resultado->execute();

    return $resultado->fetchAll(PDO::FETCH_ASSOC);
}

public function lerProduto($nome){
    $nome = "%" . $nome . "%";
    $sql = "SELECT * FROM produtos WHERE nome LIKE :nome";
    $resultado = $this->bd->prepare($sql);
    $resultado->bindParam(':nome', $nome);
    $resultado->execute();

    return $resultado->fetchAll(PDO::FETCH_OBJ);
}

public function pesquisarProduto($id){
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $resultado = $this->bd->prepare($sql);
    $resultado->bindParam(':id', $id);
    $resultado->execute();

    return $resultado->fetchAll(PDO::FETCH_OBJ);
}

public function cadastrar(){
    $sql = "INSERT INTO produtos(nome, preco, descricao, imagem) VALUES (:nome, :preco, :descricao, :imagem)";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
    $stmt->bindParam(':preco', $this->preco, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
    $stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_STR);


    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

public function atualizar(){
    $sql = "UPDATE produtos SET nome = :nome, preco = :preco, descricao, :descricao, imagem = :imagem WHERE id= :id";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
    $stmt->bindParam(':preco', $this->preco, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $this->descricao, PDO::PARAM_STR);
    $stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_STR);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
}

public function excluir(){
    $sql = "DELETE FROM produtos WHERE id = :id";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }

}

}

?>