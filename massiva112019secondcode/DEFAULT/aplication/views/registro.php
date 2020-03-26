<div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"><img src="images/logo-dark.png" width="180"></div>
                <button type="button" class="close" data-dismiss="modal"><i class="far fa-times-circle"></i></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success d-none text-center" role="alert">
                </div>
                <div class="alert alert-danger d-none text-center" role="alert">
                </div>
                <form id="registro-form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">*RFC</label>
                            <input type="text" class="form-control" name="registro-rfc" placeholder="RFC" data-sanitize="trim upper" data-validation="custom" data-validation-regexp="^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$" data-validation-error-msg="El RFC no tiene un formato válido">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">*Nombre</label>
                            <input type="text" class="form-control" name="registro-nombre" placeholder="Nombre" data-sanitize="trim upper" data-validation="alphanumeric">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">*Paterno</label>
                            <input type="text" class="form-control" name="registro-paterno" placeholder="Apellido Paterno" data-sanitize="trim upper">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">*Materno</label>
                            <input type="text" class="form-control" name="registro-materno" placeholder="Apellido Materno" data-sanitize="trim upper">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">*Correo</label>
                            <input type="text" class="form-control" name="registro-email" placeholder="Correo" data-sanitize="trim lower" data-validation="custom" data-validation-regexp='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Teléfono</label>
                            <input type="text" class="form-control" name="registro-telefono" placeholder="Teléfono">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 text-md-right">
                            <input type="checkbox" name='aviso' data-validation="required" data-validation-error-msg="Lee y acepta el Aviso de privacidad."/>
                            <small><a href="docs/AvisodePrivacidadMASSIVA.pdf" target="_blank">Aviso de Privacidad</a></small>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="checkbox" name='terminos' data-validation="required" data-validation-error-msg="Lee y acepta los Términos y Condiciones."/>
                            <small><a href="docs/TerminoyCondicionesMASSIVA.pdf" target="_blank">Términos y Condiciones</a></small>
                        </div>
                    </div>
                    <div class="text-md-right">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>