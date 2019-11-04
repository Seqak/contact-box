<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require('../vendor/autoload.php');
require_once('classes/dataValidate.php');


if (isset($_POST['send-btn'])) {

    $toastActive = true;
    //E-mail validate
    $receiver = $_POST['receiver-field'];

    $validator = new DataValidate();
    $validator->emailValidate($receiver);
    $receiver = $validator->getEmail();

    if($validator->getEmail() != null){
        $e_error = false;
    }
    else{$e_error = true;}

    //Subject validate
    $subject = $_POST['subject-field'];

    $validator->subjectValidate($subject);
    $subject = $validator->getSubject();

    if($subject != null){
        $s_error = false;
    }
    else{$s_error = true;}

    
    //Message content validate
    $messageContent = $_POST['message-field'];

    $validator->messageValidate($messageContent);
    $messageContent = $validator->getMessage();

    if($messageContent != null){
        $m_error = false; 
    }
    else{
        $m_error = true;
    }

    //Set response for JS toast alert
    // $toast = $validator->validateResult();

    if ($e_error != true && $s_error  != true && $m_error != true) {      
        $toast = true;
    }
    else{
        $toast = false;
    }

    //PHPMailer - Send e-mail with data below
    if ($toast == true) {
        if (isset($_POST['send-btn'])) {
    
            $mail = new PHPMailer();
        
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "#"; //Enter your data
            $mail->Password = '#'; //Enter your data
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
        
        
            $mail->isHTML(true);
            $mail->setFrom("#", "#"); //Enter your data
            $mail->addAddress($receiver);
            $mail->Subject = $subject;
            $mail->Body = $messageContent;
            // ktesty@wp.pl
        
            $mail->send();
        }
    }
}


//Implement Twig template engine
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('index.html', array(
    'e_error' => @$e_error,
    's_error' => @$s_error,
    'm_error' => @$m_error,
    'result' => @$result,
    'toastActive' => @$toastActive,
    'toastr' => @$toast,
    
));

/*
*
*
*
*
*/


?>