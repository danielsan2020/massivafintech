<?php
header('Content-Type: text/html; charset=UTF-8');

if (function_exists('exec')) {
    echo '<span style="color: #129031;">La funcion exec() si está disponible.</span><br><br>';
} else {
    echo '<span style="color: #A70202;">La funcion exec() no está disponible.</span><br><br>';
}

$SendaArchsCSD = "sellos_digitales/";  // Directorio en donde se los archivos correspondientes a los "Sellos digitales".
$SendaArchsPEM = "archs_pem/";         // Directorio en donde se crearán los archivos *.cer.pem y *.key.pem

$CSD_Password   = "12345678a";
$CSD_NomArchCER = "ACO560518KW7.cer"; // Nombre del archivo .CER de los "Sellos digitales".
$CSD_NomArchKEY = "ACO560518KW7.key"; // Nombre del archivo .KEY de los "Sellos digitales".
                   
$PEM_NomArchCER = "ACO560518KW7.cer.pem"; // Nombre del archivo .CER.PEM
$PEM_NomArchKEY = "ACO560518KW7.key.pem"; // Nombre del archivo .KEY.PEM
$PEM_NomArchKeyEncrip = "ACO560518KW7.key.enc.pem"; // Nombre del archivo .KEY.ENC.PEM

echo 'Archivo .CER:<br>';
echo $SendaArchsCSD.$CSD_NomArchCER;
echo '<br><br>';

echo 'Archivo .KEY:<br>';
echo $SendaArchsCSD.$CSD_NomArchKEY;
echo '<br><br>';

if (file_exists($SendaArchsCSD.$CSD_NomArchCER)) {
    echo "El fichero $CSD_NomArchCER ==> SI existe";
} else {
    echo "El fichero $CSD_NomArchCER ==> NO existe";
}
echo "<br><br>";

if (file_exists($SendaArchsCSD.$CSD_NomArchKEY)) {
    echo "El fichero $CSD_NomArchKEY ==> SI existe";
} else {
    echo "El fichero $CSD_NomArchKEY ==> NO existe";
}
echo "<br><br>";


###  A continuación con la función exec() de PHP se ejecutan los comandos de OppenSSL, analizar con detalle. ##############

    //==========================================================================
    # Obtener el archivo .key.pem del archivo .key 
     
    $Comando_key_pem = "pkcs8 -inform DER -in ".$SendaArchsCSD.$CSD_NomArchKEY." -passin pass:$CSD_Password -out ".$SendaArchsPEM.$PEM_NomArchKEY;
    
    echo 'Comando ejecutado: <span style="color: #0404B4;">'.$Comando_key_pem.'</span>';
    echo "<br><br>";
    
    exec('openssl '.$Comando_key_pem, $arr, $status);
    
    echo "Status de ejecución de comando OpenSSL: ".$status;
    echo "<br><br>";
   
  
    if ($status==0){

        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
//         chmod($SendaArchsPEM.$PEM_NomArchKEY, 0777);     
        echo '<span style="color: #129031; font-size: 14pt;">Si se pudieron ejecutar los comandos OpenSSL.</span>';
        echo "<br><br>";
        echo 'Archivo .KEY correctamente procesado, busque el archivo resultante en la carpeta: archs_pem/  <br>';
    }else{
        
        echo '<span style="color: #A70202; font-size: 14pt;">Error, no se pudieron ejecutar los comandos OpenSSL.</span>';
    }


