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

    /**
     * @title Metodo para obtener a la persona por medio de su id
     * @url /personas_contadores/get_persona_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_persona_by_id_get() {
        $id = $this->get('id');
        $data['persona'] = $this->personas_contadores_model->get_persona_by_id($id);
        if ($data['persona'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener a todas las personas por medio del id del contador
     * @url /personas_contadores/get_all_personas_by_contador_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_personas_by_contador_id_get() {
        $this->_validation_contador_id();
        $contador_id = $this->get('id');
        $this->load->helper('session');
        $jefe_contador_id = check_id();
        $data['personas'] = $this->personas_contadores_model->get_personas_by_jefe_id_and_contador_id($jefe_contador_id, $contador_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para obtener a todas las declaraciones por medio del id del contador
     * @url /personas_contadores/get_all_declaraciones_by_contador_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_declaraciones_by_contador_id_get() {
        $this->_validation_contador_id();
        $contador_id = $this->get('id');
        $this->load->helper('session');
        $jefe_contador_id = check_id();
        $data['declaraciones'] = $this->personas_contadores_model->get_all_declaraciones_by_jefe_contador_id_and_contador_id($jefe_contador_id, $contador_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }
    
    /**
     * @title Metodo para obtener a todas las declaraciones atrasadas por medio del id del contador
     * @url /personas_contadores/get_all_declaraciones_by_contador_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_declaraciones_atrasadas_by_contador_id_get() {
        $this->_validation_contador_id();
        $contador_id = $this->get('id');
        $this->load->helper('session');
        $jefe_contador_id = check_id();
        $data['declaraciones_atrasadas'] = $this->personas_contadores_model->get_all_declaraciones_declaraciones_by_jefe_contador_id_and_contador_id($jefe_contador_id, $contador_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Create
     * @url /personas_contadores/create_post
     * @access public
     * @method POST
     * @successResponse Code: 200 HTTP_OK
     */
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

    /**
     * @title Asigna una persona a un contador, creando la relación en la tabla personas_contadores
     * @url /personas_contadores/create_post
     * @access public
     * @method POST
     * @successResponse Code: 200 HTTP_OK
     */
    public function asignar_persona_a_contador_post() {
        $this->_validation_insert();
        $data_contador = $this->_fill_update_data();
        $personas_contadores_id = $this->get('id');
        $this->db->trans_start();
        if ($this->personas_contadores_model->update($personas_contadores_id, $data_contador)) {
            $data = $this->_fill_insert_data();
            $id = $this->personas_contadores_model->insert($data);
            $this->load->helper('logs');
            insert_log($id, 'personas_contadores', 1);
            insert_log($id, 'personas_contadores', 3);
            $this->db->trans_complete();
            $this->response(['id' => $id, 'message' => 'Contador asignado correctamente'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Actualizar el registro ya existente
     * @url /personas_contadores/update_post
     * @access public
     * @method POST
     * @successResponse Code: 200 HTTP_OK
     */
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
        $data['jefe_id'] = $this->post('jefe_id');
        $data['contador_id'] = $this->post('contador_id');
        $data['persona_id'] = $this->post('persona_id');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _fill_update_data() {
        $data = array();
        $data['id'] = $this->get('id');
        $data['jefe_id'] = $this->post('jefe_id');
        $data['status'] = -1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('contador_id', 'jefe contador', 'trim|integer|required');
        $this->form_validation->set_rules('jefe_id', 'jefe contador', 'trim|integer|required');
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
        $this->form_validation->set_rules('contador_id', 'jefe contador', 'trim|integer|required');
        $this->form_validation->set_rules('contador_id', 'jefe contador', 'trim|integer|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    private function _validation_contador_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|is_natural_no_zero|callback_is_contador_check');
        if (!$this->params_validation->run()) {
            $this->response(['message' => 'el id no pertenece a un contador'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function is_contador_check($posible_contador_id) {
        $this->load->model('usuarios_model');
        $contador = $this->usuarios_model->get_by_id($posible_contador_id);
        if ($contador['tipo'] === '4') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function values_filtros_check($filtros) {
        $filtros_array = json_decode(urldecode($filtros), TRUE);
        if ($filtros_array !== NULL) {
            foreach ($filtros_array as $filtro) {
                if ($filtro['key'] === 'anio_correspondiente') {
                    $anio_valido = $this->_anio_correspondiente_check($filtro['value']);
                    if (!$anio_valido) {
                        $this->params_validation->set_message('values_filtros_check', 'ingrese un año valido, Ejemplo, 2007');
                        return false;
                    }
                }
                if ($filtro['key'] === 'mes_correspondiente') {
                    $mes_valido = $this->_mes_correspondiente_check($filtro['value']);
                    if (!$mes_valido){
                        $this->params_validation->set_message('values_filtros_check', 'El valor del mes debe estar en [1,12]');
                        return false;
                    }
                    
                }
            }
        }
    }

    private function _anio_correspondiente_check($anio) {
        if (!ctype_digit($anio)) {
            return false;
        }
        $anio_en_formato_entero = (int) $anio;
        if ($anio_en_formato_entero <= 0) {
            return false;
        }
        return true;
    }
    
    private function _mes_correspondiente_check($mes){
        if (!ctype_digit($mes)) {
            return false;
        }
        $mes_en_formato_entero = (int) $mes;
        if (!($mes_en_formato_entero >= 1 && $mes_en_formato_entero <= 12)) {
            return false;
        }
        return true;
    }

}
