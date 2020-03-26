<?php

//-------------------------- Generador de mensajes personalizados a usuarios------------------------------
if (!function_exists('generate_email_no_tengo_efirma_vigente')) {

    function generate_email_no_tengo_efirma_vigente($email_usuario, $nombre_usuario) {
        $CI = & get_instance();
        //-----  cargamos la libreria email de ci
        $CI->load->library("email");
        if (in_array($_SERVER['HTTP_HOST'], array('localhost', '127.0.0.1', '::1'))) {
            //configuracion para gmail
            $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_port' => 465,
                'smtp_user' => 'omar.munibes@gmail.com',
                'smtp_pass' => 'Omarselac0m3',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );
            $CI->email->initialize($configGmail);
            $CI->email->from('danielsancheztaza@gmail.com');
        } else {
            $configServer = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtpout.secureserver.net',
                'smtp_port' => 80,
                'smtp_user' => 'erick.velazquez@codekeepers.mx',
                'smtp_pass' => 'godaddyap3sta:3',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'crlf' => "\r\n"
            );
            $CI->email->initialize($configServer);
            $CI->email->from('info@godaddy.com', 'MDT');
        }
        //cargamos la configuración para enviar con gmail
        $CI->email->to($email_usuario);
        $CI->email->subject("No tengo efirma");
        $data = array('nombre' => $nombre_usuario);
        $CI->email->message($CI->load->view('email/no_tengo_efirma_vigente', $data, TRUE));
        if ($CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

}

