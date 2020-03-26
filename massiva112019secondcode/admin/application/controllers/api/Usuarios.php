<?php

/**
 * Description of Usuarios
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
class Usuarios extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Método para obtener todos los registros activos de la tabla usuarios
     * @url /usuarios/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $data['usuarios'] = $this->usuarios_model->get_all();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para obtener un registro activo de la tablausuarios en base aid
     * @url /usuarios/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['usuarios'] = $this->usuarios_model->get_by_id($id);
        if ($data['usuarios'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * @title Metodo para obtener un registro activo de la tablausuarios en base aid
     * @url /usuarios/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_contador_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['contador'] = $this->usuarios_model->get_contador_by_id($id);
        if ($data['contador'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('mensaje' => 'El id no pertence a un contador'), REST_Controller::HTTP_OK);
        }
    }

    public function get_jefe_contador_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['jefe_contador'] = $this->usuarios_model->get_contador_by_id($id);
        if ($data['jefe_contador'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('mensaje' => 'El id no pertence a un jefe contador'), REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablausuarios
     * @url /usuarios/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['usuarios'] = $this->usuarios_model->get_all_inactive();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para obtener todo los contadores activos
     * @url /usuarios/get_all_contadores
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_contadores_get() {
        $data['contadores'] = $this->usuarios_model->get_all_contadores();
        if ($data['contadores'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener las personas de cada contador
     * @url /usuarios/get_all_contadores_y_personas_de_cada_contador
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_contadores_y_personas_de_cada_contador_get() {
        $data['contadores'] = $this->usuarios_model->get_all_contadores();
        if ($data['contadores'] !== NULL) {
            $this->_get_personas_activas($data['contadores']);
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener las personas activas
     * @url /usuarios/_get_personas_activas
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    function _get_personas_activas(&$contadores) {
        $this->load->model('personas_model');
        foreach ($contadores as &$contador) {
            $contador['contadores'] = $this->personas_model->get_cantidad_de_personas_by_contador($contador['id']);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /usuarios/create
     * @access public
     * @method POST
     * @dataParams username: [varchar(45)]
     * @dataParams password: [char(32)]
     * @dataParams tipo: [tinyint(4)]
     * @dataParams email: [varchar(245)]
     * @dataParams telefono: [char(10)]
     * @dataParams nombre: [varchar(245)]
     * @dataParams apellido_paterno: [varchar(245)]
     * @dataParams apellido_materno: [varchar(245)]
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
        $id = $this->usuarios_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'usuarios', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /usuarios/update/id/:id
     * @access public
     * @method POST
     * @dataParams username: [varchar(45)]
     * @dataParams password: [char(32)]
     * @dataParams tipo: [tinyint(4)]
     * @dataParams email: [varchar(245)]
     * @dataParams telefono: [char(10)]
     * @dataParams nombre: [varchar(245)]
     * @dataParams apellido_paterno: [varchar(245)]
     * @dataParams apellido_materno: [varchar(245)]
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
        if ($this->usuarios_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'usuarios', $data);
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para borrar un registro
     * @url /usuarios/inactivate/id/:id
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
        if ($this->usuarios_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "usuarios");
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /usuarios/reactive/id/:id
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
        if ($this->usuarios_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "usuarios", $data);
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
        $data['username'] = $this->post('username');
//        $data['password'] = $this->post('password');
        $data['tipo'] = $this->post('tipo');
        $data['email'] = $this->post('email');
        $data['telefono'] = $this->post('telefono');
        $data['nombre'] = $this->post('nombre');
        $data['apellido_paterno'] = $this->post('apellido_paterno');
        $data['apellido_materno'] = $this->post('apellido_materno');
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
        $data['username'] = $this->post('username');
        $data['tipo'] = $this->post('tipo');
        $data['email'] = $this->post('email');
        $data['telefono'] = $this->post('telefono');
        $data['nombre'] = $this->post('nombre');
        $data['apellido_paterno'] = $this->post('apellido_paterno');
        $data['apellido_materno'] = $this->post('apellido_materno');
        $data['updated_at'] = date('Y-m-d H:i:s');
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
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|integer');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|required|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|required|alpha_dash_space_period_utf8_numbers');
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
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|integer');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|required|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|required|alpha_dash_space_period_utf8_numbers');
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
