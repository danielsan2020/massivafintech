<?php

	date_default_timezone_set("America/Mexico_City");
	//instanciamos el metodo para mostrar la informacion
	if($soliRes == 1){
				
		//valores generales
		$rfc = $_SESSION['rfc'];
		$fecha = date("Y-m-d");
		$nombre = $rfc."_".$fecha;

		class FlxZipArchive extends ZipArchive { 

			public function addDir($location, $name) { 
				$this->addEmptyDir($name); $this->addDirDo($location, $name); 
			} 
			
			private function addDirDo($location, $name) { 
				$name .= '/'; $location .= '/'; $dir = opendir ($location); 
				while ($file = readdir($dir)) { 
						if ($file == '.' || $file == '..') continue; 
						$do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile'; 
						$this->$do($location . $file, $name . $file); 
				} 
			} 
		}  

		 $the_folder = 'contenedor/clientes/'.$rfc.'/'; 
		 $zip_file_name = 'contenedor/descargas/'.$nombre.'.zip'; 
		 
		 $za = new FlxZipArchive; 
		 $res = $za->open($zip_file_name, ZipArchive::CREATE); 

		 if($res === TRUE) { 
				$za->addDir($the_folder, basename($the_folder)); 
				$za->close(); 
				$valor = '1';
			} 
		else{ echo 'Could not create a zip archive'; } 
		/*
		 // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
		 header("Content-type: application/octet-stream");
		 header("Content-disposition: attachment; filename=miarchivo.zip");
		 // leemos el archivo creado
		 readfile('miarchivo.zip');
		 // Por último eliminamos el archivo temporal creado
		 unlink('miarchivo.zip');//Destruye el archivo temporal*/
		

	}
?>
<!--seccion de contenido-->
<script src="js/vista/blog.js"></script>
<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
		<div class="ibox ">
			<div class="ibox-title text-center">
				<h5>Tu Respaldo</h5>
			</div>
			<div class="ibox-content text-center">

				<?php if($valor != 1){?>
				<div class="spiner-example">
					<div class="sk-spinner sk-spinner-cube-grid">
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
						<div class="sk-cube"></div>
					</div>
				</div>
				<form action='index.php' method='GET'>
						<input type='hidden' name='soliRes' id='soliRes' value='1'> 
						<input type='hidden' name='secc' id='secc' value='respaldo'> 
						<button type='submit' class='btn btn-primary'>Generar respaldo de tu contabilidad para descarga</button>
					</form>
				<?php }else{?>
					<a class='btn btn-primary' href='<?= $zip_file_name ?>' download >Descargar archivo</a>
				<?php }?>
				
					
				
				
			</div>
		</div>
    </div>
</div>
<br>
