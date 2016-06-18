<div id="content">
    <div class="container-fluid">
        <!--<div class="jumbotron bg-transparent text-center margin-none">-->
        <h3 class="text-center">Lista de Expedientes</h3>
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
                            ?>
                            <tr>
                                <td><?php echo $info['Matricula']; ?></td>
                                <td><?php echo $info['Nombre'] . ' ' . $info['AMaterno'] . ' ' . $info['APaterno']; ?></td>
                                <td><?php echo $info['Grado'] . '-' . $info['Grupo']; ?></td>
                                <td><?php echo $info['Turno_IDTurno']; ?></td>
                                <td><p>
                                        <a href = "<?php echo site_url('expediente/modulos/' . $info['IDExp']); ?>" 
                                           class = "btn btn-info btn-stroke  btn-xs"><i class="fa fa-book"></i>&nbsp; Ver Expediente</a>
                                    </p>
                                </td>
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
