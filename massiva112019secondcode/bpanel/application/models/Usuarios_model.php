<?php

/**
 * Description of Paquetes_model
 */
class Usuarios_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los contadores de usuarios
     */

    
        public function get_by_id($id) {
        $this->db->select('id, username, tipo, email, telefono, nombre, apellido_paterno, apellido_materno');
        $this->db->from('usuarios');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

}
