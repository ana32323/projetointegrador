<?php

class DataBase{
     private $host = "127.0.0.1:3316";

     private $banco = "catalogo_alimentos";

     private $usuario = "root";

     private $senha = "123456";
     
     public $con;

     public function conectar(){
        $this->con = null;

        try{
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->banco", $this->usuario, $this->senha);
          } catch (PDOExecpion $e){
            echo "erro ao conectar:" . $e->getMessage();
          }

          return $this->con;
     }
}

?>