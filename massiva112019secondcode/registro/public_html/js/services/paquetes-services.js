/* global api_url */

angular.module("app").service("PaquetesService", [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getAllWithRegimenesAsChild = function () {
            return $uhttp({
                url: api_url + 'paquetes/get_all_with_regimenes_as_child'
            });
        };

        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'paquetes/get_by_id',
                params: {id: id}
            });
        };

    }
]);
