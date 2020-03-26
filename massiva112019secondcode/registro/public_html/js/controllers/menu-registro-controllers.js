angular.module("app").controller('MenuRegistroCtrl', [
    '$scope',
    'DocumentosFiscalesService',
    'PersonasService',
    function ($scope, DocumentosFiscalesService, PersonasService) {
        $scope.ultimo = 1;
        $scope.lista_states = [
            {number: 1, show: true, state: "main.menu_registro.datos_fiscales", text: "Datos Fiscales"},
            {number: 2, show: true, state: "main.menu_registro.documentos_fiscales", text: "Documentos Fiscales"},
            {number: 3, show: true, state: "main.menu_registro.elegir_paquetes", text: "Paquetes"},
            {number: 3, show: false, state: "main.menu_registro.paquete_pagado", text: "Forma de pago"},
            {number: 4, show: true, state: "main.menu_registro.tipo_pago", text: "Forma de pago"},
            {number: 5, show: false, state: "main.menu_registro.contabilidad_atrasada", text: "Contabilidad atrasada"},
            {number: 6, show: true, state: "main.menu_registro.resumen", text: "Resumen"}
        ];
        var ultimo = 1;


        PersonasService.getDatosById().then(function (data) {
            if (data) {
                ultimo = 2;
            }
            DocumentosFiscalesService.getFilesByPersonaId().then(function (data_response) {
                var files = data_response.list_files;
                var documentos_guardados = 0;
                PersonasService.getEfirmaByPersonaID().then(function (data_response) {
                    for (var i = 0; i < files.length; i++) {
                        if (files[i].tipo === "1" || files[i].tipo === "2" || files[i].tipo === "3" || files[i].tipo === "4" || files[i].tipo === "5") {
                            documentos_guardados++;
                        }
                    }
                    if (documentos_guardados === 5 && data_response.efirma !== null) {
                        ultimo = 3;
                    } else if (!data_response.efirma) {
                        ultimo = 2;
                    }
                    PersonasService.getPaquetesByPersonaId().then(function (data_paquete_persona) {
                        if (data_paquete_persona) {
                            ultimo = 3
                            if (data_paquete_persona.paquete.status === "1") {
                                $scope.changeListaStatesVisiblesByState('main.menu_registro.tipo_pago', false);
                                $scope.changeListaStatesVisiblesByState('main.menu_registro.elegir_paquetes', false);
                                $scope.changeListaStatesVisiblesByState('main.menu_registro.paquete_pagado', true);
                                ultimo = 4;
                            }
                        }
                        PersonasService.getDatosById().then(function (data) {
                            if (data.persona.contabilidad_atrasada === '1') {
                                $scope.changeListaStatesVisiblesByState('main.menu_registro.contabilidad_atrasada', true);
                                ultimo = 5;
                            } else {
                                $scope.changeListaStatesVisiblesByState('main.menu_registro.contabilidad_atrasada', false);
                            }
                        });
                        $scope.ultimo = ultimo;
                    });
                });
            });
        });

        function changeNumbersByShow(array_of_objects) {
            if (Array.isArray(array_of_objects)) {
                var contador = 1;
                for (var i = 0; i < array_of_objects.length; i++) {
                    if (array_of_objects[i].show) {
                        array_of_objects[i].number = contador;
                        contador++;
                    }
                }
                return $scope.lista_states;
            }
            return array_of_objects;
        }

        function findIndexByObjectValue(array_of_objects, key, value) {
            if (Array.isArray(array_of_objects)) {
                for (var i = 0; i < array_of_objects.length; i++) {
                    if (array_of_objects[i][key] === value) {
                        return i;
                    }
                }
            }
            return -1;
        }
        $scope.updateToNextStep = function (next) {
            if ($scope.ultimo < next) {
                $scope.ultimo = next;
            }
        };

        $scope.updateToNextStepByStateName = function (state_name) {
            var index_in_array = findIndexByObjectValue($scope.lista_states, 'state', state_name);
            if (index_in_array !== -1) {
                $scope.updateToNextStep($scope.lista_states[index_in_array].number + 1);
            }
        };

        $scope.changeListaStatesVisiblesByState = function (item, show) {
            var index_in_array = findIndexByObjectValue($scope.lista_states, 'state', item);
            if (index_in_array !== -1) {
                $scope.lista_states[index_in_array].show = show;
                $scope.lista_states = changeNumbersByShow($scope.lista_states);
            }
        };

    }
]);


