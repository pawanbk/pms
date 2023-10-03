<?php

namespace core;
class Application{

    public Request $request;
    public Response $response;
    public Router $router;
    public Controller $controller;
    private static $root;

    public function __construct($root){
        self::$root = $root;
        $this->request = new Request;
        $this->response = new Response;
        $this->controller = new Controller;
        $this->router = new Router($this->request,$this->response,$this->controller);
        
    }

    public function run(){
      $this->router->resolve();
    }

    public static function rootFolder(){
        return self::$root;
    }
}