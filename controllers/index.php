<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require('../vendor/autoload.php');
require_once('classes/dataValidate.php');

// if (isset($_POST['send-btn'])) {
    
//     $mail = new PHPMailer();

//     $mail->isSMTP();
//     $mail->Host = "smtp.gmail.com";
//     $mail->SMTPAuth = true;
//     $mail->Username = "jonbcrypt@gmail.com";
//     $mail->Password = '#Hash123';
//     $mail->SMTPSecure = "ssl";
//     $mail->Port = 465;


//     $mail->isHTML(true);
//     $mail->setFrom("jonbcrypt@gmail.com", "Kacper");
//     $mail->addAddress("kacperu770@gmail.com", "Test");
//     $mail->Subject = "Siema";
//     $mail->Body = "Body of email -lorem ipsum dolor sit amet";
//     // ktesty@wp.pl

//     if ($mail->send()) {
//         // echo "Mail is sent";
//     }
//     else{
//         // echo 'Mailer error: ' . $mail->ErrorInfo;
//         // echo "Something is wrong";
//     }

// }
// else{      
// }


if (isset($_POST['send-btn'])) {

    //E-mail validate
    $receiver = $_POST['receiver-field'];

    $validator = new DataValidate();
    $validator->emailValidate($receiver);

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
    $message1 = $_POST['messageField'];

    $validator->messageValidate($message1);
    $message1 = $validator->getMessage();

    if($message1 != null){
        $m_error = false;

        $toast = true;

    }
    else{
        $m_error = true;
        $toast = false;
    }

    $result = $validator->validateResult();
 
}


$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('index.html', array(
    'e_error' => @$e_error,
    's_error' => @$s_error,
    'm_error' => @$m_error,
    'result' => @$result,
    'toastr' => @$toast,
    
));


?>