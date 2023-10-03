<?php 
namespace core;

class Request{

    public function getPath(){
        $path = $_SERVER["REQUEST_URI"] ?? '/';
        if(strpos($path,'?')){
            $path = explode('?',$path)[0];
        }
        return $path;
    }

    public function getMethod(){
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function all(){
        $body = [];
        if($this->getMethod() === 'get'){
            foreach($_GET as $key=>$value){
                $body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->getMethod() === 'post'){
            foreach($_POST as $key=>$value){
                $body[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    public function only(array $keys){
        $data = [];

        foreach($keys as $key){
            $data[$key] = $this->all()[$key];
        }

        return $data;
    }

    public function get($key){
        return $this->all()[$key] ?? '';
    }
}