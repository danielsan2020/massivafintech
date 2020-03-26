/* global home_url */

angular.module("app").controller('MenuCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    'SessionService',
    'DeclaracionesService',
    function ($scope, $state, $rootScope, SessionService, DeclaracionesService) {
        $scope.necesita_autorizar = false;
        DeclaracionesService.getValidationMonthlyDeclarationByPerson().then(function (data) {
            $scope.necesita_autorizar = data.necesita_autorizar;
        });
        $scope.menu_elements = [
            {
                icon: 'fas fa-home',
                text: 'Inicio',
                state: 'main.home'
            },
            {
                icon: 'fas fa-comments',
                text: 'Soporte',
                state: 'main.soporte_lista_tickets_abierto_pendiente'
            },
            {
                icon: 'fas fa-comments',
                text: 'Declaraciones mensuales atrasadas',
                state: 'main.declaraciones_mensuales_atrasadas'
            },
            {
                icon: 'fas fa-users',
                text: 'Mis clientes',
                state: 'main.personas_clientes_list'
            },
            {
                icon: 'fa fa-car',
                text: 'Activos',
                state: 'main.activos_personas_list_active'
            },
            {
                icon: 'fa fa-car',
                text: 'Mis productos',
                state: 'main.personas_productos_list'
            },
            {
                icon: 'fas fa-file-invoice-dollar',
                text: 'Mis facturas',
                submenu_elements: [
                    {
                        text: 'Facturas',
                        state: 'main.facturas_list',
                    },
                    {
                        text: 'Facturas emitidas',
                        state: 'main.facturas_emitidas_list',
                    },
                    {
                        text: 'Facturas recibidas',
                        state: 'main.facturas_recibidas_list'
                    }
                ]
            }
        ];
        $scope.autorizar_declaracion = function () {
            DeclaracionesService.UpdateMonthlyDeclaration().then(function (data) {
                DeclaracionesService.getValidationMonthlyDeclarationByPerson().then(function (data) {
                    $scope.necesita_autorizar = data.necesita_autorizar;
                });
            });
        };
        $scope.logout = function () {
            SessionService.logout().then(function () {
                delete ($rootScope.usuario_acceso);
                $scope.intentos = 0;
                setTimeout(function () {
                    location.href = home_url;
                }, 500);
            });
        };
        /*
         * Codigo que verifica si tiene nuevos mensajes de soporte
         */

    }
]);
