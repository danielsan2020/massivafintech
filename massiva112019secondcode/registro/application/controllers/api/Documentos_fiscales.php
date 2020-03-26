<?php

/**
 * Description of Documentos fiscales
 *
 */defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Documentos_fiscales extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('documentos_fiscales_model');
        date_default_timezone_set('America/Mexico_City');
        $this->load->helper('session');
    }
    /**
     * @title Metodo que busca y devuelve una lista de archivos por persona.
     * @url /documentos_fiscales/get_files_by_persona_id
     * @access public
     * @method GET
     * @param {type:$_SESSION, name:persona_id}
     * @successResponse Code: 200 HTTP_OK Content: [list_files]
     */
    public function get_files_by_persona_id_get() {
        $persona_id = get_persona_id();
        $data['list_files'] = $this->documentos_fiscales_model->get_files_by_persona_id($persona_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para crear un registro.
     * @url /documentos_fiscales/create
     * @access public
     * @method POST
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    public function create_post() {
        $this->_validation_insert();
        $this->db->trans_start();
        $data = $this->_fill_insert_data();
        $this->_dar_baja_anterior_documento();
        $id = $this->documentos_fiscales_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->_upload_file($id);
        $this->load->helper('logs');
        insert_log($id, 'documentos_fiscales', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Documento Guardado'], REST_Controller::HTTP_CREATED);
    }

    /**
     * @title Busca un registro en la base de datos con el tipo del archivo que se va a subir si lo encuentra lo da de baja
     * @Params:{tipo:POST,persona_id:$_SESSION}
     * 
     * @access protected
     */
    private function _dar_baja_anterior_documento() {
        $tipo = $this->post('tipo');
        $persona_id = get_persona_id();
        $documento = $this->documentos_fiscales_model->get_documento_by_persona_id_and_tipo($persona_id, $tipo);
        if ($documento !== NULL) {
            $data['status'] = -1;
            if (!$this->documentos_fiscales_model->update($documento['id'], $data)) {
                $this->response(['message' => "Error al tratar de dar de baja el documento"]);
            }
        }
    }

    /**
     * @title Subida de archivos con extension .pdf image/* .cer .key
     * 
     * 
     * @access protected
     */
    private function _upload_file($name) {
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array(get_persona_id(), "documentos", "fiscales"), $this->config->item("personas_path")); //generamos los paths correspodientes
        $path_upload = $this->config->item("personas_path") . "/" . get_persona_id() . "/documentos/fiscales";
        upload_file($path_upload, $name, "file", "*", TRUE);
    }

    /**
     * @title Llenado del data con los valores del formulario
     * @return array 
     * @access protected
     */
    private function _fill_insert_data() {
        $data = array();
        $data['nombre'] = $this->post('name');
        $data['persona_id'] = $_SESSION[$this->config->item('project_name')]['persona_id'];
        $data['extension'] = $this->post('extension');
        $data['tipo'] = $this->post('tipo');
        $data['status'] = 1;
        $data['created_at'] = date("Y-m-d H:i:s");
        return $data;
    }

    /**
     * @title Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('tipo', 'Tipo de archivo de subida', 'trim|required|integer|is_natural_no_zero');
        $this->form_validation->set_rules('name', 'Nombre del archivo', 'trim|required');
        $this->form_validation->set_rules('extension', 'Extensi&oacute;n del archivo', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
