<div id='pagoEfectivo'>
    <div class='row'>
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <h4>Tu C&oacute;digo de pago</h4>
            <div class="whitepaper">

                <div class="Header">
                    <div class="Logo_empresa"><img src="images/logo.png" alt="Logo"></div>
                    <div class="Logo_paynet"><div>Servicio a pagar</div><img src="images/paynet_logo.png" alt="Logo Paynet"></div>
                </div>

                <div class="Data">
                    <div class="Big_Bullet"><span></span></div>
                    <div class="col1">
                        <img width="300" src="<?php echo $barcode->barcode_url; ?>" alt="C&oacute;digo de Barras">
                        <center><span><?php echo $barcode->reference; ?></span></center>
                        <small>En caso de que el esc&aacute;ner no sea capaz de leer el c&oacute;digo de barras, escribir la referencia tal como se muestra.</small>
                    </div>
                    <div class="col2">
                        <h2>Total a pagar</h2>
                        <h1>$ <?php echo $paquete['precio']; ?><small> MXN</small></h1>
                        <span class="note">La comisi&oacute;n por recepci&oacute;n del pago var&iacute;a de acuerdo a los T&eacute;rminos y Condiciones que cada cadena comercial establece.</span>
                    </div>
                </div>

                <div class="DT-margin"></div>
                <div class="Data">
                    <div class="Big_Bullet"><span></span></div>
                    <div class="col1"><h3>Detalles de la compra</h3></div>
                </div>

                <div class="Table-Data">
                    <div class="table-row color1">
                        <div>Descripci&oacute;n</div>
                        <span>Inscripci&oacute;n <?php echo $paquete['plazo_de_contrato']; ?> con massiva</span>
                    </div>

                    <div class="table-row color2">
                        <div>Nombre del cliente</div>
                        <span><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_paterno'] . ' ' . $usuario['apellido_materno']; ?></span>
                    </div>

                    <div class="table-row color1">
                        <div>Correo del cliente</div>
                        <span><?php echo $usuario['email']; ?> </span>
                    </div>

                    <div class="table-row color2">
                        <div>N&uacute;mero de usuario</div>
                        <span><?php echo $persona_id; ?></span>
                    </div>

                    <div class="table-row color1">
                        <div>Fecha y hora</div>
                        <span><?php echo date("Y-m-d G:i:s"); ?></span>
                    </div>

                </div>

                <div class="DT-margin"></div>

                <div>
                    <div class="Big_Bullet">
                        <span></span>
                    </div>
                    <div class="col1 text-left">
                        <h3>Como realizar el pago</h3>
                        <ol>
                            <li>Acude a cualquier tienda afiliada</li>
                            <li>Entrega al cajero el c&oacute;digo de barras y menciona que realizar&aacute;s un pago de servicio Paynet</li>
                            <li>Realizar el pago en efectivo por $ <?php echo $paquete['precio']; ?> MXN </li>
                            <li>Conserva el ticket para cualquier aclaraci&oacute;n</li>
                        </ol>
                        <small>Si tienes dudas comunícate a atencionclientes@massiva.mx</small>
                    </div>
                    <div class="col1 text-left">
                        <h3>Instrucciones para el cajero</h3>
                        <ol>
                            <li>Ingresar al men&uacute; de Pago de Servicios</li>
                            <li>Seleccionar Paynet</li>
                            <li>Escanear el c&oacute;digo de barras o ingresar el n&uacute;m. de referencia</li>
                            <li>Ingresa la cantidad total a pagar</li>
                            <li>Cobrar al cliente el monto total m&aacute;s la comisi&oacute;n</li>
                            <li>Confirmar la transacci&oacute;n y entregar el ticket al cliente</li>
                        </ol>

                    </div>
                    <br>
                </div>
                <hr><br>
                <div class="row">
                    <br>
                    <img src="images/01.png" width="80" height="35">
                    <img src="images/02.png" width="80" height="35">
                    <img src="images/03.png" width="80" height="35">
                    <img src="images/04.png" width="80" height="35">
                    <img src="images/05.png" width="80" height="35">
                    <img src="images/06.png" width="80" height="35">
                    <img src="images/07.png" width="80" height="35">
                    <img src="images/08.png" width="80" height="35">
                    <br>
                    <img src="images/powered_openpay.png" alt="Powered by Openpay" width="150">
                </div>

            </div>	
        </div>
    </div>
    <hr>
</div>