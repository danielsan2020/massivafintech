/* global base_url */

angular.module('appPassword', [
    '$uhttp',
    'jcs-autoValidate'
]).directive('confirmPassword', function (defaultErrorMessageResolver) {
    defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
        errorMessages['confirmPassword'] = 'Las contraseñas no coinciden';
    });
    return {
        restrict: 'A',
        require: 'ngModel',
        scope: {
            confirmPassword: '=confirmPassword'
        },
        link: function (scope, element, attributes, ngModel) {
            ngModel.$validators.confirmPassword = function (modelValue) {
                return modelValue === scope.confirmPassword;
            };
            scope.$watch('confirmPassword', function () {
                ngModel.$validate();
            });
        }
    };
});

angular.module('appPassword').controller('createPasswordCtrl', [
    '$scope',
    '$timeout',
    'PasswordService',
    function ($scope, $timeout, PasswordService) {
        $scope.header = "Crear contraseña";
        $scope.show_link = false;
        $scope.submit = function () {
            var password = $scope.form_password.newpassword;
            var data_send = $scope.form_password;
            data_send.password = hex_md5(password);
            PasswordService.createUsuario(data_send).then(function () {
                $scope.show_link = true;
                $timeout(function () {
                    window.location.assign(base_url);
                }, 2000);
            });
        };
    }
]);
angular.module('appPassword').controller('updatePasswordCtrl', [
    '$scope',
    '$timeout',
    'PasswordService',
    function ($scope, $timeout, PasswordService) {
        $scope.header = "Reestablecer contraseña";
        $scope.form_password = [];
        $scope.show_link = false;
        $scope.submit = function () {
            var password = $scope.form_password.newpassword;
            var repassword = $scope.form_password.renewpass;
            if (password === repassword) {
                var data_send = $scope.form_password;
                data_send.password = hex_md5(password);
                PasswordService.updatePassword(data_send).then(function () {
                    $scope.error = false;
                    $scope.show_link = true;
                    $timeout(function () {
                        window.location.assign(base_url);
                    }, 2000);
                });
            } else {
                $scope.error = true;
            }
        };
    }
]);
//configuracion de las notificaciones
angular.module('app').config([
    '$uhttpProvider',
    function ($uhttpProvider) {
        $uhttpProvider.setNotifications({
            status_callbacks: {
                401: function () {
                    $.notify('<i class="fa fa-exclamation-triangle fa-3x"></i> Para acceder a esta página debes autenticarte', {
                        title: 'Atenci&oacute;n',
                        autoHideDelay: 5000,
                        position: 'top center',
                        autoHide: true,
                        className: 'warn'
                    });
                    setTimeout(function () {
                        location.href = home_url;
                    }, 3000);
                    return false;
                },
                403: function () {
                    $.notify('<i class="fa fa-exclamation-triangle fa-3x"></i> No tienes permisos para acceder a esta página', {
                        title: 'Atenci&oacute;n',
                        autoHideDelay: 5000,
                        position: 'top center',
                        autoHide: true,
                        className: 'warn'
                    });
                    setTimeout(function () {
                        location.href = home_url;
                    }, 3000);
                    return false;
                },
                404: function (response) {
                    var message = (typeof (response.data.message) !== 'undefined') ? response.data.message : 'Contenido no disponible';
                    $.notify(message, {
                        autoHideDelay: 5000,
                        position: 'top center',
                        autoHide: true,
                        className: 'warn'
                    });
                    return false;
                }
            },
            success: function (message, time, title) {
                $.notify(message, {
                    title: title,
                    autoHideDelay: time,
                    className: 'warn'
                });
            },
            warning: function (message, time, title) {
                $.notify(message, {
                    title: title,
                    autoHideDelay: time,
                    className: 'warn'
                });
            },
            error: function (message, time, title) {
                $.notify(message, {
                    title: title,
                    autoHideDelay: time,
                    className: 'warn'
                });
            }
        });
    }
]);