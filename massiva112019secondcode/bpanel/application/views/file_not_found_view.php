<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Archivo no econtrado</title>
        <link href="<?php echo $base_url; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $base_url; ?>css/massiva.css" rel="stylesheet" type="text/css"/>
        <script language="JavaScript" type="text/javascript">
            var pagina = '<?php echo $base_url; ?>#!/descargas';
            function redireccionar() {
                location.href = pagina;
            }
            setTimeout("redireccionar()", 5000);
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <div class="text-center pt-4 pb-4">
                            <img src="<?php echo $base_url; ?>images/logo-dark.png"/>
                        </div>
                        <div class="card text-center">
                            <h4 class="pt-5"><?php echo $mensaje; ?></h4>
                            <div class="card-block p-3">
                                Espera para ser redireccionado o haz clic <a href="<?php echo $base_url; ?>#!/descargas">aqu&iacute;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
