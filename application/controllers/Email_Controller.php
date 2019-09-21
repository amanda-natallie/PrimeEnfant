<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function send($to, $name, $subject, $message)
    {
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'mail.valloritecnologia.com.br';
        $mail->SMTPAuth = true;
        $mail->Username = 'naoresponda@valloritecnologia.com.br';
        $mail->Password = 'naoresponda@123';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 995;

        $mail->setFrom('info@example.com', 'CodexWorld');
        $mail->addReplyTo($to, $name);

        // Add a recipient
        $mail->addAddress($to);

        // Email subject
        $mail->Subject = $subject;

        // Set email format to HTML
        $mail->isHTML(true);

        // Email body content
        $mailContent = $message;
        $mail->Body = $mailContent;

        // Send email
        if (!$mail->send()) {
            $error = 'Message could not be sent.<br /> Mailer Error: ' . $mail->ErrorInfo;

            print_r($error);
            die;

        } else {
            return true;
        }
    }

}