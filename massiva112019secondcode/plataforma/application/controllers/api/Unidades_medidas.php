<?php

/**
 * Description of Personas_clientes_contacto
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
class Unidades_medidas extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('unidades_medidas_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_all_get() {
        $data['unidades_de_medida'] = $this->unidades_medidas_model->get_all();
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
