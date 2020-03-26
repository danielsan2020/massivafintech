<?php
header('Content-Type: text/html; charset=UTF-8');

// IDENTIFICAR SI UN ARCHIVO .CER CORRESPONDE A UN "CSD" O UNA "FIEL".


// Datos de una FIEL ===========================
$passWordFIEL = "RERT200172*";
$SendaArchsEmisor = "archs_emisor/";
$NomArchFIEL = "RUTR7201209H5_FIEL.cer";
$NomArchPEM  = "RUTR7201209H5_FIEL.cer.pem";
$NomArchTXT  = "RUTR7201209H5_FIEL.txt";


// Datos de un CSD =============================
//$passWordFIEL = "ID32RQ8N";
//$SendaArchsEmisor = "archs_emisor/";
//$NomArchFIEL = "RUTR7201209H5_CSD.cer";
//$NomArchPEM  = "RUTR7201209H5_CSD.cer.pem";
//$NomArchTXT  = "RUTR7201209H5_CSD.txt";



// Elementos a localizar.
$Dato1 = "Digital Signature";
$Dato2 = "Data Encipherment";
$Dato3 = "Key Agreement";

// Resultados de busqueda.
$ResBus1 = 0;
$ResBus2 = 0;
$ResBus3 = 0;

###  A continuación con la función exec() de PHP se ejecutan los comandos de OppenSSL, analizar con detalle. ##############

    ##### PROCESANDO ARCHIVOS DE LA FIEL #######################################

    //===============================================================
    # Obtener el archivo .cer.pem del archivo .cer
    
    $Comando_cer_pem = "x509 -inform DER -outform PEM -in ".$SendaArchsEmisor.$NomArchFIEL." -passin pass:$passWordFIEL -out ".$SendaArchsEmisor.$NomArchPEM;
    
    exec('openssl '.$Comando_cer_pem, $arr, $status);
    
    if ($status===0){
        
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod($SendaArchsEmisor.$NomArchPEM, 0777);     
         
         echo 'Archivo .CER de la FIEL correctamente procesado, busque el archivo resultante en la carpeta: archs_emisor/    <br>';
    }else{
         echo 'Error';
    }

    //===============================================================
    # Obtener datos del archivo .cer.pem y guardarlos en un archivo .txt
    
    $ComandoOpenSSL = "x509 -in ".$SendaArchsEmisor.$NomArchPEM." > ".$SendaArchsEmisor.$NomArchTXT." -text";
    
    $cadena = exec('openssl '.$ComandoOpenSSL, $arr, $status);
    
    echo $status;
    
    echo "<br><br>";
    
    if ($status==0){
        
        chmod($SendaArchsEmisor.$NomArchTXT, 0777);
        
        $sslcert = file_get_contents($SendaArchsEmisor.$NomArchTXT);
        $sslcert = array(openssl_x509_parse($sslcert,TRUE));

        foreach ($sslcert as $name => $arrays){

            foreach ($arrays as $title => $value){

                if(is_array($value)){

                    foreach($value as $subtitle => $subvalue){

                        if ($subtitle=="keyUsage"){
                            
                            $ArrayUsos = explode(",", $subvalue);
                        }
                    }
                }
            }
        }
        
        
        for ($i=0; $i<count($ArrayUsos); $i++){

            echo $ArrayUsos[$i] ."<br>";

            if (trim($ArrayUsos[$i])=="Digital Signature"){$ResBus1=1;}
            if (trim($ArrayUsos[$i])=="Data Encipherment"){$ResBus2=1;}
            if (trim($ArrayUsos[$i])=="Key Agreement")    {$ResBus3=1;}
        }
 
        
        if ($ResBus1==1 && $ResBus2==1 && $ResBus3==1){
            echo '<h2 style="color: #1B701B;">SÍ ES UNA FIEL</h1>';
        }else{
            echo '<h2 style="color: #A70202;">NO ES UNA FIEL</h1>';
        }
        
        
    }else{
        
        echo '<h2>Error</h1>';
        
    }
   
    
    


