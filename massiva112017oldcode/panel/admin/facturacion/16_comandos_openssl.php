<?php

if (strtoupper(substr(PHP_OS, 0, 3))==='WIN') {
    // Sistemas Windows.
    $SendaArchsCSD = "./sellos_digitales/";  // Directorio en donde se los archivos correspondientes a los "Sellos digitales".
    $SendaArchsPEM = "./archs_pem/";         // Directorio en donde se crearán los archivos *.cer.pem y *.key.pem
    echo "Sistema operativo Windows.<br><br>";

} else {
    // Sistemas Linux.
    $SendaArchsCSD = "sellos_digitales/";  // Directorio en donde se los archivos correspondientes a los "Sellos digitales".
    $SendaArchsPEM = "archs_pem/";         // Directorio en donde se crearán los archivos *.cer.pem y *.key.pem
    echo "Sistema operativo Linux.<br><br>";
}

$CSD_Password   = "12345678a";
$CSD_NomArchCER = "TCM970625MB1.cer"; // Nombre del archivo .CER de los "Sellos digitales".
$CSD_NomArchKEY = "TCM970625MB1.key"; // Nombre del archivo .KEY de los "Sellos digitales".

$PEM_NomArchCER = "TCM970625MB1.cer.pem"; // Nombre del archivo .CER.PEM
$PEM_NomArchKEY = "TCM970625MB1.key.pem"; // Nombre del archivo .KEY.PEM
$PEM_NomArchKeyEncrip = "TCM970625MB1.key.enc.pem"; // Nombre del archivo .KEY.ENC.PEM

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





