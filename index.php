<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 80;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "roeldingle@gmail.com";
$mail->Password   = "gm@il@lb@rnkidd05";


$mail->IsHTML(true);
$mail->AddAddress("rmdingle@straightarrow.com.ph", "Roel Dingle");
$mail->SetFrom("roeldingle@gmail.com", "Roel Test");
$mail->AddReplyTo("roeldingle@gmail.com", "Roel Test");
$mail->AddCC("roeldingle@gmail.com", "Roel Test");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";


$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}




echo "tester gmail tester send email";

