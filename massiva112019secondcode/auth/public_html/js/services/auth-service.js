/* global api_url */
angular.module("app").service("AuthService", [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.login = function (data) {
            return  $uhttp({
                url: api_url + 'auth/acceso',
                method: 'POST',
                data: data
            });
        };
        this.logout = function () {
            return $uhttp({
                url: api_url + "auth/logout",
                method: 'POST'
            });
        };
        this.passwordChange = function (data) {
            return $uhttp({
                url: api_url + "auth/password_change",
                method: 'POST',
                data: data
            });
        };
    }
]);
