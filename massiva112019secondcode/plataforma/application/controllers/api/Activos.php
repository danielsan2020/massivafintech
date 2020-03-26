<?php

/**
 * Description of Activos
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
class Activos extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('activos_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablaactivos
     * @url /activos/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $persona_id = get_persona_id();
        $data['total_activos'] = $this->activos_model->count_all_activos_by_persona_id($persona_id);
        if ($data['total_activos'] === 0) {
            $data['activos'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['activos'] = $this->activos_model->get_all_by_persona_id($persona_id);
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para obtener un registro activo de la tablaactivos en base aid
     * @url /activos/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['activo'] = $this->activos_model->get_by_id($id);
        if ($data['activo'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablaactivos
     * @url /activos/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['activos'] = $this->activos_model->get_all_inactive();
        $data['total_activos'] = $this->activos_model->count_all_inactivos();
        if ($data['total_activos'] === 0) {
            $data['activos'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /activos/create
     * @access public
     * @method POST
     * @dataParams fecha_compra: [date]
     * @dataParams monto_compra_sin_impuestos: [decimal(10,0)]
     * @dataParams tipo: [tinyint(4)]
     * @dataParams descripcion: [varchar(500)]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Creando un nuevo registro
     */
    public function create_post() {
        $this->_validation_insert();
        $this->load->helper("session");
        $data = $this->_fill_insert_data();

        $this->db->trans_start();

        $id = $this->activos_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'activos', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /activos/update/id/:id
     * @access public
     * @method POST
     * @dataParams fecha_compra: [date]
     * @dataParams monto_compra_sin_impuestos: [decimal(10,0)]
     * @dataParams tipo: [tinyint(4)]
     * @dataParams descripcion: [varchar(500)]
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
        if ($this->activos_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'activos', $data);
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para borrar un registro
     * @url /activos/inactivate/id/:id
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
        $data['updated_at'] = date('Y-m-d H:m:s');
        if ($this->activos_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "activos");
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /activos/reactive/id/:id
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
        $data['updated_at'] = date('Y-m-d H:m:s');
        if ($this->activos_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "activos", $data);
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
        $data['fecha_compra'] = $this->post('fecha_compra');
        $data['monto_compra_sin_impuestos'] = $this->post('monto_compra_sin_impuestos');
        $data['tipo'] = $this->post('tipo');
        $data['descripcion'] = $this->post('descripcion');
        $data['persona_id'] = get_persona_id();
        $data['created_at'] = date('Y-m-d H:m:s');
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
        $data['fecha_compra'] = $this->post('fecha_compra');
        $data['monto_compra_sin_impuestos'] = $this->post('monto_compra_sin_impuestos');
        $data['tipo'] = $this->post('tipo');
        $data['descripcion'] = $this->post('descripcion');
        $data['persona_id'] = $_SESSION[$this->config->item('project_name')]['persona_id'];
        $data['updated_at'] = date('Y-m-d H:m:s');
        return $data;
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fecha_compra', 'Fecha compra', 'trim|required|date');
        $this->form_validation->set_rules('monto_compra_sin_impuestos', 'Monto compra sin impuestos', 'trim|required|numeric');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|min[1]|max[6]');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|max_length[500]');
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
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fecha_compra', 'Fecha compra', 'trim|required|date');
        $this->form_validation->set_rules('monto_compra_sin_impuestos', 'Monto compra sin impuestos', 'trim|required|numeric');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|min[1]|max[6]');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|max_length[500]');
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

}
