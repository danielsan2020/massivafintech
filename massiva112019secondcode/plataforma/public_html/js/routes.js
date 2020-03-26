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
                            'js/services/session-services.js',
                            'js/services/declaraciones-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.home', {
            url: '/home',
            templateUrl: 'templates/home.html'
        });
        //MIS CIENTES
        $stateProvider.state('main.personas_clientes_list', {
            url: '/misclientes/lista-de-misclientes',
            templateUrl: 'templates/personas-clientes/personas-clientes-list.html',
            controller: "PersonasClientesListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-clientes-controllers.js',
                            'js/services/personas-clientes-services.js'
                        ]);
                    }]
            }
        }).state('main.personas_clientes_list_inactive', {
            url: '/misclientes/lista-de-misclientes-inactivos',
            templateUrl: 'templates/personas-clientes/personas-clientes-inactive-list.html',
            controller: "PersonasClientesListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-clientes-controllers.js',
                            'js/services/personas-clientes-services.js'

                        ]);
                    }]
            }
        }).state('main.personas_clientes_create', {
            url: '/misclientes/agregar-cliente',
            templateUrl: 'templates/personas-clientes/personas-clientes-form.html',
            controller: "PersonasClientesCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([{
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
                                    'js/controllers/personas-clientes-controllers.js',
                                    'js/services/personas-clientes-services.js',
                                    'js/services/colonias-services.js'
                                ]
                            }
                        ]);
                    }]
            }
        }).state('main.personas_clientes_edit', {
            url: '/misclientes/agregar-cliente/:id',
            templateUrl: 'templates/personas-clientes/personas-clientes-form.html',
            controller: "PersonasClientesUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            {
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
                                    'js/controllers/personas-clientes-controllers.js',
                                    'js/services/personas-clientes-services.js',
                                    'js/services/colonias-services.js'
                                ]
                            }, {
                                name: 'ngDialog',
                                serie: true,
                                files: [
                                    'js/modules/ngDialog.min.js',
                                    'css/ngDialog-theme-default.min.css',
                                    'css/ngDialog.min.css'
                                ]
                            }
                        ]);
                    }]
            }

//              resolve: {
//                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
//                        return $ocLazyLoad.load([
//                            {
//                                name: 'ngFileUpload',
//                                serie: true,
//                                files: [
//                                    'js/modules/ng-file-upload.min.js',
//                                    'js/modules/ng-file-upload-shim.min.js',
//                                    'js/filters/filters.js',
//                                    'js/controllers/soporte-tickets/soporte-comentarios-controllers.js',
//                                    'js/services/soporte-tickets/soporte-tickets-services.js',
//                                    'js/services/soporte-tickets/soporte-comentarios-services.js',
//                                    'js/services/soporte-tickets/soporte-categorias-services.js'
//                                ]
//                            }, {
//                                name: 'ngDialog',
//                                serie: true,
//                                files: [
//                                    'js/modules/ngDialog.min.js',
//                                    'css/ngDialog-theme-default.min.css',
//                                    'css/ngDialog.min.css'
//                                ]
//                            }
//                        ]);
//                    }]
//            }
        });
        $stateProvider.state('main.soporte_lista_tickets_abierto_pendiente', {
            url: '/lista-tickets',
            templateUrl: 'templates/soporte-tickets/soporte-tickets-lista.html',
            controller: 'SoporteListaTicketAbiertoPendienteCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/soporte-tickets/soporte-tickets-controllers.js',
                            'js/services/soporte-tickets/soporte-tickets-services.js',
                            'js/services/usuarios-personas-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.soporte_lista_tickets_cerrado', {
            url: '/lista-tickets',
            templateUrl: 'templates/soporte-tickets/soporte-tickets-lista.html',
            controller: 'SoporteListaCerradoCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/soporte-tickets/soporte-tickets-controllers.js',
                            'js/services/soporte-tickets/soporte-tickets-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.soporte_create_ticket', {
            url: '/crear-tickets',
            templateUrl: 'templates/soporte-tickets/soporte-tickets-form.html',
            controller: 'SoporteCreateTicketCtrl',
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
                                    'js/controllers/soporte-tickets/soporte-tickets-controllers.js',
                                    'js/services/soporte-tickets/soporte-tickets-services.js',
                                    'js/services/soporte-tickets/soporte-categorias-services.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.soporte_lista_comentarios', {
            url: '/ticket/comentarios/{soporte_ticket_id:int}',
            templateUrl: 'templates/soporte-tickets/soporte-lista-comentarios.html',
            controller: 'SoporteListaComentariosCtrl',
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
                                    'js/controllers/soporte-tickets/soporte-comentarios-controllers.js',
                                    'js/services/soporte-tickets/soporte-tickets-services.js',
                                    'js/services/soporte-tickets/soporte-comentarios-services.js',
                                    'js/services/soporte-tickets/soporte-categorias-services.js'
                                ]
                            }, {
                                name: 'ngDialog',
                                serie: true,
                                files: [
                                    'js/modules/ngDialog.min.js',
                                    'css/ngDialog-theme-default.min.css',
                                    'css/ngDialog.min.css'
                                ]
                            }
                        ]);
                    }]
            }
        });
//        $stateProvider.state('main.soporte_lista_comentarios', {
//            url: '/ticket/comentarios/:{id:int}',
//            templateUrl: 'templates/soporte/soporte-form.html',
//            controller:'SoporteListaComentariosCtrl'
//        });
//DECLARACIONES MENSUALES ATRASADAS
        $stateProvider.state('main.declaraciones_mensuales_atrasadas', {
            url: '/declaraciones_mensuales_atrasadas',
            templateUrl: 'templates/declaraciones-mensuales-atrasadas/declaraciones_mensuales_atrasadas.html',
            controller: "DeclaracionesAtrasadasListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/declaraciones-atrasadas-controller.js',
                            'js/services/declaraciones-atrasadas-services.js'
                        ]);
                    }]
            }
        });

        //Activos de personas
        $stateProvider.state('main.activos_personas_list_active', {
            url: '/lista-personas-bienes-activos',
            templateUrl: 'templates/activos/activos_list.html',
            controller: "ActivosListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/activos-controllers.js',
                            'js/services/activos-service.js'
                        ]);
                    }]
            }
        }).state('main.activos_personas_list_inactive', {
            url: '/misclientes/lista-personas-bienes-inactivos',
            templateUrl: 'templates/activos/activos_list.html',
            controller: "ActivosListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/activos-controllers.js',
                            'js/services/activos-service.js'

                        ]);
                    }]
            }
        });
        $stateProvider.state('main.activos_create', {
            url: '/crear-activos',
            templateUrl: 'templates/activos/activos_form.html',
            controller: "ActivosCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/activos-controllers.js',
                            'js/services/activos-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.activos_edit', {
            url: '/activos/editar-activos-tickets/:id',
            templateUrl: 'templates/activos/activos_form.html',
            controller: "ActivosUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/activos-controllers.js',
                            'js/services/activos-service.js'
                        ]);
                    }]
            }
        });
        //Facturas
        $stateProvider.state('main.facturas_list', {
            url: '/facturas',
            templateUrl: 'templates/facturas/facturas-list.html',
            controller: "FacturasListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/facturas-controllers.js',
                            'js/services/facturas-services.js',
                            'js/services/timbrar-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.facturas_create', {
            url: '/crear-factura',
            templateUrl: 'templates/facturas/facturas-form.html',
            controller: "FacturasCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/facturas-controllers.js',
                            'js/services/facturas-services.js',
                            'js/services/personas-clientes-services.js',
                            'js/services/personas-productos-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.facturas_emitidas_list',{
           url: '/facturas-emitidas',
           templateUrl: 'templates/facturas/facturas-cfdis-list.html',
           controller: 'FacturasEmitidasListCtrl',
           resolve:{
               loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/facturas-controllers.js',
                            'js/services/cfdis-services.js'
                        ]);
                    }]
           }
        });
        $stateProvider.state('main.facturas_recibidas_list',{
           url: '/facturas-recibidas',
           templateUrl: 'templates/facturas/facturas-cfdis-list.html',
           controller: 'FacturasRecibidasListCtrl',
           resolve:{
               loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/facturas-controllers.js',
                            'js/services/cfdis-services.js'
                        ]);
                    }]
           }
        });
        //Personas y sus productos
        $stateProvider.state('main.personas_productos_list', {
            url: '/productos',
            templateUrl: 'templates/personas-productos/personas-productos-list.html',
            controller: "PersonasProductosListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-productos-controllers.js',
                            'js/services/personas-productos-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.personas_productos_create', {
            url: '/crear-producto',
            templateUrl: 'templates/personas-productos/personas-productos-form.html',
            controller: "PersonasProductosCreateCtrl",
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
                                    'js/controllers/personas-productos-controllers.js',
                                    'js/services/unidades-medida-services.js',
                                    'js/services/personas-productos-services.js',
                                    'js/services/productos-sat-services.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.personas_productos_list_inactive', {
            url: '/productos-inactivos',
            templateUrl: 'templates/personas-productos/personas-productos-inactive-list.html',
            controller: "PersonasProductosListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-productos-controllers.js',
                            'js/services/personas-productos-services.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.personas_productos_edit', {
            url: '/editar-producto/:id',
            templateUrl: 'templates/personas-productos/personas-productos-form.html',
            controller: "PersonasProductosUpdateCtrl",
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
                                    'js/controllers/personas-productos-controllers.js',
                                    'js/services/unidades-medida-services.js',
                                    'js/services/personas-productos-services.js',
                                    'js/services/productos-sat-services.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.perfil', {
            url: '/perfil',
            templateUrl: 'templates/perfil/persona-datos-fiscales-form.html',
            controller: "PersonaDatosFiscalesUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            {
                                files: [
                                    'js/controllers/personas-controllers.js',
                                    'js/services/personas-services.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
    }
]);

