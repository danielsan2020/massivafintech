<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "modelo/Conexion.php";
Class consultaTabla{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    /***********************Seccion de clientes por clientes*****************************/
    //consulto informacion de clientes
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_clientesclientes WHERE estatus = 1 ORDER BY idCliente DESC";
		return ejecutarConsulta($sql); 
    }
    //obtengo la imagen del cliente
    public function imgCliente($identi){
        $sql = "SELECT * FROM tbl_img_clientecliente WHERE id_cliente = $identi ORDER BY idImgCliCli DESC LIMIT 1";
        return ejecutarConsulta($sql);
    }

    /* obtenemos los clientes */
    public function Valorclien($id_usuario){
        $sql = "SELECT * FROM tbl_clientesclientes WHERE id_usuario = $id_usuario AND estatus = 1";
        return ejecutarConsulta($sql);
    }

    /***********************Seccion para ticket*****************************/
    //obtenego los valora para las categorias para soporte
    public function categoria(){
        $sql = "SELECT * FROM cat_categoria_soporte";
        return ejecutarConsulta($sql);
    }
    //obtengo el calor de las reas para mostrar en tickets
    public function areas(){
        $sql = "SELECT * FROM cat_areas";
        return ejecutarConsulta($sql);
    }
    public function verificoTickety($valoId){
        $sql = "SELECT * FROM tbl_ticket_soporte WHERE id_usuario_reporta = $valoId AND estatus = 1";
        return ejecutarConsulta($sql);
    }
	
	//obtenemos el log de movimientos
	public function logmovimiento(){
        $sql = "SELECT TBLAC.*,
			CALO.accion,
			CALO.seccion,
			TBUS.usuario
			FROM tbl_log_acciones as TBLAC
			LEFT JOIN cat_log AS CALO ON TBLAC.idLogs = CALO.idLogs
			LEFT JOIN tbl_usuarios AS TBUS ON TBLAC.id_usuario = TBUS.id_usuario
			ORDER BY TBLAC.idLogMoviento DESC";
        return ejecutarConsulta($sql);
    }
	
	//obtenemos el log de accesos al sistema
	public function logacceso(){
        $sql = "SELECT TBAC.*,
			TBUS.usuario
			FROM tbl_access as TBAC
			LEFT JOIN tbl_usuarios AS TBUS ON TBAC.id_usuario = TBUS.id_usuario	";
        return ejecutarConsulta($sql);
    }

    //function para encontrar los datos de recuperacion de credenciales
    public function recuperaCreden($correo){
        $sql = "SELECT id_usuario,usuario,clave,nombre,ape_paterno,ape_materno FROM tbl_usuarios WHERE mail = '$correo'";
        return ejecutarConsulta($sql);
    }
    
    //seccion para agregar el movimiento del log de recuperacion 
    public function accionLogagrega($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','20','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
 
    //obtenemos los datos de los codigos
    public function codigosTablas(){
        $sql = "SELECT * FROM tbl_codigos";
        return ejecutarConsulta($sql);   
    } 
    /***********************Consultas para tickets de soporte*****************************/
    public function ticketTerminados($id_usuario){
        $sql = "SELECT * FROM tbl_ticket_soporte WHERE id_usuario_reporta = '$id_usuario' AND estatus = 2";
        return ejecutarConsulta($sql);   
    } 

    //obtenemos las respuyestas del ticket
    public function ticketsRespues($IdenTick){
        $sql = "SELECT * FROM tbl_ticket_contable_respuesta WHERE id_soporte = '$IdenTick'";
        return ejecutarConsulta($sql);   
    } 
    public function ticketsRespues2($IdenTick){
        $sql = "SELECT * FROM tbl_ticket_soporte_respuesta WHERE id_soporte = '$IdenTick'";
        return ejecutarConsulta($sql);   
    } 

    

    //obtenemos todos los tickets abiertos para la respuesta
    public function ticketAbiertosAdmin(){
        $sql = "SELECT TSRE.* ,TBUS.usuario,CCS.nombre as nocat
        FROM tbl_ticket_soporte AS TSRE
        LEFT JOIN tbl_usuarios AS TBUS ON TSRE.id_usuario_reporta = TBUS.nusuario
        LEFT JOIN cat_categoria_soporte AS CCS ON TSRE.id_categoria_ticket = CCS.id_categoria_soporte
        ";
        return ejecutarConsulta($sql);   
    }     
    /***********************Consultas para tickets contables*****************************/
    public function verificoTicketyCon($valoId){
        $sql = "SELECT * FROM tbl_ticket_contable WHERE id_usuario_reporta = $valoId AND estatus = 1";
        return ejecutarConsulta($sql);
    }

    public function ticketTerminadosCon($id_usuario){
        $sql = "SELECT * FROM tbl_ticket_contable WHERE id_usuario_reporta = '$id_usuario' AND estatus = 2";
        return ejecutarConsulta($sql);   
    } 
      public function categoriaCon(){
        $sql = "SELECT * FROM cat_categoria_soporte_contable";
        return ejecutarConsulta($sql);
    }    
    public function ticketsRespuesCon($IdenTick){
        $sql = "SELECT * FROM tbl_ticket_contable_respuesta WHERE id_soporte = '$IdenTick'";
        return ejecutarConsulta($sql);   
    } 
    public function ticketAbiertosAdminCon(){
        $sql = "SELECT TSRE.* ,TBUS.usuario,CCS.nombre as nocat
        FROM tbl_ticket_contable AS TSRE
        LEFT JOIN tbl_usuarios AS TBUS ON TSRE.id_usuario_reporta = TBUS.nusuario
        LEFT JOIN cat_categoria_soporte_contable AS CCS ON TSRE.id_categoria_ticket = CCS.id_categoria_soporte
        ";
        return ejecutarConsulta($sql);   
    }  
    //obtenemos las consultas hechas
    public function consultasHechas($valoId){
        $sql = "SELECT * FROM tbl_contadorcontable WHERE id_usuario = '$valoId'";
        return ejecutarConsulta($sql);   
    } 

    /***********************Consultas para logs de soportes*****************************/
    public function logSoporteTecnico(){
        $sql = "SELECT TBLAC.*,
        CALO.accion,
        CALO.seccion,
        TBUS.usuario
        FROM tbl_log_acciones as TBLAC
        LEFT JOIN cat_log AS CALO ON TBLAC.idLogs = CALO.idLogs
        LEFT JOIN tbl_usuarios AS TBUS ON TBLAC.id_usuario = TBUS.id_usuario
        WHERE TBLAC.idLogs IN (26,27,28,29,30,31)
        ORDER BY TBLAC.idLogMoviento DESC";
        return ejecutarConsulta($sql);
    }
    public function logSoporteContable(){
        $sql = "SELECT TBLAC.*,
        CALO.accion,
        CALO.seccion,
        TBUS.usuario
        FROM tbl_log_acciones as TBLAC
        LEFT JOIN cat_log AS CALO ON TBLAC.idLogs = CALO.idLogs
        LEFT JOIN tbl_usuarios AS TBUS ON TBLAC.id_usuario = TBUS.id_usuario
        WHERE TBLAC.idLogs IN (32,33,34,35,36,37)
        ORDER BY TBLAC.idLogMoviento DESC";
        return ejecutarConsulta($sql);
    }

    ///obtenemos los datos del usuario
    public function informacionUsuario($id_usuario){
        $sql = "SELECT TBUS.*, TBLDO.clave as claveEfi
                FROM tbl_usuarios as TBUS
                LEFT JOIN tbl_documentacion as TBLDO on TBUS.id_usuario = TBLDO.id_usuario
                WHERE TBUS.id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);   
    } 
    
    //obtenemos los datos de tarheta
    public function infTarjeta($id_usuario){
        $sql = "SELECT * FROM tbl_tarjj WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);   
    } 
    
    //cuento lso valores que hay para tarjetas
    public function contartarjeta($id_usuario){
        $sql = "SELECT count(*) AS valor FROM tbl_tarjj WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);   
    } 

    //obtengo el primer valor de las tarjetas
    public function tarjetaUno($id_usuario){
        $sql = "SELECT *  FROM tbl_tarjj WHERE id_usuario = '$id_usuario' ORDER BY idCard DESC LIMIT 1";
        return ejecutarConsulta($sql);   
    }

    //obtengo el segundo valor de las tarjetas
    public function tarjetaDos($id_usuario){
        $sql = "SELECT *  FROM tbl_tarjj WHERE id_usuario = '$id_usuario' ORDER BY idCard ASC LIMIT 2";
        return ejecutarConsulta($sql);   
    } 
    
    /***********************Consultas para documentaion dentro de la plataforma*****************************/
    public function documenPlatafroma($valoId){
        $sql = "SELECT * FROM tbl_documentacion WHERE id_usuario = $valoId";
        return ejecutarConsulta($sql);     
    }
    /***********************Consultas para seccion de are4as de trabajo*****************************/
    //obtengo la informacion
    public function areaTrabaInfo($id_usuario){
        $sql = "SELECT * FROM tbl_areastrabajo WHERE id_usuario = $id_usuario";
        return ejecutarConsulta($sql);     
    }
    //si no tiene registro se lo agregamos
      //inserto nuevo elemento
    public function insertar($valoId,$fechaCreacion){
        $sql = "INSERT INTO tbl_areastrabajo (id_usuario,fechaCreacion) VALUES ('$valoId','$fechaCreacion')";
        return ejecutarConsulta($sql);
    }

    /***********************Consultas para productos y servicios para los predictivos*****************************/
    public function descripcionClaveServicios(){
        $sql = "SELECT descripcion,clave FROM cat_claveproductoservicio WHERE tipo LIKE'Servicios'";
        return ejecutarConsulta($sql);     
    }

    public function descripcionClaveProductosMateria(){
        $sql = "SELECT descripcion,clave FROM cat_claveproductoservicio WHERE tipo LIKE 'Materia Prima'";
        return ejecutarConsulta($sql);     
    }

    public function descripcionClaveProductosPro(){
        $sql = "SELECT descripcion,clave FROM cat_claveproductoservicio WHERE tipo LIKE 'Maquinaria y Productos'";
        return ejecutarConsulta($sql);     
    }
    
    /***********************Consultas para las cotizaciones *****************************/
    public function cotizacionPrevia($id_usuario){
        $sql = "SELECT * FROM tbl_cotizaciones WHERE id_usuario = '$id_usuario' AND estatus = '1' ORDER BY idCotizacion DESC LIMIT 1";
        return ejecutarConsulta($sql);     
    }

    public function concentradoCotizaciones($id_usuario){
        $sql = "SELECT * FROM tbl_cotizaciones WHERE id_usuario = $id_usuario AND estatus IN (2,3) ORDER BY idCotizacion DESC";
        return ejecutarConsulta($sql);     
    }

    /***********************Consultas para catalogos *****************************/
    public function catTipoPago(){
        $sql = "SELECT * FROM cat_formapago";
        return ejecutarConsulta($sql);     
    }

    public function catTipoSeguradoras(){
        $sql = "SELECT * FROM cat_aseguradora";
        return ejecutarConsulta($sql);     
    }

    /***********************Seccion para seguros *****************************/
    public function segurostabla($id_usuario){
        $sql = "SELECT * FROM tbl_seguros WHERE usuarioCreacion = '$id_usuario'";
        return ejecutarConsulta($sql);     
    }

    /***********************Seccion el log de compras seguros *****************************/
    public function logCompras(){
        $sql = "SELECT TBLAC.*,
            CALO.accion,
            CALO.seccion,
            TBUS.usuario
            FROM tbl_log_compras as TBLAC
            LEFT JOIN cat_log AS CALO ON TBLAC.idLogs = CALO.idLogs
            LEFT JOIN tbl_usuarios AS TBUS ON TBLAC.id_usuario = TBUS.id_usuario
            ORDER BY TBLAC.idLogCompra DESC";
        return ejecutarConsulta($sql);
    }

    /***********************Seccion  para activos *****************************/
    public function activos($id_usuario){
        $sql = "SELECT * FROM tbl_activos WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);     
    }

    /***********************Seccion  para contabilidad atrasada *****************************/
    ///por registrar pf
    public function conatrapfUno(){
        $sql = "SELECT * FROM tbl_contabilidadatrasada_pf WHERE estatus = '1'";
        return ejecutarConsulta($sql);     
    }
    ///por analisis pf
    public function conatrapfDos(){
        $sql = "SELECT * FROM tbl_contabilidadatrasada_pf WHERE estatus = '2'";
        return ejecutarConsulta($sql);     
    }
    //analisiando pf
    public function conatrapfTres(){
        $sql = "SELECT * FROM tbl_contabilidadatrasada_pf WHERE estatus = '3'";
        return ejecutarConsulta($sql);     
    }

    /***********************Seccion  para los bancos *****************************/
    ///informacion de los bancos
    public function bancos($id_usuario){
        $sql = "SELECT * FROM tbl_bancos WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);     
    }

    /* consulta par aobtener los ingresos */
    public function ingresosValor($id_usuario){
        $sql = "SELECT SUM(balance) as total FROM tbl_movimientosbancos_movi WHERE id_usuario= '$id_usuario' AND quees = 1";
        return ejecutarConsulta($sql);     
    }
    /* consulta par aobtener los egresos */
    public function egresosValor($id_usuario){
        $sql = "SELECT SUM(balance) as total FROM tbl_movimientosbancos_movi WHERE id_usuario= '$id_usuario' AND quees = 2";
        return ejecutarConsulta($sql);     
    }
    /* consulta par aobtener todos los valores */
    public function completoValor($id_usuario){
        $sql = "SELECT SUM(balance) as total FROM tbl_movimientosbancos_movi WHERE id_usuario= '$id_usuario'";
        return ejecutarConsulta($sql);     
    }

    /***********************Seccion de servicios y productos*****************************/
    //consulto informacion de clientes
    public function serviciosTabla($usuarioSe){
        $sql="SELECT * FROM tbl_servicios WHERE id_usuario = '$usuarioSe'";
		return ejecutarConsulta($sql); 
    }

    //consulto informacion de productos
    public function productosTabla($usuarioSe){
        $sql="SELECT * FROM tbl_inventario_productos WHERE id_usuario = '$usuarioSe'";
		return ejecutarConsulta($sql); 
    }


    /***********************consultas para las alertas iniciales*****************************/
    /* obtenemos los bancos del cliente */
    public function bancosClientes($id_usuario){
        $sql="SELECT * FROM tbl_bancousuario WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos las cuentas del banco para los  movimientos del cliente */
    public function movimientoCliente($id_usuario){
        $sql="SELECT * FROM tbl_movimientosbancos WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los verdaderos movimientos del cliente */
    public function movimientoFinalCliente($id_usuario){
        $sql="SELECT * FROM tbl_movimientosbancos_movi WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos si exite un banco */
    public function bancoBoton($id_usuario){
        $sql="SELECT idBanco FROM tbl_bancousuario WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
 
    /***********************consultas para los tickets*****************************/
    /* obtenemos los nuevos negocios */
    public function negocios(){
        $sql="SELECT nombre FROM cat_negocios";
		return ejecutarConsulta($sql); 
    }

      public function cuantotic($id_usuario){
        $sql="SELECT * FROM tbl_tickets WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    public function todostic($id_usuario){
        $sql="SELECT * FROM tbl_tickets_cliente WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los dias del comercio */
    public function diasComercio($comercioNombre){
        $sql="SELECT tiempo FROM cat_negocios WHERE nombre LIKE '$comercioNombre'";
		return ejecutarConsulta($sql); 
    }

    /***********************Consultas para portada*****************************/
    /* obtenemos el paquete seleccionado por el cliente */
    public function paqueteSelec($id_usuario){
        $sql="SELECT TBSPA.fechaSeleccion,TBSPA.montoM, CAPA.nombre
        FROM tbl_seleccion_paquete AS TBSPA
        LEFT JOIN cat_paquetes AS CAPA ON TBSPA.idPaquete = CAPA.idPaquete
        WHERE TBSPA.id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los clientes por el usuario que consulta */
     public function informacionTabla_cli($id_usuario){
        $sql="SELECT * FROM tbl_clientesclientes WHERE estatus = 1 AND id_usuario = $id_usuario ORDER BY idCliente DESC";
		return ejecutarConsulta($sql); 
    }

    /* buscamos los clientes  */
     public function informacionTabla_cliBuis($id_usuario,$busfaqCli){
        $sql="SELECT * FROM tbl_clientesclientes WHERE estatus = 1 AND id_usuario = $id_usuario AND nombreE LIKE '%$busfaqCli%'  ORDER BY idCliente DESC";
		return ejecutarConsulta($sql); 
    }

    /***********************Consultas para actualziaciones*****************************/
    /* obtenemos las obligaciones que esten terminadas */
    public function tablaOblid($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_obligaciones WHERE id_usuario = $id_usuario AND estatus = 2 ";
		return ejecutarConsulta($sql); 
    }

    /* traemosel ultimo registro para el archivo */
    public function tablaOblidARchivo($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_obligaciones WHERE estatus = 2 ORDER BY idActu DESC LIMIT 1 ";
		return ejecutarConsulta($sql); 
    }
    

    /* para ver si una actualizacion de obligaciones pendiente */
     public function tablaOblidDos($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_obligaciones WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }

    /* para ver si tenemos una solicitud de efirma */
     public function tablaefirma($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_efirma WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos las tablas de suspension de actividades */
    public function tablaSus($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_suspencion WHERE id_usuario = $id_usuario AND estatus = 2 ";
		return ejecutarConsulta($sql); 
    }

    public function tablaOblidARchivoSus($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_suspencion WHERE estatus = 2 ORDER BY idActu DESC LIMIT 1 ";
		return ejecutarConsulta($sql); 
    }

    /* para ver si una actualizacion de obligaciones pendiente */
     public function tablaSusDos($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_suspencion WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }
    
     /* obtenemos las tablas de suspension de cambio de domicilio */
    public function tablaDom($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_domicilio WHERE id_usuario = $id_usuario AND estatus = 2 ";
		return ejecutarConsulta($sql); 
    }
    public function tablaOblidARchivoDomm($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_domicilio WHERE estatus = 2 ORDER BY idActu DESC LIMIT 1 ";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos las tablas de suspension de cambio de domicilio */
     public function tablaDomDos($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_domicilio WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }

    
    /* obtenemos las tablas de suspension de cambio de domicilio */
     public function tablaconstanciaDos($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_constancia WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }

    public function tablaconstanciaDosDD($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_constancia WHERE estatus = 2 ORDER BY idActu DESC LIMIT 1 ";
		return ejecutarConsulta($sql); 
    }

     public function obtenconsta($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_constancia WHERE id_usuario = $id_usuario AND estatus = 2 ";
		return ejecutarConsulta($sql); 
    }
 
     public function obtenerdefuncion($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_defuncion WHERE id_usuario = $id_usuario AND estatus = 2 ";
		return ejecutarConsulta($sql); 
    }

     public function obtenerdefuncionDos($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_defuncion WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }

    public function obtenerdefuncionDosmmm($id_usuario){
        $sql="SELECT * FROM tbl_actualiza_defuncion WHERE estatus = 2 ORDER BY idActu DESC LIMIT 1 ";
		return ejecutarConsulta($sql); 
    }
    
    /* conseguimos el uso de cdfi */
    public function obtenemoscdfi(){
        $sql="SELECT * FROM cat_usocfdi";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos forma de pago */
    public function FormaPago(){
        $sql="SELECT * FROM cat_formapago";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos la moenda */
    public function monedadd(){
        $sql="SELECT * FROM cat_moneda";
		return ejecutarConsulta($sql); 
    }
    
    /*obtenemos el servicio del usuario */
    public function serviciosObt($id_usuario){
        $sql="SELECT * FROM tbl_servicios WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los tickets generados por el cliente */
    public function ticketusumas(){
        $sql="SELECT TTCL.*, TUS.* FROM tbl_tickets_cliente AS TTCL LEFT JOIN tbl_usuarios AS TUS ON TTCL.id_usuario = TUS.id_usuario WHERE TTCL.estatus = '2'";
		return ejecutarConsulta($sql); 
    }

    public function obtedias($comercio){
        $sql="SELECT * FROM cat_negocios WHERE nombre LIKE '$comercio'";
		return ejecutarConsulta($sql); 
    }

    /***********************Seccion de para la creacion de facturas*****************************/
    public function cuantoscdfi($id_usuario){
        $sql="SELECT TSPA.*, CAPA.*
        FROM tbl_seleccion_paquete as TSPA
        LEFT JOIN cat_paquetes AS CAPA ON TSPA.idPaquete = CAPA.idPaquete
        WHERE TSPA.id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    /***********************Seccion de tarjetas en el perfil*****************************/
    /* verificamos si tiene una tarjeta registrada */
    public function tarjetaRegis($id_usuario){
        $sql="SELECT * FROM tbl_tarjj WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    /***********************Seccion de para el dashboard de los contadores*****************************/
    /* usuario sin registro */
    public function contaatraSinregistro(){
        $sql="SELECT count(*) AS tolta FROM tbl_contabilidadatrasada_pf WHERE estatus = 1";
		return ejecutarConsulta($sql); 
    }
    /* usuarios registrados */
    public function contaatraConregis(){
        $sql="SELECT * FROM tbl_usuarios WHERE contabilidadAtrasada = 1";
		return ejecutarConsulta($sql); 
    }
    /* usuarios en proceso */
    public function contaatraProceso(){
        $sql="SELECT count(*) AS tolta FROM tbl_contabilidadatrasada_pf WHERE estatus = 3";
		return ejecutarConsulta($sql); 
    }

    /* hace conteo con la verificacion */
    public function verifiConFisicAtraCon($rfcConsu){
        $sql="SELECT * FROM tbl_contabilidadatrasada_pf WHERE rfc = '$rfcConsu' AND estatus = 2";
		return ejecutarConsulta($sql); 
    }

    /* consulta de tabla finbal sin registro  */
    public function contaatraSinregistroFinal(){
        $sql="SELECT * FROM tbl_contabilidadatrasada_pf WHERE estatus = 1";
		return ejecutarConsulta($sql); 
    }

    /* consulta de tabla final con registro en la plataforma */
    public function contaatraConregisFinal(){
        $sql="SELECT * FROM tbl_usuarios WHERE contabilidadAtrasada = 1";
		return ejecutarConsulta($sql); 
    }

    /* consulta para verificar que el suaurio ya tiene cosas en el la tabla de atarsada */
    public function verifiConFisicAtra($rfcConsu){
        $sql="SELECT * FROM tbl_contabilidadatrasada_pf WHERE rfc = '$rfcConsu'";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los datos atrasados */
    public function consuDatoscontaatraDo($id_usuario){
        $sql="SELECT * FROM tbl_documentacion WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los datos del usuario */
    public function datosAuto($id_usuario){
        $sql="SELECT * FROM tbl_usuarios WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }
    /* datos de cotizacion para  */
    public function datoscoti($rfc){
        $sql="SELECT * FROM tbl_contabilidadatrasada_pf WHERE rfc = '$rfc'";
		return ejecutarConsulta($sql); 
    }

    /* consulta de ultima tabla */
    public function contaatraFinal(){
        $sql="SELECT * FROM tbl_contabilidadatrasada_pf WHERE estatus IN(3,5)";
		return ejecutarConsulta($sql); 
    }

    /***********************Seccion de proveedores*****************************/
    /* lista de proveedores */
    public function proveeconsiu($id_usuario){
        $sql="SELECT * FROM tbl_prove WHERE estatus =1 AND id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
    /* lista de proveedores con busqeuda */
    public function proveeconsiuBus($id_usuario,$busProvee){
        $sql="SELECT * FROM tbl_prove WHERE estatus =1 AND id_usuario = '$id_usuario' AND nombre Like '%$busProvee%'";
		return ejecutarConsulta($sql); 
    }

    //consulta para el reporte particular de productos en inventario activo
	public function infProInvActivo($valInvAc){
        $sql="SELECT * FROM tbl_inventario_productos WHERE idInventario = $valInvAc ";
       return ejecutarConsulta($sql); 
   }

   	//consulta de entradas
	public function consEntra($coninven){
        $sql="SELECT * FROM tbl_inventario_entradas WHERE idInventario = $coninven ";
		return ejecutarConsulta($sql); 
    }

    //consutlas de salida
	public function consSalidas($coninven){
        $sql="SELECT * FROM tbl_inventario_salidas WHERE idInventario = $coninven ";
		return ejecutarConsulta($sql); 
    }

    /***********************Seccion de solicitar facturas*****************************/
    public function cuantoscdfiFIN($id_usuario){
        $sql="SELECT * FROM tbl_facturas WHERE id_usuario = $id_usuario ";
		return ejecutarConsulta($sql); 
    }

    public function obtenerPrimerPas($id_usuario){
        $sql="SELECT * FROM tbl_facturas_solicitadas WHERE id_usuario = $id_usuario AND estatus = 1 ";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los productos que tiene registrado el usuario */
    public function ObtenemosPro($id_usuario){
        $sql="SELECT * FROM tbl_inventario_productos WHERE id_usuario = $id_usuario ";
		return ejecutarConsulta($sql); 
    }

     /* obtenemos los servicios que tiene registrado el usuario */
     public function obteneServicios($id_usuario){
        $sql="SELECT * FROM tbl_servicios WHERE id_usuario = $id_usuario ";
		return ejecutarConsulta($sql); 
    }
    
    /* obtenemos los productos agregados a la factura */
    public function obteproductosFac($idFactura){
        $sql="SELECT * FROM tbl_productos_factura WHERE idFactura = $idFactura ";
		return ejecutarConsulta($sql); 
    }

    /* obtenemlso la suma de los productos para subtotal */
    public function subapropa($idFactura){
        $sql="SELECT SUM(total) AS subtotal FROM tbl_productos_factura WHERE idFactura = $idFactura ";
		return ejecutarConsulta($sql); 
    }
    
    /***********************Seccion de contadores de dashboard contadores*****************************/
	public function totalClientes(){
        $sql="SELECT count(*) AS total FROM tbl_usuarios WHERE tipoUsuario = 2";
		return ejecutarConsulta($sql); 
    }

    /* total de cleintes para mostrarlos en la lista */
    public function totalClientesTotal(){
        $sql="SELECT * FROM tbl_usuarios WHERE tipoUsuario = 2";
		return ejecutarConsulta($sql); 
    }
    /* obtenemos los documentos del usuario */
    public function docclien($id_usuarioCon){
        $sql="SELECT * FROM tbl_documentacion WHERE id_usuario = $id_usuarioCon";
		return ejecutarConsulta($sql); 
    }

    /* cuenta de tickets */
    public function totalTijke(){
        $sql="SELECT count(*) AS total FROM tbl_tickets_cliente WHERE estatus = '2'";
		return ejecutarConsulta($sql); 
    }
    
    /* obtenemos todos los tickets que va a facturar massiva */
    public function todosticConta(){
        $sql="SELECT * FROM tbl_tickets_cliente WHERE estatus = 2";
		return ejecutarConsulta($sql); 
    }

    /***********************Seccion de contadores de dashboard contadores*****************************/
    /* conteo para actualizaciones */
    public function totalSumaUno(){
        $sql="SELECT count(*) AS total FROM tbl_actualiza_obligaciones WHERE estatus = '1'";
		return ejecutarConsulta($sql); 
    }
    public function totalSumaDos(){
        $sql="SELECT count(*) AS total FROM tbl_actualiza_efirma WHERE estatus = '1'";
		return ejecutarConsulta($sql); 
    }
    public function totalSumaTres(){
        $sql="SELECT count(*) AS total FROM tbl_actualiza_suspencion WHERE estatus = '1'";
		return ejecutarConsulta($sql); 
    }
    public function totalSumaCuatro(){
        $sql="SELECT count(*) AS total FROM tbl_actualiza_domicilio WHERE estatus = '1'";
		return ejecutarConsulta($sql); 
    }
    public function totalSumacinco(){
        $sql="SELECT count(*) AS total FROM tbl_actualiza_constancia WHERE estatus = '1'";
		return ejecutarConsulta($sql); 
    }
    public function totalSumaSeis(){
        $sql="SELECT count(*) AS total FROM tbl_actualiza_defuncion WHERE estatus = '1'";
		return ejecutarConsulta($sql); 
    }

    /* tabla de consulta de obligaciones fiscales */
    public function pendiobli(){
        $sql="SELECT TAOB.*, TUS.*,TDO.*,TDO.clave as tdcla, TAOB.estatus as estapara
        FROM tbl_actualiza_obligaciones as TAOB
        LEFT JOIN tbl_usuarios AS TUS ON TAOB.id_usuario = TUS.id_usuario
        LEFT JOIN tbl_documentacion AS TDO ON TAOB.id_usuario = TDO.id_usuario
        WHERE TAOB.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }

    public function pendiefirma(){
        $sql="SELECT TAOB.*, TUS.*,TDO.*,TDO.clave as tdcla, TAOB.estatus as estapara
        FROM tbl_actualiza_efirma as TAOB
        LEFT JOIN tbl_usuarios AS TUS ON TAOB.id_usuario = TUS.id_usuario
        LEFT JOIN tbl_documentacion AS TDO ON TAOB.id_usuario = TDO.id_usuario
        WHERE TAOB.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }

    public function suspension(){
        $sql="SELECT TAOB.*, TUS.*,TDO.*,TDO.clave as tdcla, TAOB.estatus as estapara
        FROM tbl_actualiza_suspencion	as TAOB
        LEFT JOIN tbl_usuarios AS TUS ON TAOB.id_usuario = TUS.id_usuario
        LEFT JOIN tbl_documentacion AS TDO ON TAOB.id_usuario = TDO.id_usuario
        WHERE TAOB.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }

    public function constanciaObli(){
        $sql="SELECT TAOB.*, TUS.*,TDO.*,TDO.clave as tdcla, TAOB.estatus as estapara
        FROM tbl_actualiza_constancia	as TAOB
        LEFT JOIN tbl_usuarios AS TUS ON TAOB.id_usuario = TUS.id_usuario
        LEFT JOIN tbl_documentacion AS TDO ON TAOB.id_usuario = TDO.id_usuario
        WHERE TAOB.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }
    
    public function defuncion(){
        $sql="SELECT TAOB.*, TUS.*,TDO.*,TDO.clave as tdcla, TAOB.estatus as estapara
        FROM tbl_actualiza_defuncion as TAOB
        LEFT JOIN tbl_usuarios AS TUS ON TAOB.id_usuario = TUS.id_usuario
        LEFT JOIN tbl_documentacion AS TDO ON TAOB.id_usuario = TDO.id_usuario
        WHERE TAOB.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }
    
    public function domicilio(){
        $sql="SELECT TAOB.*, TUS.*,TDO.*,TDO.clave as tdcla, TAOB.estatus as estapara
        , TAOB.direccion as dir1
        , TAOB.estado as esta1
        , TAOB.ciudad as ciud1
        , TAOB.municipio as mun1
        , TAOB.cp as cp1
        , TAOB.comprobante as compo1
        FROM tbl_actualiza_domicilio as TAOB
        LEFT JOIN tbl_usuarios AS TUS ON TAOB.id_usuario = TUS.id_usuario
        LEFT JOIN tbl_documentacion AS TDO ON TAOB.id_usuario = TDO.id_usuario
        WHERE TAOB.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }
    
    /* para el recordatorio de clientes */
    public function recordatorioClien(){
        $sql="SELECT TUS.*, TUS.*,TDO.*,TDO.clave as tdcla, TUS.estatus as estapara
        FROM tbl_usuarios as TUS
        INNER JOIN tbl_documentacion AS TDO ON TUS.id_usuario = TDO.id_usuario
        WHERE TUS.estatus IN (1,3)";
		return ejecutarConsulta($sql); 
    }
}
