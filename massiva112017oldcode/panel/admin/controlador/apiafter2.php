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
    
    //consultamos los bancos que tiene registrado el usuario
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

        //despues de guardar hacemos la consulta para obtener ahora los movimientos de cada cuenta
        $obteneCuentas = $afterbank->obteneCuentas($id_usuario);

        while($obteneCuentasInfo = $obteneCuentas->fetch_object()){
                
            /* obtenemos las cuentas */
            $cuentaCon = $obteneCuentasInfo->cuenta;
            $tipoCuenta = $obteneCuentasInfo->tipo;
            
            if($tipoCuenta != 'investment'){

                //Datos que recibe la API de AfteBank
                $servicekey  = servicekeyAfter; //obligatorio -licencia de identificación proporcionada por afterBank
                //$details = false; //este valor es para obtener mas informacion 
                $service = $banco; //obligatorio - a partir de la lista de bancos que proporciona la afterBank ejemplo: inbursa_mx
                $documentType = 0;
                $user = $output2;
                $pass = $output1;
                $pass2 = ''; //algunos bancos utilizan una segunda contraseña
                $products = $cuentaCon; //datos obligatorios fijos, pueden cambiar verificar documentación
                $account_id= -1; //puede variar, verificar documentación
                $startDate = ''; //obligatorio -fecha desde la que queremos obtener movimientos dd-mm-aaaa;
                //$startDate = '01-01-2019'; //obligatorio -fecha desde la que queremos obtener movimientos dd-mm-aaaa;
                $headers = array('Content-Type: application/x-www-form-urlencoded');

                $ch = curl_init();https:
                curl_setopt($ch, CURLOPT_URL,'https://api.afterbanks.com/V3/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                $data = array('servicekey' => urlencode($servicekey),
                'service' => urlencode($service),
                'documentType' => urlencode($documentType),
                'user' => urlencode($user),
                'pass' => urlencode($pass),
                'pass2' => urlencode($pass2),
                'account_id' => urlencode($account_id),
                'products' => urlencode($products),
                'startdate' => urlencode($startDate)
                //'details' => urlencode($details)
                );

                $postvars='';
                $sep='';
                foreach($data as $key=>$value){
                    $postvars.=$sep.$key.'='.$value;
                    $sep='&';
                }
                
                /*echo "esta es la cadena que envio: ".$postvars;
                echo "<br>";*/
                //Ejemplo de string que acepta el api
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_multi_getcontent ($ch);
                $remote_server_outputT = curl_exec($ch);
                
                /*echo "despues de esto tiene que imprimir la llamada<br>";
                echo $remote_server_outputT;
                echo "<br><hr>";*/

                // cerramos la sesión cURL
                $obj = json_decode($remote_server_outputT, true); 
                // echo var_dump($obj);
               
                
                $valor = $obj['0']['transactions'];
                /*print_r($valor);
                echo "<hr>";*/
                
                $valordos = $valor;

                $longitud = count($valordos);
 
            //Recorro todos los elementos
            for($i=0; $i<$longitud; $i++) {
                //saco el valor de cada elemento
                $id_usuario = $id_usuario;
                $cuenta = $cuentaCon;
                $fechaUno = $valordos[$i]['date'];
                $fechaDos = $valordos[$i]['date2'];
                $monto = $valordos[$i]['amount'];
                $descripcion = $valordos[$i]['description'];
                $balance = $valordos[$i]['balance'];
                $idTransaccion = $valordos[$i]['transactionId'];
                $categoria = $valordos[$i]['categoryId'];
                $fechaCreacion = $fechaAccion;
                //aqui vemos si es ingreso o egres
                $vriDf = substr($monto, 0, 1);
                if($vriDf == '-'){ $quees = 1;} //esto es un ingreso
                else{ $quees = 2; }//esto es un egreso
                
               /* echo "id usuario: ".$id_usuario."<br>";
                echo "cuenta: ".$cuenta."<br>";
                echo "fecha uno: ".$fechaUno."<br>";
                echo "fecha dos: ".$fechaDos."<br>";
                echo "monto: ".$monto."<br>";
                echo "descripcion: ".$descripcion."<br>";
                echo "balance: ".$balance."<br>";
                echo "id transaccion: ".$idTransaccion."<br>";
                echo "categorias: ".$categoria."<br>";
                echo "fechas de creacion: ".$fechaCreacion."<br>";
                echo "que tipo es: ".$quees."<br><hr>";*/

                $veriMovimiLL = $afterbank->veriMovimi($idTransaccion);
                $veriMovimiLLInfo = $veriMovimiLL->fetch_object();
                $idMovv = $veriMovimiLLInfo->idTransaccion;

                    /*echo "este es el resultado de la consulta".$idMovv;
                    echo "<br><hr>";*/
                    //en caso de que alla movimiento no se guarda nada si no si
                    if($idMovv == '' ){
                        //guardamos el movimiento
                        $agreMovCuenta = $afterbank->agreMovCuenta($id_usuario,$cuenta,$fechaUno,$fechaDos,$monto,$descripcion,$balance,$idTransaccion,$categoria,$fechaCreacion,$quees,$banco);
                        //vairbale para decir que si hubo movimientos
                        $valorRegresa1 = 6;
                    }else{ $valorRegresa1 = 7; }
               
                }
                
               
                curl_close($ch);
            }
            
            
        }
    }   
    /* redireccionamos a la pagina */
    if($valorRegresa1 == 6){  header('location:../index.php?secc=cuentaBancarias&vaBan='.$valorRegresa1); }
    else{ header ('location:../index.php?secc=cuentaBancarias&vaBan='.$valorRegresa1); }
        
?>