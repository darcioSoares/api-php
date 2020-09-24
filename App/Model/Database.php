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

    
}

// $envPath = dirname(__FILE__) . '/../env.ini';
// $env = parse_ini_file($envPath);

// $conn = new mysqli($env["host"],$env["username"], 
// $env["password"], $env["database"]);
