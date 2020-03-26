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
class Declaraciones_mensuales extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('declaraciones_mensuales_model');
        date_default_timezone_set('America/Mexico_City');
    }
    public function validate_declaracion_pendiente_get() {
        $this->load->helper('session');
        $this->load->helper('date');
        $persona_id = get_persona_id();
        $year = intval(date("Y", now()));
        $month = intval(date("m", now()));
        $response = $this->declaraciones_mensuales_model->get_validation_declaracion_mensual_by_persona_id_anio_mes($persona_id, $year, $month);
        $data['necesita_autorizar'] = $response;
        $this->response($data, REST_Controller::HTTP_OK);
    }
     public function status_update_autorizado_post() {
        $this->db->trans_start();
        $this->load->helper('session');
        $this->load->helper('date');
        $persona_id = get_persona_id();
        $year = intval(date("Y", now()));
        $month = intval(date("m", now()));
        $data = $this->_fill_update_autorizado_data();       
        $declaracion_id = $this->declaraciones_mensuales_model->get_id_declaration_declaracion_mensual_by_persona_id_anio_mes($persona_id, $year, $month);        
        $id = $this->declaraciones_mensuales_model->update($declaracion_id, $data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo la petición'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'declaracion_mensual', $data);
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Petición actualizada correctamente'], REST_Controller::HTTP_CREATED);
    }
    /*********** Llena el arreglo con los datos que se agregan en la bd************/
    private function _fill_update_autorizado_data() {
        $data = array(
            "status" => 2,
            "updated_at" => date('Y-m-d H:i:s')
        );
        return $data;
    }
}
