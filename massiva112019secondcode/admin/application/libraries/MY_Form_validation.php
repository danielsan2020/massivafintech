<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of MY_Form_validation
 *
 * @author juan carlos
 */
class MY_Form_validation extends CI_Form_validation {

    public function __construct() {
        parent::__construct();
    }

    /**
     * alpha_dash_space_utf8_numbers
     *
     * cheque si el input tiene numeros y letras en formato ut8, asi como guiones y puntos para ciudades
     * y para nombres
     *
     * @param	string	$str
     * @return	bool
     */
    function alpha_dash_space_period_utf8_numbers($str) {
        return (!preg_match("/^([a-zñáéíóúÑÁÉÍÓÚüÜ0-9\. \-\_])+$/i", $str)) ? FALSE : TRUE;
    }

    /**
     * Valid Date
     *
     * Verify that the date value provided can be converted to a valid unix timestamp
     *
     * @param string  $str
     * @return    bool
     */
    public function valid_date($str) {
        if (($str = strtotime($str)) === FALSE) {
            $this->CI->form_validation->set_message('valid_date', '{field} must be a valid date.');
            return FALSE;
        }
        return TRUE;
    }

}
