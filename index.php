<?php 

require __DIR__ . '/vendor/autoload.php';

// Declara as Interfaces PSR-7
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


//Instanciando objeto
$app = new Slim\App;

$app->get('/', function() use ($app){
    $app->render('index.php');
});

$app->get('/contato', function($request, $response) use ($app) {
    
    $contato = new Controllers\controllers\Contato();
    $contatos = $contato->get();
    
    return $response->withJson($contatos,200);
});

$app->post('/contato', function($request, $response) use ($app) {
    
    $contato = new Controllers\controllers\Contato();
    $contato->post($request);

    return $response->withJson('success',200);
});

$app->run();