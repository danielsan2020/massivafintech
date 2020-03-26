<?php

/**
 * Description of Personas_clientes_contacto_model
 */
class Facturas_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $this->db->select('facturas.id,facturas.moneda,facturas.created_at,personas_clientes.nombre,personas_clientes.rfc,personas_clientes.razon_social');
        $this->db->from('facturas');
        $this->db->join('personas_clientes', 'personas_clientes.id=facturas.persona_cliente_id', 'INNER');
        $this->db->where_in('facturas.status', [1, 2]);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_by_id_for_timbrar($id) {
        $this->db->select('facturas.id,facturas.persona_id,facturas.persona_cliente_id,facturas.tipo_factura,facturas.uso_factura,facturas.forma_pago,facturas.metodo_pago,facturas.moneda,'
                . 'facturas.tipo_cambio,facturas.serie,facturas.folio,facturas.condiciones_pago,facturas.created_at');
        $this->db->from('facturas');
        $this->db->where('facturas.id', $id);
        $this->db->where('facturas.status', 1);
//        $this->db->where('personas_regimenes.status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('facturas', $data)) ? $this->db->insert_id() : NULL;
    }

}
