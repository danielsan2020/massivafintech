<?php

/**
 * Description of Personas_contadores
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
class Personas_contadores extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('personas_contadores_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_persona_by_id_get() {
        $id = $this->get('id');
        $data['persona'] = $this->personas_contadores_model->get_persona_by_id($id);
        if ($data['persona'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create_post() {
        $this->_validation_insert();
        $data = $this->_fill_insert_data();
        $this->db->trans_start();
        $id = $this->personas_contadores_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'personas_contadores', 1);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    public function update_post() {
        $this->_validation_update();
        $id = $this->get('id');
        $data = $this->_fill_update_data();
        $this->db->trans_start();
        if ($this->personas_contadores_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'personas_contadores', 3);
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _fill_insert_data() {
        $data = array();
        $data['contador_id'] = $this->post('contador_id');
        $data['persona_id'] = $this->post('persona_id');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _fill_update_data() {
        $data = array();
        $data['id'] = $this->get('id');
        $data['status'] = -1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('contador_id', 'contador', 'trim|integer|required');
        $this->form_validation->set_rules('persona_id', 'persona', 'trim|integer|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido para poder ser actualizado
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_update() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|integer');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('contador_id', ' contador', 'integer|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
