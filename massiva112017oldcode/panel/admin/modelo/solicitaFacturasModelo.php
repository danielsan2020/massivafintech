<?php
require_once "Conexion.php";

Class solifac{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //nuevo proveedor
    public function accionAgregoFac($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','97','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionEditoFac($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','98','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	public function accionCanFac($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','99','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionagregoProo($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','100','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	public function accionEliprolista($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','101','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionultimosDatos($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','102','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	

    /********************************************************************************/

  	//primer paso factura
	public function nuevaFactuPriPaso($id_usuario,$datoscompletos,$andire,$uso,$metodo,$forma,$moneda,$tipoCambio,$estatus,$fechaAccio,$idCliente){
		$sql = "INSERT INTO tbl_facturas_solicitadas (id_usuario,datoscompletos,andire,uso,metodo,forma,moneda,tipoCambio,fechaSolicitud,estatus,idCliente) 
		VALUES ('$id_usuario','$datoscompletos','$andire','$uso','$metodo','$forma','$moneda','$tipoCambio','$fechaAccio','$estatus','$idCliente')";
		return ejecutarConsulta($sql);
	}

	public function nuevaFactuSePaso($id_usuario,$datoscompletos,$andire,$uso,$metodo,$forma,$moneda,$tipoCambio,$idFactura){
		$sql = "UPDATE tbl_facturas_solicitadas SET id_usuario = '$id_usuario',datoscompletos= '$datoscompletos',andire= '$andire',uso= '$uso',metodo= '$metodo',forma= '$forma',moneda= '$moneda',tipoCambio= '$tipoCambio' WHERE idFactura='$idFactura'";
		return ejecutarConsulta($sql);
	}
	
	/* se cancela la factura */
	public function cancelacioFac($idFactura){
		$sql = "DELETE FROM tbl_facturas_solicitadas WHERE idFactura = '$idFactura'";
		return ejecutarConsulta($sql); 
}
	
	/* se agrega productos de la factura */
	public function agreProdaFac($idFacturaPro,$cantidad,$precio,$total,$clavesat,$nombreSat,$usuarioSe){
		$sql = "INSERT INTO tbl_productos_factura (id_usuario,idFactura,clavesat,nombreSat,cantidad,precio,total) VALUES ('$usuarioSe','$idFacturaPro','$clavesat','$nombreSat','$cantidad','$precio','$total')";
		return ejecutarConsulta($sql);
	}
	
	/* eliminamos producto de la lista de factura */
	public function eliprofac($idProFac){
		$sql = "DELETE FROM tbl_productos_factura WHERE idProFac = '$idProFac'";
		return ejecutarConsulta($sql); 
}
	
	/* agregamos los ultimos valores de la factura */
	public function ultimosValores($subtotal,$descuentos,$iva,$totalFac,$idFacturaProUltimo,$fechaAccion){
		$sql = "UPDATE tbl_facturas_solicitadas SET subtotal = '$subtotal',descuentos= '$descuentos',total= '$totalFac',estatus= '2' ,iva= '$iva',fechaSolicitud= '$fechaAccion' WHERE idFactura='$idFacturaProUltimo'";
		return ejecutarConsulta($sql);
	}

	/* obtenemos el ultiumo numero de facturas que hay  */
	public function cuantoscdfiFIN($usuarioSe){
		$sql="SELECT * FROM tbl_facturas WHERE id_usuario = $usuarioSe ";
		return ejecutarConsulta($sql); 
	}

	/* actualizamos el valor de las facturas */
	public function actualizamosValor($valorFinCon,$idFafa){
		$sql = "UPDATE tbl_facturas SET facturas = '$valorFinCon' WHERE idFacturas ='$idFafa'";
		return ejecutarConsulta($sql);
	}
	

}

?>