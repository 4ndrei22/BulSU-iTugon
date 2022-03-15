<?php
//Import PHPMailer classes into the global namespace
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$email = $_POST['email'];
$code = $_POST['code'];

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bulsuitugon@gmail.com';                     //SMTP username
    $mail->Password   = 'bulsuiTugon22';                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('bulsuitugon@gmail.com');
    $mail->addAddress(''.$email.'');     //Add a recipient
    

    //Content
    $mail->Subject = 'Forgot Password';
    $mail->Body    = 'your one time pin is '.$code.'
    
    if you did not request for change password, please ignore this email
    
    Thanks,
    BulSU iTugon';

    if($mail->send()){
        echo json_encode('Success');
    }
    else
        echo json_encode('Error');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$mail->smtpClose();
?>