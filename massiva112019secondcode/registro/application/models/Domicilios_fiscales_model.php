<?php

/**
 * Description of Paquetes_model
 */
class Domicilios_fiscales_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_persona_id($id) {
        $this->db->select('colonia_id, nombre, calle, numero_interior, numero_exterior');
        $this->db->from('domicilios_fiscales');
        $this->db->where('persona_id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('domicilios_fiscales', $data)) ? $this->db->insert_id() : NULL;
    }

    public function update($id, $data) {
        return $this->db->update('domicilios_fiscales', $data, ['persona_id' => $id]);
    }
    


}
