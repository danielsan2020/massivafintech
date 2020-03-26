/* global Noty, angular */
/*
 Controlador Lista de Personas que no tienen un contador asignado  
 */
angular.module('app').controller('PersonasSinContadorListCtrl', [
    '$scope',
    '$rootScope',
    'PersonasService',
    function ($scope, $rootScope, PersonasService) {
        var id = $rootScope.usuario_acceso.id;
        $scope.personas = [];
        PersonasService.getListPersonasSinContador(id).then(function (data) {
            $scope.personas = data.personas;
        });
    }
]);
/*
 Controlador para asignarle a una persona un contador  
 */
angular.module('app').controller('PersonasSinContadorAsignarCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    '$rootScope',
    'PersonasContadoresService',
    'UsuariosService',
    function ($scope, $stateParams, $state, $rootScope, PersonasContadoresService, UsuariosService) {
        var personas_contadores_id = $stateParams.personas_contadores_id;
        var contador_selected_id = null;
        var id_jefe = $rootScope.usuario_acceso.id;
        PersonasContadoresService.getPersonaByPersonaContadorId(personas_contadores_id).then(function (data) {
            $scope.form_persona = data.persona;
            UsuariosService.getListContadoresAndPersonas(id_jefe).then(function (data) {
                $scope.contadores = data.contadores;
                for (var k = 0; k < $scope.contadores.length; k++) {
                    var jefe_contador_id = $scope.contadores[k].id;
                    var persona_jefe_contador_asignado_id = $scope.form_persona.jefe_id;
                    if (jefe_contador_id === persona_jefe_contador_asignado_id) {
                        $scope.form_persona['contador'] = angular.copy($scope.contadores[k]);
                    }
                }
            });
        });
        $scope.submit = function () {
            var data_send = {persona_id: $scope.form_persona.id, contador_id: contador_selected_id, jefe_id: id_jefe};
            PersonasContadoresService.asignarPersonaAContador(personas_contadores_id, data_send).then(function () {
                    $state.go('main.personas_sin_contador_asignado_list');
            });
        };
        $scope.get_id_jefe_contador = function (id) {
            contador_selected_id = id;
        };
    }
]);

/*
 Controlador Lista de Personas que tienen un contador asignado  
 */
angular.module('app').controller('PersonasConContadorListCtrl', [
    '$scope',
    '$rootScope',
    'PersonasService',
    function ($scope, $rootScope, PersonasService) {
        var id = $rootScope.usuario_acceso.id;
        $scope.personas = [];
        PersonasService.getListPersonasConContador(id).then(function (data) {
            $scope.personas = data.personas;
        });
    }
]);

/*
 Controlador para cambiar de contador a la persona  
 */
angular.module('app').controller('PersonasConContadorCambiarCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    '$rootScope',
    'PersonasContadoresService',
    'UsuariosService',
    function ($scope, $stateParams, $state, $rootScope, PersonasContadoresService, UsuariosService) {
        var personas_contadores_id = $stateParams.personas_contadores_id;
        var contador_selected_id = null;
        var id_jefe = $rootScope.usuario_acceso.id;
        PersonasContadoresService.getPersonaByPersonaContadorId(personas_contadores_id).then(function (data) {
            $scope.form_persona = data.persona;
            UsuariosService.getListContadoresAndPersonas(id_jefe).then(function (data) {
                $scope.contadores = data.contadores;
                for (var k = 0; k < $scope.contadores.length; k++) {
                    var contador_id = $scope.contadores[k].id;
                    var persona_contador_asignado_id = $scope.form_persona.contador_id;
                    if (contador_id === persona_contador_asignado_id) {
                        $scope.form_persona['contador'] = angular.copy($scope.contadores[k]);
                        $scope.contadores.splice(k, 1);
                    }
                }
            });
        });
        $scope.submit = function () {
            var data_send = {persona_id: $scope.form_persona.id, contador_id: contador_selected_id, jefe_id: id_jefe};
            PersonasContadoresService.asignarPersonaAContador(personas_contadores_id, data_send).then(function () {
                    $state.go('main.personas_con_contador_list');
            });
        };
        $scope.get_id_jefe_contador = function (id) {
            contador_selected_id = id;
        };
    }
]);

angular.module('app').controller('PersonasDeUnContadorList', [
    '$scope',
    '$stateParams',
    '$state',
    'PersonasContadoresService',
    function ($scope, $stateParams, $state, PersonasContadoresService) {
        var contador_id = $stateParams.contador_id;
        PersonasContadoresService.getAllPersonasByContadorId(contador_id).then(function (data) {
            $scope.personas = data.personas;
        });
    }
]);