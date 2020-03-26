<?php

/**
 * Description of Regimenes_fiscales_model
 */
class Regimenes_fiscales_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id($id) {
        $this->db->select("id, regimen, descripcion, precio_contabilidad_atrasada");
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', 1);
        $this->db->where('id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }
   
    public function get_by_tipo($tipo) {
        $this->db->select("id, regimen, descripcion");
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', 1);
        $this->db->where('tipo', $tipo);
        $result = $this->db->get();
        return $result->result_array();
    }

}
