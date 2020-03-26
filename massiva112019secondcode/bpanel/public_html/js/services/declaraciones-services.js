/* global api_url */

angular.module('app').service('DeclaracionesServices', [
    '$uhttp',
    function ($uhttp) {
//        this.getFilesByPersonaId = function (persona_id) {
//            return $uhttp({
//                url: api_url + 'descargas/get_files_by_persona_id',
//                params: {
//                    persona_id: persona_id
//                }
//            });
//        };
        this.getDeclaracionByPersonaIdAndDeclaracionId = function(persona_id, declaracion_id){
            return $uhttp({
                url: api_url + 'personas_contadores/get_declaracion_by_persona_id_and_declaracion_id',
                params: {
                    persona_id: persona_id,
                    declaracion_id:declaracion_id
                }
            });
        };
        this.getDeclaracionAtrasadaByPersonaIdAndDeclaracionId = function(persona_id, declaracion_id){
            return $uhttp({
                url: api_url + 'personas_contadores/get_declaracion_atrasada_by_persona_id_and_declaracion_id',
                params: {
                    persona_id: persona_id,
                    declaracion_id:declaracion_id
                }
            });
        };
        this.subir_archivos_adjuntos_para_pago = function (data){
            return $uhttp({
                url: api_url + 'declaraciones/subir_archivos_adjuntos_para_pago',
                method: 'POST',
                data: data
            });
        }
    }
]);

