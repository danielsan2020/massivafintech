<?php

/**
 * Description of Paquetes
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Usuarios_personas extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios_personas_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener un registro activo de la tablausuarios_personas en base ausuario_id
     * @url /usuarios_personas/get_by_usuario_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_persona_id_by_usuario_id_get() {
        $data['usuario_persona'] = $this->usuarios_personas_model->get_persona_id_by_usuario_id($_SESSION[$this->config->item('project_name')]['id']);
        if ($data['usuario_persona'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos de la persona'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
