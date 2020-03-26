<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Crear Password</title>
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/union-utils.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>css/massiva.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript">
            var base_url = '<?php echo $base_url; ?>';
            var api_url = '<?php echo $api_url; ?>';
        </script>
    </head>
    <body ng-app="appPassword">
        <div class="wrapper">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-sm-10 col-md-6 col-lg-4">
                        <div class="text-center pt-4 pb-4">
                            <img src="<?php echo base_url(); ?>images/logo-light.png"/>
                        </div>
                        <div class="card" ng-controller="createPasswordCtrl">
                            <h3 class="text-center pt-5">{{header}}</h3>
                            <div class="card-block p-3">
                                <form class="form" ng-show="!show_link" ng-submit="submit()" novalidate autocomplete="off" ng-init="form_password = {'usuario_id': <?php echo $usuario_id; ?>}">
                                    <div class="form-group">
                                        <div class="col-12 pt-3 pb-2">
                                            <label for="pass" class="form-control-label">Inserta una contrase&ntilde;a</label>
                                        </div>
                                        <div class="input-group">
                                            <input ng-attr-type="{{ show_password ? 'text' : 'password' }}" name="new_pass" class="form-control" ng-model="form_password.newpassword" ng-minlength="6" required/>
                                            <div class="input-group-append">
                                                <span class="input-group-text" ng-click="show_password = !show_password"><i ng-class="show_password ? 'fa fa-eye-slash' : 'fa fa-eye'"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-12 pt-3 pb-2">
                                            <label for="repass" class="form-control-label">Confirmar contrase&ntilde;a</label>
                                        </div>
                                        <div class="input-group">
                                            <input ng-attr-type="{{ show_repassword ? 'text' : 'password' }}" name="repass" class="form-control" confirm-password ="form_password.newpassword" ng-model="form_password.renewpass" ng-minlength="6" required/>
                                            <div class="input-group-append">
                                                <span class="input-group-text" ng-click="show_repassword = !show_repassword"><i ng-class="show_repassword ? 'fa fa-eye-slash' : 'fa fa-eye'"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pt-4">
                                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 20px;">Guardar</button>
                                    </div>
                                </form>
                                <div class="text-center" ng-show="show_link">
                                    En unos momentos te direccionaremos para que puedas acceder a la plataforma,<br/> o haz <a href="<?php echo base_url(); ?>">clic aqui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>js/vendors/notify.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/vendors/angular.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/vendors/md5-min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/modules/jcs-auto-validate.min.js"  type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/modules/angular-uhttp.min.js"  type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/controllers/password-controllers.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/services/password-service.js" type="text/javascript"></script>
    </body>
</html>