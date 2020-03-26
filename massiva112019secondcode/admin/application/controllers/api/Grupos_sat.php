<?php

/**
 * Description of Grupos_sat
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Grupos_sat extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('grupos_sat_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablapreguntas_frecuentes
     * @url /preguntas_frecuentes/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $data['preguntas_frecuentes'] = $this->preguntas_frecuentes_model->get_all();
        if ($data['preguntas_frecuentes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener un registro activo de la tabla grupos_sat en base aid
     * @url /grupos_sat/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $division_id = $this->get('division_id');
        $data['grupos_sat'] = $this->grupos_sat_model->get_by_id($id, $division_id);
        if ($data['grupos_sat'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener un registro activo de la tabla grupos_sat en base a division_id
     * @url /grupos_sat/get_by_division_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_division_id_get() {
        $this->_validation_get_division_id();
        $division_id = $this->get('division_id');
        $data['total_grupos'] = $this->grupos_sat_model->count_all_activos($division_id);
        if ($data['total_grupos'] === 0) {
            $data['grupos_sat'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['grupos_sat'] = $this->grupos_sat_model->get_all_by_categoria_id($division_id);
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapreguntas_frecuentes
     * @url /preguntas_frecuentes/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['preguntas_frecuentes'] = $this->preguntas_frecuentes_model->get_all_inactive();
        if ($data['preguntas_frecuentes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Método para obtener todo los registros inactivos por medio de su division_id de la tabla grupos_sat
     * @url /grupos_sat/get_all_inactive_by_division_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_by_division_id_get() {
        $division_id = $this->get('division_id');
        $data['total_grupos'] = $this->grupos_sat_model->count_all_inactivos($division_id);
        if ($data['total_grupos'] === 0) {
            $data['grupos_sat'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['grupos_sat'] = $this->grupos_sat_model->get_all_inactive_by_division_id($division_id);
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /grupos-sat/create
     * @access public
     * @method POST
     * @urlParams categoria_id: [int(10) unsigned]
     * @dataParams pregunta: [text]
     * @dataParams respuesta: [text]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Creando un nuevo registro
     */
    public function create_post() {
        $this->_validation_insert();
        $data = $this->_fill_insert_data();
        $this->db->trans_start();
        $id = $this->grupos_sat_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'Grupos_sat', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /preguntas_frecuentes/update/id/:id
     * @access public
     * @method POST
     * @urlParams id: [int(10) unsigned]
     * @urlParams categoria_id: [int(10) unsigned]
     * @dataParams pregunta: [text]
     * @dataParams respuesta: [text]
     * @urlParams id: [integer]
     * @dataParams variable : [string]
     * @successResponse Code: 201 HTTP_CREATED Content: {message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */

    public function update_post() {
        $this->_validation_update();
        $id = $this->get('id');
        $data = $this->_fill_update_data();
        $this->db->trans_start();
        if ($this->grupos_sat_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'Grupos_sat', $data);
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para borrar un registro
     * @url /preguntas_frecuentes/inactivate/id/:id
     * @access public
     * @method POST
     * @urlParams id: [integer]
     * @successResponse Code: 200 HTTP_OK Content: {message:[string]}
     * @errorResponse Code: 400 HTTP_BAD_REQUEST Content: {message:[string]}
     */

    public function inactivate_post() {
        $this->_validation_id();
        $id = $this->get('id');
        $data['status'] = -1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($this->grupos_sat_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "Grupos_sat");
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /grupo_sat/reactive/id/:id
     * @access public
     * @method POST
     * @urlParams id: [integer]
     * @successResponse Code: 200 HTTP_OK Content: {message:[string]}
     * @errorResponse Code: 400 HTTP_BAD_REQUEST Content: {message:[string]}
     */

    public function reactivate_post() {
        $this->_validation_id();
        $id = $this->get('id');
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($this->grupos_sat_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "grupos_sat", $data);
            $this->response(['message' => 'El registro se dio de alta con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data() {
        $data = array();
        $data['division_sat_id'] = $this->get('division_id');
        $data['clave'] = $this->post('clave');
        $data['descripcion'] = $this->post('descripcion');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }

    /**
     * Llena el arreglo con los datos que se insertan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_update_data() {
        $data = array();
        $data['id'] = $this->get('id');
        $data['division_sat_id'] = $this->get('division_id');
        $data['clave'] = $this->post('clave');
        $data['descripcion'] = $this->post('descripcion');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _generate_public_json() {
        $this->load->model('divisiones_sat_model');
        $divisiones_sat = $this->divisiones_sat_model->get_all_generate_json();
        foreach ($categorias_preguntas_frecuentes as &$categoria) {
            $categoria['preguntas'] = $this->preguntas_frecuentes_model->get_all_by_categoria_id_json($categoria['id']);
            unset($categoria);
        }
        $content_public = $this->config->item('public_path') . 'content/';
        $preguntas_file = fopen($content_public . "preguntas_frecuentes.json", "w") or die("Error al crear el archivo publico!");
        fwrite($preguntas_file, json_encode($categorias_preguntas_frecuentes));
        fclose($preguntas_file);
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('division_id', 'Division_sat_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('clave', 'Calve', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
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
        $this->params_validation->set_rules('id', 'Id', 'trim|required|is_natural|integer');
        $this->params_validation->set_rules('division_id', 'Categoria', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('clave', 'Calve', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido para poder ser inactivado o reactivado
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    /*
      Realizando las validaciones para el metodo get_by_id_get
     */
    private function _validation_get_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    /*
      Realizando las validaciones para el metodo get_by_categoria_id_get
     */
    private function _validation_get_division_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('division_id', 'Division', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
