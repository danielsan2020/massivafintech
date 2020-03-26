<?php

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function search_users($datos) {
        $this->db->select('id , username, tipo,status');
        $this->db->from('usuarios');
        $this->db->where('username', $datos['username']);
        $this->db->where('password', $datos['pass']);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_status_by_usuario_id($usuario_id) {
        $this->db->select('status');
        $this->db->from('usuarios');
        $this->db->where('id', $usuario_id);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_permisos($id) {
        $this->db->select('sitio_id,seccion_id');
        $this->db->where('usuario_id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get('permisos');
        return $result->result_array();
    }

    public function check_pass($id, $pass) {
        $this->db->select('id');
        $this->db->from('usuarios');
        $this->db->where('password', $pass);
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

//    public function update($id, $data) {
//        return $this->db->update('usuarios', $data, array('id' => $id));
//    }
}
