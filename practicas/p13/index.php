<?php

use Psr\Http\Message\ResponseInterface as Response; 
use Psr\Http\Message\ServerRequestInterface as Request; 
use Slim\Factory\AppFactory; 

require 'vendor/autoload.php';

$app = AppFactory::create();
// /myapp/api is the api folder http://domain/myapp/api/
$app->setBasePath("/myapp/api");

$app->setBasePath('/tec_web/practicas/p13');

// "hola mundo"
$app->get('/', function(Request $request, Response $response, $args) {
    $response->getBody()->write("¡Hola, mundo Slim!");
    return $response; 
});

//hola + nombre
$app->get("/hola[/{nombre}]", function( Request $request, Response $response, $args) {
    $response->getBody()->write("Hola, " . $args["nombre"]);
    return $response; 
}); 

$app->post("/pruebapost", function($request, $response,$args){
    $reqPost = $request->getParsedBody(); 
    $val1 = $reqPost["val1"];
    $val2 = $reqPost["val2"];

    $response->getBody()->write("valores:" . $val1 . " ".$val2 ); 
    return $response; 
}); 


$app->run();





?> 