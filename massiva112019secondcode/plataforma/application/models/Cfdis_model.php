<?php

/**
 * Description of Activos_model
 */
class Cfdis_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all_emitidas($personas_id) {
        $this->db->select('name, receptor_rfc AS rfc, receptor_razon_social AS razon_social, fecha_emision, total');
        $this->db->from('cfdis');
        $this->db->where('persona_id', $personas_id);
        $this->db->where('emitida_recibida', 1);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_all_recibidas($personas_id) {
        $this->db->select('name, emisor_rfc AS rfc, emisor_razon_social AS razon_social, fecha_emision, total');
        $this->db->from('cfdis');
        $this->db->where('persona_id', $personas_id);
        $this->db->where('emitida_recibida', 2);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    
}