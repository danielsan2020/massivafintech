
/* global Noty, angular */
/*
 Controlador Lista de Activos     
 */
angular.module('app').controller("ActivosListCtrl", [
    '$scope',
    'ActivosService',
    function ($scope, ActivosService) {
        $scope.activos = [];
        ActivosService.getList().then(function (data) {
            $scope.activos = data.activos;
            $scope.total_activos = data.total_activos;
        });
        $scope.inactivate = function (id) {
            ActivosService.inactivate(id).then(function () {
                ActivosService.getList().then(function (data) {
                    $scope.activos = data.activos;
                    $scope.total_activos = data.total_activos;
                });
            });
        };
    }

]);
/*
 Controlador Lista inactiva de Activos   
 */
angular.module("app").controller('ActivosListInactiveCtrl', [
    '$scope',
    'ActivosService',
    function ($scope, ActivosService) {
        $scope.activos = [];
        ActivosService.getListInactive().then(function (data) {
            $scope.activos = data.activos;
            $scope.total_activos = data.total_activos;
        });
        $scope.reactivate = function (id) {
            ActivosService.reactivate(id).then(function () {
                ActivosService.getListInactive().then(function (data) {
                    $scope.activos = data.activos;
                    $scope.total_activos = data.total_activos;
                });
            });
        };

    }
]);
/*
 * Controlador Alta de Activos         
 */
angular.module('app').controller("ActivosCreateCtrl", [
    '$scope',
    '$state',
    'ActivosService',
    function ($scope, $state, ActivosService) {
        $scope.heading = "Crear "
        $scope.tipos = [
            {value: '1', text: 'Terreno'},
            {value: '2', text: 'Edificio'},
            {value: '3', text: 'Mobiliario'},
            {value: '4', text: 'Equipo de cómputo'},
            {value: '5', text: 'Equipo de producción'},
            {value: '6', text: 'Vehículo'}
        ];
        $scope.form_activos = {fecha_compra: '', monto_compra_sin_impuestos: '0', descripcion: '', tipo: ''};//        $single_file[] = ['campo' => $field['Field'], 'tabla_archivos' => $field['tabla_archivos'], 'tabla_archivos_singular' => $field['tabla_archivos_singular']];
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_activos);
            ActivosService.create(data_send).then(function () {
                $state.go('main.activos_personas_list_active');
            });
        };
    }
]);
/*
 Controlador modificacion de Activos         
 */
angular.module('app').controller('ActivosUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'ActivosService',
    function ($scope, $state, $stateParams, ActivosService) {
        var id = $stateParams.id;
        $scope.heading = "Editar "
        $scope.tipos = [
            {value: '1', text: 'Terreno'},
            {value: '2', text: 'Edificio'},
            {value: '3', text: 'Mobiliario'},
            {value: '4', text: 'Equipo de cómputo'},
            {value: '5', text: 'Equipo de producción'},
            {value: '6', text: 'Vehículo'}
        ]
        form_activos = [];
        ActivosService.getById(id).then(function (data) {
            $scope.form_activos = data.activo;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_activos);
            ActivosService.update(id, data_send).then(function () {
                $state.go('main.activos_personas_list_active');
            });
        };

    }
]);

