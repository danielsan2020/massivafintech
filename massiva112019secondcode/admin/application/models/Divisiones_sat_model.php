<?php

/**
 * Description of Divisiones_sat_model
 */
class Divisiones_sat_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $this->db->select("id, clave, tipo, descripcion, iva_texto, iva_retenido_texto, isr_retenido_texto, status");
        $this->db->from('divisiones_sat');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
     /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, clave, tipo, descripcion, iva_texto, iva_retenido_texto, isr_retenido_texto, status');
        $this->db->from('divisiones_sat');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, clave, tipo, descripcion, iva_texto, iva_retenido_texto, isr_retenido_texto, status');
        $this->db->from('divisiones_sat');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('divisiones_sat', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('divisiones_sat', $data, ['id' => $id]);
    }

}
