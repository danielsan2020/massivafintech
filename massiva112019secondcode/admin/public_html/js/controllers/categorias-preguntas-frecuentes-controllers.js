
/* global Noty, angular */
/*
 Controlador Lista de Categorias_preguntas_frecuentes     
 */
angular.module('app').controller('CategoriasPreguntasListCtrl', [
    '$scope',
    'CategoriasPreguntasService',
    function ($scope, CategoriasPreguntasService) {
        $scope.categorias_preguntas_frecuentes = [];
        CategoriasPreguntasService.getList().then(function (data) {
            $scope.categorias_preguntas_frecuentes = data.categorias_preguntas_frecuentes;
            $scope.total_categorias = data.total_categorias;
        });
        $scope.inactivate = function (id) {
            CategoriasPreguntasService.inactivate(id).then(function () {
                CategoriasPreguntasService.getList().then(function (data) {
                    $scope.categorias_preguntas_frecuentes = data.categorias_preguntas_frecuentes;
                    $scope.total_categorias = data.total_categorias;
                });
            });
        };
        $scope.reactivate = function (id) {
            CategoriasPreguntasService.reactivate(id).then(function () {
                CategoriasPreguntasService.getList().then(function (data) {
                    $scope.categorias_preguntas_frecuentes = data.categorias_preguntas_frecuentes;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Categorias_preguntas_frecuentes   
 */
angular.module("app").controller('CategoriasPreguntasListInactiveCtrl', [
    '$scope',
    '$state',
    'CategoriasPreguntasService',
    function ($scope, $state, CategoriasPreguntasService) {
        CategoriasPreguntasService.getListInactive().then(function (data) {
            $scope.categorias_preguntas_frecuentes = data.categorias_preguntas_frecuentes;
            $scope.total_categorias = data.total_categorias;

            $scope.submit = function () {
//                var data_send = angular.copy($scope.form_categorias_preguntas_frecuentes);
                CategoriasPreguntasService.getListInactive().then(function () {
                    $state.go('main.categorias_preguntas_frecuentes_list');
                    $scope.total_categorias = data.total_categorias;
                });
            };
        });

        $scope.reactivate = function (id) {
            CategoriasPreguntasService.reactivate(id).then(function () {
                CategoriasPreguntasService.getListInactive().then(function (data) {
                    $scope.categorias_preguntas_frecuentes = data.categorias_preguntas_frecuentes;
                    $scope.total_categorias = data.total_categorias;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Categorias_preguntas_frecuentes         
 */
angular.module('app').controller('CategoriasPreguntasCreateCtrl', [
    '$scope',
    '$state',
    'validationManager',
    'CategoriasPreguntasService',
    function ($scope, $state, validationManager, CategoriasPreguntasService) {
        $scope.heading = 'Crear ';
        $scope.form_categorias_preguntas_frecuentes = {categoria: ''};
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_categorias_preguntas_frecuentes);
            CategoriasPreguntasService.create(data_send).then(function () {
                $state.go('main.categorias_preguntas_frecuentes_list');
            });
        };
    }
]);
/*
 Controlador modificacion de Categorias_preguntas_frecuentes         
 */
angular.module('app').controller('CategoriasPreguntasUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'CategoriasPreguntasService',
    function ($scope, $state, $stateParams, CategoriasPreguntasService) {
        $scope.heading = 'Editar ';
        var id = $stateParams.id;
        CategoriasPreguntasService.getById(id).then(function (data) {
            $scope.form_categorias_preguntas_frecuentes = data.categorias_preguntas_frecuentes;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_categorias_preguntas_frecuentes);
            CategoriasPreguntasService.update(id, data_send).then(function () {
                $state.go('main.categorias_preguntas_frecuentes_list');
            });
        };
    }
]);