<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Router;
use App\Read;
use App\Create;
use App\Delete;
use App\Helper;

$configureRoutes = new Helper();
$configureRoutes->setHeaders();
$router = new Router();

$router->get('/', function(){
    echo 'Home Page';
});

$router->get('/products', function(){
    $dbInstance = new Helper();
    $dbConnect = $dbInstance->dbConnection();
    $results = new Read($dbConnect);
    echo $results->dataArray();
});

$router->post('/products', function(){
    $dbInstance = new Helper();
    $dbConnect = $dbInstance->dbConnection();
    $result = new Create($dbConnect);
    echo $result->addProduct();
});

$router->delete('/products', function(){
    $dbInstance = new Helper();
    $dbConnect = $dbInstance->dbConnection();
    $result = new Delete($dbConnect);
    echo $result->deleteProduct();
});

$router->addNotFoundHandler(function(){
    header('HTTP/1.1 404 Not Found', true, 404);
    echo json_encode(array('message' => "Path Not Found"));
});

$router->run();