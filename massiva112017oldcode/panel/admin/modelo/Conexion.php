<?php 
/****************************************************************/
// GENERACION DE CONSULTAS Y CONEXION A LA BD                   //
// CREACION DEL ARCHIVO: 21/08/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: http://www.elinnovador.mx/                         //
/****************************************************************/

///incluimos los datos generales de conexion
require_once "global.php";

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"');

//Si tenemos un posible error en la conexión lo mostramos
if (mysqli_connect_errno()){
	printf("Falló conexión a la base de datos: %s\n",mysqli_connect_error());
	exit();
}

if (!function_exists('ejecutarConsulta')){
	//ejecucion de consultas teniendo como resultado toda la informacion
	function ejecutarConsulta($sql)	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}
	//ejecutamos consulta teniendo como resulado solo una fila de consulta.
	function ejecutarConsultaSimpleFila($sql){
		global $conexion;
		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		return $row;
	}

	//ejecutamos consulta teniendo como resultado solo el id de la consulta
	function ejecutarConsulta_retornarID($sql){
		global $conexion;
		$query = $conexion->query($sql);		
		return $conexion->insert_id;			
	}

	//funcion para limpiar string de simbolos o espacios.
	function limpiarCadena($str){
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
}
