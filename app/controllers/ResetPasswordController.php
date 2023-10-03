<?php
namespace app\controllers;
use core\Request;
use core\Session;
use core\Password;
use core\Validate;
use app\models\User;
use core\Controller;

class ResetPasswordController extends Controller{

    public function index(Request $request){
        return $this->render('auth/reset-password',[
            'token'=>$request->get('token'),
            'email' => $request->get('email')
        ]);
    }

    public function reset(Request $request){
        $validate = Validate::check($request->all(),[
            'password' => [ 
                'required' => true,
                'min' => 6,
            ],
            'confirmPassword' =>[
                'required' => true,
                'matches' => 'password'
            ]
        ]);

        if(!$validate){
            return $this->render('auth/reset-password',[
                'errors' => Validate::errors(),
                'old' => $request->all()
            ]);
            exit;
        }

        $user = (new User())->where([
            'email'=>$request->get('email'),
            'token' => $request->get('token')])->get();
        if(!$user){
            return $this->render('auth/reset-password',[
                'old' -> $request->all()
            ]);
        }
       
       $update = $user->update([
           'password' => Password::hash($request->get('password')),
           'token' => ''
       ]);
       $update ? Session::put('success','Password updated. Please proceed to login') : Session::put('error','An Error Occured');
       return $this->render('auth/login');
    }
}