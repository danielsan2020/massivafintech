<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

/**
 * Description of Descargas
 *
 * @author dell
 */
class Descargas  extends REST_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('documentos_fiscales_model');
        date_default_timezone_set('America/Mexico_City');
    }
    /**
     * @title Metodo para obtener todos los archivos de documentos fiscales por persona_id
     * @url /descargas/get_files_by_persona_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_files_by_persona_id_get(){
        $this->_validation_id();
        $persona_id = $this->get("persona_id");
        $files = $this->documentos_fiscales_model->get_files_by_persona_id($persona_id);
        $this->response(['files' =>$files], REST_Controller::HTTP_OK);
    }
    /**
     * Valida que la persona_id del GET sea obligatoria
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('persona_id', 'Persona Id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
}
