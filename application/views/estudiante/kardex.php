<div id="content">
    <div class="container-fluid">
        <!--<div class="page-section">-->
        <div class="row">

            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                <h4 class="page-section-heading">
                    <img src="<?= base_url(); ?>images/logo.jpg" width="100" alt="Logo" class="img-responsive pull-left" />
                    <p><label><?php echo $this->config->item('NomEscuela');?></label></p>
                    <p>
                        <small>Kardéx</small></p>

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
                        <p><label>Matricula: </label>&nbsp; <?php echo $estudiante[0]['Matricula']?></p>
                        <p><label>Nombre: </label>&nbsp; <?php echo $estudiante[0]['NomCompleto']?></p>
                    </div>


                <div class="table-responsive">
                    <?php foreach ($grados_escolares as $k => $v) { ?>
                    <label><?php echo $v['opcion'];?></label>
                    <!-- Pricing table -->
                    <table class="table panel panel-default table-pricing">
                        <!-- Table heading -->
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>Fecha</th>
                                <th>Periodo</th>
                                <th>Forma Eval.</th>
                                <th>Calificación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> --- </td>
                                <td> --- </td>
                                <td> --- </td>
                                <td> --- </td>
                                <td> --- </td>
                            </tr>

                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

