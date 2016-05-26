<div id="content">
    <div class="container-fluid">
        <!-- Tabbable Widget -->
        <div class="tabbable tabs-vertical tabs-left">

            <!-- Tabs -->
            <ul class="nav nav-tabs">
                <li><a href="#home4" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Datos del Docente</a></li>
                <li><a href="#messages4" data-toggle="tab"><i class="fa fa-fw fa-file"></i> Documentos</a></li>
                <li><a href="#messages5" data-toggle="tab"><i class="fa fa-fw fa-file-pdf-o"></i> Comprobantes</a></li>
            </ul>
            <ul class="nav nav-tabs" style="position: fixed">
                <li class="active"><a href="#home4" data-toggle="tab"><i class="fa fa-fw fa-user"></i> Datos del Docente</a></li>
                <li><a href="#messages4" data-toggle="tab"><i class="fa fa-fw fa-file"></i> Documentos</a></li>
                <li><a href="#messages5" data-toggle="tab"><i class="fa fa-fw fa-file-pdf-o"></i> Comprobantes</a></li>
            </ul>
            <!-- // END Tabs -->

            <!-- Panes -->
            <div class="tab-content">

                <div id="home4" class="tab-pane active">
                    <?php echo form_open('docente/modificar/' . $this->uri->segment(3)) ?>
                    <div class="row">
                        <h4>Datos del Docente</h4>
                        <div class="col-md-4">
                            <h6>Nombre</h6>
                            <div class="form-group">
                                <p><?php echo $gral['Nombre']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Apellido Paterno</h6>
                            <div class="form-group">
                                <p><?php echo $gral['APaterno']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Apellido Materno</h6>
                            <div class="form-group">
                                <p><?php echo $gral['AMaterno']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Fecha Nacimiento</h6>
                            <p><?php echo FecFormatoView($gral['FecNac']); ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>CURP</h6>
                            <p><?php echo $gral['CURP']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Discapacidad</h6>
                            <p><?php echo $gral['Enfermedad']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Correo</h6>
                            <p><?php echo $gral['Correo']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Sexo</h6>
                            <p><?php echo $gral['Sexo']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Telefono casa/oficina</h6>
                            <p><?php echo $dire['PTelefono']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Num. Celular</h6>
                            <p><?php echo $dire['PCelular']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Escuela de Procedencia</h6>
                            <p><?php echo $gral['EscProcedencia']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <h6>Turno</h6>
                            <p><?php echo $gral['Turno_IDTurno']; ?></p>
                        </div>
                        <div class="col-md-12">
                            <h6>Materias</h6>
                            <p><?php echo $Materias ?></p>
                        </div>
                        <div class="col-md-12">
                            <h6>Grupos</h6>
                            <p><?php echo $Grupos ?></p>
                        </div>
                        <div class="col-md-12">
                            <h6>Observaciones</h6>
                            <p><?php echo $gral['Observacion']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <h4>Dirección</h4>
                        <div class="col-md-4">
                            <h6>Calle</h6>
                            <div class="form-group">
                                <p><?php echo $dire['Calle']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Num . Int</h6>
                            <div class="form-group">
                                <p><?php echo $dire['NumInt']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Num. Ext.</h6>
                            <div class="form-group">
                                <p><?php echo $dire['NumExt']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>País</h6>
                            <div class="input-group">
                                <p><?php echo $dire['pais']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Estado</h6>
                            <div class="input-group">
                                <p><?php echo $dire['estado']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Cod. Postal</h6>
                            <div class="input-group">
                                <p><?php echo $dire['Colonia_CodPostal']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Del. / Mun.</h6>
                            <div class="form-group">
                                <p><?php echo $dire['delMuni']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6>Colonia</h6>
                            <div class="form-group">
                                <p><?php echo $dire['colonia']; ?></p>
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
                    <div class="row">
                        <h4>Documentos del Expediente</h4>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="folder">
                                    <li>
                                        Documentos que se han cargado para este Expediente.
                                        <ul>
                                            <?php foreach ($docsExp as $key => $value) { ?>
                                                <?php if ($value["RutaDoc"] != NULL) { ?>
                                                    <li>
                                                        <a href="<?php echo $value["RutaDoc"] ?>" target="_new">
                                                        <b><?php echo $value["NomDoc"] ?></b>
                                                        <small><i>&nbsp;&nbsp;  Ver documento subido ...</i></small>
                                                        <small><i>&nbsp;&nbsp;  <?php echo $value["FecSubida"] ?></i></small>
                                                        </a>
                                                    </li>
                                                <?php } else { ?>
                                                    <li><?php echo $value["NomDoc"] ?></li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                                            <label for="<?php echo $value["IDTipoDoc"] ?>"><?php echo $value["NomDoc"] ?></p>
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