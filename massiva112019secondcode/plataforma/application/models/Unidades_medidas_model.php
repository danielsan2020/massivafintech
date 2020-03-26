<?php

/**
 * Description of Personas_productos_model
 *
 * @author dell
 */
class Unidades_medidas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
     /*
      Metodo que trae los registros activos de la tabla personas_productos
     */

    public function get_all() {
        $this->db->select('id, unidad, clave_sat');
        $this->db->from('unidades_medidas');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }
}