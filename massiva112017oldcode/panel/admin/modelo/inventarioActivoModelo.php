<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class invactivo{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    public function accionLogagrega($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','12','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogEdita($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','13','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogElimina($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','14','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogAgregCan($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','15','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogQuitCan($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','16','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	////////////////////////Accion para agregar log de acciones//////////////////////////
	public function accionNuevoSerivio($id_usuario,$fechaCreacion){
	$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','73','$fechaCreacion')";
	return ejecutarConsulta($sql);
	}
	////////////////////////Accion para eliminar servicio log de acciones//////////////////////////
	public function accionEliminoiSer($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','74','$fechaCreacion')";
		return ejecutarConsulta($sql);
		}
	////////////////////////Accion para eliminar servicio log de acciones//////////////////////////
	public function accionAgregaProd($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','75','$fechaCreacion')";
		return ejecutarConsulta($sql);
		}
	////////////////////////Accion para eliminar servicio log de acciones//////////////////////////
	public function accionAgregaEntrada($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','5','$fechaCreacion')";
		return ejecutarConsulta($sql);
		}
	////////////////////////Accion para eliminar servicio log de acciones//////////////////////////
	public function accionAgregaSalida($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','16','$fechaCreacion')";
		return ejecutarConsulta($sql);
		}
	////////////////////////Accion editra productos en el log//////////////////////////
	public function accionEditaProducto($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','96','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
		
	////////////////////////////////////////funciones para agregar acciones/////////////////////////////////////////////////////////////////////////////

	////////////////////////Accion para agregar  elemento//////////////////////////
	public function nuevoServicio($satcodigo,$titulo,$usuarioSe,$fechaAccion){
	$sql = "INSERT INTO tbl_servicios (id_usuario,titulo,satcodigo,fechaCreacion)VALUES('$usuarioSe','$titulo','$satcodigo','$fechaAccion')";
	return ejecutarConsulta($sql);}

	////////////////////////Accion para eliminar servicio elemento//////////////////////////
	public function eliminoServicio($idServicio){
		$sql = "DELETE FROM tbl_servicios WHERE idServicio = '$idServicio'";
		return ejecutarConsulta($sql);}
    
    //informacion para la datatable
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_inventario_activos ORDER BY idInventario DESC";
		return ejecutarConsulta($sql); 
    }
	
	//agregamos nuevo producto
	public function nuevoProdcuto($usuarioSe,$satdes,$unidadsat,$tipo,$cantidad,$precioCompra,$precioVenta,$descuento,$proveedor,$nombreFinal,$comentarios,$fechaAccion){
		$sql = "INSERT INTO tbl_inventario_productos (id_usuario,satdes,unidadsat,tipo,cantidad,precioCompra,precioVenta,descuento,proveedor,foto,comentarios,fechaCrea)VALUES('$usuarioSe','$satdes','$unidadsat','$tipo','$cantidad','$precioCompra','$precioVenta','$descuento','$proveedor','$nombreFinal','$comentarios','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	/* entrada de productos */

	//agrega entrada de producto
	public function agreEntrda($idInventarioE,$fechaEntradaE,$cantidadE,$precioE,$proveedorE,$unidadE,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_inventario_entradas (fechaEntrada,cantidad,precio,id_usuario,proveedor,fechaCreacion,unidad,idInventario)
		VALUES('$fechaAccion','$cantidadE','$precioE','$usuarioSe','$proveedorE','$fechaAccion','$unidadE','$idInventarioE')";
		return ejecutarConsulta($sql);
	}
	
	//actualizamos el monto del producto
	public function actMontoOri($actMonto,$idInventarioE){
		$sql = "UPDATE tbl_inventario_productos SET cantidad='$actMonto' WHERE idInventario='$idInventarioE'";
	   //ejecutamos la consulta
	   return ejecutarConsulta($sql);
   }
	/* /////////////////////////////////////////////// */
	
	/* entrada de productos */

   //agrega salida de producto
	public function agreSald($idInventarioE1,$fechaEntradaE1,$cantidadE1,$precioE1,$proveedorE1,$unidadE1,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_inventario_salidas(fechaSalida,cantidad,precio,id_usuario,proveedor,fechaCreacion,idInventario,unidad)VALUES('$fechaEntradaE1','$cantidadE1','$precioE1','$usuarioSe','$proveedorE1','$fechaAccion','$idInventarioE1','$unidadE1')";
		return ejecutarConsulta($sql);
	}
	//actualizamos el monto del producto2
	public function actMontoOri2($actMonto1,$idInventarioE1){
		$sql = "UPDATE tbl_inventario_productos SET cantidad='$actMonto1' WHERE idInventario='$idInventarioE1'";
	   return ejecutarConsulta($sql);
   }

   //obtenemos valores para la edicion del producto
   public function consultaEdita($idInventarioEdi){
		$sql = "SELECT * FROM tbl_inventario_productos WHERE idInventario = '$idInventarioEdi'";
		return ejecutarConsultaSimpleFila($sql);
	}
	/* /////////////////////////////////////////////// */

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
        $sql = "DELETE FROM tbl_inventario_productos WHERE idInventario = '$idInventario2'";
        return ejecutarConsulta($sql); 
    }


	
	
	

	//editamos los productos con imagen
	public function editaProducConimag($idInventario,$satdes,$unidadsat,$tipo,$cantidad,$precioCompra,$precioVenta,$descuento,$proveedor,$comentarios,$nombre_archivo_1){
		$sql="UPDATE tbl_inventario_productos SET satdes='$satdes',unidadsat='$unidadsat',tipo='$tipo',cantidad='$cantidad',precioCompra='$precioCompra',precioVenta='$precioVenta',descuento='$descuento',proveedor='$proveedor',comentarios='$comentarios',foto='$nombre_archivo_1'	WHERE idInventario='$idInventario'";
	   return ejecutarConsulta($sql); 
   }

   //editamos los productos sin imagen
	public function editaProducSinimag($idInventario,$satdes,$unidadsat,$tipo,$cantidad,$precioCompra,$precioVenta,$descuento,$proveedor,$comentarios){
		$sql="UPDATE tbl_inventario_productos SET satdes='$satdes',unidadsat='$unidadsat',tipo='$tipo',cantidad='$cantidad',precioCompra='$precioCompra',precioVenta='$precioVenta',descuento='$descuento',proveedor='$proveedor',comentarios='$comentarios'	WHERE idInventario='$idInventario'";
	   return ejecutarConsulta($sql); 
   }

}