<?php

/**
 * Description of Paquetes
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
class Paquetes extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('paquetes_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablapaquetes
     * @url /paquetes/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $data['paquetes'] = $this->paquetes_model->get_all();
        if ($data['paquetes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener un registro activo de la tablapaquetes en base aid
     * @url /paquetes/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['paquetes'] = $this->paquetes_model->get_by_id($id);
        if ($data['paquetes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }


    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapaquetes
     * @url /paquetes/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['paquetes'] = $this->paquetes_model->get_all_inactive();
        if ($data['paquetes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    /**
     * @title Metodo para crear un registro.
     * @url /paquetes/create
     * @access public
     * @method POST
     * @dataParams nombre: [varchar(80)]
     * @dataParams precio: [decimal(10,2)]
     * @dataParams periodo: [tinyint(4)]
     * @dataParams descripcion: [mediumtext]
     * @dataParams tipo: [tinyint(4)]
     * @dataParams cfdis_al_mes: [int(11)]
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
        $id = $this->paquetes_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'paquetes', 1);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /paquetes/update/id/:id
     * @access public
     * @method POST
     * @urlParams id: [int(10) unsigned]
     * @dataParams nombre: [varchar(80)]
     * @dataParams precio: [decimal(10,2)]
     * @dataParams periodo: [tinyint(4)]
     * @dataParams descripcion: [mediumtext]
     * @dataParams tipo: [tinyint(4)]
     * @dataParams cfdis_al_mes: [int(11)]
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
        if ($this->paquetes_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'paquetes', 3);
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    /*
     * @title Metodo para borrar un registro
     * @url /paquetes/inactivate/id/:id
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
        if ($this->paquetes_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "paquetes",2);
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /paquetes/reactive/id/:id
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
        if ($this->paquetes_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "paquetes", 4);
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
        $data['nombre'] = $this->post('nombre');
        $data['precio'] = $this->post('precio');
        $data['periodo'] = $this->post('periodo');
        $data['descripcion'] = $this->post('descripcion');
        $data['tipo'] = $this->post('tipo');
        $data['cfdis_al_mes'] = $this->post('cfdis_al_mes');
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
        $data['nombre'] = $this->post('nombre');
        $data['precio'] = $this->post('precio');
        $data['periodo'] = $this->post('periodo');
        $data['descripcion'] = $this->post('descripcion');
        $data['tipo'] = $this->post('tipo');
        $data['cfdis_al_mes'] = $this->post('cfdis_al_mes');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }
    
    private function _fill_delete_data(){
        $data = array();
        $data['status'] = -1;
        $data['updated_at'] = date('Y-m-d H:i:s');
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|integer');
        $this->form_validation->set_rules('cfdis_al_mes', 'Cfdis al mes', 'trim|required|integer');
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
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required|numeric');
        $this->form_validation->set_rules('periodo', 'Periodo', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|integer');
        $this->form_validation->set_rules('cfdis_al_mes', 'Cfdis_al_mes', 'trim|required|integer');
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
      Realizando las validaciones para el metodo get_by_tipo_get
     */
    private function _validation_get_tipo() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('tipo', 'Tipo', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
