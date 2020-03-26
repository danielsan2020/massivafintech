<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>MASSIVA 2019</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/union-utils.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/massiva.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var api_url = '<?php echo $api_url; ?>';
            var admin_url = '<?php echo $admin_url; ?>';
            var plataforma_url = '<?php echo $plataforma_url; ?>';
            var apanel_url = '<?php echo $apanel_url; ?>';
            var bpanel_url = '<?php echo $bpanel_url; ?>';
            var registro_url = '<?php echo $registro_url; ?>';
        </script>
    </head>
    <body ng-app="app">
        <div class="wrapper" ui-view></div>
        <div ng-init="$root.usuario_acceso = <?php echo $usuario; ?>;"></div>
        <script src="<?php echo base_url(); ?>js/vendors/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vendors/angular.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vendors/md5-min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vendors/notify.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-uhttp.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/jcs-auto-validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/ocLazyLoad.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/app.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/routes.js"></script>
    </body>
</html>
