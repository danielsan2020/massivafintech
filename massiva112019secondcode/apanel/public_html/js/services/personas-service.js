/* global api_url */

angular.module('app').service('PersonasService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getListPersonasSinContador = function (id) {
            return $uhttp({
                url: api_url + 'personas/get_all_personas_sin_contador',
                params: {
                    id: id
                }
            });
        };
        
        this.getListPersonasConContador = function (id){
            return $uhttp({
                url: api_url + 'personas/get_all_personas_con_contador',
                params:{
                    id: id
                }
            });
        };
        
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'personas/get_by_id',
                params: {
                    id: id
                }
            });
        };
    }
]);
