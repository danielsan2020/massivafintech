<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Declaraciones_mensuales_atrasadas extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('declaraciones_mensuales_atrasadas_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_declaraciones_mensuales_atrasadas_get() {
        $this->load->helper('session');
        $persona_id = get_persona_id();
        $response = $this->declaraciones_mensuales_atrasadas_model->get_declaraciones_mensuales_atrasadas_by_persona_id($persona_id);
        $data['lista_declaraciones_atrasadas'] = $response;
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function status_update_no_autorizado_post() {
        $this->db->trans_start();
        $this->load->helper('session');
        $this->load->helper('date');
        $declaracion_id = $this->get('id');
        $data = $this->_fill_update_no_autorizado_data();
        var_dump($data);
        $id = $this->declaraciones_mensuales_atrasadas_model->update($declaracion_id, $data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo la petición'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'declaracion_mensual_atrasada', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Petición actualizada correctamente'], REST_Controller::HTTP_CREATED);
    }

    /*     * ********* Llena el arreglo con los datos que se agregan en la bd*********** */

    private function _fill_update_no_autorizado_data() {
        $data = array(
            "status" => 3,
            "created_at" => date('Y-m-d H:i:s'),
            "persona_id" => get_persona_id()
        );
        return $data;
    }

    public function status_update_autorizado_post() {
        $this->db->trans_start();
        $this->load->helper('session');
        $this->load->helper('date');
        $declaracion_id = $this->get('id');

        $data = $this->_fill_update_autorizado_data();
        var_dump($data);
        $id = $this->declaraciones_mensuales_atrasadas_model->update($declaracion_id, $data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo la petición'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'declaracion_mensual_atrasada', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Petición actualizada correctamente'], REST_Controller::HTTP_CREATED);
    }

    private function _fill_update_autorizado_data() {
        $data = array(
            "status" => 2,
            "created_at" => date('Y-m-d H:i:s'),
            "persona_id" => get_persona_id()
        );
        return $data;
    }

}
