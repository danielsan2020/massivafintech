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
Class Mipefil{
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //log de carga de documentos
    public function logActuPerfil($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','44','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	/***********************Seccion de actualizacion de informacion de mi perfil*****************************/
	public function actualizac($nombre,$ape_paterno,$ape_materno,$telefono,$correo,$tipoActividad,$formaJuridica,$cantidadTrabajadores,$contabilidadAtrasada,$nacimiento,$dirfiscal,$estado,$ciudad,$municipio,$codigoPromo,$id_usuario,$nombreFinal,$tipoUsuario,$curp,$clave)
	{
		$sql = "UPDATE tbl_usuarios SET clave='$clave',nombre='$nombre',ape_paterno='$ape_paterno',ape_materno='$ape_materno',telefono='$telefono',correo='$correo',tipoActividad='$tipoActividad',formaJuridica='$formaJuridica',cantidadTrabajadores='$cantidadTrabajadores',tipoUsuario='2',nacimiento='$nacimiento',dirfiscal='$dirfiscal',estado='$estado',ciudad='$ciudad',municipio='$municipio',codigoPromo='$codigoPromo',foto='$nombreFinal',curp='$curp' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}

	//actualizamos la clave de la efrima
	public function actulicalveefir($id_usuario,$output)
	{
		$sql = "UPDATE tbl_documentacion SET clave='$output' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}


	//cargamos la informacion de los archivos
	public function gardocumen($nombreFinal_1,$nombreFinal_2,$nombreFinal_3,$nombreFinal_4,$nombreFinal_5,$id_usuario,$claveFinal,$fechaAccion){
		$sql = "INSERT INTO tbl_documentacion (id_usuario,comprobante,iden1,iden2,keyaar,cerar,clave,fechaCarga)VALUES('$id_usuario','$nombreFinal_1','$nombreFinal_2','$nombreFinal_3','$nombreFinal_4','$nombreFinal_5','$claveFinal','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//actualizamos la posiscion para el preregistro
	public function actpre($id_usuario){
		$sql = "UPDATE tbl_usuarios SET valorPre='2'WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}
	/***********************Seccion de actualizacion de informacion*****************************/
	
	//actualizar el pre de usuario
	public function actpre2($id_usuario){
		$sql = "UPDATE tbl_usuarios SET valorPre='5'WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	/***********************Seccion de seleccion de paquete*****************************/
	public function seleccpaquete($selecciona,$costo,$id_usuario,$fechaAccion,$codigoPagoManual){
		$sql = "INSERT INTO tbl_seleccion_paquete (id_usuario,idPaquete,fechaSeleccion,montoM,codigoPagoManual)VALUES('$id_usuario','$selecciona','$fechaAccion','$costo','$codigoPagoManual')";
		return ejecutarConsulta($sql);
	}
	
	//obtenego el paquete seleccionado cuando le doy al boton de regresar
	public function obtenerSelecPaque($id_usuario){
		$sql = "SELECT TBSLPA.*, CAPA.* FROM tbl_seleccion_paquete AS TBSLPA INNER JOIN cat_paquetes AS CAPA ON TBSLPA.idPaquete = CAPA.idPaquete WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql);
	}

	//verificamos si ya existe un campo en la tabla de seleccion de paquete
	public function Verificpaqu($id_usuario){
		$sql = "SELECT idSeleccion FROM tbl_seleccion_paquete WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql);
	}

	//en caso de que ya eciosta un registro de paquete seleccionado0 actualizamo el campo
	public function seleccpaqueteAcu($selecciona,$costo,$id_usuario,$fechaAccion,$codigoPagoManual){
		$sql = "UPDATE tbl_seleccion_paquete SET idPaquete='$selecciona',fechaSeleccion='$fechaAccion',montoM='$costo',codigoPagoManual='$codigoPagoManual' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}
	
	/***********************Seccion de seleccion de paquete*****************************/
	//agregamos tarjeta principal
	public function agregtajeta($tipo,$nombre,$numero,$fechaMes,$fechaAno,$codigo,$id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_tarjj (id_usuario,tipoTajeta,nombre,numero,fechaMes,fechaAno,codigo,fechaCreacion,tipo)VALUES('$id_usuario','$tipo','$nombre','$numero','$fechaMes','$fechaAno','$codigo','$fechaAccion','1')";
		return ejecutarConsulta($sql);
	}
	
	//agregamos tarjeta secundaris
	public function agregtajetaDos($tipo1,$nombre1,$numero1,$fechaMes1,$fechaAno1,$codigo1,$id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_tarjj (id_usuario,tipoTajeta,nombre,numero,fechaMes,fechaAno,codigo,fechaCreacion,tipo)VALUES('$id_usuario','$tipo1','$nombre1','$numero1','$fechaMes1','$fechaAno1','$codigo1','$fechaAccion','2')";
		return ejecutarConsulta($sql);
	}
	
	//cambioo del 5 al 6
	public function cambiosincoseis($id_usuario){
		$sql = "UPDATE tbl_usuarios SET valorPre='6' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	//cambioo del 6 al 7
	public function cambioseisSite($id_usuario){
		$sql = "UPDATE tbl_usuarios SET valorPre='7' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}
	
	/***********************Seccion final de informacion *****************************/
	//obtenemos la informacion general
	public function datoGener($id_usuario){
		$sql = "SELECT * FROM tbl_usuarios WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql);
	}
	///obtenemos la documentacion
	public function datosDocum($id_usuario){
		$sql = "SELECT * FROM tbl_documentacion WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql);
	}

	//obtenemos forma de pago
	public function obteneFormaPag($id_usuario){
		$sql = "SELECT * FROM tbl_tarjj WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql);
	}
	
	/***********************Seccion para botones finales *****************************/
	//botono para finalizar cuando la contabilidad esta atrasada
	public function finalSanear($id_usuario){
		$sql = "UPDATE tbl_usuarios SET valorPre='0' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

}