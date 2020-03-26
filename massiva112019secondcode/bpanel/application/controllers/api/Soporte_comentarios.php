<?php

/**
 * Description of Soporte_tickets
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
class Soporte_comentarios extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('soporte_comentarios_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Obtener los comentarios by soporte_ticket_id. 
     * @url /personas/get_list_comentarios_by_soporte_ticket_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_list_comentarios_by_soporte_ticket_id_get() {
        $soporte_ticket_id = $this->get('id');
        $data['lista_comentarios'] = $this->soporte_comentarios_model->get_list_comentarios_by_soporte_ticket_id($soporte_ticket_id);
        foreach ($data['lista_comentarios'] as &$comentario) {
            if ($comentario['tipo'] === "1") {
                $comentario['comentario'] = json_decode($comentario['comentario']);
            }
            unset($comentario);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function get_next_comentarios_by_soporte_ticket_id_get() {
        $this->_params_validation_soporte_ticket_id();
        $this->_params_validation_id();
        $soporte_ticket_id = $this->get('soporte_ticket_id');
        $registro_id = $this->get('registro_id');
        $data['lista_comentarios'] = $this->soporte_comentarios_model->get_next_by_soporte_ticket_id($soporte_ticket_id, $registro_id);
        foreach ($data['lista_comentarios'] as &$comentario) {
            if ($comentario['tipo'] === "1") {
                $comentario['comentario'] = json_decode($comentario['comentario']);
            }
            unset($comentario);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function get_last_comentarios_by_soporte_ticket_id_get() {
        $this->_params_validation_soporte_ticket_id();
        $this->_params_validation_id();
        $soporte_ticket_id = $this->get('soporte_ticket_id');
        $registro_id = $this->get('registro_id');
        $data['lista_comentarios'] = $this->soporte_comentarios_model->get_last_by_soporte_ticket_id($soporte_ticket_id, $registro_id);
        foreach ($data['lista_comentarios'] as &$comentario) {
            if ($comentario['tipo'] === "1") {
                $comentario['comentario'] = json_decode($comentario['comentario']);
            }
            unset($comentario);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Crear comentario en el ticket 
     * @url /soporte_comentarios/create_comentario_post
     * @access public
     * @method POST
     * @successResponse Code: 200 HTTP_OK
     */
    public function create_comentario_text_post() {
        $this->_params_validation_soporte_ticket_id();
        $this->_validation_insert_texto();
        $data = $this->_fill_insert_data_texto();
        $this->db->trans_start();
        $id = $this->soporte_comentarios_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se pudo crear el comentario'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'soporte_comentarios', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Comentario creado'], REST_Controller::HTTP_CREATED);
    }

    /**
     * @title Metodo para crear un registro de tipo texto en el soporte comentario.
     * @url /soporte_comentarios/create_texto
     * @access public
     * @method POST
     * @dataParams ticket_id: [int(10) unsigned]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    public function create_comentario_file_post() {

        $this->_params_validation_soporte_ticket_id();

        $this->_validation_insert_file();
        $persona_id = $this->get('persona_id');

        $data = $this->_fill_insert_data_file();
        $this->db->trans_start();
        $id = $this->soporte_comentarios_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se pudo crear el soporte de tipo archivo'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'soporte_comentarios', $data);
        $this->_upload_file($data['soporte_ticket_id'], $persona_id, $id);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Comentario creado'], REST_Controller::HTTP_CREATED);
    }

    /**
     * intenta subir un archivo a la carpeta de soporte de la persona
     * 
     * @access protected
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    private function _upload_file($soporte_ticket_id, $persona_id, $comentario_id) {
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array($persona_id, "soporte", $soporte_ticket_id, $comentario_id), $this->config->item("personas_path")); //generamos los paths correspodientes
        $path_upload = $this->config->item("personas_path") . "/" . $persona_id . "/soporte/" . $soporte_ticket_id . "/" . $comentario_id;
        upload_file($path_upload, $comentario_id, 'file', "*", TRUE);
    }

    /**
     * Llena el arreglo con los datos de tipo txt 
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data_texto() {
        $data = array();
        $data['tipo'] = $this->post('tipo');
        $data['soporte_ticket_id'] = $this->get('soporte_ticket_id');
        $data['usuario_id'] = get_id();
        $data['comentario'] = $this->post('comentario');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Llena el arreglo con los datos tipo de archivo
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data_file() {
        $data = array();
        $tmp_name = explode(".", $_FILES['file']['name']);
        $data['soporte_ticket_id'] = $this->get('soporte_ticket_id');
        $data['usuario_id'] = get_id();
        $data['tipo'] = $this->post('tipo');
        $data['comentario'] = json_encode(array("name" => $tmp_name[0], "extension" => $tmp_name[1], "tamanio" => $_FILES['file']['size']));
        $data['created_at'] = date('Y-m-d H:i:s');
        $data["status"] = 1;
        return $data;
    }

    /**
     * Reglas que validan el parametro first_id
     * @Params:{first_id:required|integer|is_natural}
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _params_validation_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('registro_id', 'id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que validan los parámetros enviados por la url
     * @Params:{soporte_ticket_id:required|integer|is_natural}
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _params_validation_soporte_ticket_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('soporte_ticket_id', 'Soporte_ticket_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert_texto() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo de comentario', 'trim|required|integer');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert_file() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comentario', 'Comentario', 'callback_validation_file');
        $this->form_validation->set_rules('tipo', 'Tipo de comentario', 'trim|required|integer');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Valida que el archivo sea obligatorio.
     * 
     * @access protected
     * @return Boolean 
     */
    public function validation_file() {
        $this->form_validation->set_message('validation_file', 'Selecciona un archivo');
        return (isset($_FILES['file']['name']));
    }

}
