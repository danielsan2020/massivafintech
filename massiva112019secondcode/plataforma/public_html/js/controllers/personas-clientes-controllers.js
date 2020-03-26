
/* global Noty, extension, base_url, ngDialog, soporte_ticket_id, angular */
/*
 Controlador Lista de Personas_clientes     
 */
angular.module('app').controller("PersonasClientesListCtrl", [
    '$scope',
    '$rootScope',
    'PersonasClientesService',
    function ($scope, $rootScope, PersonasClientesService) {
        var persona_id = $rootScope.usuario_acceso.persona_id;
        PersonasClientesService.getList(persona_id, ).then(function (data) {
            $scope.personas_clientes = data.personas_clientes;
            $scope.total_personas_clientes = data.total_personas_clientes;
            for (var k = 0; k < $scope.personas_clientes.length; k++) {
                var cliente_id = $scope.personas_clientes[k].id;
                if ($scope.personas_clientes[k].tiene_logotipo === "-1") {
                    $scope.personas_clientes[k].url = base_url + 'images/sin_imagen.jpg';
                } else {
                    $scope.personas_clientes[k].url = base_url + 'files/get_logotipo_by_cliente_id?cliente_id=' + cliente_id + '&rand=' + Math.random();
                }
            }
        });
        $scope.inactivate = function (id) {
            PersonasClientesService.inactivate(id).then(function () {
                PersonasClientesService.getList(persona_id, ).then(function (data) {
                    $scope.personas_clientes = data.personas_clientes;
                    $scope.total_personas_clientes = data.total_personas_clientes;
                    for (var k = 0; k < $scope.personas_clientes.length; k++) {
                        var cliente_id = $scope.personas_clientes[k].id;
                        if ($scope.personas_clientes[k].tiene_logotipo === "-1") {
                            $scope.personas_clientes[k].url = base_url + 'images/sin_imagen.jpg';
                        } else {
                            $scope.personas_clientes[k].url = base_url + 'files/get_logotipo_by_cliente_id?cliente_id=' + cliente_id + '&rand=' + Math.random();
                        }
                    }
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Personas_clientes   
 */
angular.module("app").controller('PersonasClientesListInactiveCtrl', [
    '$scope',
    'PersonasClientesService',
    function ($scope, PersonasClientesService) {
        $scope.header = "inactivos";
        PersonasClientesService.getListInactive().then(function (data) {
            $scope.personas_clientes = data.personas_clientes;
            $scope.total_personas_clientes = data.total_personas_clientes;
        });
        $scope.reactivate = function (id) {
            PersonasClientesService.reactivate(id).then(function () {
                PersonasClientesService.getListInactive().then(function (data) {
                    $scope.personas_clientes = data.personas_clientes;
                    $scope.total_personas_clientes = data.total_personas_clientes;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Personas_clientes         
 */
angular.module('app').controller("PersonasClientesCreateCtrl", [
    '$scope',
    '$state',
    '$rootScope',
    'PersonasClientesService',
    'ColoniasService',
    function ($scope, $state, $rootScope, PersonasClientesService, ColoniasService) {
        $scope.heading = "Registro";
        var persona_id = $rootScope.usuario_acceso.persona_id;
        $scope.colonias = [];
        $scope.form_personas_clientes = {nombre: '', razon_social: '', rfc: '', colonia_id: '', calle: '', numero_interior: '', numero_exterior: '', email: '', tiene_logotipo: -1};//        $single_file[] = ['campo' => $field['Field'], 'tabla_archivos' => $field['tabla_archivos'], 'tabla_archivos_singular' => $field['tabla_archivos_singular']];
        $scope.file_logotipo = {file: "", subir_archivo: true}; //variable que trae los datos del archivo. para el ng-file-upload
        $scope.create_or_update = 1; //Bandera para que la vista muestre los campos correspondientes al update o al create
        $scope.editar_file_logotipo = false;
        var colonia_selected_id = null;
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_personas_clientes);
            data_send.colonia_id = colonia_selected_id;
            if ($scope.file_logotipo.file !== "") {
                data_send.file_logotipo = $scope.file_logotipo.file;
                data_send.file_type = $scope.file_logotipo.file.type;
            }
            PersonasClientesService.create(persona_id, data_send).then(function () {
                $state.go('main.personas_clientes_list');
            });
        };
        $scope.get_colonias_by_codigo_postal = function () {
            ColoniasService.getColoniasByCodigoPostal(angular.copy($scope.form_personas_clientes.codigo_postal)).then(function (data_response) {
                $scope.colonias = data_response.colonias;
            });
        };
        $scope.get_id_colonia = function (id) {
            colonia_selected_id = id;
        };
        $scope.fileLogotipoUpload = function (file) {
            $scope.file_logotipo.subir_archivo = false;
            $scope.form_personas_clientes.tiene_logotipo = 1;
            var data_send = {file: file};
            data_send.name = file.name;
        };
        $scope.eliminarLogotipo = function () {
            $scope.editar_file_logotipo = false;
            $scope.file_logotipo.subir_archivo = true;
            $scope.form_personas_clientes.tiene_logotipo = -1;
            $scope.file_logotipo.file = "";
        };
        $scope.editarLogotipo = function () {
            $scope.file_logotipo.subir_archivo = true;
            $scope.editar_file_logotipo = true;
        };
    }
]);
/*
 Controlador modificacion de Personas_clientes         
 */
angular.module('app').controller('PersonasClientesUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'defaultErrorMessageResolver',
    'PersonasClientesService',
    'ColoniasService',
    function ($scope, $state, $stateParams, defaultErrorMessageResolver, PersonasClientesService, ColoniasService) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
            errorMessages['rfc'] = 'Introduce un formato válido de RFC';
        });
        $scope.heading = "Edición ";
        var id = $stateParams.id;
        var colonia_selected_id = null;
        $scope.form_personas_clientes = {};
        $scope.file_logotipo = {file: "", subir_archivo: true};
        $scope.create_or_update = 2;
        $scope.tiene_foto = false;
        $scope.url = base_url + 'files/get_logotipo_by_cliente_id?cliente_id=' + id + '&rand=' + Math.random();
        PersonasClientesService.getById(id).then(function (data) {
            $scope.form_personas_clientes = data.personas_clientes;
            if ($scope.form_personas_clientes.tiene_logotipo === '1') {
                $scope.file_logotipo.subir_archivo = false;
                $scope.tiene_foto = true;
            } else {
                $scope.file_logotipo.subir_archivo = true;
            }
            var colonia_id = parseInt($scope.form_personas_clientes.colonia_id);
            ColoniasService.getColoniaById(colonia_id).then(function (data_response) {
                $scope.colonias = data_response.colonia;
                $scope.form_personas_clientes.codigo_postal = $scope.colonias[0].cp;
                ColoniasService.getColoniasByCodigoPostal($scope.form_personas_clientes.codigo_postal).then(function (data_response) {
                    $scope.colonias = data_response.colonias;
                    for (var k = 0; k < $scope.colonias.length; k++) {
                        var colonia = parseInt($scope.colonias[k].id);
                        if (colonia_id === colonia) {
                            $scope.colonia_selected = angular.copy($scope.colonias[k]);
                            colonia_selected_id = colonia;
                        }
                    }
                });
            });
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_personas_clientes);
            data_send.colonia_id = colonia_selected_id;
            if ($scope.file_logotipo.file !== "") {
                data_send.file_logotipo = $scope.file_logotipo.file;
                data_send.file_type = $scope.file_logotipo.file.type;
                data_send.file_editado = '1';
            }
            PersonasClientesService.update(id, data_send).then(function () {
                $state.go('main.personas_clientes_list');
            });
        };
        $scope.fileLogotipoUpload = function (file) {
            $scope.file_logotipo.subir_archivo = false;
            $scope.form_personas_clientes.tiene_logotipo = 1;
            var data_send = {file: file};
            data_send.name = file.name;
            $scope.tiene_foto = false;
        };
        $scope.eliminarLogotipo = function () {
            $scope.editar_file_producto = false;
            $scope.file_logotipo.subir_archivo = true;
            $scope.form_personas_clientes.tiene_logotipo = -1;
            $scope.file_logotipo.file = -1;
        };
        
        $scope.editarLogotipo = function () {
            $scope.file_logotipo.subir_archivo = true;
            $scope.editar_file_producto = true;

        };

    }
]);

