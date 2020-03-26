<div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center">
        <div class="col-sm-10 col-md-6 col-lg-4">
            <div class="text-center pt-4 pb-4">
                <img src="<?php echo base_url(); ?>images/logo-light.png"/>
            </div>
            <div class="card">
                <div class="card-block p-5">
                    <form name="LoginForm" class="form" ng-submit="login()" ng-init="intentos =<?php echo check_ini(); ?>" novalidate>
                        <div class="form-group row">
                            <div class="col-2 pt-3 pb-2">
                                <label for="user" class="form-control-label"><i class="far fa-user"></i></label>
                            </div>
                            <div class="col-10 pt-2 pb-2">
                                <input type="text" name="user" placeholder="Usuario" class="form-control border-0" ng-model="form_login.user" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="input-group">
                                <div class="col-2 pt-3 pb-2">
                                    <label for="pass" class="form-control-label"><i class="fas fa-lock"></i></label>
                                </div>
                                <div class="col-10 pt-2 pb-2">
                                    <div class="input-group">
                                        <input ng-attr-type="{{ show_password ? 'text' : 'password' }}" type="password" name="pass" placeholder="Contrase&ntilde;a" class="form-control border-0" ng-model="form_login.pass" required/>
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="color:#495057; background-color:#fff; border: 1px solid transparent;" ng-click="show_password = !show_password"><i ng-class="show_password ? 'fa fa-eye-slash' : 'fa fa-eye'"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-lg btn-primary pl-5 pr-5" style="border-radius: 20px;">Entrar</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <small><a ui-sref="reset_pass">Olvid&eacute; mi contrase&ntilde;a</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>