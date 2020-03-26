/*
 Controlador Lista de Preguntas_frecuentes     
 */
/* global angular */

angular.module('app').controller("PreguntasFrecuentesListCtrl", [
    '$scope',
    '$stateParams',
    'PreguntasFrecuentesService',
    'CategoriasPreguntasService',
    '$state',
    function ($scope, $stateParams, PreguntasFrecuentesService, CategoriasPreguntasService, $state) {
        var categoria_id = $stateParams.categoria_id;
        $scope.preguntas_frecuentes = [];
        CategoriasPreguntasService.getById(categoria_id).then(function (data) {
            $scope.categoria = data.categorias_preguntas_frecuentes;

        }, function () {
            $state.go('main.categorias_preguntas_frecuentes_list');
        });
        PreguntasFrecuentesService.getByCategoriasPreguntasFrecuentesId(categoria_id, ).then(function (data) {
            $scope.preguntas_frecuentes = data.preguntas_frecuentes;
            $scope.total_preguntas = data.total_preguntas;
        });
        $scope.inactivate = function (id) {
            PreguntasFrecuentesService.inactivate(id).then(function () {
                PreguntasFrecuentesService.getByCategoriasPreguntasFrecuentesId(categoria_id, ).then(function (data) {
                    $scope.preguntas_frecuentes = data.preguntas_frecuentes;
                    $scope.total_preguntas = data.total_preguntas;
                });
            });
        };
        $scope.reactivate = function (id) {
            PreguntasFrecuentesService.reactivate(id).then(function () {
                PreguntasFrecuentesService.getList().then(function (data) {
                    $scope.preguntas_frecuentes = data.preguntas_frecuentes;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Preguntas_frecuentes   
 */
angular.module("app").controller('PreguntasFrecuentesListInactiveCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    'PreguntasFrecuentesService',
    'CategoriasPreguntasService',
    function ($scope, $stateParams, $state, PreguntasFrecuentesService, CategoriasPreguntasService) {
        var categoria_id = $stateParams.categoria_id;
        CategoriasPreguntasService.getById(categoria_id).then(function (data) {
            $scope.categoria = data.categorias_preguntas_frecuentes;
        }, function () {
            $state.go('main.categorias_preguntas_frecuentes_list');
        });
        PreguntasFrecuentesService.getListInactiveByCategoriaId(categoria_id, ).then(function (data) {
            $scope.preguntas_frecuentes = data.preguntas_frecuentes;
            $scope.total_preguntas = data.total_preguntas;
        });
        $scope.reactivate = function (id) {
            PreguntasFrecuentesService.reactivate(id).then(function () {
                PreguntasFrecuentesService.getListInactiveByCategoriaId(categoria_id, ).then(function (data) {
                    $scope.preguntas_frecuentes = data.preguntas_frecuentes;
                    $scope.total_preguntas = data.total_preguntas;

                });
            });
        };
    }
]);
/*
 * Controlador Alta de Preguntas_frecuentes         
 */
angular.module('app').controller("PreguntasFrecuentesCreateCtrl", [
    '$scope',
    '$state',
    '$stateParams',
    'PreguntasFrecuentesService',
    'CategoriasPreguntasService',
    function ($scope, $state, $stateParams, PreguntasFrecuentesService, CategoriasPreguntasService) {
        $scope.heading = 'Crear ';
        var categoria_id = $stateParams.categoria_id;
        var categoria_id = $stateParams.categoria_id;
        CategoriasPreguntasService.getById(categoria_id).then(function (data) {
            $scope.categoria = data.categorias_preguntas_frecuentes;
        }, function () {
            $state.go('main.categorias_preguntas_frecuentes_list');
        });
        $scope.form_preguntas_frecuentes = {};
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_preguntas_frecuentes);
            PreguntasFrecuentesService.create(categoria_id, data_send).then(function () {
                $state.go('main.preguntas_frecuentes_by_categoria_list', {
                    categoria_id: categoria_id
                });
            });
        };
    }
]);
/*
 Controlador modificacion de Preguntas_frecuentes         
 */
angular.module('app').controller('PreguntasFrecuentesUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'PreguntasFrecuentesService',
    'CategoriasPreguntasService',
    function ($scope, $state, $stateParams, PreguntasFrecuentesService, CategoriasPreguntasService) {
        $scope.heading = "Editar ";
        var id = $stateParams.id;
        var categoria_id = $stateParams.categoria_id;
        CategoriasPreguntasService.getById(categoria_id, id).then(function (data) {
            $scope.categoria = data.categorias_preguntas_frecuentes;
        }, function () {
            $state.go('main.categorias_preguntas_frecuentes_list');
        });
        PreguntasFrecuentesService.getById(id, categoria_id).then(function (data) {
            $scope.form_preguntas_frecuentes = data.preguntas_frecuentes;
        }, function () {
            $state.go('main.preguntas_frecuentes_by_categoria_list', {
                categoria_id: categoria_id
            });
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_preguntas_frecuentes);
            PreguntasFrecuentesService.update(id, categoria_id, data_send).then(function () {
                $state.go('main.preguntas_frecuentes_by_categoria_list', {
                    categoria_id: categoria_id
                });
            });
        };
    }
]);

