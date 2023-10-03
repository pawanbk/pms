<?php

namespace core;
use core\Response;

class Controller{

    private $layout;
    
    public function render($view, $data = []){
        $viewContent = $this->viewContent($view,$data);
        $layoutContent = $this->layoutContent();
        echo str_replace("{{content}}",$viewContent,$layoutContent);
        exit;
    }

    public function viewContent($view,$data=[]){
        foreach($data as $key=>$value){
            $$key = $value;
        }
        ob_start();
        include Application::rootFolder()."/app/views/$view.php";
        return ob_get_clean();
    }

    public function layoutContent(){
        Auth::isLoggedIn() ? $this->setLayout('app') : $this->setLayout('auth');
        ob_start();
        include Application::rootFolder()."/app/views/layout/$this->layout.php";
        return ob_get_clean();
    }

    public function setLayout($layout){
        $this->layout = $layout;
    }
}