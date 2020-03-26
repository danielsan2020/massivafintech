<?php
header('Content-Type: text/html; charset=UTF-8');
include("qrlib/qrlib.php");

### CÓDIGO FUENTE, DESENCRIPTAR FIEL Y OBTENER SELLO PARA FIRMAR DIGITALMENTE DOCUMENTOS. REQUIERE DEL MÓDULO "OPENSSL" DISPONIBLE EL EL SERVIDOR APACHE.


### 1. ASIGNACIÓN DE VALORES A VARIABLES #######################################
    
$Fecha               = date("d/m/Y");          // Fecha actual.
$Hora                = date("H:i:s");          // Hora actual.
$SendaArchsFiel      = "fiel/";                // Directorio en donde se encuentran los archivos .key y .cer correspondientes a la FIEL.
$SendaArchsPEM       = "archs_pem/";           // Directorio en donde se almacenarán los archivos .key.pem resultantes de la desencriptación.
$SendaArchsGraf      = "archs_graf/";          // Directorio en donde se almacenará el gráfico QR.
$NomArchKey          = "archivo_fiel.key";     // Nombre del archivo .key de la FIEL.
$NomArchCer          = "archivo_fiel.cer";     // Nombre del archivo .cer de la FIEL.
$PassWord            = "12345678a";            // Contraseña de la FIEL.
$NomArchKeyPem       = "archivo_fiel.key.pem"; // Nombre del archivo .key.pem resultante del proceso (el nombre lo asigna el usuario).
$StatusProcesArchKey = 0;                      // Estatus de proceso de desencriptación del archivo .key (0 = sin error, 1 = con error).


### A continuación con la función exec() de PHP se ejecutan los comandos de OppenSSL, analizar con detalle. ##############

    //==========================================================================
    # Obtener el archivo .key.pem del archivo .key 
     
    $Comando_key_pem = "pkcs8 -inform DER -in ".$SendaArchsFiel.$NomArchKey." -passin pass:".$PassWord." -out ".$SendaArchsPEM.$NomArchKeyPem;
    exec('openssl '.$Comando_key_pem, $arr, $status);
    
    if ($status===0){
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
        chmod($SendaArchsPEM.$NomArchKeyPem, 0777);
        $StatusProcesArchKey = 0;
        echo '<span style="font-size: 14pt; color: #088A08;">Archivo .KEY correctamente procesado.</span>';
        echo "<br><br>";
    }else{
        $StatusProcesArchKey = 1;
        echo 'Error';
        echo "<br><br>";
    }
    
    if ($StatusProcesArchKey==0){
        
        // Obteniendo el modulus del archivo .key
        $Comando_key_pem = "rsa -in ".$SendaArchsPEM.$NomArchKeyPem." -noout -modulus";
        $ModulusKey = exec("openssl ".$Comando_key_pem, $arr, $status);    
        echo $ModulusKey;
        
        echo "<br><br>";
        
        // Obteniendo el modulus del archivo .cer
        $Comando_key_pem = "x509 -inform DER -in ".$SendaArchsFiel.$NomArchCer." -noout -modulus";
        $ModulusCer = exec("openssl ".$Comando_key_pem, $arr, $status);    
        echo $ModulusCer;   
        
        //  Obtener Sello binario en base a la cadena contenida en el archivo "contrato.txt" (Ejemplo de texto correspondiente a un Contrato de Arrendamiento). 
        $Comando_key_pem = "dgst -sha1 -sign ".$SendaArchsPEM.$NomArchKeyPem." contrato.txt > sellobinario.txt";
        exec("openssl ".$Comando_key_pem, $arr, $status);    
//        echo $status."<br><br>";
        
        //  Sello binario en base64, el archivo "sello.txt" contendrá el sello que se podrá integrar en el archivo a firmar digitalmente. 
        $Comando_key_pem = "base64 -in sellobinario.txt -out sello.txt";
        exec('openssl '.$Comando_key_pem, $arr, $status);    
//        echo $status."<br><br>";
        
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
        chmod("sellobinario.txt", 0777);
        chmod("sello.txt", 0777);
        
        echo "<br><br>";
        
        # Mostrando el Sello, esto es lo que comúnmente se imprime en un doc pdf.
         
        // Abriendo el archivo
        $archivo = fopen("sello.txt", "r");

        echo "SELLO:<br>";
        
        $CadSello = "";
        
        echo '<div style="color: #000099; font-size: 12pt;">';
        
        // Recorremos todas las lineas del archivo
        while(!feof($archivo)){
            // Leyendo una linea
            $traer = fgets($archivo);
            // Imprimiendo una linea
            echo nl2br($traer);
            $CadSello .= $traer;
        }
        
        echo '</div>';

        // Cerrando el archivo
        fclose($archivo);        
        
        
        #== Crear archivo .PNG con codigo bidimensional =================================
        // En este ejemplo se está creando el código QR en base al Sello obtenido, sin embargo
        // se puede cambiar dicho contenido por otros datos, como pueden ser el tipo de documento,
        // folio, fecha, hora, etc.
        $filename = $SendaArchsGraf."/CodigoQR.png";
        QRcode::png($CadSello, $filename, 'H', 3, 2);    
        chmod($filename, 0777);  
        echo '<img src="archs_graf/CodigoQR.png" width="159" height="159" alt="CodigoQR"/>';
        
   }

echo "<br><br>";

echo "Fecha - hora de proceso: ".$Fecha." ".$Hora;


echo "<br><br>";
    

echo '<div style="color: #5C5C5C; font-size: 10pt; margin-bottom: 10px;">###### CONTENIDO DEL ARCHIVO DE EJEMPLO FIRMADO ####################</div>';
        
echo '<div style="color: #5C5C5C; font-size: 8pt;">';

        // Leyendo el archico a firmar.
        $file = fopen("contrato.txt", "r") or exit("Unable to open file!");
        
        while(!feof($file)){
            echo fgets($file). "<br />";
        }
        
        fclose($file);
        
echo '<div>';

echo '<div style="margin-bottom: 600px;"></div>';