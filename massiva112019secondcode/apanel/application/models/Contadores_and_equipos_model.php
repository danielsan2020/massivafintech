<?php

/**
 * Description of Paquetes_model
 */
class Contadores_and_equipos_model extends CI_Model {
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

    public function get_all_contadores_by_jefe_id($jefe_id) {
        $this->db->select("usuarios.nombre, usuarios.apellido_paterno, usuarios.apellido_materno, usuarios.id, usuarios.tipo, contadores_y_equipos.jefe_id");
        $this->db->from('contadores_y_equipos');
        $this->db->join('usuarios', 'usuarios.id = contadores_y_equipos.contador_id');
        $this->db->where('contadores_y_equipos.jefe_id', $jefe_id);
        $this->db->where('contadores_y_equipos.status', 1);
        $this->db->where('usuarios.status', 1);
        $this->db->where('usuarios.tipo', 4);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    

}
