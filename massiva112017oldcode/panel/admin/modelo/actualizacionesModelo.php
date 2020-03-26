<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class actuali{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    public function accionObligaciones($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','87','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	 public function accionefirma($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','88','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	 public function accionsuspension($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','89','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	 public function accionconstancia($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','90','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	 public function acciondefuncion($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','91','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	
	////////////////////////////////////////funciones para agregar acciones/////////////////////////////////////////////////////////////////////////////

	////////////////////////Accion para agregar actualziacion de obligaciones //////////////////////////
	public function ActuObli($costo,$fecha,$actividad,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_actualiza_obligaciones (id_usuario,costo,actividad,fecha,fechaSolicitud,estatus)VALUES('$usuarioSe','$costo','$actividad','$fecha','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}

	////////////////////////solicitud de actualizacion de efirma //////////////////////////
	public function actuEfirma($costo,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_actualiza_efirma (id_usuario,costo,fechaSolicitud,estatus)VALUES('$usuarioSe','$costo','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}

	////////////////////////solicitud de suspension de activiades //////////////////////////
	public function actuSuspen($costo,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_actualiza_suspencion (id_usuario,costo,fecha,estatus)VALUES('$usuarioSe','$costo','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}
	
	////////////////////////solicitud de cambio de domicilio //////////////////////////
	public function actuDomn($costo,$direccion,$estado,$ciudad,$municipio,$cppp,$nombre_archivo,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_actualiza_domicilio (id_usuario,costo,direccion,estado,ciudad,municipio,cp,comprobante,fechaSolicitud,estatus)
		VALUES('$usuarioSe','$costo','$direccion','$estado','$ciudad','$municipio','$cppp','$nombre_archivo','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}

	////////////////////////solicitud de constancia fiscal //////////////////////////
	public function actuConsss($costo,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_actualiza_constancia (id_usuario,costo,fecha,estatus)VALUES('$usuarioSe','$costo','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}

	////////////////////////solicitud de defuncion //////////////////////////
	public function actudefuncion($costo,$nombre_archivo,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_actualiza_defuncion (id_usuario,costo,defuncion,fecha,estatus)VALUES('$usuarioSe','$costo','$nombre_archivo','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}




}