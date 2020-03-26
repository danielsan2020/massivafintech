<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Facturas extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('facturas_model');
        $this->load->helper('session');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos.
     * @url /facturas/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $persona_id = get_persona_id();
        $data['facturas'] = $this->facturas_model->get_all($persona_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para crear un registro.
     * @url /facturas/create
     * @access public
     * @method POST
     * @dataParams persona_cliente_id: [int(10) unsigned]
     * @dataParams tipo_factura: [tinyint]
     * @dataParams uso_factura: [tinyint]
     * @dataParams forma_pago: [tinyint]
     * @dataParams metodo_pago: [tinyint]
     * @dataParams moneda: [char(3)]
     * @dataParams tipo_cambio: [varchar(250)]
     * @dataParams serie: [varchar(250)]
     * @dataParams folio: [varchar(250)]
     * @dataParams condiciones_pago: [text()]
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
        $id = $this->facturas_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $productos = $this->post('productos');
        $this->load->model('facturas_productos_model');
        foreach ($productos as $producto) {
            $data_producto = $this->_fill_insert_producto_data($id, $producto);
            $factura_producto_id = $this->facturas_productos_model->insert($data_producto);
            if ($factura_producto_id === NULL) {
                $this->response(['message' => 'Error: No se guardo el producto'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        $this->load->helper('logs');
        insert_log($id, 'personas_clientes', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data() {
        $data = array();
        $data['persona_id'] = get_persona_id();
        $data['persona_cliente_id'] = $this->post('persona_cliente_id');
        $data['tipo_factura'] = $this->post('tipo_factura');
        $data['uso_factura'] = $this->post('uso_factura');
        $data['forma_pago'] = $this->post('forma_pago');
        $data['metodo_pago'] = $this->post('metodo_pago');
        $data['moneda'] = $this->post('moneda');
        $data['tipo_cambio'] = $this->post('tipo_cambio');
        $data['serie'] = $this->post('serie');
        $data['folio'] = $this->post('folio');
        $data['condiciones_pago'] = $this->post('condiciones_pago');
        $data['created_at'] = date('Y-m-d H:m:s');
        $data['status'] = 1;
        return $data;
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_producto_data($factura_id, $producto) {
        $data = array();
        echo $factura_id;
        $data['factura_id'] = $factura_id;
        $data['persona_producto_id'] = $producto['id'];
        $data['cantidad'] = $producto['cantidad'];
        $data['precio'] = $producto['precio'];
        $data['created_at'] = date('Y-m-d H:m:s');
        $data['status'] = 1;
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
        $this->form_validation->set_rules('persona_cliente_id', 'Cliente', 'trim|required|integer');
        $this->form_validation->set_rules('tipo_factura', 'Tipo de factura', 'trim|required|max_length[1]');
        $this->form_validation->set_rules('uso_factura', 'Uso de factura', 'trim|required|max_length[3]');
        $this->form_validation->set_rules('forma_pago', 'Forma de pago', 'trim|required|integer');
        $this->form_validation->set_rules('metodo_pago', 'Método de pago', 'trim|required|max_length[3]');
        $this->form_validation->set_rules('moneda', 'Moneda', 'trim|required|max_length[3]');
        $this->form_validation->set_rules('tipo_cambio', 'Tipo de cambio', 'trim|max_length[250]');
        $this->form_validation->set_rules('serie', 'Serie', 'trim|max_length[250]');
        $this->form_validation->set_rules('folio', 'Folio', 'trim|max_length[250]');
        $this->form_validation->set_rules('condiciones_pago', 'Condiciones de pago', 'trim');
        $this->form_validation->set_rules('productos', 'Productos', 'trim|callback_check_productos');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function check_productos() {
        $productos = $this->post('productos');
        if (is_array($productos)) {
            if (count($productos) === 0) {
                $this->form_validation->set_message('check_productos', 'Los productos son obligatorios');
                return FALSE;
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_productos', 'Los productos son obligatorios');
            return FALSE;
        }
    }

}
