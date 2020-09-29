<?php

namespace APP\Model;


class Utility {

    private $secret;
    private $secretIV;
        
    public function __construct()
    {
         $envPath = dirname(__FILE__). "/../../env.ini";
         $env = parse_ini_file($envPath);

         $s = $env['SECRET'];
         $s2 = $env['SECRET2'];

         $this->secret = pack("a16", $s);
         $this->secretIV = pack("a16",$s2);
        
    }
    
    //
    public function Encrypt($password){

        $encrypt = openssl_encrypt(
           json_encode($password),
           'AES-128-CBC',
           $this->secret,
           0,
           $this->secretIV
        );

        return $encrypt;
    }

    public function Decrypt($password){

        $decrypt = openssl_decrypt(
            $password,
            'AES-128-CBC',
            $this->secret,
            0,
            $this->secretIV
        );

        return json_decode($decrypt,true);
    }


}