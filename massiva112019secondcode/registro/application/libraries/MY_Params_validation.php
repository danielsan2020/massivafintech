<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Params_validation extends CI_Params_validation { // Capitalization matters

    public function __construct($rules = array()) {
        // Pass the $rules to the parent constructor.
        parent::__construct($rules);
    }

    public function check_order_exists($order) {
        $ordenamientos_array = json_decode(urldecode($order), TRUE);
        foreach ($ordenamientos_array as $ordenamiento) {
            if (!isset($ordenamiento['key'])) {
                $this->CI->params_validation->set_message('check_order_exists', 'En el ordenamiento no existe el parametro');
                return FALSE;
            }
            if (!isset($ordenamiento['value'])) {
                $this->CI->params_validation->set_message('check_order_exists', 'En el ordenamiento no existe el valor');
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_filter_exists($filter) {
        $filtros_array = json_decode(urldecode($filter), TRUE);
        foreach ($filtros_array as $filtro) {
            if (!isset($filtro['key'])) {
                $this->CI->params_validation->set_message('check_filter_exists', 'En el filtro no existe el parametro');
                return FALSE;
            }
            if (!isset($filtro['value'])) {
                $this->CI->params_validation->set_message('check_filter_exists', 'En el filtro no existe el valor');
                return FALSE;
            }
            if (!isset($filtro['type'])) {
                $this->CI->params_validation->set_message('check_filter_exists', 'En el filtro no existe el tipo');
                return FALSE;
            }
        }
        return TRUE;
    }

}
