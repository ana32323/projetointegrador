<?php

include_once "configs/database.php";
include_once "produto.php";

Class ProdutoController{
    private $bd;

    private $produto;

    private $img_name;

    public function __construct(){
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->produto = new Produto($this->bd);
    }

    public function index(){
        return $this->produto->lerTodos();
    }

    public function pesquisarProduto($nome){
        return $this->produto->lerProduto($nome);
    }

    public function localizarProduto($id){
        return $this->produto->pesquisarProduto($id);
    }

    public function cadastrarProduto($dados, $arquivo){
         if($this->upload($arquivo)){
        $this->produto->nome = $dados['nome'];
        $this->produto->preco = $dados['preco'];
        $this->produto->descricao = $dados['descricao'];
        $this->produto->imagem = $dados['imagem'];

        if($this->produto->cadastrar()){
            header("location: index.php");
            exit();
        }
      }

      return false;
    }

   public function upload($arquivo){
    $target_dir = "uploads/";
    $uploadOk = 1;

    $fileName = basename($arquivo['fileToUpload']['name']);
    $target_file = $target_dir . $fileName;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $random_name = uniqid('img_', true) . "." . $imageFileType;
    $this->img_name = $random_name;
    $upload_file = $target_dir . $random_name;

    $check = getimagesize($arquivo['fileToUpload']['tmp_name']);
    if($check !== false){
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        echo "Não é imagem.";
    }

    if(file_exists($upload_file)){
        $uploadOk = 0;
        echo "Arquivo já existe.";
    }

    if($arquivo['fileToUpload']['size'] > 500000){
        $uploadOk = 0;
        echo "Imagem muito grande.";
    }

    if(!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])){
        $uploadOk = 0;
        echo "Formato não permitido.";
    }

    if($uploadOk == 0){
        return false;
    } else {
        if(move_uploaded_file($arquivo['fileToUpload']['tmp_name'], $upload_file)){
            $this->produto->imagem = $random_name;
            return true;
        } else {
            echo "Erro ao fazer upload.";
            return false;
        }
    }
}


    public function atualizarProduto($dados){
        $this->produto->id = $dados['id'];
        $this->produto->nome = $dados['nome'];
        $this->produto->preco = $dados['preco'];
        $this->produto->descricao = $dados['descricao'];
        $this->produto->imagem = $dados['imagem'];

        if($this->produto->cadastrar()){
            header("location: index.php");
            exit();
        }
        return false;
    }

    public function excluirProduto($id){
        $this->produto->id = $id;

        if($this->produto->excluir()){
            header("location: index.php");
            exit();
        }
    }

   
}