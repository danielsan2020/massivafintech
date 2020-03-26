
/* global Noty, angular */
/*
 Controlador Lista de Paquetes_tickets     
 */
angular.module('app').controller("PaquetesTicketsListCtrl", [
    '$scope',
    'PaquetesTicketsService',
    function ($scope, PaquetesTicketsService) {
        $scope.paquetes_tickets = [];
        PaquetesTicketsService.getList().then(function (data) {
            $scope.paquetes_tickets = data.paquetes_tickets;
            $scope.total_paquetes_tickets = data.total_paquetes_tickets;
        });
        $scope.inactivate = function (id) {
            PaquetesTicketsService.inactivate(id).then(function () {
                PaquetesTicketsService.getList().then(function (data) {
                    $scope.paquetes_tickets = data.paquetes_tickets;
                    $scope.total_paquetes_tickets = data.total_paquetes_tickets;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Paquetes_tickets   
 */
angular.module("app").controller('PaquetesTicketsListInactiveCtrl', [
    '$scope',
    'PaquetesTicketsService',
    function ($scope, PaquetesTicketsService) {
        PaquetesTicketsService.getListInactive().then(function (data) {
            $scope.paquetes_tickets = data.paquetes_tickets;
            $scope.total_paquetes_tickets = data.total_paquetes_tickets;
        });
        $scope.reactivate = function (id) {
            PaquetesTicketsService.reactivate(id).then(function () {
                PaquetesTicketsService.getListInactive().then(function (data) {
                    $scope.paquetes_tickets = data.paquetes_tickets;
                    $scope.total_paquetes_tickets = data.total_paquetes_tickets;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Paquetes_tickets         
 */
angular.module('app').controller("PaquetesTicketsCreateCtrl", [
    '$scope',
    '$state',
    'PaquetesTicketsService',
    function ($scope, $state, PaquetesTicketsService) {
        $scope.heading = 'Crear ';
        $scope.form_paquetes_tickets = {cantidad: '0', precio: '0'};
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_paquetes_tickets);
            PaquetesTicketsService.create(data_send).then(function () {
                $state.go('main.paquetes_tickets_list');
            });
        };
    }
]);
/*
 Controlador modificacion de Paquetes_tickets         
 */
angular.module('app').controller('PaquetesTicketsUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'PaquetesTicketsService',
    function ($scope, $state, $stateParams, PaquetesTicketsService) {
        $scope.heading = 'Editar ';
        var id = $stateParams.id;
        PaquetesTicketsService.getById(id).then(function (data) {
            $scope.form_paquetes_tickets = data.paquetes_tickets;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_paquetes_tickets);
            PaquetesTicketsService.update(id, data_send).then(function () {
                $state.go('main.paquetes_tickets_list');
            });
        };
    }
]);

