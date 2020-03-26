<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
</head>
<body>
    <div class="bkng-tb-cntnt">
        <form action="" method="POST" id="plan-form">
			<input type="hidden" name="suscripcion_id" id="suscripcion_id"/>
            <input type="submit" id="arrendamiento-button" value="Arrendamiento $199.00" name="planArrendamiento"/>
			<input type="submit" id="save-button" value="Guardar" name="guardar"/>	
		</form>	
	</div>
</body>
<script src="js/seleccionPaquete.js"></script>
</html>
<?php
	require(dirname(__FILE__) . '/openpay/Openpay.php'); 
	Openpay::setProductionMode(false);
	$openpay = Openpay::getInstance('mfwfupejgk3jzhblyipn', 'sk_251bd2a99e684a56b7ac4f8abddbc871');
	
	session_start();
	$clienteId = $_SESSION['idCustomer'];
	echo "Id de Cliente: $clienteId";
	echo "<br>";
	$tarjetaId = $_SESSION['idCard'];
	echo "Id de Tarjeta $tarjetaId";

	if(isset($_POST["planArrendamiento"])){
		$planId = $_POST["planArrendamiento"];
		echo "<br>";
		echo "Plan: $planId";
		echo "<br>";
		echo date("Y-m-d");
	}
	if(empty($planId)){
		exit("Seleccione un plan");
	}

	$subscriptionDataRequest = array(
		"trial_end_date" => date("Y-m-d"),
		'plan_id' => $planId,
		'card_id' => $tarjetaId);

	$customer = $openpay->customers->get($clienteId);

	$subscription = $customer->subscriptions->add($subscriptionDataRequest);
?>