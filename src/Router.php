<?php

declare(strict_types=1);

namespace App;

class Router {

    private array $handlers;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';
    private $notFoundHnadler;

    public function get(string $path, $handler): void {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler): void {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler($handler): void {
        $this->notFoundHnadler = $handler;
    }

    public function run(){
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];
        $requestPath = $requestUri['path'];

        $callback = null;

        foreach($this->handlers as $handler){
            if($handler['path'] === $requestPath && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }

        if(!$callback) {
            if(!empty($this->notFoundHnadler)) $callback = $this->notFoundHnadler;
        }

        call_user_func_array($callback, [ array_merge($_GET, $_POST)]);
    }

    private function addHandler(string $method, string $path, $handler): void {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler
        ];
    }
}