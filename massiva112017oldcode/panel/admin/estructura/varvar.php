<?php
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
$nusuario = $_SESSION['id_usuario'];
$fechaGlobal = date("Y-m-d");
$soloDia = date("d");
//variable para la secciones
$secc = ($_GET['secc'] == '')? 'portada' : $_GET['secc'];
//variable para busqueda de preguntas frecuentes
$busfaq = ($_GET['busfaq'] == '')? '' : $_GET['busfaq'];
//Variable para blog
$idBlog = ($_GET['idBlog'] == '')? '' : $_GET['idBlog'];
//variable para reportes particulas de inventario
$valInvAc = ($_GET['valInvAc'] == '')? '' : $_GET['valInvAc'];
//variable para la creacion de codigos	
$nncod = ($_GET['nncod'] == '')? '' : $_GET['nncod'];
//variable cuando cargo la imagen de perfil
$reinfoactu = ($_GET['reinfoactu'] == '')? '' : $_GET['reinfoactu'];
//variable para el tipo de archivo para actualizar
$tiArchivo = ($_GET['tiArchivo'] == '')? '' : $_GET['tiArchivo'];
//variable para el area de trabajo
$tarsTRa = ($_GET['tarsTRa'] == '')? '' : $_GET['tarsTRa'];
//variable para la cotizacion
$vacoti = ($_GET['vacoti'] == '')? '' : $_GET['vacoti'];
//variable para el carrito de compra
$vacarri = ($_GET['vacarri'] == '')? '' : $_GET['vacarri'];
//variable para cuando se guarda cotiszaciones desde el siumulador
$guaSim = ($_GET['guaSim'] == '')? '' : $_GET['guaSim'];
//variable para bancos
$vaBan = ($_GET['vaBan'] == '')? '' : $_GET['vaBan'];
//variable para los clientes de losusuarios
$nueClien = ($_GET['nueClien'] == '')? '' : $_GET['nueClien'];
//varible para la generacion de respaldo
$soliRes = ($_GET['soliRes'] == '')? '' : $_GET['soliRes'];
/* Variable para agregar producto servicio */
$serpro = ($_GET['serpro'] == '')? '' : $_GET['serpro'];
/* Variable para tickets de usuario */
$tiusu = ($_GET['tiusu'] == '')? '' : $_GET['tiusu'];
/* obtenemos el valor de busqeuda de clientes de lcientes */
$busfaqCli = ($_GET['busfaqCli'] == '')? '' : $_GET['busfaqCli'];
/* actualizacion de obligaciones */
$ActuObli = ($_GET['ActuObli'] == '')? '' : $_GET['ActuObli'];
/* actualizacions de efrima */
$Actuefirma = ($_GET['Actuefirma'] == '')? '' : $_GET['Actuefirma'];
/* suspencion de actividades */
$Actususpencion = ($_GET['Actususpencion'] == '')? '' : $_GET['Actususpencion'];
/* cambio de domicilio */
$Actudomi = ($_GET['Actudomi'] == '')? '' : $_GET['Actudomi'];
/* solicitud de constancia fiscal */
$ActuconsFis = ($_GET['ActuconsFis'] == '')? '' : $_GET['ActuconsFis'];
/* acta de defuncion */
$Actudefu = ($_GET['Actudefu'] == '')? '' : $_GET['Actudefu'];
/* valor para el usuario en solicitud de facturas */
$idCliFa = ($_GET['idCliFa'] == '')? '' : $_GET['idCliFa'];
/* variable para los proveedores */
$busProvee = ($_GET['busProvee'] == '')? '' : $_GET['busProvee'];
/* variable cuando se reenvia el correo de cotizacion de conta atrasada sin registro */
$EnviCo = ($_GET['EnviCo'] == '')? '' : $_GET['EnviCo'];
/* variable para el envio de la misma cotizacion al cliente con los mismos datos */
$EnviCoDOs = ($_GET['EnviCoDOs'] == '')? '' : $_GET['EnviCoDOs'];
/* variable para movimiento de proveedor */
$vapro = ($_GET['vapro'] == '')? '' : $_GET['vapro'];
/* variable par aprimer paso factura */
$priPaso = ($_GET['priPaso'] == '')? '' : $_GET['priPaso'];
/* variable para la cancelacion de fgactura */
$EliminFAc = ($_GET['EliminFAc'] == '')? '' : $_GET['EliminFAc'];
/* variable cuando agregamos un producto a la fac */
$agreporfac = ($_GET['agreporfac'] == '')? '' : $_GET['agreporfac'];
/* variable para la creacion de faltura ultimo paso */
$muestraFAc = ($_GET['muestraFAc'] == '')? '' : $_GET['muestraFAc'];
/* variable para terminar el ticket por parte de usuario */
$tickterm = ($_GET['tickterm'] == '')? '' : $_GET['tickterm'];
/* para las acciones de las actualizaciones del admin */
$actualizMod = ($_GET['actualizMod'] == '')? '' : $_GET['actualizMod'];
/* para el envio del recordatorio */
$enviaRedor = ($_GET['enviaRedor'] == '')? '' : $_GET['enviaRedor'];

?>