<?php
@session_start();
/* captamos el dato del usuario para la obtenecion de los valores a convertir */
$idFactura = $_GET['idFactura'];
$id_usuario = $_SESSION['id_usuario'];
$rfc = $_SESSION['rfc'];
$idCliente = $_GET['idCliente'];

/* instanciamos los archivos requeridos */
include '../modelo/consultaGeneraFac.php';
require_once "../modelo/datosKey.php";
$consultaFac = new consultaFac();

/* obtenemos la direccion de los archivos */
$rspTabla = $consultaFac->informacionARchivos($id_usuario);
$rspTablaInfo = $rspTabla->fetch_object();
/* sacamos los archivos */
$keyaar = $rspTablaInfo->keyaar;
$cerar = $rspTablaInfo->cerar;
$clave = $rspTablaInfo->clave;

/* obtenemos la clave original */
$calv = $clave;
$key=hash('sha256', SECRET_KEY);
$iv=substr(hash('sha256', SECRET_IV), 0, 16);
$output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);

/* validamos que el usuario no tiene ya creados los archivos */
$archiv_keyy = '../contenedor/clientes/'.$rfc.'/'.$keyaar.'.pem';
$archiv_cer = '../contenedor/clientes/'.$rfc.'/'.$cerar.'.pem';

/* en caso de que el archivo exista mandamos al archivo directo de la creacion de factura */
if (file_exists($archiv_keyy) ||file_exists($archiv_cer)) { 
    /* redireccionamos a la creaciond de factura */
    header ('location:../facturacion/creacionFactura.php?idFactura='.$idFactura);
    
} 
/* en caso de que no exista creamos los archivos */
else {

    if (strtoupper(substr(PHP_OS, 0, 3))==='WIN') {
        // Sistemas Windows.
        $SendaArchsCSD = "../contenedor/clientes/".$rfc."/";  // Directorio en donde se los archivos correspondientes a los "Sellos digitales".
        $SendaArchsPEM = "../contenedor/clientes/".$rfc."/";         // Directorio en donde se crearán los archivos *.cer.pem y *.key.pem
        echo "Sistema operativo Windows.<br><br>";

    } else {
        // Sistemas Linux.
        $SendaArchsCSD = "../contenedor/clientes/".$rfc."/"; // Directorio en donde se los archivos correspondientes a los "Sellos digitales".
        $SendaArchsPEM = "../contenedor/clientes/".$rfc."/";         // Directorio en donde se crearán los archivos *.cer.pem y *.key.pem
        echo "Sistema operativo Linux.<br><br>";
    }

    ## FUNCIONES ###################################################################
        
    function ConvANum($str){
        $legalChars = "%[^0-9\-\. ]%";
        $str        = preg_replace($legalChars,"",$str);
        return $str;
        }
    
        function ExtraeNoCer($Cad){
            $Cad1 = $Cad;
            $Cad2 = "";
            while (strlen($Cad1) > 0){
                $Cad2 .= substr($Cad1,1,1);
                $Cad1 = substr($Cad1,2,strlen($Cad1)-2);
            }    
            return $Cad2;
        }

    $CSD_Password   = $output;
    $CSD_NomArchCER = $cerar; // Nombre del archivo .CER de los "Sellos digitales".
    $CSD_NomArchKEY = $keyaar; // Nombre del archivo .KEY de los "Sellos digitales".

    $PEM_NomArchCER = $cerar.".pem"; // Nombre del archivo .CER.PEM
    $PEM_NomArchKEY = $keyaar.".pem"; // Nombre del archivo .KEY.PEM
    $PEM_NomArchKeyEncrip = $keyaar.".enc.pem"; // Nombre del archivo .KEY.ENC.PEM
    ###  A continuación con la función exec() de PHP se ejecutan los comandos de OppenSSL, analizar con detalle. ##############

        //==========================================================================
        # Obtener el archivo .key.pem del archivo .key 
        
        $Comando_key_pem = "pkcs8 -inform DER -in ".$SendaArchsCSD.$CSD_NomArchKEY." -passin pass:$CSD_Password -out ".$SendaArchsPEM.$PEM_NomArchKEY;
        
        exec('openssl '.$Comando_key_pem, $arr, $status);
    
        if ($status===0){

            # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
            chmod($SendaArchsPEM.$PEM_NomArchKEY, 0777);     
            
            echo 'Archivo .KEY correctamente procesado, busque el archivo resultante en la carpeta: archs_pem/  <br>';
        }else{
            echo 'Error';
        }

        
        //==========================================================================
        # Obtener el archivo .cer.pem del archivo .cer
        echo "<br>";
        
        $Comando_cer_pem = "x509 -inform DER -outform PEM -in ".$SendaArchsCSD.$CSD_NomArchCER." -passin pass:$CSD_Password -out ".$SendaArchsPEM.$PEM_NomArchCER;
        
        exec('openssl '.$Comando_cer_pem, $arr, $status);
        
        if ($status===0){
            
            # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
            chmod($SendaArchsPEM.$PEM_NomArchCER, 0777);     
            
            echo 'Archivo .CER correctamente procesado, busque el archivo resultante en la carpeta: archs_pem/   <br>';
        }else{
            echo 'Error';
        }
        

        
            //==========================================================================
        # Obtener No. de certificado contenido en el archivo .cer.pem 
        echo "<br>";
        
        $Comando_NoCert = "x509 -in ".$SendaArchsPEM.$PEM_NomArchCER." -noout -serial";
        $NoCert = exec('openssl '.$Comando_NoCert, $arr, $status);
        $NoCert = ConvANum($NoCert);
        $NoCert = ExtraeNoCer($NoCert);
        
        if ($status===0){
            echo "No. de certificado: ".$NoCert;
        }else{
            echo 'Error';
        }
        
        
        //==========================================================================
        # Obtener la Razon social y RFC
        echo "<br><br>";
        
        $Comando_DatosContrib = "x509 -in ".$SendaArchsPEM.$PEM_NomArchCER." -noout -subject -nameopt oneline,-esc_msb";
        $NomProp = exec('openssl '.$Comando_DatosContrib, $arr, $status);
        
        if ($status===0){
            $ArraySubject = explode(",", $NomProp);
            $ArrayNom = explode("=", $ArraySubject[1]);
            $RazSoc   = $ArrayNom[1];
            echo $RazSoc;
            echo "<br>";
            $ArrayRFC = explode("=", $ArraySubject[3]);
            $RFC      = substr($ArrayRFC[1],0,14);
            echo $RFC;
        }else{
            echo 'Error';
        }
        
        //==========================================================================
        # Encriptar con DES3 
        echo "<br><br>";
        
        $Comando_Encriptar = "rsa -in ".$SendaArchsPEM.$PEM_NomArchKEY." -des3 -out ".$SendaArchsPEM.$PEM_NomArchKeyEncrip." -passout pass:".$CSD_Password;
        exec('openssl '.$Comando_Encriptar, $arr, $status);
        
        if ($status===0){
            
            # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
            chmod($SendaArchsPEM.$PEM_NomArchKeyEncrip, 0777);
            
            echo 'Proceso de encriptado: correcto.';
        }else{
            echo 'Error';
        }    
        
        $respaccion = $consultaFac->guardamosar($id_usuario,$NoCert,$PEM_NomArchCER,$PEM_NomArchKEY);

        if($respaccion){ header ('location:../facturacion/creacionFactura.php?idFactura='.$idFactura); }
        

        
    
}





