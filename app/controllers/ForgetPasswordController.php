<?php
namespace app\controllers;
use core\Controller;
use core\Request;
use core\Validate;
use core\Mail;
use app\mail\ResetMail;
use app\models\User;
use core\Session;

class ForgetPasswordController extends Controller{
    public function index(){
        return $this->render('auth/forget-password');
    }

    public function handle(Request $request){
        $validate = Validate::check($request->all(),[
            'email' => [
                'required' => true,
                'email' => true,
                'exists' => 'users'
            ]
        ]);

        if(!$validate){
            $this->render('/auth/forget-password',[
                'errors'=>Validate::errors(),
                'old'=>$request->all()
            ]);
            exit;
        }

        $user = (new User)->where(['email',$request->get('email')])->get()->first();
        $token = sha1(mt_rand(1, 90000). $user->email);
        $update = (new user)->where(['user_id', $user->user_id])->update([
            'token' => $token
        ]);
        if(!$update){
            echo "error";
            exit;
        }

        $sent = Mail::to($request->get('email'))->send(new ResetMail([
            "email" => $user->email,
            "name"=>$user->f_name,
            "token"=>$token
            ])
        );
        if(!$sent){
            echo "error";
        }
        Session::put('success','Password reset link has been sent to your email.');
        return $this->render('auth/forget-password');

    }
}