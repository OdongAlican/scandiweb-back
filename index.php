<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\Read;
use App\Create;

$router = new Router();

$router->get('/', function(){
    echo 'Home Page';
});

$router->get('/products', function(){
    $results = new Read();
    echo $results->dataArray();
});

$router->post('/products', function(){
    $result = new Create();
    echo $result->addProduct();
});

$router->addNotFoundHandler(function(){
    echo json_encode(array('message' => "Path Not Found"));
});

$router->run();