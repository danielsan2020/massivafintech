<?php

/**
 * Description of Soporte_tickets
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
class Soporte_tickets extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('soporte_tickets_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Obtener los tickets por id_contador. 
     * @url /personas/get_tickets_by_contador_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_tickets_by_contador_id_get() {
        $usuario_id = $this->get('id');
        $data['total_tickets'] = $this->soporte_tickets_model->count_all_tickets_by_contador_id($usuario_id);
        if ($data['total_tickets'] === 0) {
            $data['tickets'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['tickets'] = $this->soporte_tickets_model->get_tickets_by_contador_id($usuario_id);
            if ($data['tickets'] !== NULL) {
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @title Obtener el ticket por medio de su id. 
     * @url /personas/get_ticket_by_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_ticket_by_id_get() {
        $ticket_id = $this->get('id');
        $data_ticket['soporte_ticket'] = $this->soporte_tickets_model->get_ticket_by_id($ticket_id);
        $this->response($data_ticket, REST_Controller::HTTP_OK);
    }

}
