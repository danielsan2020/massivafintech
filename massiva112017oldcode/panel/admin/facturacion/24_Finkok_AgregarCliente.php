<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO PARA "AGREGAR CLIENTE" AL PANEL DE FINKOK';
echo '</div>';   
   
   ### 1. Datos de acceso del usuario ############################################

    // "PRUEBAS"
    $username = "controlescolarenlinea@gmail.com";
    $password = "CtrlEsc@26"; 

    // "PRODUCCION"
    // $username = "xxxxxxxxx";
    // $password = "xxxxxxxxx";

    
    #== 2. RFC del contribuyente a agregar ========================================
    $rfc = "AAA010101AAA";
    

//== 3. Creando el SOAP de envío ==================================================
$Cadena = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope xmlns:ns0="http://facturacion.finkok.com/registration" 
   xmlns:ns1="http://schemas.xmlsoap.org/soap/envelope/" 
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
   xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"> 
   <SOAP-ENV:Header/>
   <ns1:Body>
      <ns0:add>
         <ns0:reseller_username>$username</ns0:reseller_username>
         <ns0:reseller_password>$password</ns0:reseller_password>
         <ns0:taxpayer_id>$rfc</ns0:taxpayer_id>
      </ns0:add>
   </ns1:Body>
</SOAP-ENV:Envelope>
XML;


    #== Se muestra el contenido del SOAP de envío (opcional)====================================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CONTENIDO DEL SOAP QUE SE ENVIA AL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($Cadena);
    echo '</div><br>';


        ### 4. URL PRUEBAS ########################################################
        $process = curl_init('https://demo-facturacion.finkok.com/servicios/soap/registration.wsdl');

        ### 4. URL PRODUCCION #####################################################
        // $process = curl_init('https://facturacion.finkok.com/servicios/soap/registration.wsdl');

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
            
            #== Se asigna el contenido del tag "message" a una variable ========
            $ContTagMessage = $VarXML->getElementsByTagName('message');

            #== Se obtiene el valor del nodo
            foreach($ContTagMessage as $Nodo){
                $valor_del_nodo_message = $Nodo->nodeValue; 
            }
            

            #== Se asigna el contenido del tag "success" a una variable ========
            $ContTagSuccess = $VarXML->getElementsByTagName('success');

            #== Se obtiene el valor del nodo
            foreach($ContTagSuccess as $Nodo){
                $valor_del_nodo_Success = $Nodo->nodeValue; 
            }
            
                
        curl_close($process);            
                
    // "Account Created successfully"             = Cuenta Creada con éxito       = true
    // "Account Already exists"                   = La cuenta ya existe           = true
    // "RFC Invalido"                             = RFC Invalido                  = false
    // "There was an error registering the User"  = Error al registrar al usuario = false
                
    echo $valor_del_nodo_message;
    
    echo "<br>";
    
    echo $valor_del_nodo_Success;
    
    

        
        
