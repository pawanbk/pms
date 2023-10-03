<?php

namespace app\controllers;
use core\Controller;
use core\Request;
use core\Validate;
use core\Auth;
use core\Session;

class AuthController extends Controller{

    public const INVALID_CREDENTIALS = "Oops! These Credentails doesn't match our record. Please try again.";

    public function login(){
        $this->render('/auth/login');
    }

    public function authenticate(Request $request){
       $validate = Validate::check($request->all(),[
           "email" => [
               "required" => true,
               "email" => "email"
           ],
           "password" => [
               "required" => true
           ]
        ]);
        if(!$validate){
            return $this->render('/auth/login',['errors' => Validate::errors(), 'old'=> $request->all()]);
        } 
        if(Auth::attempt($request->only(['email','password']))){
            return redirect("/");
        } else{
            return $this->render('/auth/login',['error'=>self::INVALID_CREDENTIALS,'old'=> $request->all()]);
        }
        

    }

    public function logout(){
        Session::delete('userId');
        return redirect('/login');
    }
}