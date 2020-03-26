/* global api_url */

angular.module("app").service("RegimenesFiscalesService", [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_by_id',
                params: {id: id}
            });
        };
        this.getByTipo = function () {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_by_tipo'
            });
        };

    }
]);
