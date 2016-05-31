<div id="content">
    <div class="container-fluid">
        <!--Busqueda-->
        <div class="panel-body">
        <h4 class="page-section-heading">Reportes</h4>
        </div>
        <div class="panel panel-default">
            <?php echo form_open(current_url()); ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Nombre Alumno</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s) Apellido paterno Apellido materno" value="<?php echo set_value('nombre'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Nombre Tutor</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombreTutor" id="nombreTutor" placeholder="Nombre(s) Apellido paterno Apellido materno" value="<?php echo set_value('nombreTutor'); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5>No.Cuenta</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="cuenta" id="cuenta" placeholder="123456789120" value="<?php echo set_value('cuenta'); ?>">
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
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Seleccione un rango de Fechas:</h5>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="FecsPago" id="reservationtime" 
                                   class="form-control daterangepicker-reservation" 
                                   value="<?php echo date("m/d/Y") ?> 12:00 AM - <?php echo date("m/d/Y") ?> 12:00 PM"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Tipo reporte</h5>
                        <select class="form-control" name="grupo" id="grupo">
                            <option value="0">Selecciona una opción</option>
                            <option value="SA">Saldos</option>
                            <option value="AD">Adeudos</option>
                            <option value="MO">Movimientos</option>
                            <option value="MD">Movimientos con detalle</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <h5>&nbsp;</h5>
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-recycle floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Crear Reporte</b>
                            </span>
                            <div class="clear"></div>
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!--Busqueda-->

    </div>
</div>