<?php

include_once "configs/database.php";
include_once  "produto.php";

class ProdutoController{
    private $bd;
    private $produto;

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

    public function cadastrarProduto($dados){
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

     public function upload($arquivo){
        $target_dir = "uploads/";
        $upload0k = 1;
        $target_file = $target_dir . $arquivo["name"] ["fileToUpload"];
        $imageFileType = strtolower(pathinfo($target_file,  PATHINFO_EXTENSION));

        $random_name = uniqid('img_', true).".". pathinfo($arquivo["name"]["fileToUpload"], PATHINFO_EXTENSION);
        $this->img_name = $random_name;
        $upload_file = $target_dir . $random_name;

        $check = getimagesize($arquivo["tmp_name"]["fileToUpload"]);

        if($check !== false){
            $upload0k = 1;
        }else{
            $upload0k = 0;
            echo "não é imagem";
        }

        if(file_exists($upload_file)){
            $upload0k = 0;
            echo "ja existe";
        }

        if($arquivo["size"]['fileToUpload'] > 5000000){
            $upload0k = 0;
            echo "imagem grande";
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
           $upload0k = 0;
           echo "tipo diferente"; 
        }

        if($upload0k == 0){
            return false;
        }else{
            if(move_uploaded_file($arquivo["tmp_name"]["fileToUpload"], $upload_file)){
          }else{
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

        if($this->produto->atualizar()){
            header("location: index.php");
            exit();
        }
    }  

    public function excluirProduto($id){
        $this->produto->id =$id;

        if($this->produto->excluir()){
            header("location: index.php");
            exit();        }
    }

}