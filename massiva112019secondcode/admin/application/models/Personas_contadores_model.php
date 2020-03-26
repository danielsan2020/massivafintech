<?php

class Personas_contadores_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, contador_id, persona_id');
        $this->db->from('personas_contadores');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae una persona con sus datos
     * id
     * RFC
     * Razón social
     * id de su registro en personas_contadoras
     * id del jefe contador que tiene asignado
     */

    public function get_persona_by_id($id) {
        $this->db->select('personas.rfc, personas.razon_social, personas_contadores.id, personas_contadores.contador_id, personas.id');
        $this->db->from('personas_contadores');
        $this->db->join('personas', 'personas.id = personas_contadores.persona_id');
        $this->db->where('personas_contadores.id', $id);
        $this->db->where('personas_contadores.status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('personas_contadores', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('personas_contadores', $data, ['id' => $id]);
    }

}
