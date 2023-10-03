<?php 
namespace core;

class Button{
    private $name;
    private $className;
    public function __construct($name, $className){
        $this->name = $name;
        $this->className = $className;
    }

    public function __toString(){
        return sprintf("<div class='form-group'>
                        <button type='submit'
                        class='%s'>%s</button>
                    </div>",
                    $this->className,
                    $this->name
                );
    }
}