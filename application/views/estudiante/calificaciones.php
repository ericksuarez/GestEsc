<div id="content">
    <div class="container-fluid">
        <!--<div class="page-section">-->
        <div class="row">

            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                <h4 class="page-section-heading">
                    <img src="<?= base_url(); ?>images/logo.jpg" width="100" alt="Logo" class="img-responsive pull-left" />
                    <p><label><?php echo $this->config->item('NomEscuela'); ?></label></p>
                    <p>
                        <small>Consulta de Calificaciones</small></p>

                </h4>	

                <div class="pull-right">
                    <a class="btnPrint btn btn-primary " href='<?php echo site_url("exportar/impreso_horario_individual"); ?>' id="print">
                        <i class="fa fa-file-pdf-o floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; PDF</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                    <a class="btnPrint btn btn-primary " href='<?php echo site_url("exportar/impreso_horario_individual"); ?>' id="print">
                        <i class="fa fa-print floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Imprimir</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                </div>

                <div class="panel-heading panel-heading-white">
                    <br><br>
                    <p><label>Matricula: </label>&nbsp; <?php echo $estudiante[0]['Matricula'] ?></p>
                    <p><label>Nombre: </label>&nbsp; <?php echo $estudiante[0]['NomCompleto'] ?></p>
                </div>

                <div class="table-responsive">
                        <!-- Pricing table -->
                        <table class="table panel panel-default table-pricing">
                            <!-- Table heading -->
                            <thead>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Materia</th>
                                    <th>Tarea</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($calificaciones as $key => $value) {?>
                                <tr>
                                    <td><?php echo $value['Descripcion']?></td>
                                    <td><?php echo $value['Nombre']?></td>
                                    <td><?php echo $value['NomTarea']?></td>
                                    <td><?php echo $value['Calificacion']?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
