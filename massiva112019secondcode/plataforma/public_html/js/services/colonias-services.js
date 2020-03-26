/* global api_url */

angular.module("app").service("ColoniasService", [
    '$uhttp',
    function ($uhttp) {
        this.getColoniasByCodigoPostal = function (codigo_postal) {
            return $uhttp({
                url: api_url + "colonias/get_all_colonias_by_codigo_postal",
                params: {codigo_postal: codigo_postal}
            });
        };

        this.getColoniaById = function (id) {
            return $uhttp({
                url: api_url + "colonias/get_colonia_by_id",
                params: {
                    id: id
                }
            });
        };
    }
]);


