<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use TECWEB\MYAPI\Create\Create;
use TECWEB\MYAPI\Read\Read;
use TECWEB\MYAPI\Update\Update;
use TECWEB\MYAPI\Delete\Delete;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// Middleware para parsear JSON en el body
$app->addBodyParsingMiddleware();

// Middleware para manejar errores
$app->addErrorMiddleware(true, true, true);

// product-list.php -> ruta: GET /products 
$app->get('/products', function (Request $request, Response $response) {
    $productos = new Read('marketzone');
    $productos->list();
    
    $response->getBody()->write($productos->getData());
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// product-search.php -> GET /products/{search} 
$app->get('/products/{search}', function (Request $request, Response $response, array $args) {
    $search = $args['search'];
    
    $productos = new Read('marketzone');
    $productos->search($search);
    
    $response->getBody()->write($productos->getData());
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

//GET /product/{id} -> product-single.php

$app->get('/product/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    
    $productos = new Read('marketzone');
    $productos->single($id);
    
    $response->getBody()->write($productos->getData());
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// product-add.php / POST /product 
$app->post('/product', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    
    $productos = new Create('marketzone');
    $productos->add(json_decode(json_encode($data)));
    
    $response->getBody()->write($productos->getData());
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
});

//product-edit.php -> PUT /product 
$app->put('/product', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    
    $productos = new Update('marketzone');
    $productos->edit(json_decode(json_encode($data)));
    
    $response->getBody()->write($productos->getData());
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

//product-delete.php -> rita: DELETE /product 
$app->delete('/product', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    
    $productos = new Delete('marketzone');
    $productos->delete($data['id']);
    
    $response->getBody()->write($productos->getData());
    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run(); 
?> 