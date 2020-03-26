<?php

//-------------------------- Generador de contraseña y enviado por email------------------------------
if (!function_exists('generate_mail')) {

    function generate_mail($destinatario, $id_url) {
        $CI = & get_instance();
        //-----  cargamos la libreria email de ci
        $CI->load->library("email");
        if (in_array($_SERVER['HTTP_HOST'], array('localhost', '127.0.0.1', '::1'))) {
            //configuracion para gmail
            $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://mail.massiva.mx',
                'smtp_port' => 465,
                'smtp_user' => 'notificaciones@massiva.mx',
                'smtp_pass' => 'notificacionesmassiva@2020_8',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );
            $CI->email->initialize($configGmail);
            $CI->email->from('notificaciones@massiva.mx');
        } else {
            $configServer = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtpout.secureserver.net',
                'smtp_port' => 465,
                'smtp_user' => 'notificaciones@massiva.mx',
                'smtp_pass' => 'notificacionesmassiva@2020_8',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'crlf' => "\r\n"
            );
            $CI->email->initialize($configServer);
            $CI->email->from('notificaciones@massiva.mx', 'MDT');
        }
        //cargamos la configuración para enviar con gmail
        $CI->email->to($destinatario);
        $CI->email->subject('Massiva registro');
        $data = array('url' => $CI->config->item('base_url') . 'registro/usuario/' . $id_url);
        $CI->email->message($CI->load->view('mail/registro', $data, TRUE));
        if ($CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function generate_mail_change_password($destinatario, $id_url) {
        $CI = & get_instance();
        $CI->load->library("email");
        if (in_array($_SERVER['HTTP_HOST'], array('localhost', '127.0.0.1', '::1'))) {
            //configuracion para gmail
            $configGmail = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtpout.secureserver.net',
                'smtp_port' => 465,
                'smtp_user' => 'notificaciones@massiva.mx',
                'smtp_pass' => 'notificacionesmassiva@2020_8',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'crlf' => "\r\n"
            );
            $CI->email->initialize($configGmail);
            $CI->email->from('notificaciones@massiva.mx');
        } else {
            $configServer = array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtpout.secureserver.net',
                'smtp_port' => 465,
                'smtp_user' => 'notificaciones@massiva.mx',
                'smtp_pass' => 'notificacionesmassiva@2020_8',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            );
            $CI->email->initialize($configServer);
            $CI->email->from('notificacionesmassiva@2020_8', 'MDT');
        }

        $CI->email->to($destinatario);
        $CI->email->subject('Massiva recuperación de contraseña');
        $data = array('url' => $CI->config->item('base_url') . 'registro/password/' . $id_url);
        $CI->email->message($CI->load->view('mail/recuperar_password', $data, TRUE));
        if ($CI->email->send()) {
            return true;
        } else {
            return false;
        }
    }

}

