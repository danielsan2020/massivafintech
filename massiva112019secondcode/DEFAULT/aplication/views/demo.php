<div class="modal fade" id="demo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"><img src="images/logo-dark.png" width="180"></div>
                <button type="button" class="close" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
            </div>
            <div class="modal-body">
                <div class="demo">
                    <ul class="nav nav-tabs">
                        <li name="step-1-title">¡Bienvenido!</li>
                        <li name="step-2-title">Video Demo</li>
                    </ul>
                    <div>
                        <div class="p-5 d-none step-content" id="step-1">
                            <p>Bienvenido al <strong>demo de massiva</strong>, aqu&iacute; podr&aacute;s conocer nuestra plataforma contable de una forma r&aacute;pida y sencilla. </p>
                            <p>Tambi&eacute;n podr&aacute;s conocer nuestros servicios y los beneficios que podemos ofrecerte para llevar tu contabilidad.</p>
                            <div class="alert alert-danger d-none text-center" role="alert">
                            </div>
                            <form id="form-step-1">
                                <p>Cu&eacute;ntanos un poco m&aacute;s de ti.</p>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">*RFC</label>
                                        <input type="text" class="form-control" name="demo-rfc" placeholder="RFC" data-sanitize="trim upper" data-validation="custom" data-validation-regexp="^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$" data-validation-error-msg="El RFC no tiene un formato válido">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">*Nombre</label>
                                        <input type="text" class="form-control" name="demo-nombre" placeholder="Nombre" data-sanitize="trim upper" data-validation="alphanumeric">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Paterno</label>
                                        <input type="text" class="form-control" name="demo-paterno" placeholder="Apellido Paterno" data-sanitize="trim upper">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Materno</label>
                                        <input type="text" class="form-control" name="demo-materno" placeholder="Apellido Materno" data-sanitize="trim upper">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label">*Correo</label>
                                        <input type="text" class="form-control" name="demo-email" placeholder="Correo" data-sanitize="trim lower" data-validation="custom" data-validation-regexp='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label">Teléfono</label>
                                        <input type="text" class="form-control" name="demo-telefono" placeholder="Teléfono">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 text-md-right">
                                        <input type="checkbox" name='aviso' data-validation="required" data-validation-error-msg="Lee y acepta el Aviso de Privacidad."/>
                                        <small><a href="docs/AvisodePrivacidadMASSIVA.pdf" target="_blank">Aviso de Privacidad</a></small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="checkbox" name='terminos' data-validation="required" data-validation-error-msg="Lee y acepta los Términos y Condiciones."/>
                                        <small><a href="docs/TerminoyCondicionesMASSIVA.pdf" target="_blank">Términos y Condiciones</a></small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <button class="btn btn-secondary float-right" type="submit">Continuar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="d-none step-content" id="step-2">
                            <div class="align-content-lg-center p-5">
                                <iframe width="660" height="450" src="//www.youtube.com/embed/dvpRlUfqxNo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="text-center">
                                <p><strong>¿Interesado en massiva?</strong><br>
                                    <a href="mailto:atencionalcliente@massiva.mx">atencionalcliente@massiva.mx</a></p>
                                <div class = "row col-12 float-center m-5">
                                    <!--button class="btn btn-primary col-5 m-1" type="button">Averigua el costo por ponerte al día ante el SAT</button>
                                    <button class="btn btn-primary col-5 m-1" type="button">Averigua el costo por tener varios regímenes</button-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
