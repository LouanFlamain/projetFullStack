<?php


namespace App\Helpers;

use App\Entity\Invitation;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;



class MailHelper
{
    public static function MailSender( Invitation $invitation) {

        $mail= new PHPMailer(true);
        try {

            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'mail'; //nom du conteneur
            $mail->Port = 1025;
            $mail->SMTPAuth = false;


            //$mail->SMTPSecure = 'tls';
            $mail->SetFrom("personne@gmalil.com");
            $mail->addAddress($invitation ->getMail());

            $mail->Subject = "sujet du message";
            $mail->Body = $invitation ->getToken();

            $mail->Send();
            echo "Message envoyé";

        }catch (Exception){
            echo "Message non envoyé. ERREUR:{$mail->ErrorInfo}";
        }
        die;
    }
}