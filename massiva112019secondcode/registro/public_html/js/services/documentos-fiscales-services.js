angular.module("app").service("DocumentosFiscalesService", [
    '$uhttp',
    function ($uhttp) {
        this.getFilesByPersonaId = function () {
            return $uhttp({
                url: api_url + "documentos_fiscales/get_files_by_persona_id"
            });
        };
        this.create = function (data) {
            return $uhttp({
                url: api_url + "documentos_fiscales/create",
                data: data,
                method: "POST"
            });
        };
    }
]);

