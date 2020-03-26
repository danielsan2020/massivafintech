<?php

/**
 * Description of Personas
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
class Personas extends REST_Controller {
    /*
      Método constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('personas_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_all_personas_get() {
        $data['personas'] = $this->personas_model->get_all_personas();
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    /**
     * @title Método para obtener todas las personas activas que no tengan un jefe contador asignado de la tabla personas
     * @url /personas/get_all_personas_sin_contador
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_personas_sin_contador_get() {
        $data['personas'] = $this->personas_model->get_all_personas_sin_contador();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Método para obtener todas las personas activas que sí tienen un jefe contador asignado de la tabla personas
     * @url /personas/get_all_personas_con_contador
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_personas_con_contador_get() {
        $data['personas'] = $this->personas_model->get_all_personas_con_contador();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Método para obtener todas las personas activas por medio de su id de la tabla personas
     * @url /personas/get_by_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['persona'] = $this->personas_model->get_by_id($id);
        if ($data['persona'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Reglas para validar el obtener el id
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    function _validation_get_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
