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
Class DatosPreregistro{
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //log de carga de documentos
    public function lodgar($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','40','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	//log para la acutalizacion de informacion
	public function accionLogActualiza($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','41','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	//log para la acutalizacion de informacion
	public function accionLog($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','41','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	//log para la acutalizacion de informacion
	public function accionLogSelecPaquete($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','42','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	//log par agregar tarjeta de credito
	public function accionLogagretarje($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','43','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	/***********************Seccion de carga de documentos*****************************/
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
	public function actualizac($nombre,$ape_paterno,$ape_materno,$telefono,$correo,$tipoActividad,$formaJuridica,$cantidadTrabajadores,$contabilidadAtrasada,$nacimiento,$dirfiscal,$estado,$ciudad,$municipio,$codigoPromo,$id_usuario,$curp)
	{
		$sql = "UPDATE tbl_usuarios SET nombre='$nombre',ape_paterno='$ape_paterno',ape_materno='$ape_materno',telefono='$telefono',correo='$correo',tipoActividad='$tipoActividad',formaJuridica='$formaJuridica',cantidadTrabajadores='$cantidadTrabajadores',contabilidadAtrasada='$contabilidadAtrasada',valorPre='4',nacimiento='$nacimiento',dirfiscal='$dirfiscal',estado='$estado',ciudad='$ciudad',municipio='$municipio',codigoPromo='$codigoPromo',curp='$curp' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql);
	}
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

	public function finalSanearAtrasada($id_usuario){
		$sql = "UPDATE tbl_usuarios SET valorPre='9' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	/* agregamos el cliente predeterminado */
	public function primerCliente($id_usuario,$nombreE,$rfcE,$cpE,$correo1E,$observacionesE,$fijo,$logo){
		$sql = "INSERT INTO tbl_clientesclientes (id_usuario,logo,nombreE,rfcE,cpE,correo1E,observacionesE,estatus,fijo)VALUES('$id_usuario','$logo','$nombreE','$rfcE','$cpE','$correo1E','$observacionesE','1','$fijo')";
        return ejecutarConsulta($sql); 	
	}


	/***********************Consulto cotizaciones de preregistro *****************************/

	//botono para finalizar cuando la contabilidad esta atrasada
	public function tieneCotizacionpf($rfc){
		$sql = "SELECT * FROM tbl_contabilidadatrasada_pf  WHERE rfc='$rfc'";
        return ejecutarConsulta($sql); 	
	}

	public function tieneCotizacionpm($rfc){
		$sql = "SELECT * FROM tbl_contabilidadatrasada_pm WHERE rfc='$rfc'";
        return ejecutarConsulta($sql); 	
	}

	/*********************** acciones para subir lso archivos cuando el usuario no tiene efirma *****************************/
	/* guardamos los archivos y la contraseña de usuario sin efirma */
	public function gardocumensinefirm($nombre_archivo_5,$nombre_archivo_4,$id_usuarioEfirm,$claveesinefirma,$fechaAccion){
		$sql = "UPDATE tbl_documentacion SET cerar='$nombre_archivo_5',keyaar='$nombre_archivo_4',clave='$claveesinefirma',fechaCarga='$fechaAccion' WHERE id_usuario = '$id_usuarioEfirm'";
		return ejecutarConsulta($sql);
	}
	/* cambiamos el status de pre registro cuando termina de subir los archivos el usuario sin efirma */
	public function sinefirmAct($id_usuarioEfirm){
		$sql = "UPDATE tbl_usuarios SET valorPre='0', noTengoEfirma = '0' WHERE id_usuario='$id_usuarioEfirm'";
        return ejecutarConsulta($sql); 	
	}

	/* obtenemos el numero de facturas dependiendo del paquete */
	public function numfac($selecciona){
		$sql = "SELECT * FROM cat_paquetes WHERE idPaquete='$selecciona'";
        return ejecutarConsulta($sql); 	
	}

	/* agregamos a la tabla de facturas el numero que salio del paquete */
	public function agregofac($id_usuario,$numfacfinal){
		$sql = "INSERT INTO tbl_facturas (id_usuario,facturas)VALUES('$id_usuario','$numfacfinal')";
        return ejecutarConsulta($sql); 	
	}
	
	
}