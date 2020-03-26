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
class Soporte_tickets extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->model('soporte_tickets_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener un registro activo de la tablapaquetes en base aid
     * @url /soporte_tickets/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_id();
        $id = $this->get('id');
        $data['soporte_ticket'] = $this->soporte_tickets_model->get_by_id($id);
        if ($data['soporte_ticket'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo que trae todos los tickets en estatus abiertos y pendientes por persona.
     * @url /soporte_tickets/get_all_tickets_abierto_pendiente_by_persona_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_CREATED OK: {lista_tickets:array}
     */
    public function get_all_tickets_abierto_pendiente_by_persona_id_get() {
        $this->_validation_persona_id();
        $persona_id = $this->get('persona_id');
        $data['lista_tickets'] = $this->soporte_tickets_model->get_all_by_persona_id_by_status($persona_id, [1, 3]);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo que trae todos los tickets en estatus cerrado por persona.
     * @url /soporte_tickets/get_all_tickets_abierto_cerrado_by_persona_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_CREATED OK: {lista_tickets:array}
     */
    public function get_all_tickets_cerrado_by_persona_id_get() {
        $this->_validation_persona_id();
        $persona_id = $this->get('persona_id');
        $data['lista_tickets'] = $this->soporte_tickets_model->get_all_by_persona_id_by_status($persona_id, [2]);
        $this->response([$data], REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para crear un registro.
     * @url /soporte_tickets/create
     * @access public
     * @method POST
     * @dataParams soporte_categoria_id: [int(10) unsigned]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    public function create_post() {
        $this->_validation_insert();
        $data = $this->_fill_insert_data();
        $this->db->trans_start();
        $id = $this->soporte_tickets_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se pudo crear el ticket'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'soporte_tickets', $data);
        $this->_create_soporte_comentario($id);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Ticket Creado'], REST_Controller::HTTP_CREATED);
    }

    private function _create_soporte_comentario($soporte_ticket_id) {
        $number_files_uploading = $this->post('number_files_uploading');
        $this->_create_soporte_comentario_txt($soporte_ticket_id);
        if ($number_files_uploading > 0) {
            $this->_create_soporte_comentario_files($number_files_uploading, $soporte_ticket_id);
        }
    }

    private function _create_soporte_comentario_txt($soporte_ticket_id) {
        $this->load->model('soporte_comentarios_model');
        $data = $this->_fill_insert_txt_soporte_comentario_data();
        $data['soporte_ticket_id'] = $soporte_ticket_id;
        $id = $this->soporte_comentarios_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se pudo crear el soporte de tipo texto'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        insert_log($id, 'soporte_comentarios', $data);
    }

    private function _create_soporte_comentario_files($number_files_uploading, $soporte_ticket_id) {
        $this->load->helper(array('files_helper', 'path_helper'));
        for ($i = 0; $i < $number_files_uploading; $i++) {
            $data = $this->_fill_insert_file_soporte_comentario_data($i);
            $data['soporte_ticket_id'] = $soporte_ticket_id;
            $id = $this->soporte_comentarios_model->insert($data);
            if ($id === NULL) {
                $this->response(['message' => 'Error: No se pudo crear el soporte de tipo archivo'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            insert_log($id, 'soporte_comentarios', $data);
            $this->_upload_file($i, $soporte_ticket_id, $id);
        }
    }

    private function _upload_file($i, $soporte_ticket_id, $comentario_id) {
        path_create(array(get_persona_id(), "soporte", $soporte_ticket_id, $comentario_id), $this->config->item("personas_path")); //generamos los paths correspodientes
        $path_upload = $this->config->item("personas_path") . "/" . get_persona_id() . "/soporte/" . $soporte_ticket_id . "/" . $comentario_id;
        upload_file($path_upload, $comentario_id, 'new_files_uploading_' . $i, "*", TRUE);
    }

    private function _fill_insert_file_soporte_comentario_data($i) {
        $data = array();
        $tmp_name = explode(".", $_FILES['new_files_uploading_' . $i]['name']);
        $data['usuario_id'] = get_id();
        $data['tipo'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data["status"] = 1;
        $data['comentario'] = json_encode(array("name" => $_FILES['new_files_uploading_' . $i]['name'], "extension" => $tmp_name[1], "tamanio" => $_FILES['new_files_uploading_' . $i]['size']));
        return $data;
    }

    private function _fill_insert_txt_soporte_comentario_data() {
        $data = array();
        $data['tipo'] = $this->post('number_files_uploading');
        $data['usuario_id'] = get_id();
        $data['comentario'] = $this->post('comentario');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data() {
        $data = array();
        $data['numero_ticket'] = $this->_generate_numero_ticket();
        $data['descripcion'] = $this->post('descripcion');
        $data['soporte_categoria_id'] = $this->post('soporte_categoria_id');
        $data['persona_id'] = get_persona_id();
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }

    private function _generate_numero_ticket() {
        $this->load->model('soporte_categorias_model');
        $soporte_categoria_id = $this->post('soporte_categoria_id');
        $last_numero_ticket_bd = $this->soporte_tickets_model->get_last_numero_ticket_by_soporte_categoria_id($soporte_categoria_id);
        $last_numero_ticket = 0;
        if ($last_numero_ticket_bd !== NULL) {
            $numero_ticket_bd = substr($last_numero_ticket_bd['numero_ticket'], 3, strlen($last_numero_ticket_bd['numero_ticket']));
            $last_numero_ticket = (int) $numero_ticket_bd + 1;
        } else {
            $last_numero_ticket = 1;
        }
        $clave_categoria = $this->soporte_categorias_model->get_clave_by_id($soporte_categoria_id);
        if ($clave_categoria !== NULL) {
            return $clave_categoria['clave'] . $this->_fill_left_any_caracter($last_numero_ticket, 4, "0");
        } else {
            $this->response(['Error no se encuentra el tipo de categoria:Contacte a soporte técnico'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _fill_left_any_caracter($cadena, $longitud, $fill) {
        $temp = '';
        while ((mb_strlen($cadena) + mb_strlen($temp)) < $longitud) {
            $temp .= $fill;
        }
        $temp .= $cadena;
        return $temp;
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('soporte_categoria_id', 'Categoría', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('descripcion', 'Descripci&oacute;n', 'trim|required|max_length[250]');
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|required');
        $this->form_validation->set_rules('number_files_uploading', 'Tipo de comentario', 'trim|required|integer');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que validan los parámetros enviados por la url
     * @Params:{persona_id:required|integer|is_natural}
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_persona_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('persona_id', 'Persona_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => params_validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Reglas que validan los parámetros enviados por la url
     * @Params:{id:required|integer|is_natural}
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Persona_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => params_validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
