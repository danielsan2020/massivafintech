<?php
header('Content-Type: text/html; charset=UTF-8');

    
    if (strtoupper(substr(PHP_OS, 0, 3))==='WIN') {
        // Sistemas Windows.
        $DirDes = "./archs_pem/";

    } else {
        // Sistemas Linux.
        $DirDes = "archs_pem/";
    }    
    
    $ArchKEY = "ArchCSD.key";
    $ArchCER = "ArchCSD.cer";

    if (file_exists($DirDes.$ArchKEY)) {
        unlink($DirDes.$ArchKEY);
    }    
    
    if (file_exists($DirDes.$ArchCER)) {
        unlink($DirDes.$ArchCER);
    }    

    if(file_exists($DirDes)==false){
        mkdir($DirDes);
        chmod($DirDes, 0777);
    }

    $file_tmp  = $_FILES['CSD_Archivo1']['tmp_name'];
    $ArchDes = $DirDes.$ArchKEY;
    move_uploaded_file($file_tmp,$ArchDes);
    chmod($ArchDes, 0777);

    $file_tmp  = $_FILES['CSD_Archivo2']['tmp_name'];
    $ArchDes = $DirDes.$ArchCER;
    move_uploaded_file($file_tmp,$ArchDes);
    chmod($ArchDes, 0777);
    
    echo "OK";
    

    
    
    
    