/* global Noty, base_url, angular */

angular.module("app").controller('PersonasProductosListCtrl', [
    '$scope',
    '$rootScope',
    'PersonasProductosService',
    function ($scope, $rootScope, PersonasProductosService) {
        $scope.personas_productos = {};
        var persona_id = $rootScope.usuario_acceso.persona_id;
        PersonasProductosService.getList(persona_id).then(function (data) {
            $scope.personas_productos = data.personas_productos;
            for (var k = 0; k < $scope.personas_productos.length; k++) {
                var producto_id = $scope.personas_productos[k].id;

                if ($scope.personas_productos[k].tiene_foto_producto === "-1") {
                    $scope.personas_productos[k].url = base_url + 'images/sin_imagen.jpg';
                } else {
                    $scope.personas_productos[k].url = base_url + 'files/get_foto_producto_by_producto_id?producto_id=' + producto_id + '&rand=' + Math.random();
                }
            }
        });
        $scope.inactivate = function (id) {
            PersonasProductosService.inactivate(id).then(function () {
                PersonasProductosService.getList(persona_id).then(function (data) {
                    $scope.personas_productos = data.personas_productos;
                    for (var k = 0; k < $scope.personas_productos.length; k++) {
                        var producto_id = $scope.personas_productos[k].id;
                        if ($scope.personas_productos[k].tiene_foto_producto === "-1") {
                            $scope.personas_productos[k].url = base_url + 'images/sin_imagen.jpg';
                        } else {
                            $scope.personas_productos[k].url = base_url + 'files/get_foto_producto_by_producto_id?producto_id=' + producto_id + '&rand=' + Math.random();
                        }
                    }
                });
            });
        };
    }
]);
angular.module("app").controller('PersonasProductosCreateCtrl', [
    '$scope',
    '$state',
    'UnidadesDeMedidaService',
    'PersonasProductosService',
    'ProductosSatService',
    function ($scope, $state, UnidadesDeMedidaService, PersonasProductosService, ProductosSatService) {
        $scope.heading = "Creación";
        var unidad_medida_selected_id = "";
        $scope.persona_producto = {id: '', clave: '', descripcion: '', unidad_sat: ''};
        $scope.form_persona_producto = {tipo: '', producto: '', cantidad: '', precio_compra: '', precio_venta: '', tiene_foto_producto: -1, clave:''};
        $scope.file_producto = {file: "", subir_archivo: true}; //variable que trae los datos del archivo. para el ng-file-upload
        $scope.editar_file_producto = false;
        $scope.create_or_update = 1;
        $scope.clave_producto = "";
        $scope.tipos = [
            {tipo: 'Producto terminado', value: '1'},
            {tipo: 'Materia prima', value: '2'}
        ];
        UnidadesDeMedidaService.getAll().then(function (data_response) {
            $scope.unidades_de_medida = data_response.unidades_de_medida;
        });
        $scope.buscar = function () {
            if ($scope.clave_producto.length === 8) {
                ProductosSatService.getProductoByClave($scope.clave_producto).then(function (data) {
                    $scope.persona_producto = data.informacion_producto;
                });
            } else {
                $scope.persona_producto = {};
            }
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_persona_producto);
            data_send.unidad_de_medida_id = unidad_medida_selected_id;
            data_send.producto_sat_id = $scope.persona_producto.id;
            if ($scope.file_producto.file !== "") {
                data_send.file_producto = $scope.file_producto.file;
                data_send.file_type = $scope.file_producto.file.type;
            }
            PersonasProductosService.createPersonaProducto(data_send).then(function () {
                $state.go('main.personas_productos_list');
            });
        };
        $scope.get_id_unidad_medida = function (id) {
            unidad_medida_selected_id = id;
        };
        $scope.fileProductoUpload = function (file) {
            $scope.file_producto.subir_archivo = false;
            $scope.form_persona_producto.tiene_foto_producto = 1;
            var data_send = {file: file};
            data_send.name = file.name;
        };
        $scope.eliminarImagenProducto = function () {
            $scope.editar_file_producto = false;
            $scope.file_producto.subir_archivo = true;
            $scope.form_persona_producto.tiene_foto_producto = -1;
            $scope.file_producto.file = "";
        };
        $scope.editarImagenProducto = function () {
            $scope.file_producto.subir_archivo = true;
            $scope.editar_file_producto = true;
        };
    }
]);

angular.module("app").controller('PersonasProductosListInactiveCtrl', [
    '$scope',
    'PersonasProductosService',
    function ($scope, PersonasProductosService) {
        $scope.heading = "inactivos";
        PersonasProductosService.getListInactive().then(function (data) {
            $scope.personas_productos = data.personas_productos;
        });
        $scope.reactivate = function (id) {
            PersonasProductosService.reactivate(id).then(function () {
                PersonasProductosService.getListInactive().then(function (data) {
                    $scope.personas_productos = data.personas_productos;
                });
            });
        };
    }
]);

angular.module("app").controller('PersonasProductosUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'UnidadesDeMedidaService',
    'PersonasProductosService',
    'ProductosSatService',
    function ($scope, $state, $stateParams, UnidadesDeMedidaService, PersonasProductosService, ProductosSatService) {
        $scope.heading = "Edición ";
        var producto_id = $stateParams.id;
        $scope.mostrar_formulario = false;
        $scope.mostrar_resultados = false;
        $scope.persona_producto = {id: '', clave: '', descripcion: '', unidad_sat: ''};
        $scope.form_persona_producto = {tipo: '', producto: '', cantidad: '', precio_compra: '', precio_venta: '', tiene_foto_producto: -1, clave:''};
        $scope.file_producto = {file: "", subir_archivo: true};
        $scope.create_or_update = 2;
        $scope.tiene_foto = false;
        $scope.url = base_url + 'files/get_foto_producto_by_producto_id?producto_id=' + producto_id + '&rand=' + Math.random();
        $scope.tipos = [
            {tipo: 'Producto terminado', value: '1'},
            {tipo: 'Materia prima', value: '2'}
        ];
        var unidad_medida_selected_id = "";
        PersonasProductosService.getProductoById(producto_id).then(function (data_response) {
            $scope.form_persona_producto = data_response.persona_producto;
            $scope.clave_producto = $scope.form_persona_producto.clave_sat;
            $scope.persona_producto.descripcion = $scope.form_persona_producto.descripcion;
            $scope.persona_producto.unidad_sat = $scope.form_persona_producto.unidad_sat;
            $scope.persona_producto.id = $scope.form_persona_producto.producto_sat_id;
            if ($scope.form_persona_producto.tiene_foto_producto === '1') {
                $scope.file_producto.subir_archivo = false;
                $scope.tiene_foto = true;
            } else {
                $scope.file_producto.subir_archivo = true;
            }
            var unidad_id = parseInt($scope.form_persona_producto.unidad_de_medida_id);
            UnidadesDeMedidaService.getAll().then(function (data_response) {
                $scope.unidades_de_medida = data_response.unidades_de_medida;
                for (var k = 0; k < $scope.unidades_de_medida.length; k++) {
                    var unidad_de_medida = parseInt($scope.unidades_de_medida[k].id);
                    if (unidad_id === unidad_de_medida) {
                        $scope.unidad_medida_selected = angular.copy($scope.unidades_de_medida[k]);
                        unidad_medida_selected_id = unidad_de_medida;
                    }
                }
            });
        });
        $scope.buscar = function () {
            if ($scope.clave_producto.length === 8) {
                ProductosSatService.getProductoByClave($scope.clave_producto).then(function (data) {
                    $scope.persona_producto = data.informacion_producto;
                });
            } else {
                $scope.persona_producto = {};
            }
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_persona_producto);
            data_send.unidad_de_medida_id = unidad_medida_selected_id;
            data_send.producto_sat_id = $scope.persona_producto.id;
            if ($scope.file_producto.file !== "") {
                data_send.file_producto = $scope.file_producto.file;
                data_send.file_type = $scope.file_producto.file.type;
                data_send.file_editado = '1';
            }
            PersonasProductosService.updatePersonaProducto(producto_id, data_send).then(function () {
                $state.go('main.personas_productos_list');
            });
        };
        $scope.get_id_unidad_medida = function (id) {
            unidad_medida_selected_id = id;
        };
        $scope.fileProductoUpload = function (file) {
            $scope.file_producto.subir_archivo = false;
            $scope.form_persona_producto.tiene_foto_producto = 1;
            var data_send = {file: file};
            data_send.name = file.name;
            $scope.tiene_foto = false;
        };
        $scope.eliminarImagenProducto = function () {
            $scope.editar_file_producto = false;
            $scope.file_producto.subir_archivo = true;
            $scope.form_persona_producto.tiene_foto_producto = -1;
            $scope.file_producto.file = "";
        };
        $scope.editarImagenProducto = function () {
            $scope.file_producto.subir_archivo = true;
            $scope.editar_file_producto = true;
        };
    }
]);