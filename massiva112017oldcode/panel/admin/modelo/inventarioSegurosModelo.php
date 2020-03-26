<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class invseguros{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    public function accionLogagrega($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','17','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogEdita($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','18','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogElimina($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','19','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
    /********************************************************************************/
	
    //informacion para la datatable
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_inventario_seguros ORDER BY idSeguros DESC";
		return ejecutarConsulta($sql); 
    }
	
	//agregamos nuevo seguro
	public function agreSeguro($rfc,$tipoSeguro,$prima,$fechaInicio,$fechaTermino,$descripcion,$numeroPoliza,$MetodoPago,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_inventario_activos (rfc,tipoSeguro,prima,fechaInicio,fechaTermino,descripcion,numeroPoliza,MetodoPago,usuarioCreacion,fechaCreacion)VALUES('$rfc','$tipoSeguro','$prima','$fechaInicio','$fechaTermino','$descripcion','$numeroPoliza','$MetodoPago','$usuarioSe','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//obtenemos valores para la edicion del producto
    public function ConsulEdita($idInventario){
        $sql = "SELECT * FROM tbl_inventario_activos WHERE idInventario = '$idInventario'";
        return ejecutarConsultaSimpleFila($sql);
		
    }
	
	//edicion de pregunta con imagen
	public function editarProdu($idInventario,$nombre1,$descripcion1,$cantidad1,$unidad1,$ubicacion1,$codigo1,$precioFinal1,$descuentos1,$proveedor1,$precio1,$nombreFinal){
		 $sql = "UPDATE tbl_inventario_activos SET nombre='".$nombre1."',descripcion='".$descripcion1."',cantidad='".$cantidad1."',unidad='".$unidad1."',ubicacion='".$ubicacion1."',codigo='".$codigo1."',precioFinal='".$precioFinal1."',descuentos='".$descuentos1."',imagen='".$nombreFinal."',proveedor='".$proveedor1."',precio='".$precio1."' WHERE idInventario='$idInventario'";
        //ejecutamos la consulta
        return ejecutarConsulta($sql);
	}
	//edicion de pregunta sin imagen
	public function editarProdu2($idInventario,$nombre1,$descripcion1,$cantidad1,$unidad1,$ubicacion1,$codigo1,$precioFinal1,$descuentos1,$proveedor1,$precio1,$imagen1){
		 $sql = "UPDATE tbl_inventario_activos SET nombre='".$nombre1."',descripcion='".$descripcion1."',cantidad='".$cantidad1."',unidad='".$unidad1."',ubicacion='".$ubicacion1."',codigo='".$codigo1."',precioFinal='".$precioFinal1."',descuentos='".$descuentos1."',imagen='".$imagen1."',proveedor='".$proveedor1."',precio='".$precio1."' WHERE idInventario='$idInventario'";
        //ejecutamos la consulta
        return ejecutarConsulta($sql);
	}
	
	//eliminacion de pregunta
    public function eliminaPro($idInventario2){
        $sql = "DELETE FROM tbl_inventario_activos WHERE idInventario = '$idInventario2'";
        return ejecutarConsulta($sql); 
    }
	
	//agrega entrada de producto
	public function agreEntrda($idInventarioE,$fechaEntradaE,$cantidadE,$precioE,$proveedorE,$unidadE,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_inventario_entradas (fechaEntrada,cantidad,precio,id_usuario,proveedor,fechaCreacion,idInventario,unidad)VALUES('$fechaEntradaE','$cantidadE','$precioE','$usuarioSe','$proveedorE','$fechaAccion','$idInventarioE','$unidadE')";
		return ejecutarConsulta($sql);
	}
	
	//agrega salida de producto
	public function agreSald($idInventarioE1,$fechaEntradaE1,$cantidadE1,$precioE1,$proveedorE1,$unidadE1,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_inventario_salidas(fechaSalida,cantidad,precio,id_usuario,proveedor,fechaCreacion,idInventario,unidad)VALUES('$fechaEntradaE1','$cantidadE1','$precioE1','$usuarioSe','$proveedorE1','$fechaAccion','$idInventarioE1','$unidadE1')";
		return ejecutarConsulta($sql);
	}
	
	
	//actualizamos el monto del producto
	public function actMontoOri($actMonto,$idInventarioE){
		 $sql = "UPDATE tbl_inventario_activos SET cantidad='".$actMonto."' WHERE idInventario='$idInventarioE'";
        //ejecutamos la consulta
        return ejecutarConsulta($sql);
	}
	
	//actualizamos el monto del producto2
	public function actMontoOri2($actMonto1,$idInventarioE1){
		 $sql = "UPDATE tbl_inventario_activos SET cantidad='".$actMonto1."' WHERE idInventario='$idInventarioE1'";
        //ejecutamos la consulta
        return ejecutarConsulta($sql);
	}
	
	//consulta de entradas
	public function consEntra($coninven){
        $sql="SELECT * FROM tbl_inventario_entradas WHERE idInventario = $coninven ";
		return ejecutarConsulta($sql); 
    }
	
	//consutlas de salida
	public function consSalidas($coninven){
        $sql="SELECT * FROM tbl_inventario_salidas WHERE idInventario = $coninven ";
		return ejecutarConsulta($sql); 
    }
	
	//consulta para el reporte particular de productos en inventario activo
	public function infProInvActivo($valInvAc){
		 $sql="SELECT * FROM tbl_inventario_activos WHERE idInventario = $valInvAc ";
		return ejecutarConsulta($sql); 
	}

}