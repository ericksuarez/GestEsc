<div id="content">
    <div class="container-fluid">
        <!--<div class="jumbotron bg-transparent text-center margin-none">-->

        <h3 class="text-center">Lista de Estudiantes</h3>
        <div class="panel-body">
            <?php echo $export_buttons; ?>
            <div class="pull-left">
                <a class="btn btn-success" href="<?php echo site_url("estudiante/alta"); ?>"><i class="fa fa-plus"></i> <b>&nbsp; Agregar</b></a>
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
                <?php echo $table; ?>
                <!-- // Data table -->
            </div>
        </div>



        <!--</div>-->
    </div>
</div>
