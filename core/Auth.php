<?php
namespace core;
use core\Session;
use core\Password;
use app\models\User;

class Auth{
    public static function isLoggedIn(){
        if(Session::exists('userId')){
            return true;
        }
        return false;
    }

    public static function attempt(array $credentials){
        $user = new User;
        $user = $user->where(["email"=>$credentials['email']])->get()->first();
        if($user){
            if(Password::verify($credentials['password'],$user->password)){
                Session::put('userId',$user->user_id);
                Session::put('user', $user);
                return true;
            }
        }
    }
}