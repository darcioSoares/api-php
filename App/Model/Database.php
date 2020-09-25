<?php

namespace App\Model;

use PDOException;
use PDO;

class Database {   
   
   private $dbname;
   private $host;
   private $user;
   private $password;

   private $conn;

    public function __construct(){
        $envPath = dirname(__FILE__) . "/../../env.ini";
        $env = parse_ini_file($envPath);
       
        $this->dbname = $env["database"];
        $this->host = $env["host"];
        $this->user = $env["username"];
        $this->password = $env["password"];
        
        try{
            
            $this->conn = new PDO("mysql:dbname=$this->dbname;host=$this->host",
            $this->user, $this->password);

            return $this->conn;
        }catch(PDOException $e){
            die("Error PDO conexao :" . $e->getMessage());
        }        
   }


   public function select(){

       $stmt = $this->conn->prepare("SELECT * FROM users");

       $stmt->execute();

       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

       return $result;

   }

   public function selectOne($id){
       $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");

       $stmt->bindParam(":id",$id);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);

       //return boolean
       return $result;

   }

   public function create(array $param){

       $stmt = $this->conn->prepare("INSERT INTO users(nome, sobrenome)
               VALUES(:nome, :sobrenome)");
        
        $stmt->bindParam(":nome",$param["nome"]);
        $stmt->bindParam(":sobrenome",$param["sobrenome"]);

        $result = $stmt->execute();

        // retorna um boolean
        return $result;    

   }

   public function delete($id){

        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = :id");

        $stmt->bindParam(":id",$id);

        // retorna um boolean     
        
        $result = $stmt->execute();
     

     return $result;
        

   }

//    public function update($id){
       
//        $stmt = $this->conn->prepare("UPDATE users SET nome = :nome,
//                 sobrenome = :sobrenome WHERE id = :id");


    
//    }

    
}

