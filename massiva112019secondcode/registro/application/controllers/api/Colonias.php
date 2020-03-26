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
class Colonias extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('colonias_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablapaquetes
     * @url /paquetes/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_colonias_by_codigo_postal_get() {
        $codigo_postal = $this->get('codigo_postal');
        $data['colonias'] = $this->colonias_model->get_all_colonias_by_codigo_postal($codigo_postal);
//        if ($data['codigo_postal'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
//        } else {
//            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
//        }
    }
    
    public function get_colonia_by_id_get(){
        $colonia_id = $this->get('id');
        $data['colonia'] = $this->colonias_model->get_colonia_by_id($colonia_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

}
