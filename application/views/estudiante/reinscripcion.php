<div id="content">
    <div class="container-fluid">
        <!--<div class="jumbotron bg-transparent text-center margin-none">-->
        <h3 class="text-center">Reinscripción de Estudiantes</h3>
        <div class="panel-body">
            <div class="pull-right">
                <a id="ToExcel" class="btn btn-primary" href="<?php echo site_url('exportar/excel'); ?>">
                    <i class="fa fa-file-excel-o floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Excel</b>
                    </span>
                    <div class="clear"></div>
                </a>
                <a id="ToPdf" class="btn btn-primary" href="<?php echo site_url('exportar/pdf'); ?>" target="_new">
                    <i class="fa fa-file-pdf-o floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; PDF</b>
                    </span>
                    <div class="clear"></div>
                </a>
                <a id="ToPrint" class="btn btn-primary btnPrint" href='<?php echo site_url('exportar/impreso'); ?>'>
                    <i class="fa fa-print floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Imprimir</b>
                    </span>
                    <div class="clear"></div>
                </a>
            </div>
            <div class="pull-left">
                <a class="btn btn-warning" href="<?php echo site_url("estudiante/lista"); ?>">
                    <i class="fa fa-reply floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Regresar</b>
                    </span>
                    <div class="clear"></div>
                </a>
            </div>
        </div>
        <!--buscadores-->
        <div class="panel panel-default">
            <?php echo form_open(current_url()); ?>
            <div class="panel-body">
                <div class="col-md-12">
                    <h5>Nombre completo</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s) Apellido paterno Apellido materno" value="<?php echo set_value('nombre'); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Matricula</h5>
                    <div class="form-group">
                        <input type="text" class="form-control" name="matricula" id="matricula" placeholder="XXXX0000" value="<?php echo set_value('matricula'); ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Turno</h5>
                    <select class="form-control" name="turno" id="turno">
                        <option value="0">Selecciona una opción</option>
                        <?php echo getCatOpciones("CatTurno", "turno"); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <h5>Grado / Grupo</h5>
                    <select class="form-control" name="grupo" id="grupo">
                        <option value="0">Selecciona una opción</option>
                        <?php echo getCatOpciones("CatGrado", "grupo") ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <h5>&nbsp;</h5>
                    <button type="submit" class="btn btn-info" style="width: 100%">
                        <i class="fa fa-search floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Buscar</b>
                        </span>
                        <div class="clear"></div>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!--fin buscadores-->


        <div class="panel panel-default">
            <div class="table-responsive">
                <!-- Data table -->
                <table id="example" class="table table-bordered table-hover table-condensed v-middle" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre Completo</th>
                            <th>Grupo</th>
                            <th>Turno</th>
                            <th>&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Matricula</th>
                            <th>Nombre Completo</th>
                            <th>Grupo</th>
                            <th>Turno</th>
                            <th>&nbsp;&nbsp;</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($estudiante as $key => $info) {
                                $css = ($info['Inscrito'] == 0) ? 'class="alerta-warning"' : '';
                                ?>
                                <tr <?php echo $css ?>>
                                    <td><?php echo $info['Matricula']; ?></td>
                                    <td><?php echo $info['Nombre'] . ' ' . $info['AMaterno'] . ' ' . $info['APaterno']; ?></td>
                                    <td><?php echo $info['Grado'] . '-' . $info['Grupo']; ?></td>
                                    <td><?php echo $info['Turno_IDTurno']; ?></td>
                                    <?php if ($info['Inscrito'] == 0) { ?>
                                        <td><p>
                                        <button data-mood='create' data-backdrop='static' data-keyboard='false'
                                                data-ID='<?php echo $info['IDExp'];?>' 
                                                data-User='<?php echo $info['IdUsuario'];?>'
                                                data-Descuento='<?php echo $info['DescntoColegiatura'];?>' 
                                                data-Recargo='<?php echo CalculaRecargo($info['IDExp'],$info['IdUsuario']);?>'
                                                data-toggle="modal" data-target="#wizard-reincripcion" data-content-options="modal-lg" 
                                                class="REINSCRIPCION btn btn-primary btn-stroke btn-xs"><i class="fa fa-exclamation-circle"></i>&nbsp; Reinscribir</button>        
                                            </p>
                                        </td>
                                        <?php
                                    } else {
                                        ?>
                                        <td><p>
                                                <a href = "<?php echo site_url('expediente/consultar/' . $info['IDExp']); ?>" 
                                                   class = "btn btn-info btn-stroke  btn-xs"><i class="fa fa-book"></i>&nbsp; Ver Expediente</a>
                                            </p>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
                <!-- // Data table -->
            </div>
        </div>



        <!--</div>-->
    </div>
</div>
