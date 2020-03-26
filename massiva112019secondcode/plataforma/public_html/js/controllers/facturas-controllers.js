angular.module('app').controller("FacturasListCtrl", [
    '$scope',
    'FacturasService',
    'TimbrarService',
    function ($scope, FacturasService, TimbrarService) {
        $scope.facturas = [];
        FacturasService.getList().then(function (data) {
            $scope.facturas = data.facturas;
        });
        $scope.timbrarFactura = function (id) {
            TimbrarService.timbrar_cfdi(id).then(function(data_response){
                
            });
        };
    }
]);
angular.module('app').controller("FacturasCreateCtrl", [
    '$scope',
    '$state',
    'FacturasService',
    'PersonasClientesService',
    'PersonasProductosService',
    function ($scope, $state, FacturasService, PersonasClientesService, PersonasProductosService) {
        $scope.heading = "Creación de Facturas";
        $scope.rfc = "";
        $scope.lista_productos_agregados = [];
        $scope.form_search_producto = {clave_producto_search: ""};
        $scope.show_forms = {
            show_add_producto: false,
            show_update_producto: false,
            show_buscando_producto: false,
        };
        $scope.razon_social = "";
        var index = "";
        $scope.form_factura = {
            persona_cliente_id: '',
            tipo_factura: '',
            uso_factura: '',
            forma_pago: '',
            metodo_pago: '',
            moneda: '',
            tipo_cambio: '',
            serie: '',
            folio: '',
            condiciones_pago: '',
        };
        $scope.form_add_update_producto = {
            id: "",
            clave_producto: "",
            comentario: "",
            cantidad: 1,
            precio: 0
        };
        $scope.form_update_producto = {
            id: "",
            clave_producto: "",
            comentario: "",
            cantidad: 1,
            precio: 0
        };
        $scope.totales = {
            iva_trasladado: 0,
            subtotal: 0,
            total_iva_retenido: 0,
            total_isr_retenido: 0,
            total: 0
        };
        $scope.tipos_factura = [
            {id: "", text: "Selecciona una opción"},
            {id: "E", text: "Egreso"},
            {id: "I", text: "Ingreso"},
            {id: "N", text: "Nómina"},
            {id: "P", text: "Pago"},
            {id: "T", text: "Traslado"}
        ];
        $scope.usos_factura = [
            {id: "", text: "Selecciona una opción"},
            {id: "(P01)", text: "(P01)Por definir"},
            {id: "(G01)", text: "(G01)Adquisición de mercancias"},
            {id: "(G02)", text: "(G02)Devoluciones, descuentos o bonificaciones"},
            {id: "(G03)", text: "(G03)Gastos en general"},
            {id: "(I01)", text: "(I01)Construcciones"},
            {id: "(I02)", text: "(I02)Mobiliario y equipo de oficina por inversiones"},
            {id: "(I03)", text: "(I03)Equipo de transporte"},
            {id: "(I04)", text: "(I04)Equipo de computo y accesorios"},
            {id: "(I05)", text: "(I05)Dados,troqueles,moldes,matrices y herramental"},
            {id: "(I06)", text: "(I06)Comunicaciones telefonicas"},
            {id: "(I07)", text: "(I07)Comunicaciones satelitale"},
            {id: "(I08)", text: "(I08)Otra maquinaria y equipo"}
        ];
        $scope.formas_pago = [
            {id: "", text: "Selecciona una opción"},
            {id: 1, text: "Efectivo"},
            {id: 2, text: "Cheque Nominativo"},
            {id: 3, text: "Transferencia electronica de fondos(incluye spei)"},
            {id: 4, text: "Tarjeta de credito"},
            {id: 5, text: "Monedero electronico"},
            {id: 6, text: "Dinero electronico"},
            {id: 12, text: "Dacion en pago"},
            {id: 13, text: "pago por subrogación"},
            {id: 14, text: "pago consignación"},
            {id: 15, text: "Codonacion"},
            {id: 17, text: "Compensación"},
            {id: 23, text: "Novación"},
            {id: 24, text: "Confusión"},
            {id: 25, text: "Remisión de deuda"},
            {id: 26, text: "Prescripción o caducidad"},
            {id: 27, text: "A satisfacción del acreedor"},
            {id: 28, text: "Tarjeta de débito"},
            {id: 29, text: "Tarjeta de servicios"},
            {id: 30, text: "Aplicación de anticipos"},
            {id: 31, text: "Intermidario pagos"},
            {id: 99, text: "por definir"}
        ];
        $scope.metodos_pago = [
            {id: "", text: "Selecciona una opción"},
            {id: "PPD", text: "(PPD) Pago en parcialidades o diferido"},
            {id: "PUE", text: "(PUE) Pago en una sola exhibición"}
        ];
        $scope.monedas = [
            {id: "", text: "Selecciona una opción"},
            {id: "MXN", text: "MXN"}
        ];
        $scope.searchCliente = function () {
            if ($scope.rfc.length === 13) {
                PersonasClientesService.getPersonaByRFC($scope.rfc).then(function (data) {
                    $scope.form_factura.persona_cliente_id = data.persona.id;
                    $scope.razon_social = data.persona.razon_social;
                });
            } else {
                $scope.form_factura.persona_cliente_id = '';
                $scope.razon_social = "";
            }
        };
        $scope.searchProducto = function () {
            PersonasProductosService.getProductoByClave($scope.form_search_producto.clave_producto_search).then(function (data) {
                $scope.form_add_update_producto = data.producto;
                $scope.form_add_update_producto.clave_producto = angular.copy($scope.form_search_producto.clave_producto_search);
                if (index === "") {
                    $scope.show_forms.show_add_producto = true;
                } else {
                    $scope.show_forms.show_update_producto = true;
                }
            });
        };
        $scope.addProducto = function () {
            if (!verificar_clave_add_producto_lista()) {
                fill_add_lista_productos();
                calculo_impuestos();
                limpiar_form_search_producto();
                limpiar_form_add_producto();
            } else {
                alert("la clave del producto ya existe en la lista");
            }
        };
        $scope.show_update_producto = function (key) {
            $scope.show_forms.show_update_producto = true;
            $scope.form_add_update_producto = angular.copy($scope.lista_productos_agregados[key]);
            index = key;
        };
        $scope.updateProducto = function () {
            if (!verificar_clave_update_producto_lista()) {
                fill_update_lista_productos();
                calculo_impuestos();
                limpiar_form_update_producto();
                limpiar_form_search_producto();
                index = "";
            } else {
                alert("la clave del producto ya existe en la lista en la edicion");
            }
        };
        $scope.eliminarProductoLista = function (key) {
            $scope.lista_productos_agregados.splice(key, 1);
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_factura);
            data_send.productos = angular.copy($scope.lista_productos_agregados);
            FacturasService.create(data_send).then(function (data) {
                $state.go('main.facturas_list');
            });
        };
        function fill_add_lista_productos() {
            var producto = angular.copy($scope.form_add_update_producto);
            var iva_trasladado = parseFloat(producto.iva);
            var iva_retenido = parseFloat(producto.iva_retenido);
            var isr_retenido = parseFloat(producto.isr_retenido);
            var cantidad = parseInt(producto.cantidad);
            var precio = parseFloat(producto.precio);
            producto.subtotal = precio * cantidad;
            producto.total_iva_trasladado = producto.subtotal * iva_trasladado;
            producto.total_iva_retenido = producto.subtotal * iva_retenido;
            producto.total_isr_retenido = producto.subtotal * isr_retenido;
            producto.total = producto.subtotal + producto.total_iva_trasladado - producto.total_iva_retenido - producto.total_isr_retenido;
            $scope.lista_productos_agregados.push(producto);
        }
        function fill_update_lista_productos() {
            var producto = angular.copy($scope.form_add_update_producto);
            var iva_trasladado = parseFloat(producto.iva);
            var iva_retenido = parseFloat(producto.iva_retenido);
            var isr_retenido = parseFloat(producto.isr_retenido);
            var cantidad = parseInt(producto.cantidad);
            var precio = parseFloat(producto.precio);
            producto.subtotal = precio * cantidad;
            producto.total_iva_trasladado = producto.subtotal * iva_trasladado;
            producto.total_iva_retenido = producto.subtotal * iva_retenido;
            producto.total_isr_retenido = producto.subtotal * isr_retenido;
            producto.total = producto.subtotal + producto.total_iva_trasladado - producto.total_iva_retenido - producto.total_isr_retenido;
            $scope.lista_productos_agregados[index] = producto;
        }
        function limpiar_form_search_producto() {
            $scope.form_search_producto = {clave_producto_search: ""};
            $scope.search_producto_form.$setPristine();
        }
        function limpiar_form_add_producto() {
            $scope.form_add_update_producto = {
                producto_id: "",
                clave_producto: "",
                comentario: "",
                cantidad: 1,
                precio: 0
            };
            $scope.show_forms.show_add_producto = false;
        }
        function limpiar_form_update_producto() {
            $scope.form_add_update_producto = {
                producto_id: "",
                clave_producto: "",
                comentario: "",
                cantidad: 1,
                precio: 0
            };
            $scope.show_forms.show_update_producto = false;
        }
        function calculo_impuestos() {
            var total_iva_trasladado = 0;
            var total_iva_retenido = 0;
            var total_isr_retenido = 0;
            var subtotal = 0;
            var total = 0;
            for (var i = 0; i < $scope.lista_productos_agregados.length; i++) {
                total_iva_trasladado += $scope.lista_productos_agregados[i].total_iva_trasladado;
                total_iva_retenido += $scope.lista_productos_agregados[i].total_iva_retenido;
                total_isr_retenido += $scope.lista_productos_agregados[i].total_isr_retenido;
                subtotal += $scope.lista_productos_agregados[i].subtotal;
                total += $scope.lista_productos_agregados[i].total;
            }
            $scope.totales.iva_trasladado = total_iva_trasladado;
            $scope.totales.subtotal = subtotal;
            $scope.totales.total_iva_retenido = total_iva_retenido;
            $scope.totales.total_isr_retenido = total_isr_retenido;
            $scope.totales.total = total;
        }
        function verificar_clave_add_producto_lista() {
            var no_encontrado = false;
            for (var i = 0; i < $scope.lista_productos_agregados.length; i++) {
                if ($scope.lista_productos_agregados[i].id === $scope.form_add_update_producto.id) {
                    no_encontrado = true;
                }
            }
            return no_encontrado;
        }
        function verificar_clave_update_producto_lista() {
            var no_encontrado = false;
            for (var i = 0; i < $scope.lista_productos_agregados.length; i++) {
                if ($scope.lista_productos_agregados[i].id === $scope.form_add_update_producto.id && i !== index) {
                    no_encontrado = true;
                }
            }
            return no_encontrado;
        }
    }
]);
angular.module('app').controller('FacturasEmitidasListCtrl', [
    '$scope',
    'CfdisService',
    function ($scope, CfdisService) {
        $scope.facturas = [];
        $scope.header = 'Facturas Emitidas';
        $scope.emisor_o_receptor = 'receptor'
        CfdisService.getListEmitidas().then(function (data) {
            $scope.facturas = data.facturas;
        });
    }
]);
angular.module('app').controller('FacturasRecibidasListCtrl', [
    '$scope',
    'CfdisService',
    function ($scope, CfdisService) {
        $scope.facturas = [];
        $scope.header = 'Facturas Recibidas';
        $scope.emisor_o_receptor = 'emisor';
        CfdisService.getListRecibidas().then(function (data) {
            $scope.facturas = data.facturas;
        });
    }
]);

