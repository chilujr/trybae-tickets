<?php

if(!isset($_SESSION)){
    session_start();
}
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class mail {

// function to send email

public function send_email($name, $email, $subject, $message) 
{
    $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";

        //Set gmail username
        $mail->Username = "chiyembekezop11@gmail.com";
        $mail->Password = "qgemzyrewwbrdtsz";
        $sub = $subject." ".$name;
        //Email subject
        $mail->Subject = $sub;
        $mail->setFrom("chiyembekezop11@gmail.com");
        $mail->isHTML(true);
        $mail->Body =  $message;
        $mail->addAddress("chiyembekezop11@gmail.com");

    if($mail->send()){
        $status = "failed";
        $response = "Message sent successfully";
        $_SESSION['response'] = $response;
    }
    else 
    {
        $status = "failed";
        $response = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['response'] = $response;
    }
}


public function send_qrcode($name, $email, $subject, $message, $qrcode) 
{
    //$path = "../img/qrcode_img/".$qrcode;
    $file_name = $_SESSION['tx_id'];
    $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;

        //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";

        //Set gmail username
        $mail->Username = "chiyembekezop11@gmail.com";
        $mail->Password = "qgemzyrewwbrdtsz";
        $sub = $subject." ".$name;
        //Email subject
        $mail->Subject = $sub;
        $mail->setFrom("chiyembekezop11@gmail.com");
        $mail->isHTML(true);
        $mail->Body =  $message;
        $mail->addAddress($email);
        $mail->addAttachment($qrcode, $file_name);

    if($mail->send()){
        $status = "failed";
        $response = "Message sent successfully";
        $_SESSION['response'] = $response;
    }
    else 
    {
        $status = "failed";
        $response = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['response'] = $response;
    }
}

    
}
?>

