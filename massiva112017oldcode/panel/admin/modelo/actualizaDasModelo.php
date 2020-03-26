<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class actualiza{
	
	//Implementamos nuestro constructor
	public function __construct(){}

	
    /********************************************************************************/
	/* cambiamos status de actualizacion de obligaciones fiscales */
	public function terminoUno($idActu,$nombre_archivo_1){
		$sql = "UPDATE tbl_actualiza_obligaciones SET estatus='2', archivo='$nombre_archivo_1'  WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para el error de obligaciones fiscales */
	public function errorUno($idActu){
		$sql = "UPDATE tbl_actualiza_obligaciones SET estatus='3' WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* cambiamos status de actualizacion de obligaciones fiscales */
	public function terminoDos($idActu,$nombre_archivo_1){
		$sql = "UPDATE tbl_actualiza_efirma SET estatus='2', archivo='$nombre_archivo_1'  WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para error de efirma */
	public function errorDos($idActu){
		$sql = "UPDATE tbl_actualiza_efirma SET estatus='3' WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para actulizar suspension actividades */
	public function terminoTres($idActu,$nombre_archivo_1){
		$sql = "UPDATE tbl_actualiza_suspencion SET estatus='2', archivo='$nombre_archivo_1'  WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para error de efirma */
	public function errorTres($idActu){
		$sql = "UPDATE tbl_actualiza_suspencion SET estatus='3' WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para actulizar constancia actividades */
	public function terminoCinco($idActu,$nombre_archivo_1){
		$sql = "UPDATE tbl_actualiza_constancia SET estatus='2', archivo='$nombre_archivo_1'  WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para error de constancia */
	public function errorCinco($idActu){
		$sql = "UPDATE tbl_actualiza_constancia SET estatus='3' WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para actulizar defuncion */
	public function terminoSeis($idActu,$nombre_archivo_1){
		$sql = "UPDATE tbl_actualiza_defuncion SET estatus='2', archivo='$nombre_archivo_1'  WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para error de defuncion */
	public function errorSeis($idActu){
		$sql = "UPDATE tbl_actualiza_defuncion SET estatus='3' WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para actulizar defuncion */
	public function terminoCuatro($idActu,$nombre_archivo_1){
		$sql = "UPDATE tbl_actualiza_domicilio SET estatus='2', archivo='$nombre_archivo_1'  WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}
	/* para error de defuncion */
	public function errorCuatro($idActu){
		$sql = "UPDATE tbl_actualiza_domicilio SET estatus='3' WHERE idActu='$idActu'";
		return ejecutarConsulta($sql);
	}


	
}