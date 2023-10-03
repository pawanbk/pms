<?php
namespace app\mail;
use core\Mailable;

class ResetMail extends Mailable{
    public $mailData; 

    public function __construct($data){
        parent::__construct();
        $this->mailData = $data;
    }

    public function handle(){
         return $this->from()
                    ->subject('test')
                    ->view('emails/reset');
    }
}