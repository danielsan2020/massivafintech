<?php

/**
 * Description of Regimenes_fiscales
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
        $this->load->helper('session');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tabla paquetes
     * @url /paquetes/get_all_with_regimenes_as_child
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_with_regimenes_as_child_get() {
        $paquetes = $this->paquetes_model->get_all_with_regimen_fiscal_order_by_precio();
        $data['paquetes'] = array();
        $paquetes_in_data = [];
        foreach ($paquetes as $paquete) {
            if (in_array($paquete['id'], $paquetes_in_data)) {
                $paquete_index = array_search($paquete['id'], array_column($data['paquetes'], 'id'));
                $data['paquetes'][$paquete_index]['regimenes'][] = $paquete['regimen_fiscal_id'];
            } else {
                $data['paquetes'][] = ['id' => $paquete['id'], 'nombre' => $paquete['nombre'], 'precio' => $paquete['precio'], 'periodo' => $paquete['periodo'], 'descripcion' => $paquete['descripcion'], 'regimenes' => [$paquete['regimen_fiscal_id']]];
                $paquetes_in_data[] = $paquete['id'];
            }
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para obtener un registro activo de la tablapaquetes en base aid
     * @url /paquetes/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $id = $this->get('id');
        $data['paquete'] = $this->paquetes_model->get_by_id($id);
        if ($data['paquete'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
