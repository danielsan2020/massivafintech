<?php
@session_start();	
    ini_set('max_execution_time', 900);
    /****************************************************************/
    // FUNCIONES DE CONTROLADOR PARA api de faterbank               //
    // CREACION DEL ARCHIVO:                                        //
    // MODIFICA Y/O TRABAJA: Humansl11                              //
    // PROYECTO: Massiva                                            //
    /****************************************************************/
    date_default_timezone_set('America/Mexico_City');
    /*error_reporting(E_ALL);
    ini_set('display_errors','1');*/
    
    /* Instanciamos las clases que se necesitan */
    require_once "../modelo/afterModelo.php";
    require_once "../modelo/datosKey.php";

    /* Instanciamos la funcion */
    $afterbank = new afterbank();
    
    //*********************Variables generales***************************************//
    $fechaAccion = date('Y-m-d H:i:s');
    $id_usuario = $_SESSION['id_usuario'];
    $valorRegresa = '';
    //echo $id_usuario;
   
    /* obtenemos los bancos que tengan registrado el usuario */
    $bancosUsuario = $afterbank->consultamosBancos($id_usuario);

    //recoerremos el resultado
    while($bancosUsuarioInfo = $bancosUsuario->fetch_object() ){
        /* recuperamos la vairbales que vamos a necesitar */
        $clave = $bancosUsuarioInfo->claveBanco;
        $usuario = $bancosUsuarioInfo->usuarioBanco;
        $fechaNacimiento = $bancosUsuarioInfo->fechaNacimiento;
        $banco = $bancosUsuarioInfo->banco;

        /* recuperamos el valor del usuario */
        $key1=hash('sha256', SECRET_KEY);
        $iv1=substr(hash('sha256', SECRET_IV), 0, 16);
        $output1=openssl_decrypt(base64_decode($clave), METHOD, $key1, 0, $iv1);

        /* recuperamos el valor de la clave */
        $key2=hash('sha256', SECRET_KEY);
        $iv2=substr(hash('sha256', SECRET_IV), 0, 16);
        $output2=openssl_decrypt(base64_decode($usuario), METHOD, $key2, 0, $iv2);

        /* recuperamos la fecha de nacimiento */
        $key3=hash('sha256', SECRET_KEY);
        $iv3=substr(hash('sha256', SECRET_IV), 0, 16);
        $output3=openssl_decrypt(base64_decode($fechaNacimiento), METHOD, $key3, 0, $iv3);

        
        /* realizamos la conexion a la api de fater */

        //Datos que recibe la API de AfteBank
        $servicekey  = servicekeyAfter; //obligatorio -licencia de identificación proporcionada por afterBank
        $details = true; //este valor es para obtener mas informacion 
        $service = $banco; //obligatorio - a partir de la lista de bancos que proporciona la afterBank ejemplo: inbursa_mx
        $user = $output2;
        $documentType = 0;
        $pass = $output1;
        $pass2 = ''; //algunos bancos utilizan una segunda contraseña
        $products = 'GLOBAL'; //datos obligatorios fijos, pueden cambiar verificar documentación
        $account_id= -1; //puede variar, verificar documentación
        $startDate = ''; //obligatorio -fecha desde la que queremos obtener movimientos dd-mm-aaaa;
        $headers = array('Content-Type: application/x-www-form-urlencoded');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://api.afterbanks.com/V3/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          
        
        $data = array('servicekey' => urlencode($servicekey),
         'service' => urlencode($service),
         'documentType' => urlencode($documentType),
         'user' => urlencode($user),
         'pass' => urlencode($pass),
         'pass2' => urlencode($pass2),
         'products' => urlencode($products),
         'startdate' => urlencode($startDate),
         'details' => urlencode($details),
         'account_id' => urlencode($account_id));

         $postvars='';
         $sep='';
         foreach($data as $key=>$value){
             $postvars.=$sep.$key.'='.$value;
             $sep='&';
         }
         
        //Ejemplo de string que acepta el api
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_multi_getcontent ($ch);
        $remote_server_output = curl_exec($ch);

        // cerramos la sesión cURL
        curl_close($ch);
        //print_r($remote_server_output);
        $obj = json_decode($remote_server_output, true); 
        /* verifiamos si regresa un mensaje de error */
        $mensaje = $obj['message'];

        /* enc aso de que no contenga mensaje recorremos el array */
        if($mensaje == ''){
            foreach($obj as $valor) {   
                /* generamos vaibles para guardar */
                $cuenta = $valor['product'];
                $tipo = $valor['type'];
                $balance = $valor['balance'];
                $moneda = $valor['currency'];
                $descripcion = $valor['description'];
                
                // verificamos si ya existe la cuenta del servicio del usuario
                $consultamosMovimiento = $afterbank->consultamosMovimiento($id_usuario,$cuenta,$tipo,$balance,$moneda,$descripcion);
                $consultamosMovimientoInfo = $consultamosMovimiento->fetch_object();
                $valorIDS = $consultamosMovimientoInfo->idMovimiento;
                
                 //sabiendo si existe un id con los valores 
                if($valorIDS == ''){
                    //guardamos valores
                    $tipoMov = "Afterbank";
                    $estatus = 1;
                    $banco = $banco;
                    $fechaCreacion = $fechaAccion;
                    $agregamosMovimiento = $afterbank->agregamosMovimiento($id_usuario,$cuenta,$tipo,$balance,$moneda,$descripcion,$tipoMov,$estatus,$banco,$fechaCreacion);
                }
            }
        }

        /* al terminar el proceso regresamos a la pagina de bancos */
        header ('location:apiafter2.php');
    }

?>