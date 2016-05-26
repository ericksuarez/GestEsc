<div id="content">
    <div class="container-fluid">
        <!-- Tabbable Widget -->
        <div class="tabbable tabs-vertical tabs-left">

            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li><a href="#home4" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Datos del estudiante</a></li>
                <li><a href="#profile4" data-toggle="tab"><i class="fa fa-fw fa-users"></i> Datos de los padres</a></li>
                <li><a href="#messages4" data-toggle="tab"><i class="fa fa-fw fa-file"></i> Documentos</a></li>
                <li><a href="#messages5" data-toggle="tab"><i class="fa fa-fw fa-file-pdf-o"></i> Comprobantes</a></li>
            </ul>
            <ul class="nav nav-tabs" style="position: fixed">
                <li class="active"><a href="#home4" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Datos del estudiante</a></li>
                <li><a href="#profile4" data-toggle="tab"><i class="fa fa-fw fa-users"></i> Datos de los padres</a></li>
                <li><a href="#messages4" data-toggle="tab"><i class="fa fa-fw fa-file"></i> Documentos</a></li>
                <li><a href="#messages5" data-toggle="tab"><i class="fa fa-fw fa-file-pdf-o"></i> Comprobantes</a></li>
            </ul>
            <!-- // END Tabs -->

            <!-- Panes -->
            <div class="tab-content">

                <div id="home4" class="tab-pane active">
            <?php echo form_open('estudiante/guardar') ?>
                    <div class="row">
                        <h4>Datos del Estudiante</h4>
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
                            <h6>Discapacidad</h6>
                            <input type="text" class="form-control" name="Edisca" id="Edisca" value="<?php echo set_value('Edisca', 'N/A'); ?>">
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
                            <h6>Escuela de Procedencia</h6>
                            <input type="text" class="form-control" name="Eescprod" id="Eescprod" value="<?php echo set_value('Eescprod', 'N/A'); ?>">
                        </div>
                        <div class="col-md-4">
                            <h6>Promedio</h6>
                            <input data-toggle="touch-spin" data-min="0" data-max="10" 
                                   data-step="0.1" data-decimals="2" type="text" 
                                   class="form-control" name="Epromedio" id="Epromedio" value="<?php echo set_value('Epromedio', '0.0'); ?>" >
                        </div>
                        <div class="col-md-4">
                            <h6>Matricula</h6>
                            <input type="text" class="form-control" name="Ematricula" id="Ematricula" 
                                   value="<?php echo set_value('Ematricula'); ?>" readonly="">
                        </div>
                        <div class="col-md-4">
                            <h6>Turno</h6>
                            <select class="form-control" name="Eturno" id="Eturno">
                                <option value="0">Selecciona una opción</option>
                                <?php echo getCatOpciones("CatTurno","Eturno"); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h6>Grado/Grupo</h6>
                            <select class="form-control" name="Egrupo" id="Egrupo">
                                <option value="0">Selecciona una opción</option>
                                <?php echo getCatOpciones("CatGrado","Egrupo") ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h6>Descuento (%)</h6>
                            <input id="touch-spin-1" data-toggle="touch-spin" data-min="0" data-max="100" 
                                   data-postfix="%" data-step="0.1" data-decimals="2" type="text" value="15" 
                                   name="Edescuento" value="<?php echo set_value('Edescuento', '0.0'); ?>" class="form-control" style="display: block;">
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
                    </div>
                </div>
                <div id="profile4" class="tab-pane">
                    <div class="row">
                        <h4>Datos del Padre</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Nombre</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Pnombre" value="<?php echo set_value('Pnombre'); ?>" id="Pnombre" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>Apellido Paterno</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Papaterno" value="<?php echo set_value('Papaterno'); ?>" id="Papaterno" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>Apellido Materno</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Pamaterno" value="<?php echo set_value('Pamaterno'); ?>" id="Pamaterno" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-md-4">
                                <h6>Fecha Nacimiento</h6>
                                <input id="datepickerFecP" type="text" class="form-control datepicker" name="Pfecnac" value="<?php echo set_value('Pfecnac'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>CURP</h6>
                                <input type="text" class="form-control" name="Pcurp" id="Pcurp" maxlength="18"
                                       value="<?php echo set_value('Pcurp'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Discapacidad</h6>
                                <input type="text" class="form-control" name="Pdisca" id="Pdisca" value="<?php echo set_value('Pdisca', 'N/A'); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Correo</h6>
                                <input type="text" class="form-control" name="Pcorreo" id="Pcorreo" value="<?php echo set_value('Pcorreo', 'N/A'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Sexo</h6>
                                <select class="form-control" name="Psexo" id="Psexo">
                                    <option value="M" <?php echo set_select('Psexo', 'M'); ?>>Maculino</option>
                                    <option value="F" <?php echo set_select('Psexo', 'F'); ?>>Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h6>&nbsp;</h6>
                                <div class="checkbox">
                                    <input name="Ptrabaja" id="Ptrabaja" type="checkbox" value="1" <?php echo set_checkbox('Ptrabaja', '1'); ?>>
                                    <label for="Ptrabaja">Es empleado?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">    
                            <div class="col-md-4">
                                <h6>Profesión</h6>
                                <input type="text" class="form-control" name="Pprofesion" id="Pprofesion" value="<?php echo set_value('Pprofesion', 'N/A'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Ingreso Mensual</h6>
                                <input type="number" class="form-control" name="Pingreso" id="Pingreso" value="<?php echo set_value('Pingreso', '0.0'); ?>" >
                            </div>
                            <div class="col-md-4">
                                <h6>&nbsp;</h6>
                                <div class="checkbox">
                                    <input name="Ptutor" id="Ptutor" type="checkbox" value="1"  <?php echo set_checkbox('Ptutor', '1'); ?>>
                                    <label for="Ptutor">Es el Tutor?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Telefono casa/oficina</h6>
                                <input type="text" class="form-control" name="Poficina" value="<?php echo set_value('Poficina'); ?>" id="Poficina" maxlength="10">
                            </div>
                            <div class="col-md-4">
                                <h6>Num. Celular</h6>
                                <input type="text" class="form-control" name="Pcel"  value="<?php echo set_value('Pcel'); ?>" id="Pcel" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6>Observaciones</h6>
                            <textarea rows="3" type="text" class="form-control" name="Pobserva" id="Pobserva"><?php echo set_value('Pobserva','N/A'); ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <h4>Datos del Madre</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Nombre</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Mnombre" id="Mnombre"  value="<?php echo set_value('Mnombre'); ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>Apellido Paterno</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Mapaterno" id="Mapaterno"  value="<?php echo set_value('Mapaterno'); ?>" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>Apellido Materno</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Mamaterno" id="Mamaterno" value="<?php echo set_value('Mamaterno'); ?>" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Fecha Nacimiento</h6>
                                <input id="datepickerFecM" type="text" class="form-control datepicker" name="Mfecnac"  value="<?php echo set_value('Mfecnac'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>CURP</h6>
                                <input type="text" class="form-control" name="Mcurp" id="Mcurp" maxlength="18"
                                       value="<?php echo set_value('Mcurp'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Discapacidad</h6>
                                <input type="text" class="form-control" name="Mdisca" id="Mdisca"  value="<?php echo set_value('Mdisca', 'N/A'); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Correo</h6>
                                <input type="text" class="form-control" name="Mcorreo" id="Mcorreo" value="<?php echo set_value('Mcorreo', 'N/A'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Sexo</h6>
                                <select class="form-control" name="Msexo" id="Msexo">
                                    <option value="F" <?php echo set_select('Msexo', 'F'); ?>>Femenino</option>
                                    <option value="M" <?php echo set_select('Msexo', 'M'); ?>>Maculino</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <h6>&nbsp;</h6>
                                <div class="checkbox">
                                    <input type="checkbox" name="Mtrabaja" id="Mtrabaja" value="1"  <?php echo set_checkbox('Mtrabaja', '1'); ?>>
                                    <label for="Mtrabaja">Es empleado?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Profesión</h6>
                                <input type="text" class="form-control" name="Mprofesion" id="Mprofesion" value="<?php echo set_value('Mprofesion', 'N/A'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Ingreso Mensual</h6>
                                <input type="number" class="form-control" name="Mingreso" id="Mingreso" value="<?php echo set_value('Mingreso', '0.0'); ?>" >
                            </div>
                            <div class="col-md-4">
                                <h6>&nbsp;</h6>
                                <div class="checkbox">
                                    <input name="Mtutor" id="Mtutor" type="checkbox" value="1"  <?php echo set_checkbox('Mtutor', '1'); ?>>
                                    <label for="Mtutor">Es el Tutor?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Telefono casa/oficina</h6>
                                <input type="text" class="form-control" name="Moficina" id="Moficina" maxlength="10" value="<?php echo set_value('Moficina'); ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Num. Celular</h6>
                                <input type="text" class="form-control" name="Mcel" id="Mcel" maxlength="10" value="<?php echo set_value('Mcel'); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h6>Observaciones</h6>
                            <textarea rows="3" type="text" class="form-control" name="Mobserva" id="Mobserva"><?php echo set_value('Mobserva','N/A'); ?></textarea>
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
            <?php echo form_close() ?>        
                </div>


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