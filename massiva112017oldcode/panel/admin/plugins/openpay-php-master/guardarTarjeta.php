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
        <form action="" method="POST" id="card-form">
            <fieldset>
                <legend>Datos de la tarjeta</legend>
            <p>
                <label>Nombre</label>
                <input type="text" size="20" autocomplete="off" name="holder_name" />
            </p>
            <p>
                <label>N&uacute;mero</label>
                <input type="text" size="20" autocomplete="off" name="card_number" />
            </p>
            <p>
                <label>CVV2</label>
                <input type="text" size="4" autocomplete="off" name="cvv2" />
            </p>
            <p>
                <label>Fecha de expiraci&oacute;n (MM/YY)</label>
                <input type="text" size="2" name="expiration_month" /> /
                <input type="text" size="2" name="expiration_year" />
            </p>
            </fieldset>
            <input type="submit" id="save-button" value="GuardarTarjeta" name="pagar"/>
        </form>
    </div>
</body>
</html>

<?php
require(dirname(__FILE__) . '/openpay/Openpay.php');

Openpay::setProductionMode(false);
$openpay = Openpay::getInstance('mfwfupejgk3jzhblyipn', 'sk_251bd2a99e684a56b7ac4f8abddbc871');

	session_start();
	$clienteId = $_SESSION['idCustomer'];
	echo $clienteId;
	$customer = $openpay->customers->get($clienteId);

	if(isset($_POST["holder_name"], $_POST["card_number"], $_POST["cvv2"], $_POST["expiration_month"], $_POST["expiration_year"])){

		$usuarioTarjeta = $_POST["holder_name"];
		$numeroTarjeta = $_POST["card_number"];
		$cv2 = $_POST["cvv2"];
		$mesExpiracion = $_POST["expiration_month"];
		$anioExpiracion = $_POST["expiration_year"];

		echo "dentrto del if inserción";
		$cardDataRequest = array(
    		'holder_name' => $usuarioTarjeta,
    		'card_number' => $numeroTarjeta,
    		'cvv2' => $cv2,
    		'expiration_month' => $mesExpiracion,
    		'expiration_year' => $anioExpiracion);
            
    
    $card = $customer->cards->add($cardDataRequest);


    $_SESSION["idCard"] = $card->id;

    header('Location: seleccionPaquete.php');
}

?>