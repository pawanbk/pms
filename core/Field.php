<?php
namespace core;

class Field{

    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_DATE = 'date';
    public const TYPE_HIDDEN = 'hidden';

    private $type;
    private $attribute;
    private $label;
    private $errors = [];
    private $old;

    public function __construct($label,$attribute,$errors=[], $old=[]){
        $this->type = self::TYPE_TEXT;
        $this->attribute = $attribute;
        $this->label = $label;
        $this->old = $old[$this->attribute] ?? '';
        $this->errors = $errors ?? [];

        
    }

    public function __toString(){
        return sprintf("<div class='form-group'>
                        <label>%s</label>
                        <input type='%s' class='form-control %s' name='%s' placeholder='Enter %s' value='%s'>
                        <div class='invalid-feedback'>%s</div>
                    </div>",
                    $this->label,
                    $this->type,
                    $this->hasError() ? 'is-invalid':'',
                    $this->attribute,
                    $this->label,
                    $this->old,
                    $this->firstError()
                );
       
    }

    private function hasError(){
        return $this->errors[$this->attribute] ?? false;
    }

    private function firstError(){
        return $this->errors[$this->attribute][0] ?? '';
    }

    public function passwordField(){
        $this->type = self::TYPE_PASSWORD;
    }

    public function dateField(){
        $this->type = self::TYPE_DATE;
        return $this;
    }

    public function hiddenField(){
        $this->type = self::TYPE_HIDDEN;
        return $this;
    }

    
}