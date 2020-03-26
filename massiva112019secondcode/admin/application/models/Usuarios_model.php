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

    /*
      Metodo que trae todos los registros activos de la tabla usuarios
     */

    public function get_all() {
        $this->db->select("id, username, tipo, nombre, apellido_paterno, apellido_materno");
        $this->db->from('usuarios');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
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

    public function get_jefe_contador_by_id($id) {
        $this->db->select('id, username, tipo, email, telefono, nombre, apellido_paterno, apellido_materno');
        $this->db->from('usuarios');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->where('tipo', 3);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae un contador activo en base a el campo id
     */

    public function get_contador_by_id($id) {
        $this->db->select('CONCAT_WS(" ", nombre, apellido_paterno, apellido_materno) AS nombre_completo');
        $this->db->from('usuarios');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, nombre, apellido_paterno, apellido_materno, tipo, username');
        $this->db->from('usuarios');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los contadores de usuarios
     */

    public function get_all_contadores() {
        $this->db->select("CONCAT_WS(' ',nombre, apellido_paterno, apellido_materno) as nombre, id, tipo");
        $this->db->from('usuarios');
        $this->db->where('status', 1);
        $this->db->where('tipo', 4);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('usuarios', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('usuarios', $data, ['id' => $id]);
    }

}
