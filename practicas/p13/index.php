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

//mensaje desde formulario
$app->post("/pruebapost", function($request, $response,$args){
    $reqPost = $request->getParsedBody(); 
    $val1 = $reqPost["val1"];
    $val2 = $reqPost["val2"];

    $response->getBody()->write("valores:" . $val1 . " ".$val2 ); 
    return $response; 
}); 

///obtener json de prueba
$app->get("/testjson",function($request, $response, $args){
    $data[0]["nombre"]="Ana";
    $data[0]["apellidos"]="Sanchez";
    $data[1]["nombre"]="Luis";
    $data[1]["apellidos"]="Garcia";
    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response; 
});

///post json de prueba
$app->post("/testjson2", function($request, $response, $args){
    $reqBody = $request->getParsedBody();
    $val1 = $reqBody["val1"];
    $val2 = $reqBody["val2"];

      $data = [
        'valores' => $val1 . " " . $val2,
    ];
    
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->run();





?> 