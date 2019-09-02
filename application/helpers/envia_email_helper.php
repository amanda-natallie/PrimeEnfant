<?php

function enviarEmail($to, $subject, $message, $credencial = array('host' => 'eitinerante.com.br', 'user' => 'esquici_senha@eitinerante.com.br', 'senha' => 'H@z63jf4', 'from' => 'esquici_senha@eitinerante.com.br')) {

    $CI = & get_instance();
    $CI->load->library('email');

    $config = array(
        'protocol' => 'smtp',
        'smtp_host' => $credencial['host'],
        'smtp_port' => '25',
        'smtp_user' => $credencial['user'],
        'smtp_pass' => $credencial['senha'],
        'mailtype' => 'html',
        'charset' => 'utf-8',
        'wordwrap' => TRUE,
        'newline' => "\r\n"
    );

    $CI->email->initialize($config);

    $CI->email->from($credencial['from'], 'Eitinerante');
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($message);
    $status = $CI->email->send();

    return $status;
}
