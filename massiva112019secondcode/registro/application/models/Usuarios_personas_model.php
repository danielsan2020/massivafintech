<?php

/**
 * Description of Usuarios_personas_model
 */
class Usuarios_personas_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('usuarios_personas', $data)) ? $this->db->insert_id() : NULL;
    }

}
