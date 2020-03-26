/* global api_url */

angular.module('app').service('DescargasServices', [
    '$uhttp',
    function ($uhttp) {
        this.getFilesByPersonaId = function (persona_id) {
            return $uhttp({
                url: api_url + 'descargas/get_files_by_persona_id',
                params: {
                    persona_id: persona_id
                }
            });
        };
    }
]);

