/* global panel_url, registro_url, plataforma_url, base_url, session_domain */

//Controlador para el Login
angular.module("app").controller('LoginCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    'AuthService',
    function ($scope, $state, $rootScope, AuthService) {
        $scope.form_login = {
            user: '',
            pass: '',
            captcha: ''
        };
//        $scope.captcha_url = base_url + "captcha/";
        $scope.visible = false;
//        $scope.cambia_captcha = function () {
//            $scope.captcha_url = base_url + "captcha/?r=" + Math.floor((Math.random() * 1000000) + 1);
//        };
        setTimeout(function () {
            if ($rootScope.usuario_acceso !== undefined && $rootScope.usuario_acceso) {
                if ($rootScope.usuario_acceso.tipo !== null) {
                    switch (parseInt($rootScope.usuario_acceso.tipo)) {
                        case 1://administrador
                            location.href = admin_url;
                            break;
                        case 2://clientes
                            if ($rootScope.usuario_acceso.status === "1") {
                                location.href = plataforma_url;
                            } else {
                                if ($rootScope.usuario_acceso.persona_id === null) {
                                    location.href = registro_url;
                                } else {
                                    location.href = registro_url + "#!/pre-registro/datos-fiscales";
                                }
                            }
                            break;
                        case 3://jefe contador
                            location.href = apanel_url;
                            break;
                        case 4://contador
                            location.href = bpanel_url;
                            break;
                    }
                }
            }
        }, 100);
        $scope.login = function () {
            var data = angular.copy($scope.form_login);
            data.pass = hex_md5(angular.copy($scope.form_login.pass));
            AuthService.login(data).then(function (data) {
                $rootScope.usuario_acceso = data.usuario;

//                if (data.b_cambio_contrasenia === '1') {
//                    $state.go('password_change');
//                } else {
//                    $rootScope.usuario_acceso.type = parseInt($rootScope.usuario_acceso.type);
//                    if ($rootScope.usuario_acceso.tipo !== null) {
                switch (parseInt($rootScope.usuario_acceso.tipo)) {
                    case 1://admin
                        location.href = admin_url;
                        break;
                    case 2://clientes
                        if ($rootScope.usuario_acceso.status === "1") {
                            location.href = plataforma_url;
                        } else {
                            if ($rootScope.usuario_acceso.persona_id === null) {
                                location.href = registro_url;
                            } else {
                                location.href = registro_url + "#!/pre-registro/datos-fiscales";
                            }
                        }
                        break;
                    case 3://jefe contador
                        location.href = apanel_url;
                        break;
                    case 4://contador
                        location.href = bpanel_url;
                        break;
                }

            }).catch(function () {
                $scope.intentos += 1;
//                $scope.cambia_captcha();
            });
        };
    }
]);
angular.module("app").controller('LogoutCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    'AuthService',
    function ($scope, $state, $rootScope, AuthService) {
        $scope.logout = function () {
            AuthService.logout().then(function () {
                delete ($rootScope.usuario_acceso);
                $scope.intentos = 0;
                $state.go('login');
            });
        };
    }
]);
//Controlador para Cerrar session
//angular.module("app").controller('PasswordChangeCtrl', [
//    '$scope',
//    'AuthService',
//    function ($scope, AuthService) {
//        $scope.submit = function () {
//            if ($scope.form.new_pass_confirm === $scope.form.new_pass) {
//                AuthService.passwordChange($scope.form).then(function () {
//                    location.href = cms_url;
//                });
//            } else {
//                alert("Las contraseñas son diferentes");
//            }
//        };
//    }
//]);
angular.module("app").controller("ResetCtrl", [
    '$scope',
    '$state',
    'AuthService',
    function ($scope, $state, AuthService) {
        $scope.header = "Solicitud para recuperar contraseña";
        $scope.form = {};
        $scope.show_link = false;
        $scope.submit = function () {
            var data_send = $scope.form;
            AuthService.passwordChange(data_send).then(function () {
                $scope.show_link = true;
                $timeout(function () {
                    window.location.assign(base_url);
                }, 2000);
            });
        };
        $scope.cancelar = function () {
            window.location.assign('');
        };
    }
]);