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

    public function get_documento_by_ticket_id() {
        $file_name = $this->input->get('file_id');
        $auxiliar = explode('.', $file_name);
        $soporte_ticket_id = $this->input->get('soporte_ticket_id');
        $persona_id = get_persona_id();
        $path = $this->config->item('personas_path') . "/" . $persona_id . "/soporte/" . $soporte_ticket_id . "/" . $auxiliar[0] . "/" . $file_name;
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

    public function get_logotipo_by_cliente_id() {
        $cliente_id = $this->input->get('cliente_id');
        $path = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/logotipo/logotipo.jpg";
        $this->output->set_status_header(200);
        $this->output->set_content_type('image/jpg');
        $this->output->set_output(read_file($path));
        $this->output->_display();
    }
    public function get_foto_producto_by_producto_id() {
        $productos_id = $this->input->get('producto_id');
        $path = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $productos_id . "/imagen_producto/producto.jpg";
        $this->output->set_status_header(200);
        $this->output->set_content_type('image/jpeg');
        $this->output->set_output(read_file($path));
        $this->output->_display();
    }

}
