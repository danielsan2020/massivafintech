<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class seguros{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //nuevo seguro
    public function accionNuevoseguro($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','59','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	//elimina seguro
	public function accionEliminaeguro($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','60','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	//edicion seguro
	public function accioneditaeguro($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','61','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
    /********************************************************************************/
	
    //informacion para la datatable
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_inventario_seguros ORDER BY idSeguros DESC";
		return ejecutarConsulta($sql); 
    }

	//agregamos nuevo seguro
	public function agreSeguro($rfc,$tipo,$prima,$fechaInicio,$fechaTermino,$descripcion,$numeroPoliza,$metodoPago,$aseguradora,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_seguros (rfc,tipo,prima,fechaInicio,fechaTermino,numeroPoliza,metodoPago,aseguradora,descripcion,usuarioCreacion,fechaCreacion)
		VALUES('$rfc','$tipo','$prima','$fechaInicio','$fechaTermino','$numeroPoliza','$metodoPago','$aseguradora','$descripcion','$usuarioSe','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//eliminacion de seguro
    public function eliminaSeguro($idSeguroEli){
        $sql = "DELETE FROM tbl_seguros WHERE idSeguro = '$idSeguroEli'";
        return ejecutarConsulta($sql); 
    }

    //consulta la edicion de seguros
    //obtenemos valores para la edicion del producto
    public function ConsulEdita($idenSegurrr){
        $sql = "SELECT * FROM tbl_seguros WHERE idSeguro = '$idenSegurrr'";
        return ejecutarConsultaSimpleFila($sql);
		
    }

    //editamos la informacion
    public function editarSeguro($rfc1,$tipo1,$prima1,$fechaInicio1,$fechaTermino1,$descripcion1,$numeroPoliza1,$metodoPago1,$aseguradora1,$idSeguroEdita){
		 $sql = "UPDATE tbl_seguros SET rfc='$rfc1',tipo='$tipo1',prima='$prima1',fechaInicio='$fechaInicio1',fechaTermino='$fechaTermino1',numeroPoliza='$numeroPoliza1',metodoPago='$metodoPago1',aseguradora='$aseguradora1',descripcion='$descripcion1' WHERE idSeguro='$idSeguroEdita'";
        //ejecutamos la consulta
        return ejecutarConsulta($sql);
	}


	
}