<?php

/**
 * Description of Paquetes_regimenes_model
 */
class Paquetes_regimenes_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * @title Metodo para obtener todo los registros activos por paquete_id
     * @url /regimenes_fiscales/get_by_paquete_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_regimenes_ids_by_paquete_id($paquete_id) {
        $this->db->select('paquetes_regimenes.regimen_fiscal_id');
        $this->db->from('paquetes_regimenes');
        $this->db->join('regimenes_fiscales', 'regimenes_fiscales.id = paquetes_regimenes.regimen_fiscal_id');
        $this->db->where('paquetes_regimenes.paquete_id', $paquete_id);
        $result = $this->db->get();
        $result_array = $result->result_array();
        $data = [];
        foreach ($result_array as $value) {
            $data[] = $value['regimen_fiscal_id'];
        }
        return $data;
    }
    
    /**
     * @title Metodo para obtener todo los registros activos por paquete_id
     * @url /regimenes_fiscales/get_by_paquete_id
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_regimenes_ids_by_paquete_id_for_update($paquete_id) {
        $this->db->select('id, regimen_fiscal_id');
        $this->db->from('paquetes_regimenes');
        $this->db->where('paquete_id', $paquete_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
        
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('paquetes_regimenes', $data)) ? $this->db->insert_id() : NULL;
    }

}
