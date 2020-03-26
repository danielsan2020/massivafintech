<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * @package Models
 */
class Declaraciones_mensuales_atrasadas_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //Recuperar todos los registros
    public function get_declaraciones_mensuales_atrasadas_by_persona_id($persona_id) {
        $this->db->select('declaraciones_mensuales_atrasadas.*');
        $this->db->from('declaraciones_mensuales_atrasadas');
        $this->db->where('status', 1);
        $this->db->where('persona_id', $persona_id); //quitar
        $this->db->order_by('anio_correspondiente', 'asc');
        $this->db->order_by('mes_correspondiente', 'asc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    /*
      Metodo para modificar un registro
     */
        public function update($id, $data) {
        return $this->db->update('declaraciones_mensuales_atrasadas', $data, ['id' => $id]);
    }

}
