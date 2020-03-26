
/* global Noty, angular */
/*
 Controlador Lista de Regimenes_fiscales     
 */
angular.module('app').controller("RegimenesFiscalesListCtrl", [
    '$scope',
    'RegimenesFiscalesService',
    function ($scope, RegimenesFiscalesService) {
        $scope.regimenes_fiscales = [];
        var tipos = [
            {id: "1", tipo: 'Persona física'},
            {id: "2", tipo: 'Persona moral'}
        ];
        RegimenesFiscalesService.getList().then(function (data) {
            $scope.regimenes_fiscales = data.regimenes_fiscales;
            $scope.total_regimenes_fiscales = data.total_regimenes_fiscales;
            for (var i = 0; i < $scope.regimenes_fiscales.length; i++) {
                $scope.regimenes_fiscales[i].texto_tipo = getTextOfTipo($scope.regimenes_fiscales[i].tipo);
            }
        });
        function getTextOfTipo(tipo_id) {
            for (var i = 0; i < tipos.length; i++) {
                if (tipo_id === tipos[i].id) {
                    return tipos[i].tipo;
                }
            }
        }
        $scope.inactivate = function (id) {
            RegimenesFiscalesService.inactivate(id).then(function () {
                RegimenesFiscalesService.getList().then(function (data) {
                    $scope.regimenes_fiscales = data.regimenes_fiscales;
                    $scope.total_regimenes_fiscales = data.total_regimenes_fiscales;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Regimenes_fiscales   
 */
angular.module("app").controller('RegimenesFiscalesListInactiveCtrl', [
    '$scope',
    'RegimenesFiscalesService',
    function ($scope, RegimenesFiscalesService) {
        RegimenesFiscalesService.getListInactive().then(function (data) {
            $scope.regimenes_fiscales = data.regimenes_fiscales;
            $scope.total_regimenes_fiscales = data.total_regimenes_fiscales;
        });
        $scope.reactivate = function (id) {
            RegimenesFiscalesService.reactivate(id).then(function () {
                RegimenesFiscalesService.getListInactive().then(function (data) {
                    $scope.regimenes_fiscales = data.regimenes_fiscales;
                    $scope.total_regimenes_fiscales = data.total_regimenes_fiscales;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Regimenes_fiscales         
 */
angular.module('app').controller("RegimenesFiscalesCreateCtrl", [
    '$scope',
    '$state',
    'RegimenesFiscalesService',
    function ($scope, $state, RegimenesFiscalesService) {
        $scope.heading = 'Agregar';
        $scope.tipos = [
            {id: "1", tipo: 'Persona física'},
            {id: "2", tipo: 'Persona moral'}
        ];
        $scope.form_regimenes_fiscales = {regimen: '', tipo: ''};
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_regimenes_fiscales);
            RegimenesFiscalesService.create(data_send).then(function () {
                $state.go('main.regimenes_fiscales_list');
            });
        };
    }
]);
/*
 Controlador modificacion de Regimenes_fiscales         
 */
angular.module('app').controller('RegimenesFiscalesUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'RegimenesFiscalesService',
    function ($scope, $state, $stateParams, RegimenesFiscalesService) {
        $scope.heading = 'Editar';
        var id = $stateParams.id;
        $scope.tipos = [
            {id: "1", tipo: 'Persona física'},
            {id: "2", tipo: 'Persona moral'}
        ];
        RegimenesFiscalesService.getById(id).then(function (data) {
            $scope.form_regimenes_fiscales = data.regimen_fiscal;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_regimenes_fiscales);
            RegimenesFiscalesService.update(id, data_send).then(function () {
                $state.go('main.regimenes_fiscales_list');
            });
        };
    }
]);

