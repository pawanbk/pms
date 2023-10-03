<?php
namespace core;

class Mailable {
    public $from;
    public $subject;
    public $body;
    public $view;

    public function __construct(){
        $this->handle();
    }

    public function from(){
        $this->from = MAIL_FROM_ADDRESS;
        return $this;
    }
    public function subject($subject){
        $this->subject = $subject;
        return $this;
    }

    public function body($body){
        $this->body = $body;
        return $this;
    }

    public function view($view){
        $this->view = "$view";
    }
}