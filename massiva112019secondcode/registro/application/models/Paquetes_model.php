<?php

/**
 * Description of Regimenes_fiscales_model
 */
class Paquetes_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_with_regimen_fiscal_order_by_precio() {
        $this->db->select("paquetes.id, paquetes_regimenes.regimen_fiscal_id, paquetes.precio, paquetes.nombre, paquetes.periodo, paquetes.descripcion");
        $this->db->from('paquetes_regimenes');
        $this->db->join('paquetes', 'paquetes_regimenes.paquete_id = paquetes.id', 'INNER');
        $this->db->where('paquetes.status', 1);
        $this->db->order_by('precio');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_by_id($id) {
        $this->db->select('id, nombre, precio, periodo, descripcion, open_pay_id, cfdis_al_mes');
        $this->db->from('paquetes');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

}
