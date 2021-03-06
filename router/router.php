<?php

use Slim\App;
use App\Controller\ControllerUser;

require_once('vendor/autoload.php');

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new App($config);



//                  router teste

$app->get('/', function($request, $response, $args) {

    $data = ["funcionou"=>true];

    return $response->withJson($data,201);

});

//
$app->post('/create', function($request, $response, $args){

    $body = $request->getParsedBody();
    $data = ControllerUser::ControllerCreate($body);

     
    if(!$data["error"]){
        return $response->withJson($data,201);
    }else{
        return $response->withJson($data,400);
    }

});

//
$app->get('/select', function($request, $response, $args){
    
    $data = ControllerUser::ControllerSelect();    
    return $response->withJson($data,201);
    
});

//
$app->get('/selectone/{id}', function($request, $response, $args){
    
    $id = $args["id"];
    
    if(is_numeric($id)){   

        $data = ControllerUser::ControllerSelectOne($id);        
        return $response->withJson($data, 201);
        
    }else{
        return $response->withJson(["id"=>"não numerico"]);
    } 
    
});

//
$app->put('/update/{id}', function($request, $response, $args){

    $id = $args["id"];
    $body = $request->getParsedBody();

    $data = ControllerUser::ControllerUpdate($id, $body);
    return $response->withJson($data,201);


});

//
$app->delete('/delete/{id}', function($request,$response, $args){

    $id = $args["id"];

    if(is_numeric($id)){

        $data = ControllerUser::ControllerDelete($id);
        if(!$data["error"]){
            return $response->withJson($data, 201);
        }else{
            return $response->withJson($data, 401);
        }

    }else{
        return $response->withJson(["id"=>"não numerico"]);
    }


});



//                 routes of application 


$app->post('/createdUsers', function($request, $response, $args){

    $body = $request->getParsedBody();

    $data = ControllerUser::ControllerCreatedUser($body);

    return $response->withJson($data,$data["code"]);
});

//
$app->post('/loginUsers', function($request, $response , $args){

    $body = $request->getParsedBody();

    $data = ControllerUser::ControllerLogin($body);

    return $response->withJson($data, $data["code"]);
    
});



// Run app
$app->run();