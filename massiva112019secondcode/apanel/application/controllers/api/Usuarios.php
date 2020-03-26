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
class Usuarios extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_all_contadores_y_personas_de_cada_contador_get() {
        $jefe_id = $this->get('id');
        $data['contadores'] = $this->usuarios_model->get_all_contadores($jefe_id);
        if ($data['contadores'] !== NULL) {
            $this->_get_personas_activas($data['contadores']);
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function get_all_contadores_asignados_get(){
        $this->load->helper('session');
        $jefe_contador_id = check_id();
        $this->load->model('contadores_and_equipos_model');
        $data['contadores']=$this->contadores_and_equipos_model->get_all_contadores_by_jefe_id($jefe_contador_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    function _get_personas_activas(&$contadores) {
        $this->load->model('personas_model');
        foreach ($contadores as &$contador) {
            $contador['contadores'] = $this->personas_model->get_cantidad_de_personas_by_contador($contador['id']);
        }
    }

}
