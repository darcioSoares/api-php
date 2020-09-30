<?php
namespace App\Controller;

use App\Model\Database;
use App\Model\Utility;

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
            return $result;
        }else{
            return ["delete"=>"error registro nao deletado","error"=>true];
        }
        
    }


                    //////// application 
                    

    static public function ControllerCreatedUser($body){

        $db = new Database();
        $utility = new Utility();

        $password = $body["password"];
        $email = $body["email"];
        
        $resultEmail = $db->emailExist($email);
        
        if(!$resultEmail){
            
            $resultPassword = $utility->Encrypt($password);
            $body["password"] = $resultPassword;
    
            $result = $db->createdUser($body);    
        }
        
        
        if($result){
            return ["criação"=>"criado com sucesso",
                    "code"=>201];
        }else{
            return ["criação"=>"email ja existe",
                    "code"=>400];
        };       
        
    }

    static public function ControllerLogin($body){

        $db = new Database();
        $utility = new Utility();

        $email = $body["email"];

        if($resultEmail = $db->emailExist($email)){

            $password = $db->loginUser($email);
    
            if($password){
    
                $resultPassword = $utility->Decrypt($password["password"]);
    
                if($resultPassword){
                    if($resultPassword === $body["password"]){
                        return ["result"=>true,"password"=>true,"code"=>200];
                    }else{
                        return ["error"=>"password incorrect","code"=>401];
                    }
                }else{
                    return ["error"=>'decrypt'];
                }   
    
            }else{
                return ["login"=>"email nao econtrado"];
            }
        }else{
            return ["error"=>"email nao existe","code"=>400];
        }


    }

    


}