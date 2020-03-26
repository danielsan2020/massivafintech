<?php 
    @session_start();	
    include 'modelo/consultaGeneraFac.php';
    include 'plugins/nosoap/.php';
    $consultaFac = new consultaFac();
    $id_usuario = $_SESSION['id_usuario'];

    /* obtenemos el id del cliente que pide factura */
    $idfactura = $_GET['idfactura'];

    /* obtenemos los valores de la factura */

    /* obtenemos los datos de los archivos y la contraseña */
    
    /* creamos el arcxhivo pen y lo guardamos */
    shell_exec('openssl pkcs8 -inform DER -in '.$nombreKey.' -out '.$nombreKey.'.pem -passin pass:'.$password.' 2>&1');

    /* obtenemos el sello */

    /* creamos los xml */

    /* realizamos la conexion a fel */

    /* guardamos el xml */

    /* creamos el pdf y lo guardamos */

    /* enviamos por correo las cotizaciones */
    $xml_cadena2 = '<?xml version="1.0" encoding="utf-8" ?>
<cfdi:Comprobante xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Folio="FOL123456" Fecha="2017-05-04T09:36:11" Sello="N9sSkJsBYNYYobJpJ00cXMkA9LL6dvpNFaYxLj6iINhyzOBr5mRuduH3ZEuJku+si3+vNHOBicByd68a4QO8VtgC+yV5LEYQBO0zMqs/tRg6HrviG/oMaEccJQaCi1CIPFMKSayJdkUqJOCxJXpSGwt6JUdG/JvGXIGS2sRNZOkKh2oIhTgfXaKU4kj1swbXifDgS6wFftzbJ4a8hv5MmpVz3BXl7y1d+3zCUTDiw+t2M2Cx2wUFJd19vCc0fyN+1mJ6QQKjfmfREyz/I7pUJBbS6/ARfQZHzk9Kn0sNtk4/mdOzyZ6PYh0VLz9W4WEh86zV5v5vAI70p3sBlbhh+A==" FormaPago="01" NoCertificado="20001000000300022824" Certificado="MIIDiTCCAnGgAwIBAgIUMjAwMDEwMDAwMDAzMDAwMjI4MjQwDQYJKoZIhvcNAQEFBQAwSzEVMBMGA1UEAwwMQS5DLiBQcnVlYmFzMRAwDgYDVQQKDAdQcnVlYmFzMQswCQYDVQQGEwJNWDETMBEGA1UEBwwKQ3VhdWh0ZW1vYzAeFw0xNzA0MjgxODM0NDdaFw0yMjEwMTkxODM0NDdaMIGVMRowGAYDVQQDDBFDb21wdWhpcGVybWVnYXJlZDEaMBgGA1UEKQwRQ29tcHVoaXBlcm1lZ2FyZWQxGjAYBgNVBAoMEUNvbXB1aGlwZXJtZWdhcmVkMSMwIQYDVQQtDBpURVMwMzAyMDEwMDEgLyBURVMxMDMxN0E0NjEaMBgGA1UECwwRQ29tcHVoaXBlcm1lZ2FyZWQwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCrF7Z1mytCR6XrnVnseTPdELc8IhR6SF2iYPvsW1QjGjkGZ8CVgBu24ParI95NoDEq6AuGqhJlK+uYAzRDIq8OckZmXeuT47kfS5mHKlw1GfLgPMN1fPgYmm0l7sh96eNvipTRMv2rsQ8+myTVkmiQVev0P+NHPlY+cL8QIq7Sd+ZuPIKPHwcdKlUIJEeosM/nSnS+JBXKdcue23gC/UWXJr4wFNa54Gkt8lBR4xzDthrDrqmILLwBHS/kVhY01SxaPheIFixlDCSKiGseFpMYa1h7jfymL++ljMz6J9ELN4mmMH3hofW5zwBtJRLkkjpQTNfxiRD819yoPO4GzbRXAgMBAAGjGjAYMAkGA1UdEwQCMAAwCwYDVR0PBAQDAgbAMA0GCSqGSIb3DQEBBQUAA4IBAQAj9NJAcBxKaP+QQu4wSev8ia+bYgpMVJr5iblNELiZxKk7W16x01i2goPqvEB0pmcjQb6desfWj24OP3tCbsNiin3+49MK+Qb2is1toyYUdwp0V3PPy04IaYXYjrqCABOBvFrubfaC9cGhMG+aILZfvuTCJ3oZpevj8JH70OEM1bW+2DVHM1lumweMWEucVdzfdmihRUfMk1MjctxUDakYSE+WgvnB5Q1GzW2eOtEdOxsC/ni5OerxSxed7tcJNhxCiJg77HdiyBLL2O+TZJI52anwS6ej6s9PsGbTeXJ5GldZVnPaiIsTzqfosqzYWszrYCinCKNPhnEWjewTD6hc" CondicionesDePago="CondicionesDePago" SubTotal="1000.00" Descuento="100.00" Moneda="MXN" TipoCambio="1" Total="900.00" TipoDeComprobante="I" MetodoPago="PUE" LugarExpedicion="72000" xmlns:cfdi="http://www.sat.gob.mx/cfd/3">
    <cfdi:Emisor Rfc="TES030201001" Nombre="EMISOR" RegimenFiscal="601" />
    <cfdi:Receptor Rfc="TEST010203001" Nombre="JAMES BOND 007" UsoCFDI="G02" />
    <cfdi:Conceptos>
        <cfdi:Concepto ClaveUnidad="C81" ClaveProdServ="84111506" NoIdentificacion="1234567890" Cantidad="1" Unidad="ACT" Descripcion="Pago" ValorUnitario="1000" Importe="1000.00" Descuento="100.00">
            <cfdi:Impuestos>
                <cfdi:Traslados>
                    <cfdi:Traslado Base="1000" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="160.00" />
                </cfdi:Traslados>
                <cfdi:Retenciones>
                    <cfdi:Retencion Base="1000" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="160.00" />
                </cfdi:Retenciones>
            </cfdi:Impuestos>
        </cfdi:Concepto>
    </cfdi:Conceptos>
    <cfdi:Impuestos TotalImpuestosRetenidos="160.00" TotalImpuestosTrasladados="160.00">
        <cfdi:Retenciones>
            <cfdi:Retencion Impuesto="002" Importe="160.00" />
        </cfdi:Retenciones>
        <cfdi:Traslados>
            <cfdi:Traslado Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="160.00" />
        </cfdi:Traslados>
    </cfdi:Impuestos>
    <cfdi:Complemento>
        <tfd:TimbreFiscalDigital Version="1.1" UUID="C187F214-7E57-7E57-7E57-F42AC647A092" FechaTimbrado="2017-05-04T12:39:31" SelloCFD="N9sSkJsBYNYYobJpJ00cXMkA9LL6dvpNFaYxLj6iINhyzOBr5mRuduH3ZEuJku+si3+vNHOBicByd68a4QO8VtgC+yV5LEYQBO0zMqs/tRg6HrviG/oMaEccJQaCi1CIPFMKSayJdkUqJOCxJXpSGwt6JUdG/JvGXIGS2sRNZOkKh2oIhTgfXaKU4kj1swbXifDgS6wFftzbJ4a8hv5MmpVz3BXl7y1d+3zCUTDiw+t2M2Cx2wUFJd19vCc0fyN+1mJ6QQKjfmfREyz/I7pUJBbS6/ARfQZHzk9Kn0sNtk4/mdOzyZ6PYh0VLz9W4WEh86zV5v5vAI70p3sBlbhh+A==" NoCertificadoSAT="20001000000300022323" SelloSAT="CQTdu8S+i3GXJ3MVyUnRAS1Os6J0RBhjrkkbgbQ4xbmpTjI9wF7mJPw1CTh16cFYhVyHsDYRi+QHwz8aed3wk0EUH4eN0YtON9/abFTJ6xaZgHSyRcUy3bnXNXm18RdBiUE5q/C62aOTq6Bpo0ZdTDQsmfvnZI/KshlET25tgCLmS3q850efC7ti5bGd4NT+IgCggPxZ1ASruKqtp5zs0u2UZfYpj/WMetSZjQmBIDFjO6CgO+H+YNT63EE1AMIStWdBaf1g6n9ksjNM1hp1x5f8EWHAy9UMPcakI2kxc00WukC9focBBvGSvR4DqXWTxfdmC8S0t+bTz9EVX3bQ1g==" RfcProvCertif="PAC010101TE0" xmlns:tfd="http://www.sat.gob.mx/TimbreFiscalDigital" />
    </cfdi:Complemento>
</cfdi:Comprobante>';

/*****************Aplicamos la codificacion UTF-8************************/
$xml_cadena = utf8_decode ($xml_cadena2);

//Instanciamos el servicio
$client = new SoapClient('http://www.fel.mx/WSTimbrado33Test/WSCFDI33.svc?wsdl');

$param = array('usuario' => "DEMO550610D33",'password' => "8P&BwpfmxYW+",'cadenaXML' => $xml_cadena2,'referencia' => "0001");


// Call RemoteFunction () 
$error = 0; 
try { 
    $result= $client->__call("TimbrarCFDI", array($param)); 
} catch (SoapFault $fault) { 
    $error = 1; 
    print(" 
    alert('Sorry, blah returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring.". We will now take you back to our home page.'); 
    window.location = 'main.php'; 
    "); 
} 

//Validamos la respuesta
if ($client->fault) {
	echo 'Fallo';
	print_r($result);
} else {	// Chequea errores
	echo 'Error';
	print_r ($result);
}

?>

<!-- boton de regreso -->
<div class="row wrapper border-bottom white-bg page-heading"><div class="col-sm-12"><div class="title-action"><a href="index.php?secc=misclientes" class="btn btn-primary"> Regresar</a></div></div></div>
<hr>

<div class='container-fluid'>
  <!-- seccio para el primer paso  -->
  <div class="row wrapper-content border-bottom white-bg page-heading">
    <div class='col-md-12'>
      <div class="ibox">
        <div class="ibox-content text-center">
          <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-warning text-center">Recibimos tu solicitud de factura trabajamos en ella.</div>
                </div>
           </div>
          <!--div class="row">
                <div class="col-md-6">
                    <div class="input-group m-b">
                        <span class="input-group-addon"><input type="checkbox" id="datoscompletos" name="datoscompletos" value='1' <?php if($datoscompletos == 1){ echo "checked"; }?> ></span> 
                        <input class="form-control" type="text"   placeholder="Datos completos del cliente" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group m-b">
                        <span class="input-group-addon"><input type="checkbox"  id="andire" name="andire" value='1' <?php if($andire == 1){ echo "checked"; }?>></span>
                        <input class="form-control" type="text" placeholder="Añadir dirección de entrega" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class='btn btn-primary' style='width:100%'>Enviar por correo</button>
                </div>
            </div>
          </div-->
      </div>
    </div>
  </div>
</div>
	

<hr><br>


<!-- seccion de javascript -->
<script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script>
$(document).ready(function(){

  /* accion para obtener el precio */
  $("#precio").blur(function(){
    		var cantidad = $('#cantidad').val();
        var precio = $('#precio').val();
        //var descuento = $('#descuento').val();
        var uno = cantidad * precio;
        $('#total').val(uno);
        $('#Totalmues').val(uno);
        if(uno == 0){
          alert('Agrega una cantidad o el precio');
        }else{
          $("#btnOcho").removeAttr('disabled');
        }
	});
  
});
</script>


