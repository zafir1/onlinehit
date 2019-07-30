<?php

include 'core/init.php';

/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true); 
try {
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'onlinehit.co@gmail.com';
    $mail->Password = 'zasdfghjklm@123#';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = '465';

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('zafirahmad718@gmail.com', 'Zafir Ahmad');
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}*/
	email("ahmadzafir01@gmail.com","Subject","Body");

 ?>