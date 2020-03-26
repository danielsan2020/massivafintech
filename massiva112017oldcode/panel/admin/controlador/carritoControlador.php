<?php
    @session_start();	
	date_default_timezone_set("America/Mexico_City");
    //session_start();
	error_reporting(E_ALL);
	ini_set('display_errors','1');

   
    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo 
    require_once "../modelo/carritoModelo.php";
    $carri = new carri();

    $fechaCreacion = date("Y-m-d");
    $id_usuario = $_SESSION['id_usuario'];
    $rfc = $_SESSION['rfc'];
    $correo = $_SESSION['correo'];
    $nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
    
	//*********************optenemos valores para la compra***************************************//
    $montoFin = $_POST['montoFin'];
    $diferente = $_POST['diferente'];

    $paquete1E = $_POST['paquete1E'];
    $facturas1E = $_POST['facturas1E'];
    $costo1E = $_POST['costo1E'];
    $paquete2E = $_POST['paquete2E'];
    $facturas2E = $_POST['facturas2E'];
    $costo2E = $_POST['costo2E'];
    $paquete3E = $_POST['paquete3E'];
    $facturas3E = $_POST['facturas3E'];
    $costo3E = $_POST['costo3E'];
    $paquete4E = $_POST['paquete4E'];
    $facturas4E = $_POST['facturas4E'];
    $costo4E = $_POST['costo4E'];

    $paquetet1E = $_POST['paquetet1E'];
    $ticketst1E = $_POST['ticketst1E'];
    $costot1E = $_POST['costot1E'];
    $paquetet2E = $_POST['paquetet2E'];
    $ticketst2E = $_POST['ticketst2E'];
    $costot2E = $_POST['costot2E'];
    $paquetet3E = $_POST['paquetet3E'];
    $ticketst3E = $_POST['ticketst3E'];
    $costot3E = $_POST['costot3E'];
    $paquetet4E = $_POST['paquetet4E'];
    $ticketst4E = $_POST['ticketst4E'];
    $costot4E = $_POST['costot4E'];

    $paqueteta1E = $_POST['paqueteta1E'];
    $costota1E = $_POST['costota1E'];
    $paqueteta2E = $_POST['paqueteta2E'];
    $costota2E = $_POST['costota2E'];
    $paqueteta3E = $_POST['paqueteta3E'];
    $costota3E = $_POST['costota3E'];
    $paqueteta4E = $_POST['paqueteta4E'];
    $costota4E = $_POST['costota4E'];
    $paqueteta5E = $_POST['paqueteta5E'];
    $costota5E = $_POST['costota5E'];
    $paqueteta6E = $_POST['paqueteta6E'];
    $costota6E = $_POST['costota6E'];
/*
    echo $paquete1E;
    echo "<br>";
    echo $facturas1E;
    echo "<br>";
    echo $costo1E;
    echo "<br>";
    echo $paquete2E;
    echo "<br>";
    echo $facturas2E;
    echo "<br>";
    echo $costo2E;
    echo "<br>";
    echo $paquete3E;
    echo "<br>";
    echo $facturas3E;
    echo "<br>";
    echo $costo3E;
    echo "<br>";
    echo $paquete4E;
    echo "<br>";
    echo $facturas4E;
    echo "<br>";
    echo $costo4E;
    echo "<br>";

    echo $paquetet1E ;
    echo "<br>";
    echo $ticketst1E ;
    echo "<br>";
    echo $costot1E ;
    echo "<br>";
    echo $paquetet2E ;
    echo "<br>";
    echo $ticketst2E ;
    echo "<br>";
    echo $costot2E ;
    echo "<br>";
    echo $paquetet3E ;
    echo "<br>";
    echo $ticketst3E ;
    echo "<br>";
    echo $costot3E ;
    echo "<br>";
    echo $paquetet4E ;
    echo "<br>";
    echo $ticketst4E ;
    echo "<br>";
    echo $costot4E ;
    echo "<br>";

    echo $paqueteta1E ;
    echo "<br>";
    echo $costota1E ;
    echo "<br>";
    echo $paqueteta2E ;
    echo "<br>";
    echo $costota2E ;
    echo "<br>";
    echo $paqueteta3E ;
    echo "<br>";
    echo $costota3E ;
    echo "<br>";
    echo $paqueteta4E ;
    echo "<br>";
    echo $costota4E ;
    echo "<br>";
    echo $paqueteta5E ;
    echo "<br>";
    echo $costota5E ;
    echo "<br>";
    echo $paqueteta6E ;
    echo "<br>";
    echo $costota6E ;
    echo "<br>";
*/
    ///verificamos si el compro facturas
    if($paquete1E != '0' || $paquete2E != '0' || $paquete3E != '0' || $paquete4E != '0' ){
        //vemos cuantas facturas ya tiene
        $carrirr = $carri->buscarNumFac($id_usuario);
        $carrirrInfo = $carrirr->fetch_object();
        $numFacActu = $carrirrInfo->facturas;
        if($numFacActu == ''){$numFacAc = 0;}else{ $numFacAc = $numFacActu; }
        //si alguno es mayor hacemos la suma y los tickets
        $numeroFac = $facturas1E + $facturas2E + $facturas3E +$facturas4E;
        //sumamos lo actual con lo numero
        $numFacFinal = $numeroFac + $numFacAc;
        //agregamos el numero de facturas a la tabla
        if($numFacActu == ''){
            //en caso de que no tenga valores agregamos el valor
            $agregaFac = $carri->agregaFac($id_usuario,$numFacFinal,$fechaCreacion);
            //agregamos al log de compras
            $accionlog = $carri->accionagregaFacturas($id_usuario,$fechaCreacion);
        }else{
            //en caso que ya tenga registro actualizamos
            $actualizaFac = $carri->actualizaFac($id_usuario,$numFacFinal,$fechaCreacion);
            //agregamos al log de compras
            $accionlog = $carri->accionagregaFacturas($id_usuario,$fechaCreacion);
        }
    }
       
    ///verificamos si el compro tickets
    if($paquetet1E != '0' || $paquetet2E != '0' || $paquetet3E != '0' || $paquetet4E != '0' ){
        //vemos cuantas facturas ya tiene
        $carrirr = $carri->buscarTickets($id_usuario);
        $carrirrInfo = $carrirr->fetch_object();
        $numTickActu = $carrirrInfo->tickets;
        if($numTickActu == ''){$numTicAc = 0;}else{ $numTicAc = $numTickActu; }
        //si alguno es mayor hacemos la suma y los tickets
        $numeroTicc = $ticketst1E + $ticketst2E + $ticketst3E +$ticketst4E;
        //sumamos lo actual con lo numero
        $numTiccFinal = $numeroTicc + $numTicAc;
        //agregamos el numero de facturas a la tabla
        if($numTickActu == ''){
            //en caso de que no tenga valores agregamos el valor
            $agregaFac = $carri->agregaTick($id_usuario,$numTiccFinal,$fechaCreacion);
            //agregamos al log de compras
            $accionlog = $carri->accionagregatickets($id_usuario,$fechaCreacion);
        }else{
            //en caso que ya tenga registro actualizamos
            $actualizaFac = $carri->actualizaTick($id_usuario,$numTiccFinal,$fechaCreacion);
            //agregamos al log de compras
            $accionlog = $carri->accionagregatickets($id_usuario,$fechaCreacion);
        }
    }

    //verificamos si compro actualizaciones
    if($paqueteta1E != '0' || $paqueteta2E != '0' || $paqueteta3E != '0' || $paqueteta4E != '0' || $paqueteta5E != '0' || $paqueteta6E != '0' ){
        //vemos cuantas facturas ya tiene
        $actu = $carri->buscarActualizaciones($id_usuario);
        $actuInfo = $actu->fetch_object();

        $idActualiza = $actuInfo->idActualiza;
        $suspension = $actuInfo->suspension;
        $domicilio = $actuInfo->domicilio;
        $obligaciones = $actuInfo->obligaciones;
        $efirma = $actuInfo->efirma;
        $defuncion = $actuInfo->defuncion;
        $situacion = $actuInfo->situacion;

        if($suspension == ''){$uno = 0;}else{ $uno = '1'; }
        if($domicilio == ''){$dos = 0;}else{ $dos = '1'; }
        if($obligaciones == ''){$tres = 0;}else{ $tres = '1'; }
        if($efirma == ''){$cuatro = 0;}else{ $cuatro = '1'; }
        if($defuncion == ''){$cinco = 0;}else{ $cinco = '1'; }
        if($situacion == ''){$seis = 0;}else{ $seis = '1'; }
        
        //sumamos lo actual con lo numero
        if($paqueteta1E != '0'){$numUno = $suspension + $uno;}else{$numUno = $suspension;}
        
        if($paqueteta2E != '0'){$numDos = $domicilio + $dos;}else{$numDos = $domicilio;}

        
        if($paqueteta3E != '0'){$numTres = $obligaciones + $tres;}else{$numTres = $obligaciones;}

        
        if($paqueteta4E != '0'){$numCuatro = $efirma + $cuatro;}else{$numCuatro = $efirma;}

        
        if($paqueteta5E != '0'){$numCinco = $defuncion + $cinco;}else{$numCinco = $defuncion;}

        if($paqueteta6E != '0'){$numSeis = $situacion + $seis;}else{$numSeis = $situacion;}
        //agregamos el numero de facturas a la tabla
        if($idActualiza == ''){
            //en caso de que no tenga valores agregamos el valor
            $agregaFac = $carri->agregaActu($id_usuario,$numUno,$numDos,$numTres,$numCuatro,$numCinco,$numSeis,$fechaCreacion);
            //agregamos al log de compras
            $accionlog = $carri->accionagregaActu($id_usuario,$fechaCreacion);
        }else{
            //en caso que ya tenga registro actualizamos
            $actualizaFac = $carri->actualizaActu($id_usuario,$numUno,$numDos,$numTres,$numCuatro,$numCinco,$numSeis,$fechaCreacion);
            //agregamos al log de compras
            $accionlog = $carri->accionagregaActu($id_usuario,$fechaCreacion);
        }
    }


    //despues de agregar los elementos a sus respectivas tablas agergamos la compra a la tabla

    //sumamos el monto completo

    $montoDinalCompra = $costo1E + $costo2E + $costo3E + $costo4E + $costot1E + $costot2E + $costot3E + $costot4E + $costota1E + $costota2E + $costota3E + $costota4E + $costota5E + $costota6E;

    //aqui realizamos la carga del monto con la api de openpay
    $movimiento = 0;

    //despues agregamos al bd
    $agregamoscompra = $carri->agregaCompra($id_usuario,$montoDinalCompra,$fechaCreacion,$movimiento);
    if($agregamoscompra){
        //creamos el movimiento en el log
        $compraLog = $carri->compraLog($id_usuario,$fechaCreacion);
        if($diferente == 'seccion'){ header ('location:../index.php?secc=ticketusu&vacarri=1');}
        else{header ('location:../index.php?secc=carrito&vacarri=1');}

    }


    
    

