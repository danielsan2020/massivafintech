angular.module("app").config(['$httpProvider', '$stateProvider', '$urlRouterProvider',
    function ($httpProvider, $stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/home');
        $stateProvider.state('main', {
            templateUrl: 'templates/menu.html',
            controller: 'MenuCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/menu-controllers.js',
                            'js/services/session-service.js',
                        ]);
                    }]
            }
        })
        $stateProvider.state('main.home', {
            url: '/home',
            templateUrl: 'templates/home.html',
//            controller: "HomeCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
//                            'js/controllers/home_controllers.js',
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.descargas_list_personas', {
            url: '/descargas',
            templateUrl: 'templates/descargas/descargas-list-personas.html',
            controller: "DescargasListPersonasCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/descargas-controllers.js',
                            'js/services/descargas-services.js',
                            'js/services/personas-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.soporte_list', {
            url: '/soporte',
            templateUrl: 'templates/soporte-tickets/soporte-list.html',
            controller: "SoporteListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/soporte-tickets-controllers.js',
                            'js/services/soporte-tickets-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.soporte_lista_comentarios', {
            url: '/soporte-lista-comtentarios/:{soporte_ticket_id: int}/{persona_id: int}',
            templateUrl: 'templates/soporte-tickets/soporte-comentarios-list.html',
            controller: "SoporteComentariosListCtrl",
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
                                    'js/controllers/soporte-comentarios-controllers.js',
                                    'js/services/soporte-comentarios-services.js',
                                    'js/services/soporte-tickets-services.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.show_declaraciones', {
            url: '/show-declaraciones',
            templateUrl: 'templates/declaraciones/declaraciones-list.html',
            controller: 'DeclaracionesControllers',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/declaraciones-controllers.js',
                            'js/services/personas-contadores-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.show_declaraciones_atrasadas', {
            url: '/show-declaraciones-atrasadas',
            templateUrl: 'templates/declaraciones/declaraciones-list.html',
            controller: 'DeclaracionesAtrasadasControllers',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/declaraciones-controllers.js',
                            'js/services/personas-contadores-service.js',
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.declaraciones_adjuntar_para_pago', {
            url: '/declaraciones/adjuntar-para-pago/:persona_id/:declaracion_id',
            templateUrl: 'templates/declaraciones/adjuntar-form.html',
            controller: "DeclaracionesAdjuntarParaPagoController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
//                            'js/controllers/declaraciones-controllers.js',
//                            'js/services/usuarios-service.js'
                            {
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
//                                    'js/filters/filters.js',
//                                    'js/controllers/personas-productos-controllers.js',
//                                    'js/services/unidades-de-medida-services.js',
//                                    'js/services/personas-productos-services.js',
                                    'js/services/declaraciones-services.js',
                                    'js/controllers/declaraciones-controllers.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.declaraciones_atrasadas_adjuntar_para_pago', {
            url: '/declaraciones_atrasadas/adjuntar-para-pago/:persona_id/:declaracion_id',
            templateUrl: 'templates/declaraciones/adjuntar-form.html',
            controller: "DeclaracionesAtrasadasAdjuntarParaPagoController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
//                            'js/controllers/declaraciones-controllers.js',
//                            'js/services/usuarios-service.js'
                            {
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
//                                    'js/filters/filters.js',
//                                    'js/controllers/personas-productos-controllers.js',
//                                    'js/services/unidades-de-medida-services.js',
//                                    'js/services/personas-productos-services.js',
//                                    'js/services/productos-sat-services.js'
                                    'js/services/declaraciones-services.js',
                                    'js/controllers/declaraciones-controllers.js'
                                ]
                            }
                        ]);
                    }]
            }
        });


    }
]);
//.state('cms.form_pass', {
//            url: '/form_pass',
//            templateUrl: 'templates/form_pass.html',
//            controller: 'NewPassCtrl',
//            resolve: {
//                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
//                        return $ocLazyLoad.load([
//                            'js/controllers/home_controllers.js',
//                            'js/factories/login_model_factory.js'
//                        ]);
//                    }]
//            }
//        });
