<?php

###  A continuación con la función exec() de PHP se ejecutan los comandos de OppenSSL, analizar con detalle. ##############


echo '<span style="color: #000099;">##### PROCESANDO ARCHIVOS DE LA FIEL ###########################################</span><br><br>';

    //===============================================================
    # Obtener el archivo .cer.pem del archivo .cer
    
    $Comando_cer_pem = "x509 -inform DER -outform PEM -in archs_emisor/RUTR7201209H5_FIEL.cer -passin pass:RERT200172* -out archs_emisor/RUTR7201209H5_FIEL.cer.pem";
    
    exec("openssl ".$Comando_cer_pem, $arr, $status);
    
    if ($status==0){
        
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod("archs_emisor/RUTR7201209H5_FIEL.cer.pem", 0777);     
         
         echo "Archivo .CER de la FIEL correctamente procesado, busque el archivo resultante en la carpeta: archs_emisor/    <br>";
    }else{
         echo 'Error';
    }

    //===============================================================
    # Obtener datos del archivo .cer.pem y guardarlos en un archivo .txt
    
    $ComandoOpenSSL = "x509 -in archs_emisor/RUTR7201209H5_FIEL.cer.pem > archs_emisor/RUTR7201209H5_FIEL.txt -text";
    
    $resp = exec('openssl '.$ComandoOpenSSL, $arr, $status);
    
//    echo $status;
//    echo "<br><br>";
    
    if ($status==0){
        
        chmod("archs_emisor/RUTR7201209H5_FIEL.txt", 0777);
        
        echo $resp;
    }else{
        echo 'Error';
    }


echo '<span style="color: #088A08;">##### PROCESANDO ARCHIVOS DEL CSD ###########################################</span><br><br>';

    //===============================================================
    # Obtener el archivo .cer.pem del archivo .cer
    
    $Comando_cer_pem = "x509 -inform DER -outform PEM -in archs_emisor/RUTR7201209H5_CSD.cer -passin pass:ID32RQ8N -out archs_emisor/RUTR7201209H5_CSD.cer.pem";
    
    exec("openssl ".$Comando_cer_pem, $arr, $status);
    
    if ($status==0){
        
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
         chmod("archs_emisor/RUTR7201209H5_CSD.cer.pem", 0777);     
         
         echo 'Archivo .CER del CSD correctamente procesado, busque el archivo resultante en la carpeta: archs_emisor/    <br>';
    }else{
         echo 'Error';
    }

    //===============================================================
    # Obtener datos del archivo .cer.pem y guardarlos en un archivo .txt
    
    $ComandoOpenSSL = "x509 -in archs_emisor/RUTR7201209H5_CSD.cer.pem > archs_emisor/RUTR7201209H5_CSD.txt -text";
    
    $resp = exec("openssl ".$ComandoOpenSSL, $arr, $status);
    
//    echo $status;
//    echo "<br>";
    
    if ($status==0){
        
        chmod("archs_emisor/RUTR7201209H5_CSD.txt", 0777);
        
        echo $resp;
    }else{
        echo 'Error';
    }

    echo "<br>";
    

echo '<span style="color: #000099;">##### DATOS OBTENIDOS DE LA FIEL ###########################################</span><br><br>';

$sslcert = file_get_contents("archs_emisor/RUTR7201209H5_FIEL.txt");
$sslcert = array(openssl_x509_parse($sslcert,TRUE));

foreach ($sslcert as $name => $arrays){
    
    foreach ($arrays as $title => $value){
        
        if(is_array($value)){
            
            echo $value . "<br>";
            
            foreach($value as $subtitle => $subvalue){
                echo $subtitle . " : " . $subvalue . "<br>";
            }
            
        }else{
            echo $title .  "<br>";
        }
    }
}

echo "<br><br>";


echo '<span style="color: #088A08;">##### DATOS OBTENIDOS DEL CSD ###########################################</span><br><br>';

$sslcert = file_get_contents("archs_emisor/RUTR7201209H5_CSD.txt");
$sslcert = array(openssl_x509_parse($sslcert,TRUE));

foreach ($sslcert as $name => $arrays){
    
    foreach ($arrays as $title => $value){
        
        if(is_array($value)){
            
            echo $value . "<br>";
            
            foreach($value as $subtitle => $subvalue){
                echo $subtitle . " : " . $subvalue . "<br>";
            }
            
        }else{
            echo $title .  "<br>";
        }
    }
}

echo '<div style="margin-bottom: 600px;"></div>';




