<?php
require_once("EmailServerInterface.php");
require_once("../vendor/autoload.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class MyEmailServer implements EmailServerInterface
{
    public function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'baitaptoan53@gmail.com';
                   $mail->Password = 'baitaptoan';
                   $mail->SMTPSecure = 'tls';
                   $mail->Port = 587;
                   $mail->setFrom('baitaptoan53@gmail.com', 'Nguyen Xuan Ngoc');
                   $mail->addAddress($to);
                   $mail->isHTML(true);
                   $mail->Subject = $subject;
                   $mail->Body = $body;
                   $mail->send();
                   }
                   }
                   ?>