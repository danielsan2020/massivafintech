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
class Domicilios_fiscales extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('domicilios_fiscales_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para crear un registro.
     * @url /personas/create
     * @access public
     * @method POST
     * @dataParams persona_id: [int(2)]
     * @dataParams colonia_id: [int(2)]
     * @dataParams nombre: [varchar(100)]
     * @dataParams calle: [varchar(245)]
     * @dataParams numero_interior: [varchar(20)]
     * @dataParams numero_exterior: [varchar(20)]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Creando un nuevo registro
     */
    public function create_post() {
        $data = $this->_fill_insert_data();
        $this->db->trans_start();
        $id = $this->domicilios_fiscales_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

//    public function update_post() {
////        $this->_validation_update();
////        $this->load->model('domicilios_fiscales_model');
//        $data_domicilio = $this->_fill_update_data_persona();
//        $this->db->trans_start();
//        if ($this->domicilios_fiscales_model->update(22, $data_domicilio)) {
//            $data_domicilio_fiscal = $this->_fill_update_data_domicilio_fiscal(22);
//            $this->domicilios_fiscales_model->update($data_domicilio_fiscal);
//            $this->db->trans_complete();
//            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
//        } else {
//            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
//        }
//    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data() {
        $data = array();
        $data['persona_id'] = $this->post('persona_id');
        $data['colonia_id'] = $this->post('colonia_id');
        $data['nombre'] = $this->post('nombre');
        $data['calle'] = $this->post('calle');
        $data['numero_interior'] = $this->post('numero_interior');
        $data['numero_exterior'] = $this->post('numero_exterior');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }
//
//    private function _fill_update_data_persona() {
//        $data = array();
//        $data['colonia_id'] = $this->post('colonia_id');
//        $data['nombre'] = $this->post('nombre');
//        $data['calle'] = $this->post('calle');
//        $data['numero_interior'] = $this->post('numero_interior');
//        $data['numero_exterior'] = $this->post('numero_exterior');
//        $data['updated_at'] = date('Y-m-d H:i:s');
//        $data['status'] = 1;
//        return $data;
//    }

}
