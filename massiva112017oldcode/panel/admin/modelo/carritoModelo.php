<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "Conexion.php";
Class carri{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    /***********************Seccion para guardar los logs*****************************/
    //movimiento de creacion de cotizacion
	public function accionagregaFacturas($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','55','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	public function accionagregatickets($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','57','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	public function accionagregaActu($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','58','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	public function compraLog($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_compras (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','56','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	
	
	

	///acciones

	//facturas
	//obtenemos los numero sde factura que ya tenga el usuario
	 public function buscarNumFac($id_usuario){
        $sql="SELECT facturas FROM tbl_facturas WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql); 
    }

    //agregamos nuevo registro de facturas
    public function agregaFac($id_usuario,$numFacFinal,$fechaCreacion){
		$sql= "INSERT INTO tbl_facturas (id_usuario,facturas,fechaCreacion) VALUES('$id_usuario','$numFacFinal','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
    
    //actualizamos registro de facturas
	public function actualizaFac($id_usuario,$numFacFinal,$fechaCreacion){
		$sql = "UPDATE tbl_facturas SET facturas='$numFacFinal', fechaCreacion='$fechaCreacion' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	//tickets
	//obtenemos los tickets que tiene actual
	 public function buscarTickets($id_usuario){
        $sql="SELECT tickets FROM tbl_tickets WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql); 
    }
	
	public function agregaTick($id_usuario,$numTiccFinal,$fechaCreacion){
		$sql= "INSERT INTO tbl_tickets (id_usuario,tickets,fechaCreacion)
		VALUES('$id_usuario','$numTiccFinal','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
    
    //actualizamos registro de facturas
	public function actualizaTick($id_usuario,$numTiccFinal,$fechaCreacion){
		$sql = "UPDATE tbl_tickets SET tickets='$numTiccFinal', fechaCreacion='$fechaCreacion' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	//actualziaciones
	//actualizaciones
	 public function buscarActualizaciones($id_usuario){
        $sql="SELECT * FROM tbl_actualizaciones WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql); 
    }


    public function agregaActu($id_usuario,$numUno,$numDos,$numTres,$numCuatro,$numCinco,$numSeis,$fechaCreacion){
		$sql= "INSERT INTO tbl_actualizaciones (id_usuario,suspension,domicilio,obligaciones,efirma,defuncion,situacion,fechaCreacion)
		VALUES('$id_usuario','$numUno','$numDos','$numTres','$numCuatro','$numCinco','$numSeis','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
    
    //actualizamos registro de facturas
	public function actualizaActu($id_usuario,$numUno,$numDos,$numTres,$numCuatro,$numCinco,$numSeis,$fechaCreacion){
		$sql = "UPDATE tbl_actualizaciones SET suspension='$numUno', domicilio='$numDos',obligaciones='$numTres',efirma='$numCuatro',defuncion='$numCinco', situacion='$numSeis' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	///compora

	//agregamos la compra 
	public function agregaCompra($id_usuario,$montoDinalCompra,$fechaCreacion,$movimiento){
		$sql= "INSERT INTO tbl_compra (id_usuario,monto,fechaCompra,transaccion) VALUES('$id_usuario','$montoDinalCompra','$fechaCreacion','$movimiento')";
		return ejecutarConsulta($sql);
	}
	







	//agregamos la cotizacion en la primera vizualizacion
	public function Agragr($id_usuario,$dirigido,$lugarFecha,$titulo,$descripcion,$notas,$correo1,$correo2,$usuarioCreacion,$fechaCreacion,$estatus){
		$sql= "INSERT INTO tbl_cotizaciones (id_usuario,dirigido,lugarFecha,titulo,descripcion,notas,correo1,correo2,usuarioCreacion,fechaCreacion,estatus)
		VALUES('$id_usuario','$dirigido','$lugarFecha','$titulo','$descripcion','$notas','$correo1','$correo2','$usuarioCreacion','$fechaCreacion','$estatus')";
		return ejecutarConsulta($sql);
	}

	///editamos la cotizacion actual
	public function EditaPrevi($dirigido,$lugarFecha,$titulo,$descripcion,$notas,$correo1,$correo2,$idCotizacion){
		$sql = "UPDATE tbl_cotizaciones SET dirigido='$dirigido', lugarFecha='$lugarFecha', titulo='$titulo', descripcion='$descripcion', notas='$notas', correo1='$correo1', correo2='$correo2' WHERE idCotizacion='$idCotizacion'";
        return ejecutarConsulta($sql); 	
	}

	//eliminamos la cotizacion
	 public function eliminar($idElimina){
        $sql = "DELETE FROM tbl_cotizaciones WHERE idCotizacion = '$idElimina'";
        return ejecutarConsulta($sql); 
    }
	
	//guardamos para despues
	public function guardodespues($iddespues){
		$sql = "UPDATE tbl_cotizaciones SET estatus='2' WHERE idCotizacion='$iddespues'";
        return ejecutarConsulta($sql); 	
	}
	
	//guardamos ahora
	public function guardoAhora($iddespues){
		$sql = "UPDATE tbl_cotizaciones SET estatus='3' WHERE idCotizacion='$iddespues'";
        return ejecutarConsulta($sql); 	
	}
	

	//obtenemos la informaicon de la cotizacion
	 public function obtenemosinfocoti($idAhora){
        $sql="SELECT * FROM tbl_cotizaciones WHERE idCotizacion='$idAhora'";
		return ejecutarConsulta($sql); 
    }
	

}



