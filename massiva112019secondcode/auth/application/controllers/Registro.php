<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('preregistros_model');
        $this->load->model('usuarios_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function Usuario($id_url) {
        $this->load->helper('url');
        $url_decode = urldecode($id_url);
//        if (base64_decode($url_decode)) {
//            echo (base64_decode($url_decode));
        base64_decode($url_decode);
        $url = base64_decode($url_decode);
        if (gzinflate($url)) {
            $id_registro = gzinflate($url);
            $registro_array = explode('|', $id_registro);
            $usuario_id = $registro_array[0];
            $email_usuario = $registro_array[1];
            $preregistro_encontrado = $this->preregistros_model->get_preregistro_by_id_and_email($usuario_id, $email_usuario);
            if ($preregistro_encontrado === NULL) {
                $this->load->view('url-no-existe');
            } else if ($preregistro_encontrado['status'] !== '1') {
                $this->load->view('url-no-disponible');
            } else {
                $data['api_url'] = $this->config->item('api_url');
                $data['base_url'] = $this->config->item('base_url');
                $data['usuario_id'] = $usuario_id;
                $this->load->view('establecer-password-form', $data);
            }
        }
    }

    public function Password($id_url) {
        $this->load->helper('url');
        $url_decode = urldecode($id_url);
        $url = base64_decode($url_decode);
        if (gzinflate($url)) {
            $id_registro = gzinflate($url);
            $registro_array = explode('|', $id_registro);
            $usuario_id = $registro_array[0];
            $username = $registro_array[1];
            $date = new DateTime($registro_array[2]);
            $fecha_actual = new DateTime("now");
            $diferencia = $date->diff($fecha_actual);
            $diferencia_numero = (int) $diferencia->format('%H%i');
            if ($diferencia_numero > 200) {
                $this->load->view('url-expirada');
            } else {
                $usuario_encontrado = $this->usuarios_model->get_registro_by_id_and_username($usuario_id, $username);
                if ($usuario_encontrado === NULL) {
                    $this->load->view('url-no-existe');
                } else {
                    $data['api_url'] = $this->config->item('api_url');
                    $data['base_url'] = $this->config->item('base_url');
                    $data['usuario_id'] = $usuario_id;
                    $this->load->view('reestablecer-password-form', $data);
                }
            }
        }
    }

}
