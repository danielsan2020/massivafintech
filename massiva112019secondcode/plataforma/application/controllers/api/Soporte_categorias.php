<?php

/**
 * Description of Soporte_categorias
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
class Soporte_categorias extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('soporte_categorias_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablasoporte_categorias
     * @url /soporte_categorias/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $this->_validation_tipo();
        $tipo = $this->get('tipo');
        $data['soporte_categorias'] = $this->soporte_categorias_model->get_all_by_tipo($tipo);
        if ($data['soporte_categorias'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _validation_tipo() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('tipo', 'tipo', 'trim|required|integer|is_natural_no_zero');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
