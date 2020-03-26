<?php

/**
 * Description of Paquetes_tickets
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
class Paquetes_tickets extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('paquetes_tickets_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablapaquetes_tickets
     * @url /paquetes_tickets/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
            $data['paquetes_tickets'] = $this->paquetes_tickets_model->get_all();
            $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para obtener un registro activo de la tablapaquetes_tickets en base aid
     * @url /paquetes_tickets/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['paquetes_tickets'] = $this->paquetes_tickets_model->get_by_id($id);
        if ($data['paquetes_tickets'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapaquetes_tickets
     * @url /paquetes_tickets/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['total_paquetes_tickets'] = $this->paquetes_tickets_model->count_all_inactivos();
//        $data['paquetes_tickets'] = $this->paquetes_tickets_model->get_all_inactive();
//        if ($data['paquetes_tickets'] !== NULL) {
//            $this->response($data, REST_Controller::HTTP_OK);
//        } else {
//            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
//        }
        if ($data['total_paquetes_tickets'] === 0) {
            $data['paquetes_tickets'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['paquetes_tickets'] = $this->paquetes_tickets_model->get_all_inactive();
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /paquetes_tickets/create
     * @access public
     * @method POST
     * @dataParams cantidad: [tinyint(4)]
     * @dataParams precio: [decimal(8,2)]
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
        $id = $this->paquetes_tickets_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'paquetes_tickets', $data);
        $this->db->trans_complete();
        $this->_generate_public_json();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /paquetes_tickets/update/id/:id
     * @access public
     * @method POST
     * @urlParams id: [int(10) unsigned]
     * @dataParams cantidad: [tinyint(4)]
     * @dataParams precio: [decimal(8,2)]
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
        if ($this->paquetes_tickets_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'paquetes_tickets', $data);
            $this->db->trans_complete();
            $this->_generate_public_json();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para borrar un registro
     * @url /paquetes_tickets/inactivate/id/:id
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
        if ($this->paquetes_tickets_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "paquetes_tickets");
            $this->_generate_public_json();
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /paquetes_tickets/reactive/id/:id
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
        if ($this->paquetes_tickets_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "paquetes_tickets", $data);
            $this->_generate_public_json();
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
        $data['cantidad'] = $this->post('cantidad');
        $data['precio'] = $this->post('precio');
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
        $data['cantidad'] = $this->post('cantidad');
        $data['precio'] = $this->post('precio');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _generate_public_json() {
        $paquetes_tickets = $this->paquetes_tickets_model->get_all_generate_json();
        $content_public = $this->config->item('public_path') . 'content/';
        $paquetes_tickets_file = fopen($content_public . "paquetes_tickets.json", "w") or die("Error al crear el archivo publico!");
        fwrite($paquetes_tickets_file, json_encode($paquetes_tickets));
        fclose($paquetes_tickets_file);
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|integer|is_natural');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required|numeric');
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
        $this->params_validation->set_rules('id', 'Id', 'trim|required');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required|integer|is_natural');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required|numeric');
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
