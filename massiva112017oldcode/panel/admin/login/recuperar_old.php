<?PHP 
@session_start();
include "global.php";
$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
//invocamos los valores
mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
if (mysqli_connect_errno()){
    printf("Fallo conexion a la base de datos %s\n", mysqli_connect_error());
    exit();
}

//termina seccion de conexion
$mail = $_REQUEST['mail'];

if(!isset($mail) && $mail == ''){ 
    //en caso de que la vairbale que enviamos este vacio regresamos a la pagina
    header ('location:../recuperar.php?opcion=false');}
else{
    
    ///verificamos que el correo exista
    $sel = $conexion->query("SELECT * FROM tbl_usuarios WHERE mail LIKE '%$mail%' AND estatus = 1");
    $var = $sel->fetch_assoc(); 

    //en caso de que se encuentre los datos con el correo selecionado intramos a enviar el correo
    if ($var){
        //variables de cabezera
        //para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        //dirección del remitente 
        $headers .= "From: Faccil.mx <soportetecnico.faccil.mx>\r\n"; 
        //dirección de respuesta, si queremos que sea distinta que la del remitente 
        $headers .= "Reply-To: ahernandez@faccil.mx\r\n"; 
        //ruta del mensaje desde origen a destino 
        $headers .= "Return-path: seguimientosoporte@faccil.mx\r\n"; 
        //despues de la recuperacion de informacion enviamos el correo
        $destinatario = $var['mail'];
        $asunto = "Recuperacion de datos de acceso";
        $mensaje = "<html> 
        <head> 
           <title>Recuperacion de datos de acceso</title> 
        </head> 
        <body> 
        <h1>Datos de Acceso</h1> 
        <p> 
        <b>Estimado usuario enseguida le reenviamos sus datos de acceso.<br>
            <b>Numero de Usuario: </b> ".$var['id_usuario']."<br>
            <b>Usuario: </b> ".$var['usuario']."<br>
            <b>Clave: </b> ".$var['clave']."<br>
            <small class='text-center'>
                
            </small>
        </p> 
        </body> 
        </html>";

        if (mail($destinatario,$asunto,$mensaje,$headers)){
            $sel = $conexion->query("INSERT INTO tbl_system (id_usuario,actividad) VALUES ('0','26')");
            if(sel){
                header ('location:../recuperar.php?opcion=true');
            }
        }
    }else{ 
        //en caso contrario regresamos a la pgain
        header ('location:../recuperar.php?opcion=false');
    }
}
?>