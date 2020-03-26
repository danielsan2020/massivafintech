<?php

/**
 * Description of Preregistros_model
 */
class Preregistros_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

//    /*
//      Metodo que trae un registro activo en base a el campo id
//     */
//
//    public function get_by_id($id) {
//        $this->db->select('id, username, email, telefono, nombre, apellido_paterno, apellido_materno');
//        $this->db->from('usuarios');
//        $this->db->where('id', $id);
//        $this->db->where('status', 1);
//        $this->db->order_by('id', 'asc');
//        $result = $this->db->get();
//        return $result->row_array();
//    }

    public function get_preregistro_by_id_and_email($usuario_id, $email_usuario) {
        $this->db->select('id, email, nombre, status');
        $this->db->from('preregistros');
        $this->db->where('id', $usuario_id);
        $this->db->where('email', $email_usuario);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_preregistro_by_id($usuario_id) {
        $this->db->select('username, telefono, email, nombre, apellido_paterno, apellido_materno, rfc, status');
        $this->db->from('preregistros');
        $this->db->where('id', $usuario_id);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('preregistros', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */
    public function update($usuario_id, $status_preregistro) {
        return $this->db->update('preregistros', $status_preregistro, ['id' => $usuario_id]);
    }

}
