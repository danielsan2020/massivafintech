/*
 Controlador lista de preregistros con usuario asignado         
 */
/* global Noty, angular */

angular.module('app').controller('ClientesPreregistroConUsuarioListCtrl', [
    '$scope',
    'PreregistrosService',
    function ($scope, PreregistrosService) {
        $scope.header = "Clientes con usuario, sin trámite concluido";
        $scope.preregistro_con_usuario = [];
        PreregistrosService.getListPreregistroConUsuario().then(function (data) {
            $scope.preregistro_con_usuario = data.preregistro_con_usuario;
            $scope.total_preregistro_con_usuario = data.total_preregistro_con_usuario;
            for (var i = 0; i < $scope.preregistro_con_usuario.length; i++) {
                var day_fecha_registro = moment($scope.preregistro_con_usuario[i].fecha_registro);
                $scope.preregistro_con_usuario[i].fecha_registro = day_fecha_registro.format("D/MMM/YYYY H:mm");
//                if ($scope.preregistro_con_usuario[i].ultima.ultimo_contacto !== null) {
//                    var day_ultimo_contacto = moment($scope.preregistro_con_usuario[i].ultima.ultimo_contacto);
//                    $scope.preregistro_con_usuario[i].ultima.ultimo_contacto = day_ultimo_contacto.format("D/MMM/YYYY H:mm");
//                } else {
//                    $scope.preregistro_con_usuario[i].ultima.ultimo_contacto = "Sin contactar";
//                }
                if ($scope.preregistro_con_usuario[i].ultimo_contacto !== null) {
                    var day_ultimo_contacto = moment($scope.preregistro_con_usuario[i].ultimo_contacto);
                    $scope.preregistro_con_usuario[i].ultimo_contacto = day_ultimo_contacto.format("D/MMM/YYYY H:mm");
                } else {
                    $scope.preregistro_con_usuario[i].ultimo_contacto = "Sin contactar";
                }
            }
        });
    }
]);
/*
 *  Controlador lista de preregistros sin usuario asignado  
 */
angular.module('app').controller('ClientesPreregistroSinUsuarioListCtrl', [
    '$scope',
    'PreregistrosService',
    function ($scope, PreregistrosService) {
        $scope.header = "Clientes sin Usuario";
        $scope.preregistro_sin_usuario = [];
        PreregistrosService.getListPreregistroSinUsuario().then(function (data) {
            $scope.preregistro_sin_usuario = data.preregistro_sin_usuario;
            $scope.submit = function (id) {
                PreregistrosService.enviarCorreoPassword(id).then(function () {
                });
            };
        });
    }
]);
/*
 *  Controlador envio de correo electrónicos a usuarios sin registro concluido  
 */

angular.module('app').controller('ClientesPreregistroEnviarEmailCtrl', [
    '$scope',
    '$stateParams',
    '$rootScope',
    'PreregistrosService',
    'UsuariosService',
    function ($scope, $stateParams, $rootScope, PreregistrosService, UsuariosService) {
        var usuario_id = $stateParams.id;
        var administrador_id = $rootScope.usuario_acceso.id;
        $scope.header = "Enviar correo electrónico a usuario";
        UsuariosService.getUsuarioStatus2ById(usuario_id).then(function (data) {
            $scope.form_email = data.usuarios;
        });
        $scope.submit = function () {
            var data_send = $scope.form_email;
            data_send.administrador_id = administrador_id;
            PreregistrosService.enviarCorreo(usuario_id, administrador_id, data_send).then(function () {
            });
        };
    }
]);
