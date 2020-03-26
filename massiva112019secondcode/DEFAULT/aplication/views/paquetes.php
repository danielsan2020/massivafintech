<!--section id="paquetes">
    <div class="container-fluid pt-5">
        <div class="text-center pt-5 pb-5">
            <h2>Nuestros planes</h2>
            <hr>
        </div>
    </div>
    <div class="container">
        <!--?php
        $paquetes_file = fopen("content/paquetes.json", "r")or die("No se puede cargar el contenido");
        $paquetes_json = fread($paquetes_file, filesize("content/paquetes.json"));
        fclose($paquetes_file);
        $paquetes_con_descripcion = json_decode($paquetes_json, TRUE);
        $paquetes_tickets_file = fopen("content/paquetes_tickets.json", "r")or die("No se puede cargar el contenido");
        $paquetes_tickets_json = fread($paquetes_tickets_file, filesize("content/paquetes_tickets.json"));
        fclose($paquetes_tickets_file);
        $paquetes_tickets = json_decode($paquetes_tickets_json, TRUE);
        ?>
        <div class="row">
            <div class="col-md-12 m-3">
                <ul class="nav nav-pills mb-3 text-secondary" role="tablist">
                    <li class="nav-item btn-primary" name='paquetes_descripcion'>
                        <a class="nav-link">Planes</a>
                    </li>
                    <li class="nav-item" name='extras'>
                        <a class="nav-link">Extras</a-->
                    </li>
                </ul>
                <<!--div>
                    <div id="paquetes_descripcion" class="container d-none">
                        <?php
                        for ($i = 0; $i < count($paquetes_con_descripcion); $i++) {
                            $paquete = $paquetes_con_descripcion[$i];
                            ?>
                            <div class="div-massiva-container mb-3">
                                <h3><?php echo strtoupper($paquete['nombre']); ?></h3>
                                <p class="p-0"><b style='color:#f1005e'>$<?php echo $paquete['precio']; ?></b> por un periodo de <?php echo $paquete['periodo'] ?> meses</p> 
                                <div class="div-massiva-header pointer">
                                    <i class="fas fa-plus-circle float-right"></i>
                                    <i class="fas fa-minus-circle float-right"></i>
                                    <h5>Incluye</h5>
                                </div>
                                <div class="div-massiva-body">
                                    <?php echo $paquete['descripcion']; ?>
                                    <footer class="m-4">*El cliente decide a trav&eacute;s de la plataforma ticket de compra, si massiva realiza la facturaci&oacute;n, con un costo adicional. Consulta en tu perfil.</footer>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="div-massiva-container mb-3">
                            <h3>ESPECIAL</h3>
                            <p class="p-0">Costo total mensual basado en la suma de Personas físicas seleccionadas*.</p> 
                            <div class="div-massiva-header pointer">
                                <i class="fas fa-plus-circle float-right"></i>
                                <i class="fas fa-minus-circle float-right"></i>
                                <h5>Incluye</h5>
                            </div>
                            <div class="div-massiva-body">
                                <p>Puedes seleccionar hasta 5 formas jurídicas a la vez.</p>
                                <ul>
                                    <li>Análisis de situación fiscal antes del comienzo del servicio.</li>
                                    <li>Facturación de 12 CFDI al mes.</li>
                                    <li>Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.</li>
                                    <li>Presentación de declaración de ISR, IVA y DIOT en el portal SAT.</li>
                                    <li>Almacenamiento y pre rellenado para facturación de tickets de compra. **</li>
                                    <li>Asesorías telefónicas.</li>
                                    <li>MASSIVA resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.</li>
                                </ul>
                                <footer class="m-4">*A la Persona física de más valor seleccionada se suma el resto de las Personas Físicas, cobrando el 80% de su costo a la segunda y el resto de las Personas Físicas seleccionadas el 50% sobre su valor.</footer>
                                <footer class="m-4">**El cliente decide a trav&eacute;s de la plataforma ticket de compra, si massiva realiza la facturaci&oacute;n, con un costo adicional. Consulta en tu perfil.</footer>
                            </div>
                        </div>
                    </div>
                    <div id="extras" class="container d-none">
                        <?php
                        for ($k = 0; $k < count($paquetes_tickets); $k++) {
                            $ticket = $paquetes_tickets[$k];
                            ?>
                            <p><b style='color:#f1005e'>$<?php echo $ticket['precio'] ?></b> pesos, <?php echo $ticket['cantidad'] ?> facturas.</p>
                            <?php
                        }
                        ?>
                        <footer>- Consulta en <a href='mailto:atencionalcliente@massiva.mx'>atencionalcliente@massiva.mx</a></small> para mayor información. </footer>
                    </div<!-->
                </div>
            </div>
        </div>
    </div<!-->
<!--/section-->