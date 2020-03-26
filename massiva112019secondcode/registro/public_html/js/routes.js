/* global angular */

angular.module("app").run([
    '$rootScope',
    '$state',
    '$transitions',
    function ($rootScope, $state, $transitions) {
        $transitions.onStart({}, function (transition) {
            var persona_id = $rootScope.usuario_acceso.persona_id;
            var authenticate = transition.to().authenticate;
            if (typeof authenticate !== "undefined") {
                if (persona_id === null) {
                    $state.transitionTo('main.menu_inicio.datos_fiscales');
                }
            }
        });
    }
]);
angular.module("app").config([
    '$stateProvider',
    '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/datos-fiscales');
        $stateProvider.state('main', {
            templateUrl: 'templates/menu.html',
            controller: "MenuCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/session-controllers.js',
                            'js/services/session-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_inicio', {
            templateUrl: 'templates/menu-inicio.html'
        });
        $stateProvider.state('main.menu_inicio.datos_fiscales', {
            url: '/datos-fiscales',
            templateUrl: 'templates/persona/persona-datos-fiscales-form.html',
            controller: "PersonaDatosFiscalesCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js',
                            'js/services/colonias-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro', {
            url: "/pre-registro",
            templateUrl: 'templates/menu-registro.html',
            controller: "MenuRegistroCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/menu-registro-controllers.js',
                            'js/services/documentos-fiscales-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.datos_fiscales', {
            url: '/datos-fiscales',
            templateUrl: 'templates/persona/persona-datos-fiscales-form.html',
            controller: "PersonaDatosFiscalesUpdateCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js',
                            'js/services/colonias-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.documentos_fiscales', {
            url: '/documentos-fiscales',
            templateUrl: 'templates/persona/persona-documentos-fiscales-form.html',
            controller: "PersonaDocumentosFiscalesCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            {
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
                                    'js/filters/filters.js',
                                    'js/controllers/documentos-fiscales-controllers.js',
                                    'js/services/documentos-fiscales-services.js',
                                    'js/services/personas-services.js'
                                ]
                            }
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.elegir_paquetes', {
            url: '/paquetes',
            templateUrl: 'templates/persona/persona-elegir-paquetes-form.html',
            controller: "PersonaPaquetesCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js',
                            'js/services/regimenes-fiscales-services.js',
                            'js/services/paquetes-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.paquete_pagado', {
            url: '/paquete-pagado',
            templateUrl: 'templates/persona/paquete_pagado.html',
            controller: "PersonaPaquetePagadoCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js',
                            'js/services/paquetes-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.tipo_pago', {
            url: '/tipo-pago',
            templateUrl: 'templates/persona/persona-tipo-pago-form.html',
            controller: "PersonaTipoPagoCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.tipo_pago.tarjeta_bancaria', {
            url: '/tarjeta-bancaria',
            templateUrl: 'templates/persona/forms-tipo-pago/tarjeta-bancaria-form.html',
            controller: "PersonaTarjetaBancariaCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.tipo_pago.transferencia_bancaria', {
            url: '/transferencia-bancaria',
            templateUrl: 'templates/persona/forms-tipo-pago/transferencia-bancaria-form.html',
            controller: "PersonaTransferenciaBancariaCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.tipo_pago.pago_efectivo', {
            url: '/pago-efectivo',
            templateUrl: 'templates/persona/forms-tipo-pago/pago-efectivo-form.html',
            controller: "PersonaEfectivoCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.contabilidad_atrasada', {
            url: '/contabilidad-atrasada',
            templateUrl: 'templates/persona/persona-contabilidad-atrasada.html',
            controller: "PersonaContabilidadAtrasadaCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js',
                            'js/services/regimenes-fiscales-services.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main.menu_registro.resumen', {
            url: '/resumen',
            templateUrl: 'templates/persona/resumen.html',
            controller: "PersonaResumenCtrl",
            authenticate: true,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-services.js',
                            'js/services/colonias-services.js',
                            'js/services/documentos-fiscales-services.js'
                        ]);
                    }
                ]
            }
        });
    }
]);