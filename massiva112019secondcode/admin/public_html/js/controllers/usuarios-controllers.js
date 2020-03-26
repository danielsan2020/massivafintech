
/* global Noty, angular */
/*
 Controlador Lista de Usuarios     
 */
angular.module('app').controller("UsuariosListCtrl", [
    '$scope',
    'UsuariosService',
    function ($scope, UsuariosService) {
        $scope.usuarios = [];
        UsuariosService.getList().then(function (data) {
            $scope.usuarios = data.usuarios;
            $scope.total_usuarios = data.total_usuarios;
        });
        $scope.inactivate = function (id) {
            UsuariosService.inactivate(id).then(function () {
                UsuariosService.getList().then(function (data) {
                    $scope.usuarios = data.usuarios;
                    $scope.total_usuarios = data.total_usuarios;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Usuarios   
 */
angular.module("app").controller('UsuariosListInactiveCtrl', [
    '$scope',
    'UsuariosService',
    function ($scope, UsuariosService) {
        $scope.usuarios = [];
        UsuariosService.getListInactive().then(function (data) {
            $scope.usuarios = data.usuarios;
            $scope.total_usuarios = data.total_usuarios;
        });
        $scope.reactivate = function (id) {
            UsuariosService.reactivate(id).then(function () {
                UsuariosService.getListInactive().then(function (data) {
                    $scope.usuarios = data.usuarios;
                    $scope.total_usuarios = data.total_usuarios;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Usuarios         
 */
angular.module('app').controller("UsuariosCreateCtrl", [
    '$scope',
    '$state',
    'UsuariosService',
    'defaultErrorMessageResolver',
    function ($scope, $state, UsuariosService, defaultErrorMessageResolver) {
        $scope.heading = "Crear ";
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
            errorMessages['letras'] = 'El campo s&oacute;lo acepta letras.';
        });
        $scope.tipos = [
            {id: '1', tipo: 'Administrador'},
            {id: '4', tipo: 'Contador'}
        ];
        $scope.form_usuarios = {username: '', tipo: '', email: '', nombre: '', apellido_paterno: '', apellido_materno: ''};
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_usuarios);
            UsuariosService.create(data_send).then(function () {
                $state.go('main.usuarios_list');
            });
        };
    }
]);
/*
 Controlador modificacion de Usuarios         
 */
angular.module('app').controller('UsuariosUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'UsuariosService',
    function ($scope, $state, $stateParams, UsuariosService) {
        var id = $stateParams.id;
        $scope.heading = "Editar ";
        UsuariosService.getById(id).then(function (data) {
            $scope.form_usuarios = data.usuarios;
            $scope.tipos = [
                {id: '1', tipo: 'Administrador'},
                {id: '4', tipo: 'Contador'}
            ];
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_usuarios);
            UsuariosService.update(id, data_send).then(function () {
                $state.go('main.usuarios_list');
            });
        };
    }
]);


