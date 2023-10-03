<?php 

namespace app\controllers;
use core\Controller;
use core\Request;
use core\Validate;
use core\Password;
use app\models\User;
use core\Session;

class RegisterController extends Controller{

    public function index(){
        return $this->render('auth/register');
    }

    public function store(Request $request){
       $validate = Validate::check($request->all(),[
            'email' => [
                'required' => true,
                'email' => true
            ],
            'password' => [
                'required' => true,
                'min' => 6
            ],
            'confirmPassword' => [
                'required' => true,
                'matches' => 'password'
            ]
       ]);

       if(!$validate){
           return $this->render('auth/register',['errors' => Validate::errors(),'old' => $request->all()]);
       }

        $user = (new User)->insert([
            'f_name' => $request->get('firstName'),
            'l_name' => $request->get('lastName'),
            'email' => $request->get('email'),
            'date' => date('Y-m-d'),
            'password' => Password::hash($request->get('password')),

        ]);
        if($user){
            Session::put('success','Registration Successfull ! Please login');
            $this->render('auth/login');
        }
       
    }
}