/* global angular, home_url */

angular.module("app").controller('MenuCtrl', [
    '$scope',
    '$rootScope',
    'SessionService',
    function ($scope, $rootScope, SessionService) {
        $scope.logout = function () {
            SessionService.logout().then(function () {
                delete ($rootScope.usuario_acceso);
                $scope.intentos = 0;
                setTimeout(function () {
                    location.href = home_url;
                }, 500);
            });
        };
    }
]);


