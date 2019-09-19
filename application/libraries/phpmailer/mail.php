<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: igorribeirolobo
 * Date: 18/09/19
 * Time: 23:39
 */

namespace PHPMailer\PHPMailer;


require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


class CI_Mail
{

    function _construct(){
        $this->ci =& get_instance();
    }

    function mail($to,$name,$subject,$message){

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'mail.valloritecnologia.com.br';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'naoresponda@valloritecnologia.com.br';                     // SMTP username
            $mail->Password   = 'naoresponda@123';                               // SMTP password
            $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 993;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('naoresponda@valloritecnlogia.com.br', 'Não Responda');
            $mail->addAddress($to, $name);     // Add a recipient

            // Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return  true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }


}