<?php
namespace core;

class Dotenv{
    private $path;
    public function __construct(string $path){
        if(!file_exists($path)){
            throw new \Exception(sprintf("File %s not found.",$path),1); 
        }
        $this->path = $path;
    }

    public function load(){
        if(!is_readable($this->path)){
            throw new \Exception(sprintf("File %s is not Readable.",$this->path),1); 
        }
        $lines = file($this->path,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line){
            
            $line = explode('=',$line);
            [$key, $value] = $line;
            $key = trim($key);
            $value = trim($value);
            if(!array_key_exists($key,$_SERVER) && !array_key_exists($key,$_ENV)){
                // putenv(sprintf("%s = %s",$key, $value));
                $_ENV[$key] = $value;   
            }
        }
    }
}