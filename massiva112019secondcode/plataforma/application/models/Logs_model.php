<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * @package Models
 */

class Logs_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
