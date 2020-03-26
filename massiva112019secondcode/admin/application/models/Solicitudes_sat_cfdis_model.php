<?php

/**
 * Description of Solicitudes_sat_cfdis_model
 */
class Solicitudes_sat_cfdis_model extends CI_Model {

    /**
      Metodo constructor de la clase
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
      Metodo que trae todos los registros activos de la tabla paquetes
     */
    public function get_all_by_persona_id($persona_id) {
        $this->db->select('id, solicitud_sat_id, status, created_at, updated_at');
        $this->db->from('solicitudes_sat_cfdis');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status >', -1);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    /**
      Metodo que trae todos los registros activos de la tabla paquetes
     */
    public function get_by_id($id) {
        $this->db->select('persona_id, solicitud_sat_id, status, created_at, updated_at');
        $this->db->from('solicitudes_sat_cfdis');
        $this->db->where('id', $id);
        $this->db->where('status >', -1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /**
      Metodo para dar de alta un registro
     */
    public function insert($data) {
        return ($this->db->insert('solicitudes_sat_cfdis', $data)) ? $this->db->insert_id() : NULL;
    }

    /**
      Metodo para modificar un registro
     */
    public function update($id, $data) {
        return $this->db->update('solicitudes_sat_cfdis', $data, ['id' => $id]);
    }

}
