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
class Productos_sat extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('productos_sat_model');
        date_default_timezone_set('America/Mexico_City');
    }
    
/**
     * @title Metodo para obtener la descripcion de un producto por medio de su clave
     * @url /personas_clientes/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_producto_by_clave_get() {
        $clave = $this->get('clave');
        $data['informacion_producto'] = $this->productos_sat_model->get_producto_by_clave($clave);
        $this->response($data, REST_Controller::HTTP_OK);
    }
}
