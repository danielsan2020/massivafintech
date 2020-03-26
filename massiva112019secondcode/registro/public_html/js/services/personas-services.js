/* global api_url */

angular.module("app").service("PersonasService", [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getEfirmaByPersonaID = function () {
            return $uhttp({
                url: api_url + "personas/get_efirma_by_persona_id"
            });
        };

        this.getDatosById = function () {
            return $uhttp({
                url: api_url + 'personas/get_datos'
            });
        };
        
        this.getRegimenesByPersonaId = function () {
            return $uhttp({
                url: api_url + 'personas/get_regimenes_by_persona_id'
            });
        };
        this.getPaquetesByPersonaId = function () {
            return $uhttp({
                url: api_url + 'personas/get_paquetes_by_persona_id'
            });
        };
        // ----- POST -----
        this.createRegistro = function (data) {
            return $uhttp({
                url: api_url + "personas/create_registro",
                data: data,
                method: "POST"
            });
        };
        this.createPersona = function (data) {
            return $uhttp({
                url: api_url + 'personas/create',
                method: 'POST',
                data: data
            });
        };

        this.payWithTarjetaBancaria = function (data) {
            return $uhttp({
                url: api_url + 'personas/pay_with_tarjeta_bancaria',
                method: 'POST',
                data: data
            });
        };

        this.updatePersona = function (id, data) {
            return $uhttp({
                url: api_url + 'personas/update',
                method: 'POST',
                params: {
                    id: id
                },
                data: data
            });
        };
        this.savePaqueteAndRegimenes = function (data) {
            return $uhttp({
                url: api_url + 'personas/save_paquete_and_regimenes',
                method: 'POST',
                data: data
            });
        };
        this.updateEfirma = function (data) {
            return $uhttp({
                url: api_url + 'personas/update_efirma',
                method: 'POST',
                data: data
            });
        };
        this.enviarCorreoNoTengoEfirma = function (usuario_id) {
            return $uhttp({
                url: api_url + 'personas/enviar_correo_no_tengo_efirma_vigente_by_usuario_id',
                params: {
                    id: usuario_id
                }
            });
        };

    }
]);
