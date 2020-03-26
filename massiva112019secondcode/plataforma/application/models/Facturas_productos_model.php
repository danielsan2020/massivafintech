<?php

class Facturas_productos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('facturas_productos', $data)) ? $this->db->insert_id() : NULL;
    }

    public function get_productos_by_factura_id($factura_id) {
        $this->db->select('facturas_productos.cantidad,facturas_productos.precio,productos_sat.clave as clave_producto_sat,unidades_medidas.clave_sat as clave_unidad_sat,'
                . 'productos_sat.descripcion as descripcion_producto_sat,divisiones_sat.iva,divisiones_sat.iva_retenido,divisiones_sat.isr_retenido');
        $this->db->from('facturas_productos');
        $this->db->join('personas_productos', 'personas_productos.id=facturas_productos.persona_producto_id', 'INNER');
        $this->db->join('unidades_medidas', 'unidades_medidas.id=personas_productos.unidad_medida_id', 'INNER');
        $this->db->join('productos_sat', 'productos_sat.id=personas_productos.producto_sat_id', 'INNER');
        $this->db->join('grupos_sat', 'grupos_sat.id=productos_sat.grupo_sat_id', 'INNER');
        $this->db->join('divisiones_sat', 'divisiones_sat.id=grupos_sat.division_sat_id', 'INNER');
        $this->db->where('facturas_productos.factura_id', $factura_id);
        $this->db->where('facturas_productos.status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

}
