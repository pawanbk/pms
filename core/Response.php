<?php

namespace core;

class Response{

    public function set_status_code(int $code){
        http_response_code($code);
    }

    public function back(){
        echo "<script>history.go(-1)</script>";
    }

}