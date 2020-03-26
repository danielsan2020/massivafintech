<?php

class Declaraciones_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id_and_persona_id($id, $persona_id) {
        $this->db->select('id');
        $this->db->from('declaraciones_mensuales');
        $this->db->where('id', $id);
        $this->db->where('persona_id', $persona_id);
//        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }
    
    public function get_declaracion_by_persona_id_and_declaracion_id($persona_id, $declaracion_id){
        $this->db->select('declaraciones_mensuales.id, anio_correspondiente, mes_correspondiente, personas.rfc');
        $this->db->from('declaraciones_mensuales');
        $this->db->join('personas', 'personas.id = declaraciones_mensuales.persona_id');
        $this->db->where('declaraciones_mensuales.id', $declaracion_id);
        $this->db->where('persona_id', $persona_id);
//        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }
}
