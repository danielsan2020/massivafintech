<?php

/**
 * Description of Paquetes
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('file');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_contrato_by_persona_id() {
        $name = "contrato.pdf";
        $persona_id = get_persona_id();
        $path = $this->config->item('personas_path') . "/" . $persona_id . "/documentos/contrato/" . $name;
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/pdf');
        $this->output->set_output(read_file($path));
        $this->output->_display();
    }

    public function get_documento_by_persona_id() {
        $file_name = $this->input->get('file_id');
        $auxiliar = explode('.', $file_name);
        $persona_id = $this->input->get('persona_id');
        $path = $this->config->item('personas_path') . "/" . $persona_id . "/documentos/fiscales/" . $file_name;
        $this->output->set_status_header(200);
        switch ($auxiliar[1]) {
            case 'pdf':
                $this->output->set_content_type('application/pdf');
                break;
            case 'jpg':
            case 'jpeg':
                $this->output->set_content_type('image/jpeg');
                break;
            case 'png':
                $this->output->set_content_type('image/png');
                break;
            default:
                $this->output->set_content_type('text/plain');
                break;
        }
        $this->output->set_output(read_file($path));
        $this->output->_display();
    }

    public function get_codigo_pago_by_persona_id() {
        $name = "pago_efectivo.pdf";
        $persona_id = get_persona_id();
        $path = $this->config->item('personas_path') . "/" . $persona_id . "/documentos/payment/" . $name;
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/pdf');
        $this->output->set_output(read_file($path));
        $this->output->_display();
    }

}
