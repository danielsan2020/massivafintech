<?php

/**
 * Description of Usuarios_model
 */
class Usuarios_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_email_by_id_usuario($usuario_id) {
        $this->db->select('email, CONCAT_WS(" ", nombre, apellido_paterno, apellido_materno) AS nombre_usuario');
        $this->db->from('usuarios');
        $this->db->where('id', $usuario_id);
        $this->db->where('status', 2);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

}
