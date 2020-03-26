<?php

/**
 * Description of Regimenes_fiscales
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
class Regimenes_fiscales extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('regimenes_fiscales_model');
        $this->load->model('personas_model');
        date_default_timezone_set('America/Mexico_City');
        $this->load->helper('session');
    }

    /**
     * @title Metodo para obtener un registro por su id de la tablaregimenes_fiscales
     * @url /regimenes_fiscales/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $data['regimen'] = $this->regimenes_fiscales_model->get_by_id($this->get('id'));
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
     /**
     * @title Metodo para obtener los registros activos por su tipo de la tablaregimenes_fiscales
     * @url /regimenes_fiscales/get_by_tipo_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_tipo_get() {
        $persona_id = get_persona_id();
        $persona = $this->personas_model->get_by_id($persona_id);
        $data['regimenes_fiscales'] = $this->regimenes_fiscales_model->get_by_tipo($persona['tipo']);
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
