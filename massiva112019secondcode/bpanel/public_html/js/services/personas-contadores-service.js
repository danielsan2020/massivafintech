/* global api_url */

angular.module('app').service('PersonasContadoresService', [

    '$uhttp',
    function ($uhttp) {
        this.getPersonaByPersonaContadorId = function (id) {
            return $uhttp({
                url: api_url + 'personas_contadores/get_persona_by_id',
                params: {
                    id: id
                }
            });
        };
        // ----- POST -----
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'personas_contadores/create',
                method: 'POST',
                data: data
            });
        };
        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'personas_contadores/update',
                method: 'POST',
                params: {
                    id: id
                },
                data: data
            });
        };

        this.getAllDeclaracionesByContadorId = function (contador_id){
            return $uhttp({
                url: api_url + 'personas_contadores/get_all_declaraciones_by_contador_id',
                params: {
                    id: contador_id
                }
            });
        };
        this.getAllDeclaracionesAtrasadasByContadorId = function (contador_id){
            return $uhttp({
                url: api_url + 'personas_contadores/get_all_declaraciones_atrasadas_by_contador_id',
                params: {
                    id: contador_id
                }
            });
        };
        
    }
]);


