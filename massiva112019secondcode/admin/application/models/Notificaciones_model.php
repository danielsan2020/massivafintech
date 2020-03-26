<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * @package Models
 */

class Notificaciones_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //Recuperar todos los registros
    /* public function get_all_notificaciones_by_usuario_id($usuario_id) {
      $this->db->select('notificaciones.*');
      $this->db->from('notificaciones');
      $this->db->where('usuario_id', $usuario_id);
      $this->db->order_by('created_at', 'desc');
      $result = $this->db->get();
      return $result->result_array();
      } */

    public function get_all_activos_whith_filters_by_user_id($usuario_id) {
        $this->db->select('id, texto, status, created_at');
        $this->db->from('notificaciones');
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('status !=', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_last_activas_by_usuario_id($usuario_id) {
        $this->db->select('notificaciones.*');
        $this->db->from('notificaciones');
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('status !=', -1);
        $this->db->order_by('created_at', 'desc');
        $this->db->limit(2);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function count_all_activos_whith_filters_by_user_id($usuario_id) {
        $this->db->from('notificaciones');
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('status !=', -1);
        return $this->db->count_all_results();
    }

    public function count_all_activos_by_usuario_id($usuario_id) {
        $this->db->select('count(*) as total');
        $this->db->from('notificaciones');
        $this->db->where('status !=', -1);
        $this->db->where('usuario_id', $usuario_id);
        $result = $this->db->get();
        $row = $result->row_array();
        return $row['total'];
    }

    public function count_no_leidas_by_usuario_id($usuario_id) {
        $this->db->select('count(*) as total');
        $this->db->from('notificaciones');
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        $row = $result->row_array();
        return $row['total'];
    }

    public function update_status($id, $data) {
        return $this->db->update('notificaciones', $data, ['id' => $id]);
    }

}
