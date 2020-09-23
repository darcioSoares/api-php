<?php

use App\Model\User;
use Slim\App;

require_once('vendor/autoload.php');

$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

$app = new App($config);


//router
$app->get('/', function ($request, $response, $args) {
    return $response->write("my darcio ");

});




// Run app
$app->run();