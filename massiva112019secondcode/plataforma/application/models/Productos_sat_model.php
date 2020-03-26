<?php

/**
 * Description of Productos_sat_model
 *
 * @author dell
 */
class Productos_sat_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae los productos activos por medio de su clave
     */

    public function get_producto_by_clave($clave) {
        $this->db->select('productos_sat.id, productos_sat.descripcion AS descripcion, productos_sat.grupo_sat_id, productos_sat.id, productos_sat.clave,  divisiones_sat.descripcion AS unidad_sat');
        $this->db->from('productos_sat');
        $this->db->join('grupos_sat', 'productos_sat.grupo_sat_id = grupos_sat.id');
        $this->db->join('divisiones_sat', 'divisiones_sat.id = grupos_sat.division_sat_id');
        $this->db->where('productos_sat.clave', $clave);
        $this->db->where('productos_sat.status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }
    
}
