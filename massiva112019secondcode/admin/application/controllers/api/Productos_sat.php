<?php

/**
 * Description of Productos_sat
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

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
     * @title Metodo para obtener un registro activo de la tabla productos_sat en base a grupo_id
     * @url /productos_sat/get_by_grupo_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_grupo_id_get() {
        $this->_validation_get_division_id();
        $grupo_id = $this->get('grupo_sat_id');
        $data['total_productos'] = $this->productos_sat_model->count_all_activos($grupo_id);
        if ($data['total_productos'] === 0) {
            $data['productos_sat'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['productos_sat'] = $this->productos_sat_model->get_all_by_grupo_id($grupo_id);
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    /*
      Realizando las validaciones para el metodo get_by_grupo_id_get
     */
    private function _validation_get_division_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('grupo_sat_id', 'Grupo_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
