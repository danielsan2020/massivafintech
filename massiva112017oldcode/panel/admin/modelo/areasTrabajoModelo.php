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
Class areasTra{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    /***********************Seccion para guardar los logs*****************************/
	public function accionLogarea($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','45','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	//eliminamos activos
	public function accionElimiActi($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','69','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	///acciones

  
	//actualizamos	
    public function actualiza($administracion,$produccion,$transporte,$fechaCreacion,$idAreasTrabajo){
		$sql = "UPDATE tbl_areastrabajo SET administracion='$administracion', produccion='$produccion', transporte='$transporte', fechaCreacion='$fechaCreacion' WHERE idAreasTrabajo='$idAreasTrabajo'";
        return ejecutarConsulta($sql); 	
	}
	
	/* agregamos el nuevo registro de area de trabajo */
	public function agregaAtra($administracion,$produccion,$transporte,$fechaCreacion,$id_usuario){
		$sql = "INSERT INTO tbl_areastrabajo (id_usuario,administracion,produccion,transporte,fechaCreacion)VALUES('$id_usuario','$administracion','$produccion','$transporte','$fechaCreacion')";
        return ejecutarConsulta($sql); 	
	}
	
	
	public function elimnAct($idActivioEli){
		$sql = "DELETE FROM tbl_activos WHERE idActivo = '$idActivioEli'";
        return ejecutarConsulta($sql); 	
	}
 
	

}



