angular.module("app").controller('DescargasListPersonasCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    'DescargasServices',
    'PersonasServices',
    function ($scope, $state, $rootScope, DescargasServices, PersonasServices) {
        var contador_id = $rootScope.usuario_acceso.id;
        $scope.personas = [];
        $scope.personas.show_password = false;
        PersonasServices.getListPersonasByContadorId(contador_id).then(function (data_response) {
            $scope.personas = data_response.personas;
            console.log($scope.personas);
            for (var i = 0; i < $scope.personas.length; i++) {
                $scope.personas[i].files = [];
            }
        });
        $scope.getFilesDocumentosFiscales = function (persona) {
            DescargasServices.getFilesByPersonaId(persona.id).then(function (data_response) {
                persona.show_files = true;
                persona.files = data_response.files;
            });
        };
        $scope.hideFiles = function (persona) {
            persona.show_files = false;
        };
        $scope.downloadZip = function (persona) {
            location.href = base_url + 'descargas/download_file_zip?persona_id=' + persona.id;
        };
        $scope.downloadFileDocumentosFiscalesById = function (persona_id, file) {
            location.href = base_url + 'descargas/download_documentos_fiscales_by_id?persona_id=' + persona_id + "&file_id=" + file.id;
        };
    }
]);


