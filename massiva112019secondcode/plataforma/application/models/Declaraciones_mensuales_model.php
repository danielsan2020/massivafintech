<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * @package Models
 */

class Declaraciones_mensuales_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //Recuperar todos los registros
    public function get_validation_declaracion_mensual_by_persona_id_anio_mes($persona_id, $year, $month) {
        $this->db->select('declaraciones_mensuales.id');
        $this->db->from('declaraciones_mensuales');
        $this->db->where('status', 1);
        $this->db->where('persona_id', $persona_id);
        $this->db->where('anio_correspondiente', $year);
        $this->db->where('mes_correspondiente', $month);
        $this->db->limit(1); 
        $query=$this->db->get();
        return($query->num_rows()>0);        
    }  
    public function get_id_declaration_declaracion_mensual_by_persona_id_anio_mes($persona_id, $year, $month) {
        $this->db->select('declaraciones_mensuales.id');
        $this->db->from('declaraciones_mensuales');
        $this->db->where('status', 1);
        $this->db->where('persona_id', $persona_id);
        $this->db->where('anio_correspondiente', $year);
        $this->db->where('mes_correspondiente', $month);
        $this->db->limit(1); 
        $query=$this->db->get();
        return $query->row_array()['id'];        
    }    
    public function update($declaracion_id, $data) {
        return $this->db->update('declaraciones_mensuales', $data, ['id' => $declaracion_id]);
    }
    //Recuperar todos los registros
    public function get($select = '*') {
        $this->db->select($select);
        $result = $this->db->get('logs');
        return $result->result_array();
    }
    //Insertamos un nuevo registro
    public function insert($data) {
        return ($this->db->insert('logs', $data)) ? $this->db->insert_id() : FALSE;
    }
}
