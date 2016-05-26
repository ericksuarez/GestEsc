<div id="content">
    <div class="container-fluid">
        <!--<div class="jumbotron bg-transparent text-center margin-none">-->

        <h3 class="text-center">Horarios Grupales</h3>
        <div class="panel-body">
            <div class="pull-right">
                <a id="ToPdf" class="btn btn-primary" href="<?php echo site_url('exportar/pdf_horario')?>" target="_new">
                    <i class="fa fa-file-pdf-o floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; PDF</b>
                    </span>
                    <div class="clear"></div>
                </a>
                <a id="ToPrint" class="btn btn-primary btnPrint" href="<?php echo site_url('exportar/pdf_horario')?>">
                    <i class="fa fa-print floatL t3"></i>
                    <span class="hidden-xs floatL l5">
                        <b>&nbsp; Imprimir</b>
                    </span>
                    <div class="clear"></div>
                </a>
            </div>
        </div>
        <!--buscadores-->
        <div class="panel panel-default">
            <?php echo form_open(current_url()); ?>
            <div class="panel-body">
                <div class="col-md-4">
                    <h5>Turno</h5>
                    <select class="form-control" name="turno" id="turno">
                        <option value="0">Seleccióna una opción</option>
                        <?php echo getCatOpciones("CatTurno", "turno", $IDTurno); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <h5>Grado / Grupo</h5>
                    <select class="form-control" name="grupo" id="grupo">
                        <option value="0">Selecciona una opción</option>
                        <?php echo getCatOpciones("CatGrado", "grupo", $IDGrado) ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <h5>&nbsp;</h5>
                    <button type="submit" class="btn btn-info" style="width: 100%">
                        <i class="fa fa-sign-in floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Crear Horario</b>
                        </span>
                        <div class="clear"></div>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!--fin buscadores-->

        <?php echo form_open(site_url('curricular/guardarHorarioGrupal')); ?>
        <div class="panel panel-default">
            <div class="table-responsive">
                <!--Data table--> 
                <table class="table table-bordered table-hover table-condensed v-middle" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <?php foreach (DiasSemana() as $key => $dia) { ?>
                                <th><?php echo $dia ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($horas as $key => $value) {
                            if ($Receso == $value["Hora"]) {
                                ?>
                                <tr class="alerta-warning text-center">
                                    <td><?php echo $value["Hora"]; ?></td>
                                    <?php foreach (DiasSemana() as $key => $dia) { ?>
                                        <th>Receso</th>
                                    <?php } ?>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <td><p class="text-center"><?php echo $value["Hora"]; ?></p></td>
                                    <?php foreach (DiasSemana() as $k => $dia) { ?>
                                        <td>
                                            <div class="timeline-block text-center" id="<?php echo $dia . $key ?>_Doc">
                                                <?php
                                                foreach ($horarios as $horario) {
                                                    if ($horario['Dia'] == $dia && $value["Hora"] == $horario['Hora']) {
                                                        $HrsMateria = $horario['IDMateria'];
                                                        ?>
                                                        <?php
                                                        $splitImagenes = explode(',', $horario['Expedientes']);
                                                        foreach ($splitImagenes as $key => $val) {
                                                            ?>
                                                            <img src="<?php echo getNombreDocumentoExp($val, 4); ?>" width="50" alt="Docente">
                                                        <?php } ?>
                                                        <p class="text"><?php echo $horario['Docentes'] ?></p>
                                                        <?php
                                                        break;
                                                    } else {
                                                        $HrsMateria = 0;
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <select class="horario form-control" 
                                                    data-hrs="<?php echo $value["Hora"] ?>" 
                                                    data-dia="<?php echo $dia ?>" 
                                                    name="materia<?php echo $key ?>" 
                                                    id="<?php echo $dia . $key ?>">
                                                <option value="0">-Materia-</option>
                                                <?php echo getCatOpcionesWhere("CatMateria", "materia" . $key, $HrsMateria, $where_materias) ?>
                                            </select>
                                        </td>
                                    <?php } ?>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!--// Data table--> 
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <h5>&nbsp;</h5>
                    <button type="submit" class="btn btn-success" style="width: 100%">
                        <i class="fa fa-save floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Guardar Horario</b>
                        </span>
                        <div class="clear"></div>
                    </button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <!--</div>-->
    </div>
</div>
