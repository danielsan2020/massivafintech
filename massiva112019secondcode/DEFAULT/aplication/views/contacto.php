<section id="contacto">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style type="text/css">
    .contacto .col-lg-8{
        background: url(images/contacto/bg.jpg) no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        color: #FFF;
        padding: 50px 150px;
    }
    .contacto .col-lg-4{
        background-color: #f5f5f5;
    }
</style>
<div class="row mt-5 contacto">
    <div class="col-lg-8">
        <h3>Oficina México</h3> 
        <address class="s1">
            <span style="color: #FFF;"><i class="fa fa-map-marker" style="color: #e2004a;"></i> Horario de 9:00 - 18:30</span><br> 
            <!--span><i class="fa fa-phone fa-lg" style="color: #e2004a"></i> 55 5105 7038</span-->
            <span><i class="far fa-envelope" style="color: #e2004a"></i> <a style="color: #FFF;" href="mailto:atencionalcliente@massiva.mx">atencionalcliente@massiva.mx</a></span><br>
        </address>
    </div>
    <div class="col-lg-4 p-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <form id="registro-form">
                
                    <div class="form-group">
                        <label class="control-label">*Nombre</label>
                        <input type="text" class="form-control" name="registro-nombre" placeholder="Nombre" data-sanitize="trim upper" data-validation="alphanumeric">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Paterno</label>
                        <input type="text" class="form-control" name="registro-paterno" placeholder="Apellido Paterno" data-sanitize="trim upper">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Materno</label>
                        <input type="text" class="form-control" name="registro-materno" placeholder="Apellido Materno" data-sanitize="trim upper">
                    </div>
                    <div class="form-group">
                        <label class="control-label">*Correo</label>
                        <input type="text" class="form-control" name="registro-email" placeholder="Correo" data-sanitize="trim lower" data-validation="custom" data-validation-regexp='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Teléfono</label>
                        <input type="text" class="form-control" name="registro-telefono" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ciudad</label>
                        <input type="text" class="form-control" name="registro-ciudad" placeholder="Ciudad">
                    </div>
                    <div class="form-group">
                        <label class="control-label">*Forma jurídica</label>
                        <div class="border rounded bg-white px-2 pt-2">
                            <label><input type="radio" name="tipo" value="F"> F&iacute;sica</label>&nbsp;
                            <label><input type="radio" name="tipo" value="M"> Moral</label>
                        </div>
                        <div class="field-set"> <br><textarea name='message' id='message' class="form-control" placeholder="Escriba su mensaje" required></textarea><br/></div>
                             <div class="spacer-half"></div>
                            <div class="g-recaptcha" data-sitekey="6LfdeZsUAAAAAEevIg8jYdNJej570XjKhLLQtAxN"></div>
                             <br>
                             <div id='text-center'>
                             <input type='submit'  style="btn btn-primary" value='Enviar mensaje' class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div>
<footer class="bg-gray3 footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div-- class="widget">
                        <h5 style="font-family: 'century Gothic'">AVISO LEGAL IMPORTANTE </h5>
                        <div class="tiny-border"><span></span></div>
                       <p class="text-center" style="font-family: 'century Gothic'"><small>MASSIVA CONTABILIDAD INNOVADORA S.C. es responsable del tratamiento (uso) de sus datos personales.<br> Usted puede conocer nuestro Aviso de Privacidad integral solicitándolo al correo electrónico <a href='mailto:atencionalcliente@massiva.mx'>atencionalcliente@massiva.mx.</a></small></p><br>
                        <div class="text-center avisos">
                            <a href="docs/AvisodePrivacidadMASSIVA.pdf" target="_blank" style="font-family: 'century Gothic'">Aviso de Privacidad</a> 
                            &nbsp;|&nbsp;<a href="docs/TerminoyCondicionesMASSIVA.pdf" target="_blank" style="font-family: 'century Gothic'">Términos y Condiciones</a>
                        </div><br>
                    <div class="text-center">
                        <img src="images/footer/pci.png" style="height: 40px;">
                        <img src="images/footer/ssl.png" style="height: 40px;">
                        <img src="images/footer/AWS_Partner_Network_latest.png" style="height: 40px;">
                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 
                        <img src="images/footer/VISA-logo.png" alt="Visa">
                        <img src="images/footer/1280px-Mastercard-logo.svg.png" alt="Master card">
                        <img src="images/footer/american-express.jpg" alt="American Express">
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
        </section-->
      <!--valor para la informacion legal de la pagina--->
        <div class="subfooter">
            <div class="container text-center">
                  <div class="row"><div class="col-md-12" style="font-family: 'century Gothic'">&copy; 2019 © Todos los derechos Reservados. Diseño y programación por: Massiva Contabilidad Innovadora S.C.</div></div>
            </div>
        </div>
    </footer>
