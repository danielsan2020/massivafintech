/* global Noty */
/*
 Controlador lista de contadores 
 */
angular.module('app').controller('DeclaracionesControllers', [
    '$scope',
    '$stateParams',
    '$rootScope',
    'PersonasContadoresService',
    function ($scope, $stateParams, $rootScope, PersonasContadoresService) {
        var contador_id = $rootScope.usuario_acceso.id;
        $scope.state_title = 'Declaraciones';
        $scope.meses = [
            {mes: 'Cualquier mes', value: ''},
            {mes: 'Enero', value: 1},
            {mes: 'Febrero', value: 2},
            {mes: 'Marzo', value: 3},
            {mes: 'Abril', value: 4},
            {mes: 'Mayo', value: 5},
            {mes: 'Junio', value: 6},
            {mes: 'Julio', value: 7},
            {mes: 'Agosto', value: 8},
            {mes: 'Septiembre', value: 9},
            {mes: 'Octubre', value: 10},
            {mes: 'Noviembre', value: 11},
            {mes: 'Diciembre', value: 12},
        ];
//        $scope.mes_selected = $scope.meses[0];
        $scope.declaraciones = [];
//        var contador_id = $stateParams.contador_id;
        PersonasContadoresService.getAllDeclaracionesByContadorId(contador_id).then(function (data) {
            $scope.declaraciones = data.declaraciones;
        });
        $scope.get_nombre_del_mes = function (mes_value) {
            var mes_numeric_value = parseInt(mes_value);
            for (var i = 0; i < $scope.meses.length; i++) {
                if (mes_numeric_value === $scope.meses[i].value) {
                    return $scope.meses[i].mes;
                }
            }
            return 'Error';
        };
        $scope.get_text_status_declaracion = function (status_value) {
            switch (status_value) {
                case '-1':
                    return 'Rechazada';
                    break;
                case '1':
                    return 'Requerida';
                    break;
                case '2':
                    return 'Vista';
                    break;
                case '3':
                    return 'Aceptada';
                    break;
                case '4':
                    return 'Realizada';
                    break;
                case '5':
                    return 'Requiere actualizacion';
                    break;
                case '6':
                    return 'Pagada';
                    break;
            }
        };
        $scope.requiere_boton_adjuntar_para_pago = function (status_value) {
            switch (status_value) {
                case '3':
                case '5':
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        };
        $scope.get_state_destino = function (persona_id, declaracion_id) {
            return "main.declaraciones_adjuntar_para_pago({persona_id:" + persona_id + ", declaracion_id:" + declaracion_id + "})";
        };
    }
]);
angular.module('app').controller('DeclaracionesAtrasadasControllers', [
    '$scope',
    '$rootScope',
    'PersonasContadoresService',
    function ($scope, $rootScope, PersonasContadoresService) {
        var contador_id = $rootScope.usuario_acceso.id;
        $scope.state_title = 'Declaraciones Atrasadas';
        $scope.filter_form = {};
        $scope.meses = [
            {mes: 'Cualquier mes', value: ''},
            {mes: 'Enero', value: 1},
            {mes: 'Febrero', value: 2},
            {mes: 'Marzo', value: 3},
            {mes: 'Abril', value: 4},
            {mes: 'Mayo', value: 5},
            {mes: 'Junio', value: 6},
            {mes: 'Julio', value: 7},
            {mes: 'Agosto', value: 8},
            {mes: 'Septiembre', value: 9},
            {mes: 'Octubre', value: 10},
            {mes: 'Noviembre', value: 11},
            {mes: 'Diciembre', value: 12},
        ];
        $scope.declaraciones = [];
        PersonasContadoresService.getAllDeclaracionesAtrasadasByContadorId(contador_id).then(function (data) {
            $scope.declaraciones = data.declaraciones_atrasadas;
        });
        $scope.get_nombre_del_mes = function (mes_value) {
            var mes_numeric_value = parseInt(mes_value);
            for (var i = 0; i < $scope.meses.length; i++) {
                if (mes_numeric_value === $scope.meses[i].value) {
                    return $scope.meses[i].mes;
                }
            }
            return 'Error';
        };
        $scope.get_text_status_declaracion = function (status_value) {
            switch (status_value) {
                case '-1':
                    return 'Rechazada';
                    break;
                case '1':
                    return 'Requerida';
                    break;
                case '2':
                    return 'Vista';
                    break;
                case '3':
                    return 'Aceptada';
                    break;
                case '4':
                    return 'Realizada';
                    break;
                case '5':
                    return 'Requiere actualizacion';
                    break;
                case '6':
                    return 'Pagada';
                    break;
            }
        };
        $scope.requiere_boton_adjuntar_para_pago = function (status_value) {
            switch (status_value) {
                case '3':
                case '5':
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        };
        $scope.get_state_destino = function (persona_id, declaracion_id) {
            return "main.declaraciones_atrasadas_adjuntar_para_pago({persona_id:" + persona_id + ", declaracion_id:" + declaracion_id + "})";
        };
    }
]);
angular.module('app').controller('DeclaracionesAdjuntarParaPagoController', [
    '$scope',
    '$state',
    '$stateParams',
    'DeclaracionesServices',
    function ($scope, $state, $stateParams, DeclaracionesServices) {
        $scope.declaracion = {};
        $scope.file_pdf = {seleccionado: false, file: null, extension_archivo: 'pdf'};
        $scope.file_zip = {seleccionado: false, file: null, extension_archivo: 'zip'};
        $scope.data = {};

        var persona_id = $stateParams.persona_id;
        var declaracion_id = $stateParams.declaracion_id;

        DeclaracionesServices.getDeclaracionByPersonaIdAndDeclaracionId(persona_id, declaracion_id).then(function (data) {
            $scope.declaracion = data.declaracion;
        }, function (data) {
            $state.go("main.show_declaraciones");
        });

        $scope.fileProductoUpload = function (file) {
            if (file.file === null) {
                show_error_message(file.extension_archivo);
            } else {
                console.log(file.file);
                file.seleccionado = true;
            }
        };
        $scope.quitar_archivo_seleccionado = function (file) {
            file.seleccionado = false;
            file.file = null;
        };
        $scope.editar_archivo_seleccionado = function (file) {
            file.editando = true;
            file.seleccionado = false;
        };
        $scope.cancelar_edicion = function (file) {
            file.editando = false;
            file.seleccionado = true;
        };
        $scope.subir_archivos = function () {
            if (se_adjunto_archivo()) {
//                alert('mandar al servidor');
                set_datos_a_mandar_al_servidor()
                DeclaracionesServices.subir_archivos_adjuntos_para_pago($scope.data).then(function (data) {
                    alert("se hizo peticion");
                });
            } else {
                alert('adjunte por lo menos un archivo');
            }
        };
        function show_error_message(extension_archivo) {
            alert('Seleccione un archivo con la extension: ' + extension_archivo);
        }
        function se_adjunto_archivo() {
            if (($scope.file_pdf.seleccionado) | ($scope.file_zip.seleccionado)) {
                return true;
            }
            return false;
        }
        function set_datos_a_mandar_al_servidor() {
            set_files();
            $scope.data.persona_id = persona_id;
            $scope.data.declaracion_id = declaracion_id;
        }
        function set_files() {
            if ($scope.file_zip.file !== null) {
                $scope.data.file_zip = $scope.file_zip.file;
                $scope.data.zip = true;
            }

            if ($scope.file_pdf.file !== null) {
                $scope.data.file_pdf = $scope.file_pdf.file;
                $scope.data.pdf = true;
            }
        }
    }
]);
angular.module('app').controller('DeclaracionesAtrasadasAdjuntarParaPagoController', [
    '$scope',
    '$state',
    '$stateParams',
    'DeclaracionesServices',
    function ($scope, $state, $stateParams, DeclaracionesServices) {
        $scope.declaracion = {};
        $scope.file_pdf = {seleccionado: false, file: null};
        $scope.file_zip = {seleccionado: false, file: null};
        var persona_id = $stateParams.persona_id;
        var declaracion_id = $stateParams.declaracion_id;
        DeclaracionesServices.getDeclaracionAtrasadaByPersonaIdAndDeclaracionId(persona_id, declaracion_id).then(function (data) {
            $scope.declaracion = data.declaracion;
        }, function (data) {
            $state.go("main.show_declaraciones_atrasadas");
        });
        $scope.fileProductoUpload = function (file) {
            file.seleccionado = true;
        };
        $scope.quitar_archivo_seleccionado = function (file) {
            file.seleccionado = false;
            file.file = null;
        };
        $scope.editar_archivo_seleccionado = function (file) {
            file.editando = true;
            file.seleccionado = false;
        };
        $scope.cancelar_edicion = function (file) {
            file.editando = false;
            file.seleccionado = true;
        };
        $scope.subir_archivos = function () {
            alert('Declaraciones atrasadas');
        };
    }
]);