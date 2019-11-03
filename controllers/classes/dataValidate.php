<?php

class DataValidate{
    private $emailAddress;
    private $subject;
    private $messageContent;
    private $result;

    public function emailValidate($email){

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($email);
            $this->emailAddress = $email;
        }
    }

    public function subjectValidate($subject){

        if (!empty($subject)) {
            $subject = htmlspecialchars($subject);
            $this->subject = $subject;
        }
        else{
            $this->subject = null;
        }  
    }

    public function messageValidate($message){

        if (!empty($message)) {
            $message = htmlspecialchars($message);
            $this->messageContent = $message;
        }
        else{
            $this->messageContent = null;
        }  
    }

    public function validateResult(){
        $email = $this->emailAddress;
        $subject = $this->subject;
        $msg = $this->messageContent;
        if ($email != null && $subject != null && $msg != null) {
            
            return true;
        }
        else{
            return false;
        }
    }

    public function getEmail(){
        return $this->emailAddress;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function getMessage(){
        return $this->messageContent;
    }
}