<div id="content">
    <div class="container-fluid">
        <!--<div class="page-section">-->
        <div class="row">

            <div class="col-md-11 col-lg-9 col-md-offset-1 col-lg-offset-1">
                <h4 class="page-section-heading">
                    <img src="<?= base_url(); ?>images/logo.jpg" width="100" alt="Logo" class="img-responsive pull-left" />
                    <p><label><?php echo $this->config->item('NomEscuela'); ?></label></p>
                    <p>
                        <small>Comprobante de horario</small></p>

                </h4>	

                <div class="pull-right">
                    <a class="btnPrint btn btn-primary " href='<?php echo site_url("exportar/impreso_horario_individual");  ?>' id="print">
                        <i class="fa fa-file-pdf-o floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; PDF</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                    <a class="btnPrint btn btn-primary " href='<?php echo site_url("exportar/impreso_horario_individual");  ?>' id="print">
                        <i class="fa fa-print floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Imprimir</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                </div>

                <div class="panel-heading panel-heading-white">
                    <br><br>
                    <p><label>Grado y Grupo: </label>&nbsp; <?php echo $estudiante[0]["Grado"] . ' - ' . $estudiante[0]["Grupo"] ?></p>
                </div>
            </div>

            <div class="col-md-12">

                <div class="table-responsive">

                    <table class="table panel panel-default table-bordered table-hover table-condensed v-middle" cellspacing="0">
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
                                                <?php echo getCatOpcionesWhereText("CatMateria", "materia" . $key, $HrsMateria, $where_materias) ?>
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
            </div>
        </div>
    </div>
</div>

