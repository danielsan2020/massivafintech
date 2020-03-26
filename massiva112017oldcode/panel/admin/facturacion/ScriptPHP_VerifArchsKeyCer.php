<?php
header("Content-Type: application/xml");

$ClaveSellos = $_GET["ClaveSellos"];

$ArchKEY = "ArchCSD.key";
$ArchCER = "ArchCSD.cer";

$ArchKEY_pem = "ArchCSD.key.pem";
$ArchCER_pem = "ArchCSD.cer.pem";

$StatusArchKEY = 0;
$StatusArchCER = 0;

$ModulusKey = "X1X1X1";
$ModulusCer = "Y1Y1Y1";
$ValidModulus = 1;

$NoCert = "";
$RFC    = "";
$RazSoc = "";

if (strtoupper(substr(PHP_OS, 0, 3))==='WIN') {
    // Sistemas Windows.
    $DirDes = "./archs_pem/";

} else {
    // Sistemas Linux.
    $DirDes = "archs_pem/";
}    
    


if (file_exists($DirDes.$ArchKEY)) {
    $StatusArchKEY = 1;
}    

if (file_exists($DirDes.$ArchCER)) {
    $StatusArchCER = 1;
}    


if ($StatusArchKEY==1 && $StatusArchCER==1){
    
    //===============================================================
    # Obtener el archivo .key.pem del archivo .key 
     
    $Comando_key_pem = "pkcs8 -inform DER -in '".$DirDes.$ArchKEY."' -passin pass:$ClaveSellos -out '".$DirDes.$ArchKEY_pem."'";
    exec('openssl '.$Comando_key_pem, $arr, $status);
  
    if ($status===0){
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod($DirDes.$ArchKEY_pem, 0777);     
    }
    
    
    //===============================================================
    # Obtener el archivo .cer.pem del archivo .cer
    
     $Comando_cer_pem = "x509 -inform DER -outform PEM -in ".$DirDes.$ArchCER." -passin pass:$ClaveSellos -out ".$DirDes.$ArchCER_pem;
    exec('openssl '.$Comando_cer_pem, $arr, $status);
    
    if ($status===0){
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod($DirDes."/".$ArchCER_pem, 0777);     
    }

    
    //===============================================================
    # Obtener el modulus de key.pem
    $Comando_key_pem = "rsa -in ".$DirDes.$ArchKEY_pem." -noout -modulus";
    $CadModulusKey = exec('openssl '.$Comando_key_pem, $arr, $status);    
    $ArrayModKey = explode("=",$CadModulusKey);
    $ModulusKey = $ArrayModKey[1];
    
    //===============================================================
    # Obtener el modulus de cer.pem
    $Comando_cer_pem = "x509 -inform DER -in ".$DirDes.$ArchCER." -noout -modulus";
    $CadModulusCer = exec('openssl '.$Comando_cer_pem, $arr, $status);    
    $ArrayModCer = explode("=",$CadModulusCer);
    $ModulusCer = $ArrayModCer[1];
    
    
    if ($ModulusKey == $ModulusCer){
        
        $ValidModulus = 0;
        
        //===============================================================
        # Obtener No. de certificado contenido en el archivo .cer.pem 

        $Comando_NoCert = "x509 -in ".$DirDes.$ArchCER_pem." -noout -serial";
        $NoCert = exec('openssl '.$Comando_NoCert, $arr, $status);
        $NoCert = ConvANum($NoCert);
        $NoCert = trim(ExtraeNoCer($NoCert));


        //===============================================================
        # Obtener la Razon social y RFC

        $Comando_DatosContrib = "x509 -in ".$DirDes.$ArchCER_pem." -noout -subject -nameopt oneline,-esc_msb";
        $NomProp = exec('openssl '.$Comando_DatosContrib, $arr, $status);
        
        if ($status===0){
            $ArraySubject = explode(",", $NomProp);
            $ArrayNom = explode("=", $ArraySubject[1]);
            $RazSoc   = trim($ArrayNom[1]);
            $ArrayRFC = explode("=", $ArraySubject[3]);
            $RFC      = trim(substr($ArrayRFC[1],0,14));
            
            $ConSQL = "update gc_empresas set fact_nombre='$RazSoc', fact_rfc='$RFC', noCertificado='$NoCert', ArchPEM_NomArchCer='$ArchCER_pem', ArchPEM_NomArchKey='$ArchKEY_pem' where IdEmpr='$IdEmpr'";
             
            mysqli_query($conexion, $ConSQL);
        }    
    }
}

$Param = "<param StatusArchKEY='$StatusArchKEY' StatusArchCER='$StatusArchCER' ValidModulus='$ValidModulus' RFC='$RFC' RazSoc='$RazSoc' NoCert='$NoCert' />\n";

echo "<datos>\n$Param</datos>";


// FUNCIONES ===================================================================

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


