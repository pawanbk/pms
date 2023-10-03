<?php

namespace core;
use core\Database;

class Validate{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'matches';
    public const RULE_EXISTS = 'exists';
    public const RULE_UNIQUE = 'unique';
    public const RULE_LATEST = 'latest';
    public const RULE_SELECT = 'selected';
 
    private static $errors = [];
    public static function check(array $inputs, array $items){
        foreach($items as $item=>$rules){
            $value = $inputs[$item];
            foreach($rules as $rule=>$ruleValue){
                if($rule === self::RULE_REQUIRED && empty($value)){
                    self::addError($item,self::RULE_REQUIRED);
                } elseif(!empty($value)){
                    switch($rule){
                        case self::RULE_MIN:
                            if(strlen($value) < $ruleValue){
                                self::addError($item,$rule,$ruleValue);
                            }
                            break;
                        case self::RULE_MAX:
                            if(strlen($value) > $ruleValue){
                                self::addError($item,$rule,$ruleValue);
                            }
                            break;
                        case self::RULE_MATCH:
                            if($value != $inputs[$ruleValue]){
                                self::addError($item,$rule,$ruleValue);
                            }
                            break;
                        case self::RULE_EMAIL:
                            $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
                            if(!preg_match($pattern,$value)){
                                self::addError($item,$rule);
                            }
                            break;
                        case self::RULE_EXISTS:
                            $db = new Database();
                            $results = $db->query("SELECT * FROM $ruleValue WHERE $item = ?",array($value));
                            if(!$results->count() > 0){
                                self::addError($item,$rule,$ruleValue);
                            }
                            break;
                        case self::RULE_UNIQUE:
                            $db = new Database();
                            $results = $db->query("SELECT * FROM $ruleValue WHERE $item = ?",array($value));
                            if($results->count() > 0){
                                self::addError($item,$rule,$ruleValue);
                            }
                            break;
                        case self::RULE_LATEST:
                            $curDate = date('Y-m-d');
                            if($value < $curDate){
                                self::addError($item,$rule);
                            }
                            break;
                        case self::RULE_SELECT:
                            if(empty($value)){
                                self::addError($item,$rule);
                            }
                            break;
                    }
                }
            }
        }
        return empty(self::$errors) ?? false ;
    }

    public static function errorMessage(){
        return[
            self::RULE_REQUIRED => "This field is required.",
            self::RULE_EMAIL => "This field must be valid email.",
            self::RULE_MIN => "This field must be of min length {min}.",
            self::RULE_MAX => "This field must be of max length {max}.",
            self::RULE_MATCH => "This field must match {matches} field.",
            self::RULE_EXISTS => "This {item} doesnot exists in our record.",
            self::RULE_UNIQUE => "This {item} already exists in our record.",
            self::RULE_LATEST => "This field must be latest date.",
            self::RULE_SELECT => "This field must be selected.",
            
        ];
    }

    private static function addError(string $key,string $rule,string $ruleValue = ''){
        $message = self::errorMessage()[$rule] ?? '';
        $message = str_replace("{item}",$key,$message);
        $message = str_replace("{{$rule}}",$ruleValue,$message);
        self::$errors[$key][] = $message;
    }

    public static function errors(){
        return self::$errors;
    }

    

}