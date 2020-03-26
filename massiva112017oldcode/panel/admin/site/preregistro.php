<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){
$sinFima = $_SESSION['noTengoEfirma'];
///cabezera
include 'estructura/header.php';
///script
include 'estructura/script.php';
//incluimos pdf

require('plugins/fpdf/WriteHTML.php');

$aviso = $_GET['valorReg'];
$var = $_GET['var'];

//genero las variables para uso generar
$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
$nusuario = $_SESSION['nusuario'];
$rfc = $_SESSION['rfc'];
$tipo = ($_SESSION['formaJuridica'] == 'f')? 'Física' : 'Moral';

$fechaGlobal = date("Y-m-d");
//obtenemos el valor del usuario
$indes = $_GET['indes'];
//obtenemnos el valor si hay un error al cargar archivos
$error = ($_GET['error'] == '')? '' : $_GET['error'] ;

//creamos el pdf para mostrarlo despues
$twxt = "<b>CONTRATO DE RESPONSIVA Y PRESTACIÓN DE SERVICIOS</b> (el 'Contrato') que celebran, por una parte, <b>MASSIVA CONTABILIDAD INNOVADORA SOCIEDAD CIVIL 
	'MASSIVA'</b>, ( ".$nombre.",con la forma jurídica de persona ".$tipo."), y conjuntamente, las 'Partes' e indistintamente una 'Parte', al tenor de las siguientes declaraciones:<br>

	<b>DECLARACIONES</b><br>

	1. Declara MASSIVA que:<br><br>

	a) Esa una sociedad debidamente constituida de conformidad con las leyes de los Estados Unidos Mexicanos como consta en escritura escritura número 100,990 otorgada ante la fe del licenciado, Notario, Lic. Alfredo Ayala Herrera, Titular de la Notaria 237, de la Ciudad de México, el día 7 de febrero de 2019., acreditando a su vez a su representante con las facultades suficientes para celebrar este Contrato.<br>

	b) Se encuentra inscrita en el Registro Federal de Contribuyentes bajo el número MCI1902072A6.<br>

	c) Para MASSIVA el tratamiento de sus datos personales es de suma importancia. De esta manera se reitera nuestro compromiso con su privacidad y el derecho a la autodeterminación informativa.<br><br>

	Como cliente, empleado y proveedor de MASSIVA usted debe estar seguro de que sus datos personales estarán protegidos. La seguridad de su información es nuestra prioridad, es por ello que la protegemos mediante el uso, aplicación y mantenimiento de altas medidas de seguridad.<br><br>

	En virtud de lo anterior el presente documento tiene como objeto informarle sobre el tratamiento que se le dará a sus datos personales cuando los mismos son recabados, utilizados, almacenados, transmitidos y/o transferidos por MASSIVA, lo anterior, en cumplimiento a lo establecido en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (en adelante la “Ley”), su Reglamento y Lineamientos.<br><br>

	2. Declara el Cliente que:<br><br>

	a) Es una Persona Física o Moral debidamente constituida de conformidad con las leyes de la República Mexicana, contando su representante con las facultades suficientes para celebrar este Contrato, y en caso de ser la primera que cuenta con capacidad legal de acuerdo a lo establecido en el Código Civil vigente. <br>

	b) Se encuentra adscrito en el Registro Federal de Contribuyentes con número y domicilio fiscal que adjuntan en la plataforma massiva.mx.<br>

	c) Requiere que MASSIVA le preste los servicios como proveedor de facturación electrónica y contabilidad integral digital.<br>
	En virtud de las declaraciones anteriores, las Partes convienen sujetarse a lo dispuesto en las siguientes cláusulas.<br>

	d) Hace entrega digital de forma voluntaria a MASSIVA de toda la documentación digitalizada, los archivos de su e.firma junto a su contraseña para el análisis inicial de mi situación fiscal por parte de MASSIVA y para llevar toda mi contabilidad mensualmente a través de la plataforma llamada massiva.mx.";


$pdf=new PDF_HTML();
$pdf->AddPage('P', 'A4');
$pdf->SetAutoPageBreak(true, 10);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTopMargin(10);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);


/* --- Image --- */
$pdf->Image('img/logo.jpg', 139, 10, 61, 27);
/* --- Cell --- */
$pdf->SetXY(151, 35);
$pdf->Cell(49, 6, 'Fecha: '.$fechaGlobal, 0, 1, 'R', false);
$pdf->Cell(49, 6, '', 0, 1, 'R', false);
/* --- MultiCell --- */
$pdf->SetXY(10, 41);
$pdf->WriteHTML($twxt);
//$pdf->MultiCell(190, 236, $twxt, 0, 'L', false);


$pdf->Output('contenedor/clientes/'.$rfc.'/'.$rfc.'_AcuerdoEntregaEfirmaDocumentosFiscales.pdf','F');


?>
<script>
function cambiar(){ document.getElementById('clave').type = 'text'; }
</script>
</head>
<body>
<!--div class="alert alert-info" role="alert"><dev><?php $vars = get_defined_vars(); print_r($vars);  ?></dev></div-->

    <div class="gray-bg dashbard-1">
		<div class="container-fluid"><div class="row"><div class="alert alert-warning text-center"><b>Bienvenido <?= $nombre?></b></div></div></div>
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header"><div class="col-md-12 text-center"><img src="img/logo.png" style='height: 70px'></div></div>
		<hr>
		<div class='row text-center'>
			<div class="alert alert-warning">Por tu seguridad y control validamos toda tu información proporcionada ya que será de suma importancia.<br> <b>Recuerda que tus archivos deben de pesar menos de 2 MB.</b></div></div>
		</div>
		
		<!--mensaje de error-->
		<?php if($error == 1){?>
		<div class='row'> <div class="alert alert-danger text-center">Recuerda cargar todos los documentos solicitados.</div></div>
		<?php }?>
		<hr>
		<!--contrato-->
		<div class='row text-center'>
			<?php echo $aviso;?>
		</div>

		<div class='row'>
			<div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Contrato por entrega de documentos oficiales</h5>
                        <div class="ibox-tools"><a class="fullscreen-link"><i class="fa fa-expand"></i></a></div>
                    </div>
                    <div class="ibox-content">
						<embed src="contenedor/clientes/<?=$rfc?>/<?=$rfc?>_AcuerdoEntregaEfirmaDocumentosFiscales.pdf" type="application/pdf" width="100%" height="600"></embed>
                    </div>
                </div>
			</div>
			<!--carga de informacion-->
			<div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Carga de documentación oficial requerida </h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>

                    <div class="ibox-content">
						<form action='controlador/documentacionpre.php' method='POST'  enctype="multipart/form-data">

							<input type='hidden' name='rfcAr' id='rfcAr' value='<?= $rfc;?>'>
						
							<div class="input-group m-b">
								<span class="input-group-addon">Comprobante de domicilio</span> 
								<input type="file" placeholder="domicilio" id='comprobante' name='comprobante' class="form-control" required>
							</div>
							<hr>
							<div class="input-group m-b">
								<span class="input-group-addon">INE, IFE o FM</span> 
								<input type="file" placeholder="Username" name='iden1' id='iden1' class="form-control" required>
								<input type="file" placeholder="Username" name='iden2' id='iden2' class="form-control" required>
							</div>
							<hr>
							
							<?php if($sinFima != 1){?>
							<!---estos valores no apareceran a las personas que no tengan efirma hasta el preregistro 7 -->
							<div class="input-group m-b">
								<span class="input-group-addon">e.firma .KEY</span> 
								<input type="file" placeholder="efirma" name='key' id='key' class="form-control" required>
							</div>
							<hr>
							<div class="input-group m-b">
								<span class="input-group-addon">e.firma .CER</span> 
								<input type="file" placeholder="efirma" name='cer' id='cer' class="form-control" required>
							</div>
							<hr>
							<div class="input-group m-b">
								<span class="input-group-addon">Contraseña de e.firma</span> 
								<input type="password" placeholder="Ingrese su clave de la e.firma" name='clave' id='clave'  class="form-control" required>
								<span class="input-group-addon"><i class="fa fa-eye" onclick="javascript: cambiar()"></i></span>
							</div>
							<!---estos valores no apareceran a las personas que no tengan efirma hasta el preregistro 7 -->
							<?php }?>
							
							<button class="btn btn-primary " type="submit">&nbsp;Guardar y continuar</button>
							<!--este boton verificamos si ya tiene guardado los documentos-->
							<?php if($var == 1){?>
							<a href="preregistro2.php"><button class="btn btn-primary " type="submit">&nbsp;Adelante</button></a>
							<?php }?>
						</form>
						
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
</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
