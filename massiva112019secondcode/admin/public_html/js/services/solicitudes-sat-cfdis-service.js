/* global api_url, angular */

angular.module('app').service('SolicitudesSatCfdisService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getListByPersonaId = function (persona_id) {
            return $uhttp({
                url: api_url + 'solicitudes_sat_cfdis/get_all_solicitudes_sat_cfdis_by_perona_id/persona_id/' + persona_id
            });
        };

        /**
         @param {int} solicitud_id
         */
        this.descargarCfdis = function (solicitud_id) {
            return $uhttp({
                url: api_url + 'solicitudes_sat_cfdis/descargar_cfdis/solicitud_id/' + solicitud_id,
                method: 'GET'
            });
        };

        /**
         @param {int} persona_id
         */
        this.solicitarCfdis = function (persona_id) {
            return $uhttp({
                url: api_url + 'solicitudes_sat_cfdis/solicitar_cfdis',
                method: 'POST',
                params: {
                    persona_id: persona_id
                }
            });
        };


    }
]);
