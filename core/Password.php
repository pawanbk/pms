<?php
namespace core;

class Password{

    public static function hash(string $password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verify($password, $hashed){
        return password_verify($password, $hashed);
    }
}