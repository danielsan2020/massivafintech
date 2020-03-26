<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class simula{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //nuevo seguro
    public function accionAgregoContapf($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','63','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionAgregoContapm($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','64','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionReenvio($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','65','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionElimina($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','66','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	
	
    /********************************************************************************/
	
    //informacion para la datatable
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_inventario_seguros ORDER BY idSeguros DESC";
		return ejecutarConsulta($sql); 
    }

	//agregamos nuevo seguro
	public function agregacontaatrapf($montoCal,$rfc,$nombre,$ape_paterno,$ape_materno,$correo,$periodoRegu,$obliga,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_contabilidadatrasada_pf (rfc,nombre,ape_paterno,ape_materno,correo,periodo,obligaciones,cheInteres,cheasalariado,chearrendamiento,cheservicios,cheempresaria,cherif,estatus,creado,usuarioCreacion,fechaCreacion,monto)
		VALUES('$rfc','$nombre','$ape_paterno','$ape_materno','$correo','$periodoRegu','$obliga','$cheInteres','$cheasalariado','$chearrendamiento','$cheservicios','$cheempresaria','$cherif','$estatus','$creado','$usuarioSe','$fechaAccion','$montoCal')";
		return ejecutarConsulta($sql);
	}
	public function agregacontaatrapf2($montoCal,$rfc,$nombre,$ape_paterno,$ape_materno,$correo,$periodoRegu,$obliga,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$fechaAccion,$usuarioSe,$mesesin){
		$sql = "INSERT INTO tbl_contabilidadatrasada_pf (rfc,nombre,ape_paterno,ape_materno,correo,periodo,obligaciones,cheInteres,cheasalariado,chearrendamiento,cheservicios,cheempresaria,cherif,estatus,creado,usuarioCreacion,fechaCreacion,monto,mesesin)
		VALUES('$rfc','$nombre','$ape_paterno','$ape_materno','$correo','$periodoRegu','$obliga','$cheInteres','$cheasalariado','$chearrendamiento','$cheservicios','$cheempresaria','$cherif','$estatus','$creado','$usuarioSe','$fechaAccion','$montoCal','$mesesin')";
		return ejecutarConsulta($sql);
	}

	//para el preregistro
	public function agregacontaatrapf3($montoCal,$rfc,$nombre,$ape_paterno,$ape_materno,$correo,$periodoRegu,$obliga,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$fechaAccion,$usuarioSe,$mesesin){
		$sql = "INSERT INTO tbl_contabilidadatrasada_pf (rfc,nombre,ape_paterno,ape_materno,correo,periodo,obligaciones,cheInteres,cheasalariado,chearrendamiento,cheservicios,cheempresaria,cherif,estatus,creado,usuarioCreacion,fechaCreacion,monto,mesesin)
		VALUES('$rfc','$nombre','$ape_paterno','$ape_materno','$correo','$periodoRegu','$obliga','$cheInteres','$cheasalariado','$chearrendamiento','$cheservicios','$cheempresaria','$cherif','$estatus','$creado','$usuarioSe','$fechaAccion','$montoCal','$mesesin')";
		return ejecutarConsulta($sql);
	}

	//agregamos nuevo seguro
	public function agregacontaatrapm($montoCal1,$rfc1,$nombre1,$ape_paterno1,$ape_materno1,$correo1,$periodoRegu2,$obliga2,$movIngUno2,$regeneral,$fineslucra,$estatus1,$creado1,$fechaAccion,$usuarioSe){
		$sql = "INSERT INTO tbl_contabilidadatrasada_pm (rfc,nombre,ape_paterno,ape_materno,correo,periodo,obligaciones,ingresos,regeneral,fineslucra,estatus,creado,usuarioCreacion,fechaCreacion,monto)
		VALUES('$rfc1','$nombre1','$ape_paterno1','$ape_materno1','$correo1','$periodoRegu2','$obliga2','$movIngUno2','$regeneral','$fineslucra','$estatus1','$creado1','$usuarioSe','$fechaAccion','$montoCal1')";
		return ejecutarConsulta($sql);
	}

	//eliminamos el presupuesto
	public function elimino($idContaAtrasada){
		$sql = "DELETE FROM tbl_contabilidadatrasada_pf WHERE idContaAtrasada='$idContaAtrasada'";
		return ejecutarConsulta($sql);
	}

	/********************************Acciones para la contabilidad atrasada ************************************************/
	/* obtenemos los valores de la tabla de conta atrasada para realizar el documento */
	public function informacionContaa($rfcCoti){
		$sql = "SELECT * FROM tbl_contabilidadatrasada_pf WHERE rfc='$rfcCoti'";
		return ejecutarConsulta($sql);
	}
	/* funcion para cambiar el status en epera de autortizacion */
	public function estatusEspera($idContaAtrasadaEd){
		$sql = "UPDATE tbl_contabilidadatrasada_pf SET estatus='4' WHERE idContaAtrasada='$idContaAtrasadaEd'";
		return ejecutarConsulta($sql);
	}

	/* actualizamos conta atrasada */
	public function editaContaatrad($periodoRegu,$valorFinal,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$montoCal,$idContaAtrasadaEdi,$nombre_archivo_1){
		$sql = "UPDATE tbl_contabilidadatrasada_pf SET periodo='$periodoRegu',obligaciones='$valorFinal',cheInteres='$cheInteres',cheasalariado='$cheasalariado',chearrendamiento='$chearrendamiento',cheservicios='$cheservicios',cheempresaria='$cheempresaria',cherif='$cherif',estatus='$estatus',creado='$creado',monto='$montoCal',documento='$nombre_archivo_1'
		 WHERE idContaAtrasada='$idContaAtrasadaEdi'";
		return ejecutarConsulta($sql);
	}
	
	/* cambiamos el estatus de autorizacion o negacion */
	public function cambioestatusAuto($estatus,$idContaAtrasada){
		$sql = "UPDATE tbl_contabilidadatrasada_pf SET estatus='$estatus'  WHERE idContaAtrasada='$idContaAtrasada'";
		return ejecutarConsulta($sql);
	}
	
	/* finalizamos la cotizacion */
	public function finaCotia($idContaAtrasadaEdi,$nombre_archivo_1){
		$sql = "UPDATE tbl_contabilidadatrasada_pf SET estatus='5', documentofinal = '$nombre_archivo_1'  WHERE idContaAtrasada='$idContaAtrasadaEdi'";
		return ejecutarConsulta($sql);
	}

	/* cambiamos el status del usuario */
	public function camstatusfin($refcEd){
		$sql = "UPDATE tbl_usuarios SET valorPre=0 WHERE rfc='$refcEd'";
		return ejecutarConsulta($sql);
	}

	public function datosCorr($refcEd){
		$sql = "SELECT * FROM tbl_usuarios WHERE rfc='$refcEd'";
		return ejecutarConsulta($sql);
	}

	
}