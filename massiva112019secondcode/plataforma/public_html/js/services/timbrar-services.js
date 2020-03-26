angular.module('app').service('TimbrarService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {}
         */
        this.timbrar_cfdi = function (id) {
            return $uhttp({
                url: api_url + 'timbrar_cfdi/timbrar',
                params: {id: id}
            });
        };
    }
]);