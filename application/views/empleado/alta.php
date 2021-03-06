<div id="content">
    <div class="container-fluid">
        <!-- Tabbable Widget -->
        <div class="tabbable tabs-vertical tabs-left">

            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li><a href="#home4" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Datos del Empleado</a></li>
                <li><a href="#messages4" data-toggle="tab"><i class="fa fa-fw fa-file"></i> Documentos</a></li>
                <li><a href="#messages5" data-toggle="tab"><i class="fa fa-fw fa-file-pdf-o"></i> Comprobantes</a></li>
            </ul>
            <ul class="nav nav-tabs" style="position: fixed">
                <li class="active"><a href="#home4" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Datos del Empleado</a></li>
                <li><a href="#messages4" data-toggle="tab"><i class="fa fa-fw fa-file"></i> Documentos</a></li>
                <li><a href="#messages5" data-toggle="tab"><i class="fa fa-fw fa-file-pdf-o"></i> Comprobantes</a></li>
            </ul>
            <!-- // END Tabs -->

            <!-- Panes -->
            <div class="tab-content">

                <div id="home4" class="tab-pane active">
            <?php echo form_open('empleado/guardar') ?>
                    <div class="row">
                        <h4>Datos del Empleado</h4>
                        <div class="col-md-4">
                            <h6>Nombre</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Enombre" id="anombre" value="<?php echo set_value('Enombre'); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Apellido Paterno</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Eapaterno" id="Eapaterno" value="<?php echo set_value('Eapaterno'); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Apellido Materno</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Eamaterno" id="Eamaterno" value="<?php echo set_value('Eamaterno'); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Fecha Nacimiento</h6>
                            <input id="datepickerFec" type="text" class="form-control datepicker" name="Efecnac" value="<?php echo set_value('Efecnac'); ?>" >
                        </div>
                        <div class="col-md-4">
                            <h6>CURP</h6>
                            <input type="text" class="form-control" name="Ecurp" id="Ecurp" maxlength="18"
                                   value="<?php echo set_value('Ecurp'); ?>">
                        </div>
                        <div class="col-md-4">
                            <h6>Correo</h6>
                            <input type="text" class="form-control" name="Ecorreo" id="Ecorreo" value="<?php echo set_value('Ecorreo', 'N/A'); ?>">
                        </div>
                        <div class="col-md-4">
                            <h6>Sexo</h6>
                            <select class="form-control" name="Esexo" id="Esexo">
                                <option value="M" <?php echo set_select('Esexo', 'M'); ?>>Maculino</option>
                                <option value="F" <?php echo set_select('Esexo', 'F'); ?>>Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h6>Puesto</h6>
                            <input type="text" class="form-control" name="Epuesto" id="Epuesto" maxlength="18"
                                   value="<?php echo set_value('Epuesto'); ?>">
                        </div>
                            <div class="col-md-4">
                                <h6>Telefono casa</h6>
                                <input type="text" class="form-control" name="Doficina" value="<?php echo set_value('Doficina'); ?>" id="Doficina" maxlength="10">
                            </div>
                            <div class="col-md-4">
                                <h6>Num. Celular</h6>
                                <input type="text" class="form-control" name="Dcel"  value="<?php echo set_value('Dcel'); ?>" id="Dcel" maxlength="10">
                            </div>
                        <div class="col-md-4">
                            <h6>Turno</h6>
                            <select class="form-control" name="Eturno" id="Eturno">
                                <option value="0">Selecciona una opción</option>
                                <?php echo getCatOpciones("CatTurno","Eturno"); ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <h6>Observaciones</h6>
                            <textarea rows="3" type="text" class="form-control" name="Eobserva" id="Eobserva"><?php echo set_value('Eobserva','N/A'); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h4>Dirección</h4>
                        <div class="col-md-4">
                            <h6>Calle</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Ecalle" id="Ecalle" value="<?php echo set_value('Ecalle'); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Num . Int</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Enumint" id="Enumint" value="<?php echo set_value('Enumint'); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Num. Ext.</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" name="Enumext" id="Enumext" value="<?php echo set_value('Enumext'); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>País</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo set_value('nomPais', 'MÉXICO'); ?>" name="nomPais" id="nomPais" disabled="">
                                <input type="hidden" class="form-control" value="<?php echo set_value('idPais', '69'); ?>" name="idPais" id="idPais">
                                <span class="input-group-btn">
                                    <button class="btn btn-info Bpais" type="button" data-toggle="modal" data-target="#modal-slide-down" data-table="pais"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Estado</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo set_value('nomEdo', 'MÉXICO'); ?>" name="nomEdo" id="nomEdo" disabled="">
                                <input type="hidden" class="form-control" value="<?php echo set_value('idEdo', '15'); ?>" name="idEdo" id="idEdo">
                                <span class="input-group-btn">
                                    <button class="btn btn-info Bestado" type="button" data-toggle="modal" data-target="#modal-slide-down-2" data-table="estado"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Cod. Postal</h6>
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo set_value('nomcodpost'); ?>"name="nomcodpost" id="nomcodpost">
                                <input type="hidden" class="form-control" value="<?php echo set_value('idcodpost'); ?>" name="idcodpost" id="idcodpost">
                                <span class="input-group-btn">
                                    <button class="btn btn-info BcodpostForm" type="button" data-toggle="modal" data-target="#modal-slide-down-3" data-table="codpost"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Del. / Mun.</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo set_value('nomdelmun'); ?>" name="nomdelmun" id="nomdelmun" readonly="">
                                <input type="hidden" class="form-control" value="<?php echo set_value('iddelmun'); ?>" name="iddelmun" id="iddelmun">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Colonia</h6>
                            <div class="form-group">
                                <input type="text" class="form-control" value="<?php echo set_value('nomcol'); ?>" name="nomcol" id="nomcol" readonly="">
                                <input type="hidden" class="form-control" value="<?php echo set_value('idcol'); ?>" name="idcol" id="idcol">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <button class="btn btn-success pull-right" type="submit">
                                <i class="fa fa-save floatL t3"></i>
                                <span class="hidden-xs floatL l5">
                                    <b>&nbsp; Guardar</b>
                                </span>
                                <div class="clear"></div>
                            </button>
                        </div>
                    </div>
                </div>
            <?php echo form_close() ?>        


                <div id="messages4" class="tab-pane">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        Debes de guardar la Información general antes de subir los documentos. Gracias!!!
                    </div>
                </div>
                
                <div id="messages5" class="tab-pane">
                    <div class="row">
                        <h4>Impresión de comprobantes</h4>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul>
                                    <?php foreach ($comprobante as $key => $value) { ?>
                                        <div class="checkbox">
                                            <input name="<?php echo $value["IDTipoDoc"] ?>" id="<?php echo $value["IDTipoDoc"] ?>" type="checkbox" value="">
                                            <label for="<?php echo $value["IDTipoDoc"] ?>"><?php echo $value["NomDoc"] ?></label>
                                        </div>
                                    <?php } ?>
                                </ul>
                                <div class="panel-footer">
                                    <a class="btn btn-info pull-right" data-url="/demo/bootstrap_theme/print">
                                        <i class="fa fa-print floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <b>&nbsp; Imprimir</b>
                                        </span>
                                        <div class="clear"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- // END Panes -->

        </div>
        <!-- // END Tabbable Widget -->
    </div>
</div>

<?php $this->load->view('modal/modal_direccion.php'); ?>

<script>
    function MiPais(idpais, nompais) {
        $('#idPais').val(idpais);
        $('#nomPais').val(nompais);
    }
    function MiEdo(idedo, nomedo) {
        $('#idEdo').val(idedo);
        $('#nomEdo').val(nomedo);
    }
    function MiCodPos(idcodpost, nomcodpost, iddelmun, nomdelmun, idcol, nomcol) {
        $('#idcodpost').val(idcodpost);
        $('#nomcodpost').val(nomcodpost);
        $('#iddelmun').val(iddelmun);
        $('#nomdelmun').val(nomdelmun);
        $('#idcol').val(idcol);
        $('#nomcol').val(nomcol);
    }
</script>