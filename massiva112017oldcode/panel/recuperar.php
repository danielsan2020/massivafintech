<?php 
//obtengo el valor de accion
$accion = $_GET['accion'];
if ($accion == 3){ 
    $anuncio = "<div class='container-login100-form-btn m-t-32'>
        <div class='alert alert-danger text-center' role='alert'>Tus datos son incorrectos, prueba de nuevo por favor.</div>
    </div>";
}
elseif ($accion == 2) {
    $anuncio = "<div class='container-login100-form-btn m-t-32'>
        <div class='alert alert-danger text-center' role='alert'>Existe un error. Prueba de nuevo por favor.</div>
    </div>";
}
elseif ($accion == 1) {
    $anuncio = "<div class='container-login100-form-btn m-t-32'>
        <div class='alert alert-success text-center' role='alert'>Se ha enviado a tu correo los datos de acceso.</div>
    </div>";
}
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Massiva | Recuperar contraseña</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="../images/massiva.ico" />
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41"><img src="images/logo-dark.png"></span>
                <form class="login100-form validate-form p-b-33 p-t-5" action="admin/correos/recuperar.php" method="post">
                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
                        <input class="input100" type="text" name="correo" placeholder="Ingresa tu correo" required>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>
                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn" type="submit">Recuperar contraseña </button>
                    </div>
                    <div class="container-login100-form-btn m-t-32">
                        <p><a href="index.php" style="cursor: pointer">Ingresar</a></p>
                    </div>
                    <?php echo $anuncio;?>
                </form>
            </div>
        </div>
    </div>
    <div id="dropDownSelect1"></div>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/animsition/js/animsition.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<script src="vendor/countdowntime/countdowntime.js"></script>
<script src="js/main.js"></script>
</body>
</html>