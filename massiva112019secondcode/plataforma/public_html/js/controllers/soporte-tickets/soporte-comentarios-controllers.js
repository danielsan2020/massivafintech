/* global base_url */

angular.module("app").controller('SoporteListaComentariosCtrl', [
    '$scope',
    '$rootScope',
    'ngDialog',
    '$state',
    '$stateParams',
    '$interval',
    'SoporteTicketsService',
    'SoporteComentariosService',
    function ($scope, $rootScope, ngDialog, $state, $stateParams, $interval, SoporteTicketsService, SoporteComentariosService) {
        $scope.lista_comentarios = [];
        $scope.soporte_ticket = {};
        $scope.soporte_ticket_form = {tipo: 2, comentario: ""};
        $scope.archivo = {};
        var first_id_comentario = "";
        var last_id_comentario = "";
        var soporte_ticket_id = $stateParams.soporte_ticket_id;
        SoporteTicketsService.getById(soporte_ticket_id).then(function (data_response) {
            $scope.soporte_ticket = data_response.soporte_ticket;
            SoporteComentariosService.getListComentariosBySoporteTicketID(soporte_ticket_id).then(function (data_response) {
                $scope.lista_comentarios = data_response.lista_comentarios.reverse();
                first_id_comentario = $scope.lista_comentarios[0].id;
                last_id_comentario = $scope.lista_comentarios[$scope.lista_comentarios.length - 1].id;
            });
        });
        $scope.submit = function () {
            var data_send = {};
            if ($scope.soporte_ticket_form.tipo === 2) {
                data_send = angular.copy($scope.soporte_ticket_form);
                SoporteComentariosService.createTexto(soporte_ticket_id, data_send).then(function () {
                    $scope.soporte_ticket_form = {tipo: 2, comentario: ""};
                    $scope.archivo = {};
                });
            } else {
                data_send = angular.copy($scope.soporte_ticket_form);
                data_send.file = $scope.archivo.file;
                SoporteComentariosService.createFile(soporte_ticket_id, data_send).then(function () {
                    $scope.soporte_ticket_form = {tipo: 2, comentario: ""};
                    $scope.archivo = {};
                });
            }
            $scope.form_ingresar_comentario.$setPristine();
        };
        $scope.showBeforeComentarios = function () {
            SoporteComentariosService.getNextComentariosBySoporteTicketID(soporte_ticket_id, first_id_comentario).then(function (data_response) {
                for (var i = 0; i < data_response.lista_comentarios.length; i++) {
                    $scope.lista_comentarios.unshift(data_response.lista_comentarios[i]);
                }
                first_id_comentario = $scope.lista_comentarios[0].id;
            });
        };
        $scope.fileDownload = function (comentario) {
            location.href = base_url + 'descargas/download_files_soporte_by_id?soporte_ticket_id=' + soporte_ticket_id + "&file_id=" + comentario.id;
        };
        $scope.fileOpen = function (comentario) {
            location.href = base_url + 'files/open_files_soporte_by_id?soporte_ticket_id=' + soporte_ticket_id + "&file_id=" + comentario.id + '.' + comentario.extension;
        };
        var inteval = $interval(function () {
            getLastComentarios();
        }, 2000);


        function getLastComentarios() {
            SoporteComentariosService.getLastComentariosBySoporteTicketdID(soporte_ticket_id, last_id_comentario).then(function (data_response) {
                for (var i = 0; i < data_response.lista_comentarios.length; i++) {
                    $scope.lista_comentarios.push(data_response.lista_comentarios[i]);
                }
                last_id_comentario = $scope.lista_comentarios[$scope.lista_comentarios.length - 1].id;
            });
        }
        $scope.$on('$destroy', function (e) {
            $interval.cancel(inteval);
        });


        $scope.clickToOpen = function (extension, id) {
            if (esPdf(extension)) {
                $scope.url = base_url + 'files/get_documento_by_ticket_id?soporte_ticket_id=' + soporte_ticket_id + "&file_id=" + id + '.' + extension;

                abrirPdf();
            } else {
                $scope.url = base_url + 'files/get_documento_by_ticket_id?soporte_ticket_id=' + soporte_ticket_id + "&file_id=" + id + '.' + extension;
                abrirImagen();
            }
        };

        function esPdf(extension) {
            return extension === 'pdf';
        }
        function abrirPdf() {
            ngDialog.open({
                template: base_url + 'templates/dialogs/dialog-pdf.html',
                controller: 'SoporteListaComentariosCtrl',
                width: '100%',
                scope: $scope
            });
        }

        function abrirImagen() {
            ngDialog.open({
                template: base_url + 'templates/dialogs/dialog-jpeg.html',
                controller: 'SoporteListaComentariosCtrl',
                width: '100%',
                scope: $scope
            });
        }
    }
]);


