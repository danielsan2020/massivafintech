<?php

/**
 * Description of Cfdis
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
class Cfdis extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cfdis_model');
        date_default_timezone_set('America/Mexico_City');
    }
    
     /**
     * @title Metodo para obtener todos los cfdis emitidos.
     * @url /cfdis/get_all_emitidas
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_emitidas_get() {
        $persona_id = get_persona_id();
        $data['facturas'] = $this->cfdis_model->get_all_emitidas($persona_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }
     /**
     * @title Metodo para obtener todos los cfdis recibidos.
     * @url /cfdis/get_all_recibidas
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_recibidas_get() {
        $persona_id = get_persona_id();
        $data['facturas'] = $this->cfdis_model->get_all_recibidas($persona_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }
}