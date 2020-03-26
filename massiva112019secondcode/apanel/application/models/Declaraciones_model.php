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

}
