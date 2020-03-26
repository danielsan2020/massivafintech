/* global api_url */


angular.module('app').service('UsuariosService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getListContadoresAndPersonas = function (id_jefe) {
            return $uhttp({
                url: api_url + 'usuarios/get_all_contadores_y_personas_de_cada_contador',
                params: {
                    id: id_jefe
                }
            });
        };
        
        this.getContadoresAsignadosList = function (){
            return $uhttp({
                url: api_url + 'usuarios/get_all_contadores_asignados'
            });
        };
//          this.getListJefesContadoresAndPersonas = function (){
//            return $uhttp({
//                url: api_url + 'usuarios/get_all_jefes_contadores_y_personas_de_cada_contador'
//            });
//        };
    }
]);