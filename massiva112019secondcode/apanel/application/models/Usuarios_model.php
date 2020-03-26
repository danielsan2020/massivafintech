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

    public function get_all_contadores($jefe_id) {
        $this->db->select("CONCAT_WS(' ',usuarios.nombre, usuarios.apellido_paterno, usuarios.apellido_materno) as nombre, usuarios.id, usuarios.tipo, contadores_y_equipos.jefe_id");
        $this->db->from('usuarios');
        $this->db->join('contadores_y_equipos', 'usuarios.id = contadores_y_equipos.contador_id');
        $this->db->where('contadores_y_equipos.jefe_id', $jefe_id);
        $this->db->where('contadores_y_equipos.status', 1);
        $this->db->where('usuarios.status', 1);
        $this->db->where('usuarios.tipo', 4);
        $result = $this->db->get();
        return $result->result_array();
    }
    
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
