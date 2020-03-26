<?php

/**
 * Description of Paquetes
 *
 */defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

/**
 * CodeIgniter Rest Controller
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package         API
 * @subpackage      Poner
 * @category        Poner
 * @author          Poner
 */
class Paquetes_regimenes extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('paquetes_regimenes_model');
        date_default_timezone_set('America/Mexico_City');
        $this->load->helper('openpay_helper');
    }
}