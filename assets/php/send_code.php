<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;




require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

function sendCode($email,$subject,$code){
global $mail;
    try {
        
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'keertivijapur.13@gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'keertivijapur.13@gmail.com';                     
        $mail->Password   = 'Keerti@13';                               
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    
    
        $mail->setFrom('keertivijapur.13@gmail.com', 'eco-kannect');    
        $mail->addAddress($email);               
    
       
        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = 'Your Verification code is : <b>'.$code.'</b>';
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}
