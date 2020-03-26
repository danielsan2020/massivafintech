/* global angular */

angular.module('app').controller("PersonasClientesListCtrl", [
    '$scope',
    'PersonasClientesService',
    function ($scope, PersonasClientesService) {
        $scope.personas_clientes_contacto = [];
        PersonasClientesService.getList().then(function (data) {
            $scope.personas_clientes_contacto = data.personas_clientes_contacto;
            $scope.total_personas_clientes_contacto = data.total_personas_clientes_contacto;
        });
        $scope.inactivate = function (id) {
            PersonasClientesService.inactivate(id).then(function () {
                PersonasClientesService.getList().then(function (data) {
                    $scope.personas_clientes_contacto = data.personas_clientes_contacto;
                    $scope.total_personas_clientes_contacto = data.total_personas_clientes_contacto;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Personas_clientes_contacto   
 */
angular.module("app").controller('PersonasClientesListInactiveCtrl', [
    '$scope',
    'PersonasClientesService',
    function ($scope, PersonasClientesService) {
        PersonasClientesService.getListInactive().then(function (data) {
            $scope.personas_clientes_contacto = data.personas_clientes_contacto;
            $scope.total_personas_clientes_contacto = data.total_personas_clientes_contacto;
        });
        $scope.reactivate = function (id) {
            PersonasClientesService.reactivate(id).then(function () {
                PersonasClientesService.getListInactive().then(function (data) {
                    $scope.personas_clientes_contacto = data.personas_clientes_contacto;
                    $scope.total_personas_clientes_contacto = data.total_personas_clientes_contacto;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Personas_clientes_contacto         
 */
angular.module('app').controller("PersonasClientesCreateCtrl", [
    '$scope',
    '$state',
    'PersonasClientesService',
    function ($scope, $state, PersonasClientesService) {
        $scope.form_personas_clientes_contacto = {nombre: '', apellido_paterno: '', apellido_materno: '', departamento: '', puesto: '', telefono_1: '', telefono_2: '', celular_1: '', celular_2: '', email_1: '', email_2: ''};
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_personas_clientes_contacto);
            PersonasClientesService.createPersonas_clientes_contacto(data_send).then(function () {
                $state.go('main.personas_clientes_contacto_list');
            });
        };
    }
]);
/*
 Controlador modificacion de Personas_clientes_contacto         
 */
angular.module('app').controller('PersonasClientesUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'PersonasClientesService',
    function ($scope, $state, $stateParams, PersonasClientesService) {
        var id = $stateParams.id;
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_personas_clientes_contacto);
            PersonasClientesService.update(id, data_send).then(function () {
                $state.go('main.personas_clientes_contacto_list');
            });
        };
    }
]);