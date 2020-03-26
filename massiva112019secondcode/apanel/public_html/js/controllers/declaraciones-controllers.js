/* global Noty, angular */
/*
 Controlador lista de contadores de un jefe contador 
 */
angular.module('app').controller('DeclaracionesControllers', [
    '$scope',
    '$stateParams',
    'PersonasContadoresService',
    function ($scope, $stateParams, PersonasContadoresService) {
        $scope.state_title = 'Declaraciones';
        $scope.meses = [
            {mes:'Cualquier mes', value:''},
            {mes:'Enero', value:1},
            {mes:'Febrero', value:2},
            {mes:'Marzo', value:3},
            {mes:'Abril', value:4},
            {mes:'Mayo', value:5},
            {mes:'Junio', value:6},
            {mes:'Julio', value:7},
            {mes:'Agosto', value:8},
            {mes:'Septiembre', value:9},
            {mes:'Octubre', value:10},
            {mes:'Noviembre', value:11},
            {mes:'Diciembre', value:12}
        ];
//        $scope.mes_selected = $scope.meses[0];
        $scope.declaraciones = [];
        var contador_id = $stateParams.contador_id;
        PersonasContadoresService.getAllDeclaracionesByContadorId(contador_id).then(function (data){
            $scope.declaraciones=data.declaraciones;
        });
        $scope.get_nombre_del_mes = function(mes_value){
            var mes_numeric_value = parseInt(mes_value);
            for (var i=0; i < $scope.meses.length; i++){
                if (mes_numeric_value === $scope.meses[i].value){
                    return $scope.meses[i].mes;
                }
            }
            return 'Error';
        };
        $scope.get_text_status_declaracion = function(status_value){
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
        $scope.requiere_boton_adjuntar_para_pago = function(status_value){
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
        $scope.get_state_destino = function(persona_id, declaracion_id){
            return "main.declaraciones_adjuntar_para_pago({persona_id:"+persona_id+", declaracion_id:"+declaracion_id+"})";
        };
    }
]);
angular.module('app').controller('DeclaracionesAtrasadasControllers', [
    '$scope',
    '$stateParams',
    'PersonasContadoresService',
    function ($scope, $stateParams, PersonasContadoresService) {
        $scope.state_title = 'Declaraciones Atrasadas';
        $scope.meses = [
            {mes:'Cualquier mes', value:''},
            {mes:'Enero', value:1},
            {mes:'Febrero', value:2},
            {mes:'Marzo', value:3},
            {mes:'Abril', value:4},
            {mes:'Mayo', value:5},
            {mes:'Junio', value:6},
            {mes:'Julio', value:7},
            {mes:'Agosto', value:8},
            {mes:'Septiembre', value:9},
            {mes:'Octubre', value:10},
            {mes:'Noviembre', value:11},
            {mes:'Diciembre', value:12},
        ];
        $scope.declaraciones = [];
        var contador_id = $stateParams.contador_id;
        PersonasContadoresService.getAllDeclaracionesAtrasadasByContadorId(contador_id).then(function (data){
            $scope.declaraciones=data.declaraciones_atrasadas;
        });
        $scope.get_nombre_del_mes = function(mes_value){
            var mes_numeric_value = parseInt(mes_value);
            for (var i=0; i < $scope.meses.length; i++){
                if (mes_numeric_value === $scope.meses[i].value){
                    return $scope.meses[i].mes;
                }
            }
            return 'Error';
        };
        $scope.get_text_status_declaracion = function(status_value){
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
        $scope.requiere_boton_adjuntar_para_pago = function(status_value){
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
        $scope.get_state_destino = function(persona_id, declaracion_id){
            return "main.declaraciones_atrasadas_adjuntar_para_pago({persona_id:"+persona_id+", declaracion_id:"+declaracion_id+"})";
        };
    }
]);
angular.module('app').controller('DeclaracionesAdjuntarParaPagoController', [
    '$scope',
    '$stateParams',
    function ($scope, $stateParams, PersonasContadoresService) {
        $scope.file_pdf = {seleccionado:false};
        $scope.file_zip = {seleccionado:false};
        $scope.fileProductoUpload = function(file){
            file.seleccionado = true;
        };
        $scope.quitar_archivo_seleccionado = function(file){
            file.seleccionado = false;
            file.file = null;
        };
        $scope.editar_archivo_seleccionado = function(file){
            file.editando = true;
            file.seleccionado = false;
        }
        $scope.cancelar_edicion = function(file){
            file.editando = false;
            file.seleccionado = true;
        }
    }
]);
angular.module('app').controller('DeclaracionesAtrasadasAdjuntarParaPagoController', [
    '$scope',
    '$stateParams',
    function ($scope, $stateParams, PersonasContadoresService) {
        $scope.file_pdf = {seleccionado:false};
        $scope.file_zip = {seleccionado:false};
        $scope.fileProductoUpload = function(file){
            file.seleccionado = true;
        };
        $scope.quitar_archivo_seleccionado = function(file){
            file.seleccionado = false;
            file.file = null;
        };
        $scope.editar_archivo_seleccionado = function(file){
            file.editando = true;
            file.seleccionado = false;
        }
        $scope.cancelar_edicion = function(file){
            file.editando = false;
            file.seleccionado = true;
        }
    }
]);