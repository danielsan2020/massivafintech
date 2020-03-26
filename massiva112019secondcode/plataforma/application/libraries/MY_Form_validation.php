<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Form_validation
 *
 */
class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

    public function curp($str) {
        $this->CI->form_validation->set_message('curp', 'El CURP ingresado no es valido');
        return (!preg_match("/^([a-zA-Z]{4})([0-9]{6})([a-zA-Z]{6})([a-zA-Z0-9]{2})$/", $str)) ? FALSE : TRUE;
    }

    public function rfc($str) {
        $this->CI->form_validation->set_message('rfc', 'El RFC ingresado no es valido');
        return (!preg_match("/^([a-zA-Z]{3,4})([0-9]{6})([a-zA-Z0-9]{3})$/", $str)) ? FALSE : TRUE;
    }

    /**
     * date
     *
     * Check if the input value is date in the format yyyy- mm -dd
     *
     *
     * @param	string	$date
     * @return	bool
     */
    public function date($date) {
        $bd = FALSE;
        if (is_string($date)) {
            if (preg_match("/^[[:digit:]]{4}-[[:digit:]]{2}-[[:digit:]]{2}$/", $date)) {
                $fecha = explode('-', $date);
                if (checkdate($fecha[1], $fecha[2], $fecha[0])) {
                    $bd = TRUE;
                } else if ($date == '0000-00-00') {
                    $bd = TRUE;
                }
            }
        }
        if (!$bd) {
            $this->CI->form_validation->set_message('date', 'La fecha ingresada no es valida');
        }
        return $bd;
    }

    public function min($value, $min) {
        $bd = FALSE;
        if (is_numeric($value)) {
            if (is_int($value)) {
                $value = intval($value);
            } else {
                if (is_float($value)) {
                    $value = floatval($value);
                }
            }
            if ($value >= $min) {
                $bd = TRUE;
            }
        }
        if (!$bd) {
            $this->CI->form_validation->set_message('min', 'El valor de {field} debe de ser mayor o igual a  ' . $min);
        }
        return $bd;
    }

    public function max($value, $max) {
        $bd = FALSE;
        if (is_numeric($value)) {
            if (is_int($value)) {
                $value = intval($value);
            } else {
                if (is_float($value)) {
                    $value = floatval($value);
                }
            }
            if ($value <= $max) {
                $bd = TRUE;
            }
        }
        if (!$bd) {
            $this->CI->form_validation->set_message('max', 'El valor de {field} debe de ser menor o igual a  ' . $max);
        }
        return $bd;
    }

}
