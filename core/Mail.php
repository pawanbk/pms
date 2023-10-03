<?php 
namespace core;
use PHPMailer\PHPMailer\PHPMailer;
use core\Controller;

class Mail {

    public static $to;
    public static Controller $controller;

    public static function to($email){
        self::$to = $email;
        self::$controller = new Controller();
        return new Mail();
    }

    public function send($mailable){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = MAIL_HOST;
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = MAIL_PORT;
        $phpmailer->Username = MAIL_USERNAME;
        $phpmailer->Password = MAIL_PASSWORD;
        $phpmailer->AddAddress(self::$to,'Pawan'); 
        $phpmailer->Subject = "Password Reset Link";
        $phpmailer->Body = self::$controller->viewContent($mailable->view,$mailable->mailData);
        $phpmailer->isHTML(true); 
        if(!$phpmailer->Send()){
            return false;
        } 
        return true;
    }

}
