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
        return (!preg_match("/^([a-zA-Z]{4})([0-9]{6})([a-zA-Z]{6})([a-zA-Z0-9]{2})$/", $str)) ? FALSE : TRUE;
    }

    public function rfc($str) {
        return (!preg_match("/^([a-zA-Z]{3,4})([0-9]{6})([a-zA-Z0-9]{3})$/", $str)) ? FALSE : TRUE;
    }

}
