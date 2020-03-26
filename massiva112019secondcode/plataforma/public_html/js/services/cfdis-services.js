/* global api_url */

angular.module('app').service('CfdisService', [
    '$uhttp',
    function ($uhttp) {
         // ----- GET -----
        /**
         @return {object}  activosList
         */
        this.getListEmitidas = function () {
            return $uhttp({
                url: api_url + 'cfdis/get_all_emitidas'
            });
        };
        this.getListRecibidas = function () {
            return $uhttp({
                url: api_url + 'cfdis/get_all_recibidas'
            });
        };
    }
]);