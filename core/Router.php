<?php
namespace core;

class Router{
    
    private $routes = [];
    private Request $request;
    private Response $response;
    private Controller $controller;

    public function __construct(Request $request, Response $response, Controller $controller){
        $this->request = $request;
        $this->response = $response;
        $this->controller = $controller;
    }


    public function register( string $requestMethod, string $requestUri, callable|array $action) :self{
        $this->routes[$requestMethod][$requestUri] = $action;
        return $this;
    }

    public function routes(): array{
        return $this->routes;
    }

    public function get($path, callable|array $action){
       return $this->register('get',$path, $action);
    }

    public function post($path, callable|array $action){
        return $this->register('post',$path, $action);
    }
    public function put($path, callable|array $action){
        return $this->register('post',$path, $action);
    }

    public function delete($path, callable|array $action){
        return $this->register('get',$path, $action);
    }

    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $id = '';
        $token = '';
        if (preg_match('~[0-9]+~', $path)) {
            $id = (int)filter_var($path, FILTER_SANITIZE_NUMBER_INT);
            if($id){
              $path = str_replace($id,'{id}',$path);
            }
        }
        $action = $this->routes[$method][$path] ?? false;
        
        if(!$action){
            $this->controller->render('404');
            exit;
        }

        if(is_callable($action)){
            call_user_func($action);
        }

        if(is_array($action)){
            $action[0] = new $action[0];
        }

        if($action[1] === 'delete'){
            return call_user_func($action,$this->response,$id);
            exit;
        } 
        if($action[1] === 'edit'){
            return call_user_func($action,$id,$this->request,$this->response);
            exit;
        }
        call_user_func($action,$this->request,$this->response,$id);
    }

}