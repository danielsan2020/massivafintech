<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){

///cabezera
include 'estructura/header.php';
///script
include 'estructura/script.php';

//genero las variables para uso generar
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
$nusuario = $_SESSION['id_usuario'];
$fechaGlobal = date("Y-m-d");
$rfc = $_SESSION['rfc'];
$tipo = ($_SESSION['formaJuridica'] == 'f')? 'Física' : 'Moral';

//creamos el contrato
require('plugins/fpdf/WriteHTML.php');
$twxt = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
</head>

<body >
<p>
<br>
CONTRATO DE PRESTACIÓN DE SERVICIOS (el 'Contrato') que celebran, por una parte, <b>MASSIVA CONTABILIDAD INNOVADORA SOCIEDAD CIVIL 'MASSIVA'</b>, (".$nombre.", con la forma jurídica de Persona ".$tipo.",RFC: ".$rfc."), y conjuntamente, las 'Partes' e indistintamente una 'Parte', al tenor de las siguientes declaraciones y cláusulas:<br><br>

<b>DECLARACIONES</b><br><br>

<b>1. Declara MASSIVA que:</b><br>
a)	Esa una sociedad debidamente constituida de conformidad con las leyes de los Estados Unidos Mexicanos como consta en escritura número 100,990 otorgada ante la fe del licenciado, Notario, Lic. Alfredo Ayala Herrera, Titular de la Notaria 237, de la Ciudad de México, el día 7 de febrero de 2019, acreditando a su vez a su representante con las facultades suficientes para celebrar este Contrato.<br>
b)	Se encuentra inscrita en el Registro Federal de Contribuyentes bajo el número <b>MCI1902072A6</b>.<br><br>

<b>2. Declara el Cliente que:</b><br>
a) Es una Persona Física o Moral debidamente constituida de conformidad con las leyes de la República Mexicana, contando su representante con las facultades suficientes para celebrar este Contrato, y en caso de ser la primera que cuenta con capacidad legal de acuerdo a lo establecido en el Código Civil vigente. <br>
b) Se encuentra adscrito en el Registro Federal de Contribuyentes con número y domicilio fiscal que adjuntan en la plataforma <b>massiva.mx</b><br>
c) Requiere que <b>MASSIVA</b> le preste los servicios como proveedor de facturación electrónica y contabilidad integral digital.<br>
En virtud de las declaraciones anteriores, las Partes convienen sujetarse a lo dispuesto en las siguientes cláusulas.<br><br>

<b>CLÁUSULAS</b><br><br>

<b>1. Objeto.</b><br>
Hasta el primer cobro del plan seleccionado implicará la aceptación por parte del cliente a <b>MASSIVA</b> de este Contrato, e iniciará la prestación al cliente a través del Sistema, de los servicios de generación y emisión electrónica de CFDIs, recopilación, procesamiento, almacenamiento, manejo y envío de información relativa a las transacciones de CFDIs realizadas para el cliente, además de las declaraciones, cotizaciones, facturación de tickets (comprobante fiscal), sincronización de cuentas bancarias, nóminas y pago de impuestos a través del Sitio Web, los cuales se describen a mayor detalle en el Anexo 'A'  'B' y 'C' del presente contrato ('de Servicios')<br><br>

<b>2. Precios.</b><br>
<b>a)</b> 'El Cliente' pagará a <b>MASSIVA</b>, como contraprestación, las cantidades estipuladas en el referido Anexo 'A' de este Contrato ('la Contraprestación'), incluido el Impuesto al Valor Agregado (I.V.A.) correspondiente.<br>
<b>b)</b> 'El Cliente' pagará a <b>MASSIVA</b> a través del sistema <b>OPENPAY</b>, que analiza cada transacción en tiempo real con el <b>sistema antifraude</b>, información <b>encriptada con certificados SSL y bajo la certificación PCI-DSS</b> para el manejo y almacenamiento de tarjetas, las cantidades estipuladas en el referido Anexo 'B' de este Contrato ('la Contraprestación'), incluido el Impuesto al Valor Agregado (I.V.A.) correspondiente.<br>
<b>c)</b> 'El Cliente' pagará a <b>MASSIVA</b> por penalización y costos adicionales por uso extraordinario, las cantidades estipuladas en el referido Anexo 'C' de este Contrato ('la Contraprestación'), incluido el Impuesto al Valor Agregado (I.V.A.) correspondiente.<br><br>

<b>3. Forma de Pago.</b><br>
<b>a)</b> La contraprestación por el Servicio será exigible y pagadera por el Cliente conforme a lo siguiente:
I.- 'El Cliente' al momento de registrarse en la plataforma y aceptar las condiciones de llevar su contabilidad integral digital, lo cual incluye realización de facturas a su nombre, con previa solicitud de 'El Cliente', realización de declaraciones, sincronización de cuentas bancarias, nóminas, si se solicita, cotizaciones, aviso y pago de impuestos, si corresponde, respetando los costos señalados en el Anexo A de este Contrato. Posterior al pago realizado por 'El Cliente' y a la entrega de todos los archivos y datos necesarios para poder emitir una factura electrónica y llevar su contabilidad integral digital, <b>MASSIVA</b> habilitará en un plazo no mayor a 48 horas, el sistema para la solicitud y generación de CFDI con sus folios correspondientes según su plan contratado.<br>
<b>b)</b> El pago del plan mensual contratado en el Anexo 'A' solicitado por el 'El Cliente' podrá ser mediante depósito bancario o transferencia bancaria con las tarjetas de VISA, MASTERCARD y AMERICAN EXPRESS al Banco <b>BANREGIO</b>, número de cuenta <b>220 93562 001 5</b>, CLABE <b>058180000002766829 </b>de <b>MASSIVA</b>.<br>
<b>c)</b> En caso de que el Cliente no realice el pago convenido de la Contraprestación a favor de <b>MASSIVA</b> conforme a este Contrato, <b>MASSIVA</b> tendrá el derecho de suspender la prestación del Servicio sin previo aviso y de forma inmediata.<br><br><br>

<b>4. Límites de Responsabilidad</b><br>
'El Cliente' se obliga a cumplir con las obligaciones fiscales adquiridas por la contratación las cuales son:<br>
<b>a)</b> Autorizar la entrega al Servicio de Administración Tributaria (SAT), copia de los comprobantes fiscales que hayan realizado con <b>MASSIVA</b>, de acuerdo a lo establecido en la regla <b>2.7.4.1 – 2.21.2</b> de conformidad con la  miscelánea fiscal para el 2018  y en complemento ANEXO 24 de la miscelánea fiscal del 2015 (Artículo 28 del Código Fiscal de la Federación, Artículos 33 y 34 del Reglamento del Código Fiscal de la Federación, Extracto de las Reglas de Contabilidad electrónica de la Resolución Miscelánea Fiscal para 2018 (Extracto de la publicada en el Diario Oficial de la Federación el 03 de marzo 2015), Anexo 24 de la Resolución de modificaciones a la Resolución Miscelánea Fiscal 2018 (Extracto de la publicada en el Diario Oficial de la Federación el 14 de mayo de 2015)Tercera Resolución de Modificaciones a la Resolución Miscelánea Fiscal 2015(Extracto de la publicada en el Diario Oficial de la Federación el 02 de julio de 2015).<br>
<b>b)</b> Conservar en medios electrónicos actualizados las Facturas Electrónicas y tenerlos a disposición de las autoridades fiscales.<br>
<b>d)</b> Conservar dentro de la plataforma <b>massiva.mx</b>, en el perfil del Cliente, de forma limitada, su documentación e información hasta que decida darse de baja de forma voluntaria o hasta que <b>MASSIVA</b> dé de baja al Cliente por falta de pago. Dicha información quedará hospedada en la plataforma de <b>massiva.mx</b> únicamente por 15 (quince) días, pasado ese límite de tiempo toda información quedará eliminada dentro de la plataforma <b>massiva.mx</b>.<br>
<b>d)</b> Conservar dentro de la plataforma <b>massiva.mx</b>, en el perfil del Cliente, de forma limitada, su documentación e información hasta que decida darse de baja de forma voluntaria o hasta que <b>MASSIVA</b> dé de baja al Cliente por falta de pago. Dicha información quedará hospedada en la plataforma de <b>massiva.mx</b> únicamente por 15 (quince) días, pasado ese límite de tiempo toda información quedará eliminada dentro de la plataforma <b>massiva.mx</b>.<br><br>

'El Cliente' deberá descargar toda su información de su perfil antes de darse de baja, si lo hace después, deberá solicitarla a atencionclientes@massiva.mx y antes de los 15 días de haberlo hecho porque su información será eliminada del sistema de <b>MASSIVA</b> a partir del día 16 desde que se dio de baja. <br><br>

<b>Obligatoriedad de resguardo de toda la documentación</b>
“El Cliente” está obligado de hacer resguardo de su propia información durante al menos 5 años.
<b>MASSIVA</b> resguardará toda su documentación e información mientras sea cliente de <b>MASSIVA</b> y el Cliente podrá hacer un corte de su contabilidad en una sección de su Perfil llamada Respaldo, la cual podrá enviarse a su correo si así lo desea.<br><br>

<b>6. Uso del Sistema. </b>
<b>a)</b> 'El Cliente' reconoce y acepta que los servicios contenidos en el presente contrato se prestan a través del Sistema, cuyo uso se pone a disposición del Cliente en el Sitio Web bajo el URL <b>www.massiva.mx,</b> el cual cumple con todos los requisitos señalados en las disposiciones fiscales para emitir comprobantes fiscales digitales.<br><br>

<b>7. Conservación de Base de Datos ante Caso Fortuito o de Fuerza Mayor.</b><br>
En caso de que <b>MASSIVA</b> no pueda prestar los servicios contenidos en el servicio por más de 15 (quince) días naturales consecutivos con motivo de casos fortuitos, fuerza mayor o en general por causas no atribuibles a la misma, <b>MASSIVA</b> tan pronto sea posible devolverá al Cliente su Base de Datos, salvo que el Cliente decida que <b>MASSIVA</b> continúe conservándola. El Cliente tendrá 30 (treinta) días naturales a partir del siguiente día al que se haya suspendido el servicio, para solicitar la devolución de su Base de Datos a <b>MASSIVA</b>. Transcurrido dicho plazo, se entenderá que el Cliente ha solicitado a <b>MASSIVA</b> que conserve dicha Base de Datos hasta nuevo aviso.<br><br>

<b>8. Vigencia y Terminación.</b><br>
<b>a)</b> El presente Contrato se celebra por tiempo indefinido una vez aceptado.<br>
<b>b)</b> En caso de rescisión de este Contrato, el cliente deberá haber pagado a <b>MASSIVA</b> la Contraprestación generada hasta esa fecha y cumplido con las demás obligaciones a su cargo bajo este Contrato.<br>
<b>c)</b> No obstante lo anterior, cualquiera de las partes podrá rescindir de pleno derecho este Contrato, sin necesidad de declaración judicial, mediante simple aviso vía correo electrónico 5 (cinco) días naturales antes de la fecha de corte dirigido a la otra Parte, en caso de que la otra Parte incumpla con cualquiera de sus obligaciones establecidas en este Contrato o en los términos y condiciones de uso del Sitio Web. En este caso la Parte Incumplida tendrá un plazo de 15 (quince) días naturales siguientes al aviso de la Parte afectada para subsanar su incumplimiento. Una vez transcurrido dicho plazo sin que la Parte incumplida hubiere remediado su incumplimiento a satisfacción de <b>MASSIVA</b>, la rescisión de este contrato operará de forma automática.<br><br><br>

<b>9. Avisos.</b><br>
<b>a)</b> En caso de recisión del presente contrato por parte de 'El Cliente', no será reembolsable cantidad alguna pagada anticipadamente a <b>MASSIVA</b> por ningún concepto.<br>
<b>b)</b> Cualquier aviso, requerimiento, notificación y demás comunicaciones relativas a este Contrato deberá ser por vía correo electrónico. <br><br>

Dichas comunicaciones surtirán sus efectos en la fecha en que hayan sido registradas por los servidores de correo electrónico de <b>MASSIVA</b> y/o del Cliente.<br>
Las comunicaciones vía correo electrónico deberán enviarse a las siguientes direcciones de correo electrónico:<br>
Si es dirigida a <b>MASSIVA</b>, a: atencionclientes@massiva.mx<br>
Si es dirigida al Cliente, a: Se enviará a la dirección registrada en el portal massiva.mx<br><br>

<b>10. Acuerdo Único y Modificaciones.</b><br>
<b>a)</b> Este Contrato y sus anexos contienen la totalidad del acuerdo entre las Partes formando en conjunto un solo instrumento, razón por la cual las Partes dejan sin efecto legal cualquier otro acuerdo legal o escrito que hayan acordado o suscrito con fecha anterior a la fecha de celebración del mismo.<br>
<b>b)</b> Este contrato sólo podrá ser modificado mediante convenio escrito firmado por las Partes.<br><br>

<b>11. Ley Aplicable y Jurisdicción.</b><br>
<b>MASSIVA</b> y 'El Cliente' convienen en que para todo lo relacionado con este Contrato se sujetan expresamente a las leyes vigentes y tribunales competentes en Ciudad de México, México, renunciando a cualquier otra jurisdicción que les pudiera corresponder ahora o en el futuro en razón de sus domicilios o por cualquier otra causa.<br><br>

<b>ANEXO 'A'</b><br><br>
<b>Servicios</b><br>
Anexo 'A' al contrato de prestación de servicios celebrado entre (NOMBRE DEL CLIENTE POR PLATAFORMA), <b>MASSIVA CONTABILIDAD INNOVADORA SOCIEDAD CIVIL</b> y 'El Cliente' de conformidad con la cláusula 2 del Contrato, en contraprestación por el 'Servicio' (generación y emisión electrónica de CFDIs, recopilación, procesamiento, almacenamiento, manejo y envío de información relativa a las transacciones de CFDIs realizadas para el cliente, además de las declaraciones, pago de impuestos del Cliente y nóminas sí corresponde), 'El Cliente' queda obligado a pagar a <b>MASSIVA</b> el monto, según el plan seleccionado y que está publicado en <b>massiva.mx</b> que a continuación se enuncian. <br><br>

<strong>Persona Física</strong><br>
<strong>ASALARIADOS-INTERÉS</strong><br>
<strong>$199</strong> pago anual.<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos. <br>
	-Presentación de declaración de ISR anual en el portal SAT.<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.*<br>
	-Asesorías telefónicas ilimitadas.<br>
	-<b>MASSIVA</b> resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>
<small>*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.<br>
En el caso de asalariado, si la <b>devolución es automática</b> no existe costo, pero sino es así <b>se cobra un 5% sobre la devolución.</b></small><br><br>

<strong>Persona Física</strong><br>
<strong>ARRENDAMIENTO</strong><br>
<strong>$199</strong> mensuales<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de 10 cfdi de ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.*<br>
	-Asesorías telefónicas ilimitadas.<br>
	-</b>MASSIVA</b> resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>
<small>*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>

<strong>Persona Física</strong><br>
<strong>SERVICIOS PROFESIONALES BÁSICO</strong><br>
<strong>$199</strong> mensuales<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de 12 cfdi de ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA, DIOT e IEPS en el portal SAT.<br>
	-Plantilla de cotización para tus clientes.*<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.**<br>
	-Asesorías telefónicas ilimitadas.<br>
	-<b>MASSIVA</b> resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>

<small>*Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
**El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>


<strong>Persona Física</strong><br>
<strong>SERVICIOS PROFESIONALES PLUS</strong><br>
<strong>$299</strong> mensuales<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de 20 cfdi de ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA, DIOT e IEPS en el portal SAT.<br>
	-Plantilla de cotización para tus clientes.*<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.**<br>
	-Asesorías telefónicas ilimitadas.<br>
	-MASSIVA resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>
<small>*Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
**El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>

<strong>Persona Física</strong><br>
<strong>ACTIVIDAD EMPRESARIAL</strong><br>
<strong>$199</strong> mensuales<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de 12 cfdi de ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA, DIOT e IEPS en el portal SAT.<br>
	-Plantilla de cotización para tus clientes.*<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.**<br>
	-Asesorías telefónicas ilimitadas.<br>
	-MASSIVA resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>
<small>
*Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
**El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>

<strong>Persona Física </strong><br>
<strong>Régimen de Incorporación Fiscal (RIF)</strong><br>
<strong>$99</strong> mensuales<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de 12 cfdi de ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración bimestral de ISR e IVA en el portal SAT.<br>
	-Plantilla de cotización para tus clientes.*<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.**<br>
	-Asesorías telefónicas ilimitadas.<br>
	-MASSIVA resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>

<small>*Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
**El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>

<strong>Persona Física </strong><br>
<strong>ESPECIAL </strong><br>
Costo total mensual basado en la suma de personas físicas seleccionadas*.<br>
Puedes seleccionar hasta 5 formas jurídicas a la vez.<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de 12 cfdi de ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA, DIOT e IEPS, si aplicara, en el portal SAT.<br>
	-Plantilla de cotización para tus clientes.**<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.***<br>
	-Asesorías telefónicas ilimitadas.<br>
	-MASSIVA resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>

<small>
* A la Persona Física de más valor seleccionada se suma el resto de las Personas Físicas, cobrando el 80% de su costo a la segunda y el resto de las Personas Físicas seleccionadas el 50% sobre su valor.<br>
**Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
***El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>


<strong>Persona Moral</strong><br>
<strong>Régimen General</strong><br>
Cobro accesible mensual basado sobre ingresos, gastos y contabilidad general*<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de cfdi por ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA, DIOT, RETENCIONES e IEPS en el portal SAT.<br>
	-Asesorías telefónicas ilimitadas.<br>
	-Generación de reportes auxiliares.<br>
	-Envío de contabilidad mensual al SAT.<br>
	-Generación de libros contables y contabilidad electrónica.<br>
	-Plantilla de cotización para tus clientes.**<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.***<br>
	-<b>MASSIVA</b> resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>

<small>*Consulta la calculadora de personas morales en tu perfil o con atención al cliente. Nuestros costos son los mejores del mercado.<br>
**Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
***El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>

<strong>Persona Moral</strong><br>
<strong>Con Fines no Lucrativos</strong><br>
Cobro accesible mensual basado sobre ingresos, gastos y contabilidad general*<br>
	-Análisis de situación fiscal antes del comienzo del servicio.<br>
	-Facturación de cfdi por ingresos al mes.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR, IVA, DIOT, RETENCIONES e IEPS en el portal SAT.<br>
	-Asesorías telefónicas ilimitadas.<br>
	-Generación de reportes auxiliares.<br>
	-Envío de contabilidad mensual al SAT.<br>
	-Generación de libros contables y contabilidad electrónica.<br>
	-Plantilla de cotización para tus clientes.**<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.***<br>
	-<b>MASSIVA</b> resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>

<small>*Consulta la calculadora de personas morales en tu perfil o con atención al cliente. Nuestros costos son los mejores del mercado.<br>
**Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
***El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>


<strong>Persona Moral</strong><br>
<strong>Asociaciones civiles Donatarias Autorizadas</strong><br>
MUY PRONTO<br>
$999- donativos bancarizados, declaración anual.<br>
$1,499- donativos no bancarizados y en especie, declaración mensual.<br>
$2,999- donativos del extranjero, declaración anual y mensual.<br>
	-Análisis de situación fiscal antes del comienzo del servicio y revisión del nivel de riesgo según SAT.<br>
	-Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
	-Presentación de declaración de ISR e IEPS, si procede, en el portal SAT.<br>
	-Almacenamiento de recibos de donación para calculo anual.<br>
	-Asesorías telefónicas ilimitadas.<br>
	-Generación de reportes auxiliares.<br>
	-Envío de contabilidad mensual al SAT.<br>
	-Generación de libros contables y contabilidad electrónica.<br>
	-Plantilla de cotización para tus clientes.**<br>
	-Almacenamiento y pre rellenado para facturación de tickets de compra.***<br>
	-<b>MASSIVA</b> resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta 5 años.<br><br>

<small>*Consulta la calculadora de personas morales en tu perfil o con atención al cliente. Nuestros costos son los mejores del mercado.<br>
**Cada cotización para solicitud directa de factura tendrá un costo extra de $5 pesos.<br>
***El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Revisa Anexo 'C' para ver costos.</small><br><br>


<b>Persona Moral</b><br>
<b>Asociaciones religiosas</b><br>
NO DISPONIBLE POR EL MOMENTO<br><br>

<b>Persona Moral</b> <br>
<b>Casa de Bolsa y Bancos</b><br>
<b>NO DISPONIBLE POR EL MOMENTO</b><br><br>

<b>Persona Moral </b><br>
<b>Sindicatos laborales</b><br>
<b>NO DISPONIBLE POR EL MOMENTO</b><br><br>

El cobro mensual total de las Personas Morales se basa en un tabulador interno desarrollado por <b>MASSIVA</b>, el cual según tres variantes; contabilidad fija, gastos e ingresos mensuales, y bajo un algoritmo, nuestra plataforma refleja costos totales. Estos costos serán siempre más accesibles que el costo promedio en el mercado.<br><br>

<b>ANEXO 'B' </b><br>
<b>Medios de Pago</b><br> 
Al contrato de Prestación de Servicios (el 'Contrato') celebrado entre <b>MASSIVA CONTABILIDAD INNOVADORA SOCIEDAD CIVIL</b> y 'El Cliente' para efectos de este Contrato, 'El Cliente' acepta en este acto las cuentas bancarias para ser utilizadas como medio de pago para las operaciones realizadas por medio de <b>massiva.mx</b> en los términos de la cláusula 3 del Contrato:<br>

Nombre: <b>MASSIVA CONTABILIDAD INNOVADORA S.C.</b><br>
Banco: <b>BANREGIO</b><br>
Cuenta: <b>220 93562 001 5</b><br>
CLABE: <b>058180000002766829</b><br>
Referencia: <b>Pago de inscripción a plataforma MASSIVA, con numero de usuario ".$nusuario."</b><br><br>

A través del sistema <b>OPENPAY</b>, analizamos cada transacción en tiempo real con el <b>sistema antifraude</b>, recabamos la información <b>encriptada con certificados SSL</b> y bajo la <b>certificación PCI-DSS</b> para el manejo y almacenamiento de tarjetas.<br><br>

Me comprometo a realizar los pagos por los conceptos que en este documento se detallan, con depósito a la cuenta bancaria identificada por la CLABE y número de cuenta en donde se efectuará la transacción indicado al rubro. Convengo en que el Banco Receptor quedará liberado de toda responsabilidad si el Emisor ejercitara acciones contra mí, derivados de la Ley o el Contrato que tengamos celebrado, y que el Banco emisor no estará obligado a efectuar ninguna reclamación al receptor; ni a interponer recursos de ninguna especie contra multas, sanciones o cobros indebidos, todo lo cual, en caso de ser necesario, será ejecutado por mí. El Banco Receptor tampoco será responsable si el Emisor no entregara oportunamente los comprobantes de servicios, o si los pagos se realizaran extemporáneamente por razones ajenas al Banco Receptor, el cual tendrá absoluta libertad de cancelarme este servicio si en mi cuenta no existieran fondos suficientes para cubrir uno o más de los pagos que le requiera el Emisor, o bien, ésta estuviera, bloqueada por algún motivo.<br><br>

<b>ANEXO 'C' </b><br><br>

<b>Costos adicionales por uso extraordinario o penalizaciones.</b><br><br>

<b>a)</b>	Costo adicional aplicable <b>únicamente a Personas Morales.</b> Cuando el cliente no tenga ingresos mensuales durante la activación inicial en la plataforma <b>massiva.mx</b> o de forma temporal dentro de la plataforma de <b>massiva.mx</b>, es decir, cuando no tenga un ingreso durante algún mes, procede lo siguiente:<br>

-El cobro a Personas Morales que <b>NO</b> tengan operaciones (ingresos) durante los primeros meses de inicio en la plataforma con <b>massiva.mx</b> será de <b>$199.00 al mes*</b>. Una vez que ya inicien facturación, operación e ingresos, el cobro será según el tabulador calculadora que se centra sobre contabilidad, ingresos y gastos. Si tienes dudas sobre estos cobros podrás comunicarte a: atencionclientes@massiva.mx
-Para clientes que <b>NO</b> hayan tenido ingresos en un mes pero <b>SI</b> en meses anteriores con <b>MASSIVA</b>, se aplicará de nuevo el mismo cobro automático de <b>$199.00 al mes*</b>.<br>

*El costo de $199 al mes se debe a que <b>MASSIVA</b> debe realizar actividades fijas dentro de tu contabilidad aunque no tengas ingresos o gastos.<br>

<b>b)</b> Si el cliente cancela una misma factura más de 1 vez, se le cobrará automáticamente $5 pesos adicionales por la realización de la nueva factura a reenviar a su cliente definido ya anteriormente. Aplica para Personas Físicas, en cualquiera de sus modalidades, en Personas Morales, en cualquiera de sus modalidades.<br>

<b>c)</b> El costo por la solicitud directa a factura de cada cotización aprobada tendrá un costo extra de <b>$5 pesos</b>. EL servicio de realizar la cotización está incluida en todos los paquetes pero no la conversión de la cotización a solicitud de factura directamente. Pudiendo este último paso hacerlo sin costo alguno el propio cliente pero rellenando de nuevo los datos a facturar en la opción de Solicitud de Factura. Si el cliente acepta este servicio adicional, se le cobrará en su tarjeta registrada por cada solicitud realizada.<br>


<b>d)</b> El cliente puede tener atrasos y obligaciones anteriores a MASSIVA, pudiendo nuestro equipo contable revisar y sanear conforme a las disposiciones fiscales actuales antes de llevar la contabilidad diaria. <br>

<p style=”text-align: justify;”>
Este servicio adicional tiene un costo según al régimen fiscal al que pertenezca Y al tener que presentar las declaraciones atrasadas se cobrará como mes corriente al que pertenezca siempre y cuando se deba de regularizar el total de las obligaciones, brindando descuentos sobre el valor del mes si no se deben el total de las declaraciones. Así como un descuento por la antigüedad de los atrasos, esto para el apoyo en la economía del contribuyente. Dichos descuentos y consulta de costos totales, podrán solicitarlos a nuestra área de atención al cliente. Si el cliente acepta este servicio adicional, se le cobrará en su tarjeta registrada.<br>

La fecha de <b>análisis</b> para Personas Físicas y Morales será de <b>2 días hábiles</b>, y la realización de la contabilidad atrasada antes de <b>MASSIVA</b> será de <b>5 a 7 días hábiles</b> para <b>Personas Físicas</b> y de <b>20 a 30 días</b> para <b>Personas Morales</b>.<br>

	<b>e) MASSIVA</b> resguardará toda su documentación e información mientras sea cliente de MASSIVA, en su Perfil en la sección Respaldo, donde podrá tener un respaldo de toda su contabilidad en el momento que la solicite.<br>


<b>f)</b> El costo por realizar las facturas de los <b>tickets de compra</b> (comprobante fiscal) almacenados por 'El Cliente' por <b>MASSIVA</b> tiene un costo adicional de <b>10 tickets por $99 pesos, 25 tickets por $199 pesos, 50 tickets por $349 pesos, 100 tickets por $699 pesos,</b> pero no tendrá ningún costo el almacenamiento y la realización de las facturas por los tickets de compra (comprobantes fiscales) almacenados por el propio cliente. Si el cliente acepta este servicio y costo adicional, se le cobrará en su tarjeta registrada y podrá hacer uso de los créditos comprados, por una vigencia no máxima de 3 meses (aplica solo para tickets no para facturas extras), pudiendo renovar el servicio tantas veces quiera 'El Cliente'.<br>

<b>g)</b> Adicional a la contratación de su paquete por ser Persona Física y/o Persona Moral, el cliente puede contratar el servicio de <b>Nóminas</b> con un costo <b>desde $299</b> según el número de trabajadores. <br>
</p>
De <b>1 a 25 trabajadores</b> el costo mensual será de <b>$299</b>, de <b>26 a 50 trabajadores</b> el costo mensual será de <b>$199</b>, de <b>51 trabajadores</b> en adelante el costo mensual será de <b>$99.</b><br><br>

El servicio de <b>Nómina</b> incluye:<br>

	-Reporte de la Nómina.<br>
	-Control del timbrado de los CFDI.<br>
	-Timbrado de los CFDI.<br>
	-Acumulado de Nóminas mensual.<br>
	-Generación de las cuotas obreros patronales (IMSS, SAR e INFONAVIT).<br>
	-Generación de la línea de captura dependiendo del impuesto por cada Estado.<br>
	-Generación del Pago referenciado (SIPARE) interno sin SUA.<br>
	-Generación de reporte de incidencias para carga en SUA.*<br>
	-Movimientos del Seguro Social (Altas, Bajas, Incapacidad y Modificación de Salarios)<br><br>


Incluye: Control de salarios, horas extras, prima vacacional, aguinaldo, reparto de utilidades, vacaciones e incidencias.<br>

*El cliente decide a través de la plataforma nómina si massiva realiza la carga en el SUA, con un costo adicional. Este costo adicional es de <b>$49 por cada carga en el SUA.</b><br>

Cada <b>cancelación de recibo de nómina y expedición nueva</b> tendrá un costo extra de <b>$5 pesos.</b><br>

<b>h)</b> El costo por la compra de facturas extras es de <b>10 facturas por $49 pesos, 25 facturas por $99 pesos, 50 facturas por $189 pesos, 100 facturas por $289 pesos,</b> por si algún mes requieres más de las que tu paquete incluye.<br>

Consulta al área de atención al cliente para mayor información, atencionclientes@massiva.mx.<br>

<b>i)</b> 'El Cliente' podrá contratar el servicio de renta del <b>CHECADOR MASSIVA.</b> Si el cliente acepta este servicio adicional, se le cobrará en su tarjeta registrada. 
Este servicio de <b>CHECADOR MASSIVA</b> complementa a la plataforma de <b>Nóminas</b>, ya que eficientiza tiempos y efectividad de datos. <br>

Consulta al área de atención al cliente para mayor información de como adquirir tu <b>CHECADOR MASSIVA</b>, atencionclientes@massiva.mx.<br>

<b>j)</b> 'El Cliente' podrá contratar el servicio de <b>PUNTO DE VENTA ONLINE.</b> Si el cliente acepta este servicio adicional, se le cobrará en su tarjeta registrada.<br>

Consulta al área de atención al cliente para mayor información de como adquirir tu <b>PUNTO DE VENTA ONLINE,</b> atencionclientes@massiva.mx. <br>

<b>k)</b> 'El Cliente' podrá tener acceso a  una sección de <b>Inventarios, es gratuito,</b> solo deberá seleccionarlo en su carrito dentro de su perfil o bien antes de contratar el plan.<br>

<b>l)</b> Si 'El Cliente' requiere de modificaciones dentro de su forma jurídica tendrá un costo adicional, que a continuación reflejamos:<br>
<b>- Suspensión de actividades,</b> su costo es de <b>$49 pesos.</b><br>
<b>- Cambio de domicilio,</b> su costo es de <b>$49 pesos.</b><br>
<b>- Actualización de obligaciones fiscales,</b> su costo es de <b>$49 pesos.</b><br>
<b>- Actualización de e.firma,</b> su costo es de <b>$49 pesos.</b><br>
<b>- Constancia de obligación fiscal,</b> su costo es de <b>$29 pesos.</b><br><br>


<b>ANEXO 'D'</b><br>

<b>Sincronización de cuentas bancarias.</b><br>

<b>a)</b>	EL servicio de sincronización de cuentas bancarias de nuestros clientes se realiza a través de <b>Afterbanks</b> con domicilio fiscal en Valencia, España. Los servidores están alojados en centros de datos seguros alrededor del mundo y son monitoreados 24/7. Para ingresar se requieren varios niveles de autenticación, incluyendo verificación de identidad y reconocimiento biométrico.<br>
<b>b)</b>	Usamos encriptación con el estándar industrial AES 256-bit, el mismo que usan los bancos, además la información se almacena en centros de datos privados que requieren verificación de acceso multinivel, por lo tanto la información está a salvo y no puede ser consultada por terceros sin autorización.<br>
<b>c)</b>	Se obtienen los estados de cuenta desglosados de <b>solo lectura,</b> con nombre del cuentahabiente, dirección, CLABE, RFC, saldo de la cuenta, historial de transacciones, depósitos y retiros con fecha, monto y moneda.<br>
<b>d)</b>	<b>MASSIVA</b> no compartirá o transferirá datos personales y/o información financiera a ningún tercero, sin la autorización previa del titular.<br>
<b>e)</b>	Cuando los usuarios finales proporcionan sus credenciales a <b>MASSIVA</b>, autorizan a <b>MASSIVA</b> a actuar en su nombre para extraer su información de las instituciones de solo lectura.<br>
<b>f)</b>	Solo se permite un acceso de sólo lectura a la información y no es posible hacer pagos o transferencias a través de <b>MASSIVA.</b><br><br><br>


<b>Actualización: 01 de marzo de 2019</b> <br><br>
</p>	


<b>massiva.mx</b><br>
<b>#SencillaSegura</b><br>

</body>
</html>


";


$pdf=new PDF_HTML();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 8);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);


/* --- Image --- */
$pdf->Image('img/logo.jpg',  100, 5, 100, 27);
/* --- Cell --- */
$pdf->SetXY(151, 35);
$pdf->Cell(49, 6, 'Fecha: '.$fechaGlobal, 0, 1, 'R', false);
$pdf->Cell(49, 6, '', 0, 1, 'R', false);
/* --- MultiCell --- */
$pdf->SetXY(10, 41);
$pdf->WriteHTML($twxt);
//$pdf->MultiCell(190, 236, $twxt, 0, 'L', false);


$pdf->Output('contenedor/clientes/'.$rfc.'/'.$rfc.'_contratoServicios.pdf','F');

?>
<script src="js/vista/preregistro.js"></script>
</head>
<body>
<!--div class="alert alert-info" role="alert"><dev><?php $vars = get_defined_vars(); print_r($vars);  ?></dev></div-->

    <div class="gray-bg dashbard-1">
		<div class="row"><div class="alert alert-warning text-center"><b>Bienvenido <?= $nombre?></b></div></div>
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header">
			<div class="col-md-12 text-center">
				<img src="img/logo.png" style='height: 70px'>
			</div>
		</div>
		<hr>
		<div class='row text-center'>
			<div class="alert alert-warning">Ya estás por terminar el proceso de registro. Revisa y lee con detenimiento el contrato de cliente con massiva. 	</div>
		</div>

		<div class='row'><div class='col-md-12' id='alertAccion' name='alertAccion'></div></div>
		<!--contrato-->
		<div class='row'>
			<div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-content text-center">
						<embed src="contenedor/clientes/<?=$rfc?>/<?=$rfc?>_contratoServicios.pdf" type="application/pdf" width="100%" height="600">
                    </div>
                </div>
			</div>
			<!--carga de informacion-->
			<div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-content">
						

							<div class="row">
								<div class="col-md-4"></div>

								<div class="col-md-4 text-center"><input type="checkbox" name="aviPri" id="aviPri" value='1'> <a href="AvisodePrivacidadMASSIVA.pdf" target="_blank" style='color:  rgb(226, 0, 74)' style="text-decoration:none;">Aviso de Privacidad</a> </div>
								<div class="col-md-4"></div>
							
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12 text-center">
									<input type="hidden" name="idRefe" id="idRefe" value="<?= $_SESSION['id_usuario'];?>">
									<a href="preregistro5.php"><button type="button" class="btn btn-w-m btn-primary"> Regresar</button></a>
									<button class="btn btn-primary" id="pasasrsiete">&nbsp;Acepto</button>		
								</div>
							</div>
					
						
                    </div>
                </div>
            </div>
		</div>
		<hr>
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div>   
    </div>

<!--seccion para el modal -->
<div class="modal inmodal fade" id="sinefirma" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo"></h4>
			</div>
			<div class="modal-body">
				<div class='row text-center'>
					<img src="img/logo.png" style="height: 60px">
					<hr>
					<br>
					<div class="alert alert-danger"><h4><b>Es tiempo de que saques tu cita en el SAT.</b><br><br>
					<a href="https://citas.sat.gob.mx/citasat/agregarcita.aspx" target="_blank"><button type="button" id='btnElimina' class="btn btn-w-m btn-primary"> Sacar cita</button></a>
					</h5></div>
					
					<hr>
					<div class="alert alert-warning"><h4><b>En cuanto tengas los archivos de la e.firma entra en Acceso desde la web y adjúntalos.<br><br>¡Te esperamos!</b>
					</h5></div>
					

				</div>
    			
			</div>
			<div class="modal-footer">
				<!---este boton cuando no tenga la efirma lo sacamos del proceso y guardamos la informacion y cuando vuelva a entrar lo mandamos al resumen-->
				<button type="button" id='btnElimina' class="btn btn-w-m btn-primary"> Ya tengo mi cita</button>
				<button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
