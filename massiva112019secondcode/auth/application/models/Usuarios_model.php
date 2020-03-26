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

    public function get_id_by_email($email) {

        $this->db->select('id, email, username');
        $this->db->from('usuarios');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_registro_by_id_and_username($usuario_id, $username) {
        $this->db->select('id, username, email, status');
        $this->db->from('usuarios');
        $this->db->where('id', $usuario_id);
        $this->db->where('username', $username);
//        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('usuarios', $data)) ? $this->db->insert_id() : NULL;
    }

    public function update($id, $data) {
        return $this->db->update('usuarios', ['password' => $data], ['id' => $id]);
    }

}
