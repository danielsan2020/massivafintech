/* global api_url */

angular.module('app').service('SessionService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.logout = function () {
            return $uhttp({
                url: api_url + 'session/logout',
            });
        };
    }
]);
