<?php

/**
 * Description of Paquetes_model
 */
class Colonias_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todas las colonias pertenecientes a un codigo postal
     */

    public function get_all_colonias_by_codigo_postal($codigo_postal) {
        $this->db->select('colonias.id, colonias.colonia, colonias.alcaldia_municipio, colonias.cp, estados.estado');
        $this->db->from('colonias');
        $this->db->join('estados', 'colonias.estado_id = estados.id');
        $this->db->where('colonias.cp', $codigo_postal);
        $result = $this->db->get();
//        echo $this->db->last_query();
        return $result->result_array();
    }
    
     public function get_colonia_by_id($colonia_id) {
        $this->db->select('colonias.id, colonias.colonia, colonias.alcaldia_municipio, colonias.cp, estados.estado');
        $this->db->from('colonias');
        $this->db->join('estados', 'colonias.estado_id = estados.id');
        $this->db->where('colonias.id', $colonia_id);
        $result = $this->db->get();
//        echo $this->db->last_query();
        return $result->result_array();
    }

}
