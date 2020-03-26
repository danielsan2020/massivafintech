<?php
require_once "Conexion.php";

Class proveedorMod{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //nuevo proveedor
    public function accionAgregoPro($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','93','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	//editoproveedor
	public function accionEditoPro($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','94','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	//eliminoproveedor
	public function accionEliPro($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','95','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

    /********************************************************************************/

  	//agregamos nuevo proveedor
	public function nuevoProveedor($id_usuario,$rfc,$nombre,$dir,$colonia,$cp,$estado,$ciudad,$tel,$correo,$pagina,$razon,$pais,$dias,$tipo,$observaciones,$nombre_archivo_1,$estatus){
		$sql = "INSERT INTO tbl_prove (id_usuario,rfcPro,nombre,direcc,colonia,cpPro,estado,ciudad,telefeo,correo,pagina,razon,pais,dias,tipo,observaciones,logo,estatus) 
		VALUES ('$id_usuario','$rfc','$nombre','$dir','$colonia','$cp','$estado','$ciudad','$tel','$correo','$pagina','$razon','$pais','$dias','$tipo','$observaciones','$nombre_archivo_1','$estatus')";
		return ejecutarConsulta($sql);
	}

	/* consulta para la edicion del proveedor */
	public function consultaEdita($idenEdita){
		$sql = "SELECT * FROM tbl_prove WHERE estatus=1 AND idproveedor = '$idenEdita'";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	
	//editamos proveedorcon con logo
	public function editaPro($idproveedor,$rfc,$nombre,$dir,$colonia,$cp,$estado,$ciudad,$tel,$correo,$pagina,$razon,$pais,$dias,$tipo,$observaciones,$nombre_archivo_1){
		$sql = "UPDATE tbl_prove SET rfcPro = '$rfc',nombre= '$nombre',direcc= '$dir',colonia= '$colonia',cpPro= '$cp',estado= '$estado',ciudad= '$ciudad',telefeo= '$tel',correo= '$correo',
		pagina= '$pagina',razon= '$razon',pais= '$pais',dias= '$dias',tipo= '$tipo',observaciones= '$observaciones',logo= '$nombre_archivo_1' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}
	
		
	
	//editamos proveedorcon con logo
	public function editaProSin($idproveedor,$rfc,$nombre,$dir,$colonia,$cp,$estado,$ciudad,$tel,$correo,$pagina,$razon,$pais,$dias,$tipo,$observaciones){
		$sql = "UPDATE tbl_prove SET rfcPro = '$rfc',nombre= '$nombre',direcc= '$dir',colonia= '$colonia',cpPro= '$cp',estado= '$estado',ciudad= '$ciudad',telefeo= '$tel',correo= '$correo',
		pagina= '$pagina',razon= '$razon',pais= '$pais',dias= '$dias',tipo= '$tipo',observaciones= '$observaciones' WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}

	//eliminamos proveedor
	public function eliPro($idproveedor){
		$sql = "UPDATE tbl_prove SET estatus=2 WHERE idproveedor='$idproveedor'";
		return ejecutarConsulta($sql);
	}


}

?>