//Controlador del home
angular.module("app").controller('HomeCtrl', [
    '$scope',
    '$rootScope',
    function ($scope, $rootScope) {
        $scope.lista_urls = [];
        if ($rootScope.usuario_acceso !== undefined) {
            if ($rootScope.usuario_acceso.tipo === "1") {
                $scope.lista_urls = $rootScope.usuario_acceso.url;
            } else {
                location.href = $rootScope.usuario_acceso.url;
            }
        }
    }
]);
//angular.module("app").controller('NewPassCtrl', [
//    '$scope',
//    '$state',
//    '$rootScope',
//    'UsuarioService',
//    function ($scope, $state, $rootScope, UsuarioService) {
//        $scope.form = {
//            pass: '',
//            newpass: '',
//            renewpass: ''
//        };
//        $scope.submit = function () {
//            var data = {pass: hex_md5($scope.form.pass), newpass: hex_md5($scope.form.newpass), renewpass: hex_md5($scope.form.renewpass)};
//            UsuarioService.cambioPass(data).then(function (data_response) {
//                if ($rootScope.usuario_acceso.permisos.length === 1) {
//                    switch (parseInt($rootScope.usuario_acceso.permisos[0].sitio)) {
//                        case 1:
//                            location.href = users_url;
//                            break;
//                        case 2:
//                            location.href = federales_url;
//                            break;
//                        case 3:
//                            location.href = estatales_url; 
//                            break;
//                        case 4:
//                            location.href = multilaterales_url; 
//                            break;
//                        case 5:
//                            location.href = principal_url;
//                            break;
//                    }
//                } else {
//                    $state.go("cms.home");
//                }
//            });
//        };
//    }
//]);
