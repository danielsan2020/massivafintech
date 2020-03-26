<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>MASSIVA 2019</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/angular-datatables.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/angular-tooltips.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/quill.snow.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/quill.bubble.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/select.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/select2.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/massiva.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>css/union-utils.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var api_url = '<?php echo $this->config->item('api_url'); ?>';
            var home_url = '<?php echo $this->config->item('home_url'); ?>';
        </script>
    </head>
    <body ng-app="app">
        <div class="wrapper" ui-view></div>
        <div ng-init="$root.usuario_acceso = <?php echo $usuario; ?>;"></div>
        <script src="<?php echo base_url(); ?>js/vendors/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/vendors/jquery.dataTables.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vendors/angular.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vendors/md5-min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/vendors/notify.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-datatables.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-tooltips.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-ui-router.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-uhttp.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-animate.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/jcs-auto-validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/ocLazyLoad.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/angular-sanitize.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/select.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/quill.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/ng-quill.js" ></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/ng-file-upload.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/modules/ng-file-upload-shim.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/app.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/routes.js"></script>
    </body>
</html>
