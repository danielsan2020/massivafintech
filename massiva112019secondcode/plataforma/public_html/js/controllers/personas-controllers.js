/* global base_url */

angular.module("app").controller('PersonaDatosFiscalesCreateCtrl', [
    '$scope',
    '$rootScope',
    '$state',
    'defaultErrorMessageResolver',
    'PersonasService',
    'ColoniasService',
    function ($scope, $rootScope, $state, defaultErrorMessageResolver, PersonasService, ColoniasService) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
            errorMessages['curp'] = 'Introduce un formato v&aacute;lido de CURP';
            errorMessages['rfc'] = 'Introduce un formato válido de RFC';
        });
        $scope.form_persona = {};
        $scope.colonias = [];
        var colonia_selected_id = null;
        var usuario_id = $rootScope.usuario_acceso.id;
        $scope.tipos = [{
                tipo: 'Persona Física',
                value: 1,
                selected: true
            }];
        $scope.form_persona.tipo = 1;
        $scope.get_colonias_by_codigo_postal = function () {
            ColoniasService.getColoniasByCodigoPostal(angular.copy($scope.form_persona.codigo_postal)).then(function (data_response) {
                $scope.colonias = data_response.colonias;
            });
        };
        $scope.get_id_colonia = function (id) {
            colonia_selected_id = id;
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_persona);
            data_send.colonia_id = colonia_selected_id;
            if (data_send.tiene_efirma_vigente === "-1") {
                PersonasService.enviarCorreoNoTengoEfirma(usuario_id).then(function () {
                });
            }
            PersonasService.createPersona(data_send).then(function (data_response) {
                $state.go('main.menu_registro.documentos_fiscales');
            });
        };
    }
]);
angular.module("app").controller('PersonaDatosFiscalesUpdateCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    'defaultErrorMessageResolver',
    'PersonasService',
    'ColoniasService',
    function ($scope, $state, $rootScope, defaultErrorMessageResolver, PersonasService, ColoniasService) {
        defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
            errorMessages['curp'] = 'Introduce un formato v&aacute;lido de CURP';
            errorMessages['rfc'] = 'Introduce un formato válido de RFC';
        });
        $scope.heading = "Editar datos de la Persona";
        $scope.form_persona = {};
        $scope.colonias = [];
        var usuario_id = $rootScope.usuario_acceso.id;
        var persona_id = $rootScope.usuario_acceso.persona_id;
//        var usuario_id = $rootScope.usuario_acceso.id;
        var colonia_selected_id = null;
        $scope.tipos = [{
                tipo: 'Persona Física',
                value: 1,
                selected: true
            }];
        PersonasService.getDatosById().then(function (data) {

            $scope.form_persona = data.persona;
            $scope.form_persona.tipo = 1;
            var colonia_id = parseInt($scope.form_persona.colonia_id);
            ColoniasService.getColoniaById(colonia_id).then(function (data_response) {
                $scope.colonias = data_response.colonia;
                $scope.form_persona.codigo_postal = $scope.colonias[0].cp;
                ColoniasService.getColoniasByCodigoPostal($scope.form_persona.codigo_postal).then(function (data_response) {
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

        $scope.get_colonias_by_codigo_postal = function () {
            ColoniasService.getColoniasByCodigoPostal(angular.copy($scope.form_persona.codigo_postal)).then(function (data_response) {
                $scope.colonias = data_response.colonias;
            });
        };

        $scope.get_id_colonia = function (id) {
            colonia_selected_id = id;
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_persona);
            data_send.colonia_id = colonia_selected_id;
            if (data_send.tiene_efirma_vigente === "-1") {
                PersonasService.enviarCorreoNoTengoEfirma(usuario_id).then(function () {
                });
            }
            PersonasService.updatePersona(persona_id, data_send).then(function () {
                $rootScope.usuario_acceso.contabilidad_atrasada = data_send.contabilidad_atrasada;
                $rootScope.usuario_acceso.tiene_efirma_vigente = data_send.tiene_efirma_vigente;
                if (data_send.contabilidad_atrasada === '1') {
                    $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.contabilidad_atrasada', true);

                } else {
                    $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.contabilidad_atrasada', false);
                }
                $scope.$parent.updateToNextStepByStateName('main.menu_registro.datos_fiscales');
                $state.go('main.menu_registro.documentos_fiscales');
            });
        };
    }

]);
angular.module("app").controller('PersonaPaquetesCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    'PersonasService',
    'RegimenesFiscalesService',
    'PaquetesService',
    '$state',
    function ($scope, $stateParams, $state, PersonasService, RegimenesFiscalesService, PaquetesService, $state) {
        $scope.form_persona = {};
        $scope.pagado = true;
        PersonasService.getPaquetesByPersonaId().then(function (data_paquete_persona) {
            if (data_paquete_persona.paquete.status === "1") {
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.tipo_pago', false);
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.elegir_paquetes', false);
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.paquete_pagado', true);
                $state.go('main.menu_registro.paquete_pagado');
            } else {
                $scope.pagado = false;
            }
            RegimenesFiscalesService.getByTipo().then(function (data) {
                $scope.regimenes_fiscales = data.regimenes_fiscales;
                PersonasService.getRegimenesByPersonaId().then(function (data) {
                    $scope.form_persona.regimenes = [];
                    for (var i = 0; i < data.regimenes.length; i++) {
                        $scope.form_persona.regimenes.push(data.regimenes[i].regimen_fiscal_id);
                    }
                    PaquetesService.getAllWithRegimenesAsChild().then(function (data_paquetes) {
                        $scope.paquetes = data_paquetes.paquetes;
                        $scope.showPaquetes();
                        $scope.form_persona.paquete_id = data_paquete_persona.paquete.paquete_id;
                    });
                });
            });
        });


        $scope.showPaquetes = function () {
            $scope.form_persona.paquete_id = '';
            $scope.paquetes_for_regimen_selected = [];
            for (var i = 0; i < $scope.paquetes.length; i++) {
                if (JSON.stringify($scope.paquetes[i].regimenes.sort()) === JSON.stringify($scope.form_persona.regimenes.sort())) {
                    $scope.paquetes_for_regimen_selected.push($scope.paquetes[i]);
                }
            }
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_persona);
            PersonasService.savePaqueteAndRegimenes(data_send).then(function () {
                $scope.$parent.updateToNextStepByStateName('main.menu_registro.elegir_paquetes');
                $state.go('main.menu_registro.tipo_pago');
            });
        };
    }
]);
angular.module("app").controller('PersonaTipoPagoCtrl', [
    '$scope',
    '$stateParams',
    'PersonasService',
    '$state',
    function ($scope, $stateParams, PersonasService, $state) {
        $scope.pagado = true;
        PersonasService.getPaquetesByPersonaId().then(function (data) {
            if (data.paquete.status === "1") {
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.tipo_pago', false);
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.elegir_paquetes', false);
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.paquete_pagado', true);
                $state.go('main.menu_registro.paquete_pagado');
            } else {
                $scope.pagado = false;
            }
        });
    }
]);
angular.module("app").controller('PersonaTarjetaBancariaCtrl', [
    '$scope',
    '$stateParams',
    'PersonasService',
    '$state',
    function ($scope, $stateParams, PersonasService, $state) {
        $scope.form_tarjeta_bancaria = {nombre_titular: '', numero_tarjeta: '', mes_expiracion: '', anio_expiracion: '', codigo: '', first_digits: '', second_digits: '', third_digits: '', fourth_digits: ''};
        var submited = false;
        $scope.goNextOnMaxLength = function (e, numero, element) {
            if (numero.length === 4 && element !== '4' && e.keyCode !== 8) {
                document.getElementById("numero-tarjeta-" + (parseInt(element) + 1)).focus();
            } else if (numero.length === 0 && element !== '1' && e.keyCode === 8) {
                document.getElementById("numero-tarjeta-" + (parseInt(element) - 1)).focus();
            }
            var numero_tarjeta = $scope.form_tarjeta_bancaria.first_digits.toString();
            numero_tarjeta += $scope.form_tarjeta_bancaria.second_digits.toString();
            numero_tarjeta += $scope.form_tarjeta_bancaria.third_digits.toString();
            numero_tarjeta += $scope.form_tarjeta_bancaria.fourth_digits.toString();
            $scope.form_tarjeta_bancaria.numero_tarjeta = numero_tarjeta;
        };
        $scope.submit = function () {
            if (!submited) {
                submited = true;
                var data_send = angular.copy($scope.form_tarjeta_bancaria);
                PersonasService.payWithTarjetaBancaria(data_send).then(function () {
                    PersonasService.getDatosById().then(function (data) {
                        $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.tipo_pago', false);
                        $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.elegir_paquetes', false);
                        $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.paquete_pagado', true);
                        $scope.$parent.updateToNextStepByStateName('main.menu_registro.tipo_pago');
                        if (data.persona.contabilidad_atrasada === '-1') {
                            $state.go('main.menu_registro.resumen');
                        } else {
                            $state.go('main.menu_registro.contabilidad_atrasada');
                        }
                    });
                }, function () {
                    submited = false;
                });
            }

        };
    }
]);
angular.module("app").controller('PersonaTransferenciaBancariaCtrl', [
    '$scope',
    '$stateParams',
    'PersonasService',
    '$state',
    function ($scope, $stateParams, PersonasService, $state) {
        $scope.goToNextState = function () {
            PersonasService.getDatosById().then(function (data) {
                if (data.persona.contabilidad_atrasada === '-1') {
                    $state.go('main.menu_registro.resumen');
                } else {
                    $state.go('main.menu_registro.contabilidad_atrasada');
                }
            });
        };
    }
]);

angular.module("app").controller('PersonaContabilidadAtrasadaCtrl', [
    '$scope',
    '$stateParams',
    'PersonasService',
    'RegimenesFiscalesService',
    '$state',
    function ($scope, $stateParams, PersonasService, RegimenesFiscalesService, $state) {
        $scope.form_contabilidad_atrasada = {periodo_a_regularizar: '', obligaciones_pendientes: ['-1', '-1', '-1'], regimenes: [], costo_final: ''};
        $scope.calcularCostoContabilidadAtrasada = function () {
            PersonasService.getRegimenesByPersonaId().then(function (data) {
                var costo_sin_descuento = 0;
                var porcentaje_descuento_obligaciones = 0;
                var cantidad_obligaciones_pendientes = 0;
                var porcentaje_descuento_periodo = 0;
                $scope.validacion_checkboxes=false;
                $scope.form_contabilidad_atrasada.costo_final = 0;
                for (var i = 0; i < $scope.form_contabilidad_atrasada.obligaciones_pendientes.length; i++) {
                    if ($scope.form_contabilidad_atrasada.obligaciones_pendientes[i] !== '-1') {
                        cantidad_obligaciones_pendientes++;
                    }
                }
                if (cantidad_obligaciones_pendientes > 0) {
                    $scope.validacion_checkboxes=true;
                    $scope.form_contabilidad_atrasada.regimenes = [];
                    for (var i = 0; i < data.regimenes.length; i++) {
                        $scope.form_contabilidad_atrasada.regimenes.push(data.regimenes[i].regimen_fiscal_id);
                        RegimenesFiscalesService.getById(data.regimenes[i].regimen_fiscal_id).then(function (data_regimenes) {
                            costo_sin_descuento += (parseFloat(data_regimenes.regimen.precio_contabilidad_atrasada) * parseInt($scope.form_contabilidad_atrasada.periodo_a_regularizar) * 13);
                            porcentaje_descuento_obligaciones = (cantidad_obligaciones_pendientes * .4) - ((cantidad_obligaciones_pendientes / 10) - .1);
                            if ($scope.form_contabilidad_atrasada.periodo_a_regularizar !== 6) {
                                porcentaje_descuento_periodo = 1 - (parseInt($scope.form_contabilidad_atrasada.periodo_a_regularizar) * 0.05);
                            } else {
                                porcentaje_descuento_periodo = 0.72;
                            }
                            $scope.form_contabilidad_atrasada.costo_final = Math.round((costo_sin_descuento * porcentaje_descuento_obligaciones.toFixed(2)) * porcentaje_descuento_periodo);
                        });
                    }
                }
            });
        };
        $scope.sendMail = function () {
            alert();
        };
    }
]);

angular.module("app").controller('PersonaPaquetePagadoCtrl', [
    '$scope',
    '$stateParams',
    'PersonasService',
    '$state',
    'PaquetesService',
    function ($scope, $stateParams, PersonasService, $state, PaquetesService) {
        $scope.pagado = false;
        PersonasService.getPaquetesByPersonaId().then(function (data) {
            $scope.paquete_persona = data.paquete;
            if (data.paquete.status === "1") {
                $scope.pagado = true;
                PaquetesService.getById($scope.paquete_persona.paquete_id).then(function (data_paquete) {
                    $scope.paquete = data_paquete.paquete;
                    $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.tipo_pago', false);
                    $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.elegir_paquetes', false);
                    $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.paquete_pagado', true);
                    $scope.$parent.updateToNextStepByStateName('main.menu_registro.paquete_pagado');
                });
            } else {
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.tipo_pago', true);
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.elegir_paquetes', true);
                $scope.$parent.changeListaStatesVisiblesByState('main.menu_registro.paquete_pagado', false);
                $scope.$parent.updateToNextStepByStateName('main.menu_registro.paquete_pagado');
                $state.go('main.menu_registro.elegir_paquetes');
            }
        });
        $scope.goToNextState = function () {
            PersonasService.getDatosById().then(function (data) {
                if (data.persona.contabilidad_atrasada === '-1') {
                    $scope.$parent.updateToNextStepByStateName('main.menu_registro.resumen');
                    $state.go('main.menu_registro.resumen');
                } else {
                    alert('que paso perro por aqui no pasas por tu conta atrasada');
                }
            });
        };
    }
]);
angular.module("app").controller('PersonaEfectivoCtrl', [
    '$scope',
    '$stateParams',
    'PersonasService',
    'ngDialog',
    '$state',
    function ($scope, $stateParams, PersonasService, ngDialog, $state) {
        $scope.url_pago_efectivo = base_url + "files/get_codigo_pago_by_persona_id/";
        $scope.showMapaModal = function () {
            ngDialog.open({
                template: base_url + 'templates/dialogs/mapa-tiendas.html',
                controller: 'PersonaEfectivoCtrl',
                width: '60%'
            });
        };

        $scope.showTiendasModal = function () {
            ngDialog.open({
                template: base_url + 'templates/dialogs/tiendas-afiliadas.html',
                controller: 'PersonaEfectivoCtrl',
                width: '60%'
            });
        };

        $scope.showTarjetaAmazonModal = function () {
            ngDialog.open({
                template: base_url + 'templates/dialogs/tarjeta-amazon.html',
                controller: 'PersonaEfectivoCtrl',
                width: '60%'
            });
        };

        $scope.goToNextState = function () {
            PersonasService.getDatosById().then(function (data) {
                if (data.persona.contabilidad_atrasada === '-1') {
                    $state.go('main.menu_registro.resumen');
                } else {
                    alert('que paso perro por aqui no pasas por tu conta atrasada');
                }
            });
        };
    }
]);
angular.module("app").controller('PersonaResumenCtrl', [
    '$scope',
    'ngDialog',
    'PersonasService',
    'ColoniasService',
    'DocumentosFiscalesService',
    function ($scope, ngDialog, PersonasService, ColoniasService, DocumentosFiscalesService) {
        PersonasService.getDatosById().then(function (data) {
            $scope.url = '';
            $scope.tipos = [{
                    tipo: 'Persona Física',
                    value: 1,
                    selected: true
                }];
            $scope.datos_persona = data.persona;
            $scope.datos_persona.tipo = 1;
            if ($scope.datos_persona.contabilidad_atrasada === "1") {
                $scope.datos_persona.contabilidad_atrasada = "Sí";
            } else {
                $scope.datos_persona.contabilidad_atrasada = "No";
            }
            if ($scope.datos_persona.tiene_efirma_vigente === "1") {
                $scope.datos_persona.tiene_efirma_vigente = "Sí";
            } else {
                $scope.datos_persona.tiene_efirma_vigente = "No";
            }
            var colonia_id = parseInt($scope.datos_persona.colonia_id);
            ColoniasService.getColoniaById(colonia_id).then(function (data_response) {
                $scope.colonias = data_response.colonia;
                $scope.datos_persona.codigo_postal = $scope.colonias[0].cp;
                ColoniasService.getColoniasByCodigoPostal($scope.datos_persona.codigo_postal).then(function (data_response) {
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
            DocumentosFiscalesService.getFilesByPersonaId().then(function (data_response) {
                $scope.files_guardados = {
                    comprobante_domicilio: {id: "", nombre: "", extension: ""},
                    identificacion_oficial_delantera: {id: "", nombre: "", extension: ""},
                    identificacion_oficial_trasera: {id: "", nombre: "", extension: ""},
                    key: {id: "", nombre: "", extension: ""},
                    cer: {id: "", nombre: "", extension: ""}
                };
                if (data_response.list_files.length > 0) {
                    for (var i = 0; i < data_response.list_files.length; i++) {
                        switch (data_response.list_files[i].tipo) {
                            case "1":
                                $scope.files_guardados.key.id = data_response.list_files[i].id;
                                $scope.files_guardados.key.nombre = data_response.list_files[i].nombre;
                                $scope.files_guardados.key.extension = data_response.list_files[i].extension;
                                $scope.files_guardados.key.url = base_url + 'files/get_documento_by_persona_id?persona_id=' + $scope.datos_persona.id + "&file_id=" + $scope.files_guardados.key.id + '.' + $scope.files_guardados.key.extension;
                                break;
                            case "2":
                                $scope.files_guardados.cer.id = data_response.list_files[i].id;
                                $scope.files_guardados.cer.nombre = data_response.list_files[i].nombre;
                                $scope.files_guardados.cer.extension = data_response.list_files[i].extension;
                                $scope.files_guardados.key.url = base_url + 'files/get_documento_by_persona_id?persona_id=' + $scope.datos_persona.id + "&file_id=" + $scope.files_guardados.key.id + '.' + $scope.files_guardados.key.extension;
                                break;
                            case "3":
                                $scope.files_guardados.identificacion_oficial_delantera.id = data_response.list_files[i].id;
                                $scope.files_guardados.identificacion_oficial_delantera.nombre = data_response.list_files[i].nombre;
                                $scope.files_guardados.identificacion_oficial_delantera.extension = data_response.list_files[i].extension;
                                $scope.files_guardados.identificacion_oficial_delantera.url = base_url + 'files/get_documento_by_persona_id?persona_id=' + $scope.datos_persona.id + "&file_id=" + $scope.files_guardados.identificacion_oficial_delantera.id + '.' + $scope.files_guardados.identificacion_oficial_delantera.extension;
                                break;
                            case "4":
                                $scope.files_guardados.identificacion_oficial_trasera.id = data_response.list_files[i].id;
                                $scope.files_guardados.identificacion_oficial_trasera.nombre = data_response.list_files[i].nombre;
                                $scope.files_guardados.identificacion_oficial_trasera.extension = data_response.list_files[i].extension;
                                $scope.files_guardados.identificacion_oficial_trasera.url = base_url + 'files/get_documento_by_persona_id?persona_id=' + $scope.datos_persona.id + "&file_id=" + $scope.files_guardados.identificacion_oficial_trasera.id + '.' + $scope.files_guardados.identificacion_oficial_trasera.extension;
                                break;
                            case "5":
                                $scope.files_guardados.comprobante_domicilio.id = data_response.list_files[i].id;
                                $scope.files_guardados.comprobante_domicilio.nombre = data_response.list_files[i].nombre;
                                $scope.files_guardados.comprobante_domicilio.extension = data_response.list_files[i].extension;
                                $scope.files_guardados.comprobante_domicilio.url = base_url + 'files/get_documento_by_persona_id?persona_id=' + $scope.datos_persona.id + "&file_id=" + $scope.files_guardados.comprobante_domicilio.id + '.' + $scope.files_guardados.comprobante_domicilio.extension;
                                break;
                        }
                    }
                }
            });
            $scope.downloadFileDocumentosFiscalesById = function (persona_id, file) {
                location.href = base_url + 'descargas/download_documentos_fiscales_by_id?persona_id=' + persona_id + "&file_id=" + file.id;
            };

            $scope.openFileDocumentosFiscalesById = function (persona_id, file) {
                location.href = base_url + 'files/get_documento_by_persona_id?persona_id=' + persona_id + "&file_id=" + file.id + '.' + file.extension;
            };

            $scope.clickToOpen = function (extension, url) {
                if (esPdf(extension)) {
                    $scope.url = url;
                    abrirPdf();
                } else {
                    $scope.url = url;
                    abrirImagen();
                }
            };
            function esPdf(extension) {
                return extension === 'pdf';
            }
            function abrirPdf() {
                ngDialog.open({
                    template: base_url + 'templates/dialogs/dialog-pdf.html',
                    controller: 'PersonaResumenCtrl',
                    width: '60%',
                    scope: $scope
                });
            }

            function abrirImagen() {
                ngDialog.open({
                    template: base_url + 'templates/dialogs/dialog-jpeg.html',
                    controller: 'PersonaResumenCtrl',
                    width: '60%',
                    scope: $scope
                });
            }


        });
    }
]);