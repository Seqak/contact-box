<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require('../vendor/autoload.php');

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
// $addressError = false;

if (isset($_POST['receiver-field'])) {
    
    $odbiorca = $_POST['receiver-field'];
    if ($odbiorca > 3) {
        $addressError = true;
    }
    else{
        $addressError = false;
    }   
}
else{
   
}


$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

$title = 'Cycki Marioli';
$title2 = 'Muffinki~~';

echo $twig->render('index.html', array(
    'alert' => 'Błąd walidacji danych',
    'age' => 3,
    'title' => $title,
    'title2' => $title2,
    'error1' => $addressError,
    
));


?>