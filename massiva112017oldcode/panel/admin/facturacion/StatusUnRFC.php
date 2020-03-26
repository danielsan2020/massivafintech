<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO PARA OBTENER EL STATUS DE UN RFC CONTRIBUYENTE DEL PANEL DE FINKOK';
echo '</div>';   

   ### 1. Datos de acceso del usuario ############################################

    // "PRUEBAS"
    $username = "controlescolarenlinea@gmail.com";
    $password = "CtrlEsc@26"; 

    // "PRODUCCION"
    // $username = "xxxxxxxxx";
    // $password = "xxxxxxxxx";

    
    #== 2. RFC del contribuyente a consultar ========================================
    $rfc = "AAA010101AAA";
    

//== Creando el SOAP de envío ==================================================
$Cadena = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
   xmlns:reg="http://facturacion.finkok.com/registration">
   <soapenv:Header/>
   <soapenv:Body>
      <reg:get>
         <reg:reseller_username>$username</reg:reseller_username>
         <reg:reseller_password>$password</reg:reseller_password>
         <reg:taxpayer_id>$rfc</reg:taxpayer_id>
      </reg:get>
   </soapenv:Body>
</soapenv:Envelope>        
XML;


    #== Se muestra el contenido del SOAP de envío (opcional)====================================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CONTENIDO DEL SOAP QUE SE ENVIA AL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($Cadena);
    echo '</div><br>';


        ### URL PRUEBAS ########################################################
        $process = curl_init('http://demo-facturacion.finkok.com/servicios/soap/registration.wsdl');

        ### URL PRODUCCION #####################################################
        // $process = curl_init('http://facturacion.finkok.com/servicios/soap/registration.wsdl');

        curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml',' charset=utf-8'));
        curl_setopt($process, CURLOPT_POSTFIELDS,$Cadena);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($process, CURLOPT_POST, true);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
        $RespServ = curl_exec($process);

        echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
        echo 'RESPUESTA DEL SERVIDOR DEL PAC';
        echo '</div>';
        echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
        echo htmlspecialchars($RespServ);
        echo '</div><br>';
        

        # == Se asigna la respuesta del servidor a una variable de tipo DOM ====
        $VarXML = new DOMDocument();
        $VarXML->loadXML($RespServ);            
            
            #== Se asigna el contenido del tag "status" a una variable ========
            $ContTagStatus = $VarXML->getElementsByTagName('status');

            #== Se obtiene el valor del nodo
            foreach($ContTagStatus as $Nodo){
                $valor_del_nodo_status = $Nodo->nodeValue; 
            }
            

            #== Se asigna el contenido del tag "taxpayer_id" a una variable ========
            $ContTagTaxpaerId = $VarXML->getElementsByTagName('taxpayer_id');

            #== Se obtiene el valor del nodo
            foreach($ContTagTaxpaerId as $Nodo){
                $valor_del_nodo_taxpayer_id = $Nodo->nodeValue; 
            }
            
                
        curl_close($process);            
                
    // "Account was Suspended successfully"  = Cuenta suspendida con éxito         = true
    // "Account was Activated successfully"  = La cuenta ha sido activada conéxito = true
                
    echo $valor_del_nodo_status;
    
    echo "<br>";
    
    echo $valor_del_nodo_taxpayer_id;
    
    

        
        
