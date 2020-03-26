/* global api_url */

angular.module('app').service('PersonasServices', [
    '$uhttp',
    function ($uhttp) {
        this.getListPersonasByContadorId = function (contador_id) {
            return $uhttp({
                url: api_url + 'personas/get_all_personas_by_contador_id',
                params:{
                    id: contador_id
                }
            });
        };
    }
]);





