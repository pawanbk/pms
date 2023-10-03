<?php
namespace core;
use core\Field;
use core\Button;

class Form{

    public static function start($method,$action,$title=''){
        echo sprintf("<form method=%s action=%s>
                        <h3 class='form-title'>%s</h3>", $method, $action,$title);
        return new Form();
    }


    public function field($label,$attribute,$errors = [], $old = []){
        return new Field($label,$attribute,$errors,$old);
    }
    public function button($name,$className){
        return new Button($name,$className);
    }

    public static function end(){
        echo "</form>";
    }

}