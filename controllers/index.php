<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require('../vendor/autoload.php');

if (isset($_POST['send-btn'])) {
    
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "jonbcrypt@gmail.com";
    $mail->Password = '#Hash123';
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;


    $mail->isHTML(true);
    $mail->setFrom("jonbcrypt@gmail.com", "Kacper");
    $mail->addAddress("kacperu770@gmail.com", "Test");
    $mail->Subject = "Test e-mail2";
    $mail->Body = "Body of email -lorem ipsum dolor sit amet";
    // ktesty@wp.pl

    if ($mail->send()) {
        echo "Mail is sent";
    }
    else{
        echo 'Mailer error: ' . $mail->ErrorInfo;
        echo "Something is wrong";
    }

}
else{

        
}

if (isset($_POST['odbiorca-in'])) {
    // echo "tekstyyy: " . $_POST['odbiorca-in'];
    $_SESSION['test'] = $_POST['odbiorca-in'];
    
}
else{
    $_SESSION['test'] = "Nie działa";
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
    'test' => $_SESSION['test'],
    
));


?>