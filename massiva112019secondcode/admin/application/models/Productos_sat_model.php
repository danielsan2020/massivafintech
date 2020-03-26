<?php

/**
 * Description of Productos_sat_model
 */
class Productos_sat_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla
     */

    public function count_all_activos($grupo_sat_id) {
        $this->db->from('productos_sat');
        $this->db->where('grupo_sat_id', $grupo_sat_id);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }
     /*
      Metodo que trae todos los registros activos en base a el campo grupo_sat_id
     */

    public function get_all_by_grupo_id($grupo_id) {
        $this->db->select('id, grupo_sat_id, clave, descripcion, busquedas_similares');
        $this->db->from('productos_sat');
        $this->db->where('grupo_sat_id', $grupo_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }



}
