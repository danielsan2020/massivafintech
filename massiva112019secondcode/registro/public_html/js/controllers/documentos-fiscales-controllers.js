/* global base_url */

angular.module("app").controller('PersonaDocumentosFiscalesCtrl', [
    '$scope',
    '$rootScope',
    '$state',
    'DocumentosFiscalesService',
    'PersonasService',
    function ($scope, $rootScope, $state, DocumentosFiscalesService, PersonasService) {
        $scope.file_comprobante_domicilio = {};
        $scope.file_identificacion_oficial_delantera = {};
        $scope.file_identificacion_oficial_trasera = {};
        $scope.file_key = {};
        $scope.file_cer = {};
        $scope.url_contrato = "";
        $scope.tiene_efirma_vigente = $rootScope.usuario_acceso.tiene_efirma_vigente;
        $scope.cambiar_efirma = false;
        $scope.files_guardados = {
            comprobante_domicilio: {guardado: -1, nombre: "", extension: "", file_edit: false},
            identificacion_oficial_delantera: {guardado: -1, nombre: "", extension: "", file_edit: false},
            identificacion_oficial_trasera: {guardado: -1, nombre: "", extension: "", file_edit: false},
            key: {guardado: -1, nombre: "", extension: "", file_edit: false},
            cer: {guardado: -1, nombre: "", extension: "", file_edit: false}
        };
        $scope.form_documentos_fiscales = {

            efirma: ''
        };
        $scope.cambiarEfirma = function () {
            $scope.cambiar_efirma = !$scope.cambiar_efirma;
        };
        DocumentosFiscalesService.getFilesByPersonaId().then(function (data_response) {
            if (data_response.list_files.length > 0) {
                for (var i = 0; i < data_response.list_files.length; i++) {
                    switch (data_response.list_files[i].tipo) {
                        case "1":
                            $scope.files_guardados.key.guardado = 1;
                            $scope.files_guardados.key.nombre = data_response.list_files[i].nombre;
                            $scope.files_guardados.key.extension = data_response.list_files[i].extension;
                            break;
                        case "2":
                            $scope.files_guardados.cer.guardado = 1;
                            $scope.files_guardados.cer.nombre = data_response.list_files[i].nombre;
                            $scope.files_guardados.cer.extension = data_response.list_files[i].extension;
                            break;
                        case "3":
                            $scope.files_guardados.identificacion_oficial_delantera.guardado = 1;
                            $scope.files_guardados.identificacion_oficial_delantera.nombre = data_response.list_files[i].nombre;
                            $scope.files_guardados.identificacion_oficial_delantera.extension = data_response.list_files[i].extension;
                            break;
                        case "4":
                            $scope.files_guardados.identificacion_oficial_trasera.guardado = 1;
                            $scope.files_guardados.identificacion_oficial_trasera.nombre = data_response.list_files[i].nombre;
                            $scope.files_guardados.identificacion_oficial_trasera.extension = data_response.list_files[i].extension;
                            break;
                        case "5":
                            $scope.files_guardados.comprobante_domicilio.guardado = 1;
                            $scope.files_guardados.comprobante_domicilio.nombre = data_response.list_files[i].nombre;
                            $scope.files_guardados.comprobante_domicilio.extension = data_response.list_files[i].extension;
                            break;
                    }
                }
            }
            PersonasService.getEfirmaByPersonaID().then(function (data_response) {
                $scope.tiene_efirma = data_response;
                $scope.url_contrato = base_url + "files/get_contrato_by_persona_id/";
            });
        });
        $scope.editarFile = function (tipo) {
            switch (tipo) {
                case "1":
                    $scope.files_guardados.key.file_edit = true;
                    $scope.files_guardados.key.guardado = -1;
                    break;
                case "2":
                    $scope.files_guardados.cer.file_edit = true;
                    $scope.files_guardados.cer.guardado = -1;
                    break;
                case "3":
                    $scope.files_guardados.identificacion_oficial_delantera.file_edit = true;
                    $scope.files_guardados.identificacion_oficial_delantera.guardado = -1;
                    break;
                case "4":
                    $scope.files_guardados.identificacion_oficial_trasera.file_edit = true;
                    $scope.files_guardados.identificacion_oficial_trasera.guardado = -1;
                    break;
                case "5":
                    $scope.files_guardados.comprobante_domicilio.file_edit = true;
                    $scope.files_guardados.comprobante_domicilio.guardado = -1;
                    break;
            }
        };
        $scope.cancelEdit = function (tipo) {
            switch (tipo) {
                case "1":
                    $scope.files_guardados.key.file_edit = false;
                    $scope.files_guardados.key.guardado = 1;
                    break;
                case "2":
                    $scope.files_guardados.cer.file_edit = false;
                    $scope.files_guardados.cer.guardado = 1;
                    break;
                case "3":
                    $scope.files_guardados.identificacion_oficial_delantera.file_edit = false;
                    $scope.files_guardados.identificacion_oficial_delantera.guardado = 1;
                    break;
                case "4":
                    $scope.files_guardados.identificacion_oficial_trasera.file_edit = false;
                    $scope.files_guardados.identificacion_oficial_trasera.guardado = 1;
                    break;
                case "5":
                    $scope.files_guardados.comprobante_domicilio.file_edit = false;
                    $scope.files_guardados.comprobante_domicilio.guardado = 1;
                    break;
            }
        };
        $scope.fileKeyUpload = function (file) {
            var data_send = {file: file};
            data_send.tipo = 1;
            data_send.name = file.name;
            var explode = data_send.name.split(".");
            data_send.extension = explode[1];
            DocumentosFiscalesService.create(data_send).then(function () {
                $scope.files_guardados.key.file_edit = false;
                $scope.files_guardados.key.guardado = 1;
                $scope.files_guardados.key.nombre = data_send.name;
                $scope.files_guardados.key.extension = data_send.extension;
            });
        };
        $scope.fileCerUpload = function (file) {
            var data_send = {file: file};
            data_send.tipo = 2;
            data_send.name = file.name;
            var explode = data_send.name.split(".");
            data_send.extension = explode[1];
            DocumentosFiscalesService.create(data_send).then(function () {
                $scope.files_guardados.cer.file_edit = false;
                $scope.files_guardados.cer.guardado = 1;
                $scope.files_guardados.cer.nombre = data_send.name;
                $scope.files_guardados.cer.extension = data_send.extension;
            });
        };
        $scope.fileIdentificacionOficialDelanteraUpload = function (file) {
            var data_send = {file: file};
            data_send.tipo = 3;
            data_send.name = file.name;
            var explode = data_send.name.split(".");
            data_send.extension = explode[1];
            DocumentosFiscalesService.create(data_send).then(function () {
                $scope.files_guardados.identificacion_oficial_delantera.file_edit = false;
                $scope.files_guardados.identificacion_oficial_delantera.guardado = 1;
                $scope.files_guardados.identificacion_oficial_delantera.nombre = data_send.name;
                $scope.files_guardados.identificacion_oficial_delantera.extension = data_send.extension;
            });
        };
        $scope.fileIdentificacionOficialTraseraUpload = function (file) {
            var data_send = {file: file};
            data_send.tipo = 4;
            data_send.name = file.name;
            var explode = data_send.name.split(".");
            data_send.extension = explode[1];
            DocumentosFiscalesService.create(data_send).then(function () {
                $scope.files_guardados.identificacion_oficial_trasera.file_edit = false;
                $scope.files_guardados.identificacion_oficial_trasera.guardado = 1;
                $scope.files_guardados.identificacion_oficial_trasera.nombre = data_send.name;
                $scope.files_guardados.identificacion_oficial_trasera.extension = data_send.extension;
            });
        };
        $scope.fileComprobanteDomicilioUpload = function (file) {
            var data_send = {file: file};
            data_send.tipo = 5;
            data_send.name = file.name;
            var explode = data_send.name.split(".");
            data_send.extension = explode[1];
            DocumentosFiscalesService.create(data_send).then(function () {
                $scope.files_guardados.comprobante_domicilio.file_edit = false;
                $scope.files_guardados.comprobante_domicilio.guardado = 1;
                $scope.files_guardados.comprobante_domicilio.nombre = data_send.name;
                $scope.files_guardados.comprobante_domicilio.extension = data_send.extension;
            });
        };
        $scope.submit = function () {
            var data_send = {efirma: angular.copy($scope.form_documentos_fiscales.efirma), tiene_efirma: angular.copy($scope.tiene_efirma), cambiar_efirma: angular.copy($scope.cambiar_efirma)};
            console.log(data_send);
            PersonasService.updateEfirma(data_send).then(function () {
                $scope.$parent.updateToNextStepByStateName('main.menu_registro.documentos_fiscales');
                $state.go('main.menu_registro.elegir_paquetes');
            });
        };
    }
]);


