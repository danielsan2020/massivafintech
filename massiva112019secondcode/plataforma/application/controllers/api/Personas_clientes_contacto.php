<?php

/**
 * Description of Personas_clientes_contacto
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
class Personas_clientes_contacto extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('personas_clientes_contacto_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablapersonas_clientes_contacto
     * @url /personas_clientes_contacto/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $data[total_personas_clientes_contacto] = $this->personas_clientes_contacto_model->count_all_activos();
        if ($data[total_personas_clientes_contacto] === 0) {
            $data[personas_clientes_contacto] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data[personas_clientes_contacto] = $this->personas_clientes_contacto_model->get_all();
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapersonas_clientes_contacto
     * @url /personas_clientes_contacto/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['personas_clientes_contacto'] = $this->personas_clientes_contacto_model->get_all_inactive();
        if ($data['personas_clientes_contacto'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /personas_clientes_contacto/create
     * @access public
     * @method POST
     * @dataParams nombre: [varchar(245)]
     * @dataParams apellido_paterno: [varchar(245)]
     * @dataParams apellido_materno: [varchar(245)]
     * @dataParams departamento: [varchar(245)]
     * @dataParams puesto: [varchar(245)]
     * @dataParams telefono_1: [char(15)]
     * @dataParams telefono_2: [char(15)]
     * @dataParams celular_1: [char(15)]
     * @dataParams celular_2: [char(15)]
     * @dataParams email_1: [varchar(245)]
     * @dataParams email_2: [varchar(245)]
     * @dataParams colonias_id: [int(10) unsigned]
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
        $id = $this->personas_clientes_contacto_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'personas_clientes_contacto', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /personas_clientes_contacto/update/id/:id
     * @access public
     * @method POST
     * @dataParams nombre: [varchar(245)]
     * @dataParams apellido_paterno: [varchar(245)]
     * @dataParams apellido_materno: [varchar(245)]
     * @dataParams departamento: [varchar(245)]
     * @dataParams puesto: [varchar(245)]
     * @dataParams telefono_1: [char(15)]
     * @dataParams telefono_2: [char(15)]
     * @dataParams celular_1: [char(15)]
     * @dataParams celular_2: [char(15)]
     * @dataParams email_1: [varchar(245)]
     * @dataParams email_2: [varchar(245)]
     * @dataParams colonias_id: [int(10) unsigned]
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
        if ($this->personas_clientes_contacto_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'personas_clientes_contacto', $data);
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para borrar un registro
     * @url /personas_clientes_contacto/inactivate/id/:id
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
        if ($this->personas_clientes_contacto_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "personas_clientes_contacto");
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /personas_clientes_contacto/reactive/id/:id
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
        if ($this->personas_clientes_contacto_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "personas_clientes_contacto", $data);
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
        $data['apellido_paterno'] = $this->post('apellido_paterno');
        $data['apellido_materno'] = $this->post('apellido_materno');
        $data['departamento'] = $this->post('departamento');
        $data['puesto'] = $this->post('puesto');
        $data['telefono_1'] = $this->post('telefono_1');
        $data['telefono_2'] = $this->post('telefono_2');
        $data['celular_1'] = $this->post('celular_1');
        $data['celular_2'] = $this->post('celular_2');
        $data['email_1'] = $this->post('email_1');
        $data['email_2'] = $this->post('email_2');
        $data['colonias_id'] = $this->post('colonias_id');
        $data['persona_cliente_id'] = $_SESSION[$this->config->item('project_name')]['persona_cliente_id'];
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
        $data['nombre'] = $this->post('nombre');
        $data['apellido_paterno'] = $this->post('apellido_paterno');
        $data['apellido_materno'] = $this->post('apellido_materno');
        $data['departamento'] = $this->post('departamento');
        $data['puesto'] = $this->post('puesto');
        $data['telefono_1'] = $this->post('telefono_1');
        $data['telefono_2'] = $this->post('telefono_2');
        $data['celular_1'] = $this->post('celular_1');
        $data['celular_2'] = $this->post('celular_2');
        $data['email_1'] = $this->post('email_1');
        $data['email_2'] = $this->post('email_2');
        $data['colonias_id'] = $this->post('colonias_id');
        $data['persona_cliente_id'] = $_SESSION[$this->config->item('project_name')]['persona_cliente_id'];
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
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido_paterno', 'trim|');
        $this->form_validation->set_rules('apellido_materno', 'Apellido_materno', 'trim|');
        $this->form_validation->set_rules('departamento', 'Departamento', 'trim|');
        $this->form_validation->set_rules('puesto', 'Puesto', 'trim|');
        $this->form_validation->set_rules('telefono_1', 'Telefono_1', 'trim|');
        $this->form_validation->set_rules('telefono_2', 'Telefono_2', 'trim|');
        $this->form_validation->set_rules('celular_1', 'Celular_1', 'trim|');
        $this->form_validation->set_rules('celular_2', 'Celular_2', 'trim|');
        $this->form_validation->set_rules('email_1', 'Email_1', 'trim|v');
        $this->form_validation->set_rules('email_2', 'Email_2', 'trim|v');
        $this->form_validation->set_rules('colonias_id', 'Colonias_id', 'trim|required|i');
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
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|');
        $this->form_validation->set_rules('apellido_paterno', 'Apellido_paterno', 'trim|');
        $this->form_validation->set_rules('apellido_materno', 'Apellido_materno', 'trim|');
        $this->form_validation->set_rules('departamento', 'Departamento', 'trim|');
        $this->form_validation->set_rules('puesto', 'Puesto', 'trim|');
        $this->form_validation->set_rules('telefono_1', 'Telefono_1', 'trim|');
        $this->form_validation->set_rules('telefono_2', 'Telefono_2', 'trim|');
        $this->form_validation->set_rules('celular_1', 'Celular_1', 'trim|');
        $this->form_validation->set_rules('celular_2', 'Celular_2', 'trim|');
        $this->form_validation->set_rules('email_1', 'Email_1', 'trim|');
        $this->form_validation->set_rules('email_2', 'Email_2', 'trim|');
        $this->form_validation->set_rules('colonias_id', 'Colonias_id', 'trim|required|integer');
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

}
