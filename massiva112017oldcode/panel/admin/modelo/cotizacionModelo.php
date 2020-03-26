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
Class cotiza{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    /***********************Seccion para guardar los logs*****************************/
    //movimiento de creacion de cotizacion
	public function accionPrevizualizacion($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','52','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
	//movimiento de cancelacion de ctoizacion
	public function accioncancela($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','51','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	//movimienot de actualizacion de cotizacion
	public function accionAcutaliz($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','54','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	//movimienot de guardar cotizacion para enviar despues de cotizacion
	public function acciondespues($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','53','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	//movimienot de guardar cotizacion para enviar despues de cotizacion
	public function accionAhora($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','50','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
	
	

	///acciones
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



