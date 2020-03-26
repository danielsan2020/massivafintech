<?PHP 
@session_start();

include "../config/global.php";
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

//invocamos los valores
mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
if (mysqli_connect_errno()){
    printf("Fallo conexion a la base de datos %s\n", mysqli_connect_error());
    exit();
}
//termina seccion de conexion
$usuario = strip_tags($_REQUEST['usuario']);
$hola = strip_tags($_REQUEST['clave']);

if($usuario == '' && $hola == ''){ header ('location:../../index.php?act=2'); }

else{
    
    $sel = $conexion->query("SELECT TBUS.*, TSEPA.idPaquete as VALPAQ
    FROM tbl_usuarios as TBUS
    LEFT JOIN tbl_seleccion_paquete AS TSEPA ON TBUS.id_usuario = TSEPA.id_usuario
    WHERE usuario = '$usuario' AND clave = '$hola' AND estatus = 1");

    $var = $sel->fetch_assoc(); 

    //validamos 
    if ($var){
        //creamos las variables de session
        $_SESSION['id_usuario'] = $var['id_usuario'];
        $_SESSION['usuario'] = $var['usuario'];
        $_SESSION['clave'] = $var['clave'];
        $_SESSION['nombre'] = $var['nombre'];
        $_SESSION['ape_paterno'] = $var['ape_paterno'];
        $_SESSION['ape_materno'] = $var['ape_materno'];
        $_SESSION['telefono'] = $var['telefono'];
        $_SESSION['rfc'] = $var['rfc'];
        $_SESSION['correo'] = $var['correo'];
        $_SESSION['tipoActividad'] = $var['tipoActividad'];
        $_SESSION['formaJuridica'] = $var['formaJuridica'];
        $_SESSION['cantidadTrabajadores'] = $var['cantidadTrabajadores'];
        $_SESSION['noTengoEfirma'] = $var['noTengoEfirma'];
        $_SESSION['contabilidadAtrasada'] = $var['contabilidadAtrasada'];
        $_SESSION['tipoUsuario'] = $var['tipoUsuario'];
        $_SESSION['valorPre'] = $var['valorPre'];
        $_SESSION['fechaCrea'] = $var['fechaCrea'];
        $_SESSION['estatus'] = $var['estatus'];
        $_SESSION['nUsuario'] = $var['nUsuario'];
        $_SESSION['nacimiento'] = $var['nacimiento'];
        $_SESSION['celular'] = $var['celular'];
        $_SESSION['correo2'] = $var['correo2'];
        $_SESSION['dirfiscal'] = $var['dirfiscal'];
        $_SESSION['estado'] = $var['estado'];
        $_SESSION['ciudad'] = $var['ciudad'];
        $_SESSION['municipio'] = $var['municipio'];
        $_SESSION['codigoPromo'] = $var['codigoPromo'];
        $_SESSION['foto'] = $var['foto'];
        $_SESSION['VALPAQ'] = $var['VALPAQ'];
       
        //guardamos el acceso en la tabla
        $explorador = $_SERVER['HTTP_USER_AGENT'];
        $fecha = date("Y-m-d H:i:s");
        $preregistro = $var['valorPre'];

        //verificamos en que estatus del preregistro esta
        if($preregistro == '0'){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso a la plataforma')");
            //aqui verificamos si el suaurio ya entro al pre registro
            header ('location:../index.php?msj=Bienvenido al Sistema&indes='.$var['id_usuario']); 
        }
        
        elseif($preregistro == 1){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso al preregistro')");
            header ('location:../preregistro.php'); 
            
        }
        elseif($preregistro == 2){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso al preregistro')");
            header ('location:../preregistro2.php'); 
        }
        elseif($preregistro == 4){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso al preregistro')");
            header ('location:../preregistro4.php'); 
        }
        elseif($preregistro == 5){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso al preregistro')");
            header ('location:../preregistro5.php'); 
        }
        elseif($preregistro == 6){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso al preregistro')");
            header ('location:../preregistro6.php'); 
        }
        elseif($preregistro == 7){
            $acceso = $conexion->query("INSERT INTO tbl_access VALUES ('','".$idExplorar."','".$explorador."','".$fecha."','Ingreso al preregistro')");
            header ('location:../preregistro7.php'); 
        }
        elseif($preregistro == 9){
            header ('location:../falta.php'); 
        }

    }else{ header ('location:../../index.php?act=3'); }

}
?>