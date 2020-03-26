angular.module('app').service('FacturasService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {array}  
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'facturas/get_all',
            });
        };
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'facturas/create',
                method: "POST",
                data: data
            });
        };
    }
]);