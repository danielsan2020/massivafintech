<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
<!--Se asginan nuestro id de Negocio y LlavePublica-->
</head>
<body>
    <div class="bkng-tb-cntnt">
        <form action="" method="POST" id="customer-form">
            <fieldset>
                <legend>Datos del cliente</legend>
            <p>
                <label>Nombre</label>
                <input type="text" size="20" autocomplete="on" name="client_name"/>
            </p>
            <p>
                <label>Apellido</label>
                <input type="text" size="20" autocomplete="on" name="last_name"/>
            </p>
            <p>
                <label>Número telefonico</label>
                <input type="text" size="20" autocomplete="on" name="phone_number"/>
            </p>
            <p>
                <label>Correo Electr&oacute;nico</label>
                <input type="text" size="20" autocomplete="on" name="cliente_email"/>
            </p>
            </fieldset>
            <input type="submit" id="save-button" value="Guardar" name="guardar"/>
        </form>
    </div>
</body>
</html>

<?php
require(dirname(__FILE__) . '/openpay/Openpay.php');

Openpay::setProductionMode(false);
$openpay = Openpay::getInstance('mfwfupejgk3jzhblyipn', 'sk_251bd2a99e684a56b7ac4f8abddbc871');
//Se crea un cliente para un comercio
//Los datos de la tarjeta se utilizan para obtenr un token no se almacenan
if(isset($_POST["client_name"], $_POST["cliente_email"], $_POST["last_name"], $_POST["phone_number"])){

	$nombre = $_POST["client_name"];
	$apellido = $_POST["last_name"];
	$correo = $_POST["cliente_email"];
	$telefono = $_POST["phone_number"];

	$customerData = array(
        'name' => $nombre,
        'email' => $correo,
        'last_name' => $apellido,
        'phone_number' => $telefono,
        'requires_account' => false); //Esto indica que el cliente no manejara su propio saldo... será un cliente tipo cátalogo
            
    $customer = $openpay->customers->add($customerData);
    var_dump($customer->id); //id del cliente se debe de almacenar para posteriores funciones

    session_start();
    $_SESSION["idCustomer"] = $customer->id;

    header('Location: guardarTarjeta.php');
}


?>