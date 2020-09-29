<?php
namespace App\Controller;

use App\Model\Database;

require_once('vendor/autoload.php');

class ControllerUser{

    static public function ControllerCreate(array $body){

        $db = new Database();

        $result = $db->create($body);

        if($result){
            return ["registro"=>"criado com sucesso","error"=>false];
        }else{
            return ["registro"=>"nao criado","error"=>true];
        }         

    }

    //
    static public function ControllerSelect(){

        $db = new Database();
    
       $result = $db->select();

        if($result){
            return $result;
        }else{
            return ["usuario"=>"vazio"];
        }
    }

    //
    static public function ControllerSelectOne($id):array{

        $db = new Database();

        $result = $db->selectOne($id);
        
        if($result){
            return $result;
        }else{
            return ["usuario"=>"nao encontrado"];
        }

    }

    //
    static public function ControllerUpdate($id, array $body){

        $db = new Database();

        $result = $db->update($id, $body);
        
        if($result){
            return $result;  
        }else{
            return ["error"=>"database"];
        }

    }

    //
    static public function ControllerDelete($id){

        $db = new Database();

        $result = $db->delete($id);

        if($result){
            return ["delete"=>"efetuado com sucesso","error"=>false];
        }else{
            return ["delete"=>"error registro nao deletado","error"=>true];
        }

        return $result;
    }

    //////// application 

    static public function ControllerCreatedUser($body){

        $db = new Database();

        $result = $db->createdUser($body);    
        
        if($result){
            return ["criação"=>"criado com sucesso"];
        }else{
            return ["criação"=>"não criou o registro"];
        };
        
        
    }

    static public function ControllerLogin($body){

        $db = new Database();

        $result = $db->loginUser($body);

        if($result){
            return $result;
        }else{
            return ["login"=>"email nao econtrado"];
        }


    }

}