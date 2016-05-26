<div id="content">
    <div class="container-fluid">
        <!-- Tabbable Widget -->
        <div class="row">
            <h4 class="page-section-heading">Asignar Docentes a los Grupos</h4>
            <div class="media  media-clearfix-xs-min media-grid col-xs-12 col-sm-12 col-md-12">
                <div class="media-body">
                    <?php echo form_open(current_url()); ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Grado/Grupo</h6>
                                    <select class="form-control" name="grado" id="grado">
                                        <?php echo getCatOpciones("CatGradoIndex", "grado", $IDGrado); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h6>Turno</h6>
                                    <select class="form-control" name="turno" id="turno">
                                        <?php echo getCatOpciones("CatTurno", "turno", $IDTurno); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <h5>&nbsp;</h5>
                                    <button type="submit" class="btn btn-info" style="width: 100%">
                                        <i class="fa fa-sign-in floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <b>&nbsp; Asignar Docente(s)</b>
                                        </span>
                                        <div class="clear"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="media">
                        <div class="media-body message">
                            <div id="espera" style="z-index: 100; position: fixed"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading panel-heading-white">
                                    <h3><label class="control-label" id="grupo-carga">
                                            ----</label></h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo form_open(site_url('curricular/guardarDocenteGrupoMateria')); ?>
                                    <input type="hidden" name="turno" value="" id="IDTurno">
                                    <input type="hidden" name="grado" value="" id="IDGrado">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Asignar Docente Grupal</h6>
                                            <select class="form-control" name="docente_gral" id="docente_gral">
                                                <option value="0">Todos los Docentes</option>
                                                <?php foreach ($docentes as $val) { ?>
                                                    <option value="<?php echo $val['IDDocente'] ?>" <?php echo set_select("docente_gral") ?>><?php echo $val['NomCompleto'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>&nbsp;</h5>
                                            <button type="submit" class="btn btn-success btn-sm" style="width: 100%">
                                                <i class="fa fa-save floatL t3"></i>
                                                <span class="hidden-xs floatL l5">
                                                    <b>&nbsp; Guardar</b>
                                                </span>
                                                <div class="clear"></div>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row"><br>
                                        <label class="control-label">Lista de materias</label><br>
                                        <?php foreach ($materias as $key => $value) { ?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="control-label">
                                                        <?php echo $value['opcion'] ?>
                                                    </label>    
                                                </div>
                                                <div class="col-md-8">
                                                    <?php $docentesAsignados = getDocentesAsignadosMateria($value['index']); ?>
                                                    <input type="hidden" name="mapa[<?php echo $key ?>][materia]" value="<?php echo $value['index'] ?>">
                                                    <select class="selectpicker" multiple data-style="btn-white" title='Selecciona una opción' name="mapa[<?php echo $key ?>][docente][]">    
                                                        <?php echo getCatDocentesPorMateria("CatDocentesPorMateria", "mapa[" . $key . "][docente][]", $IDTurno, $value['index'], $docentesAsignados) ?>
                                                    </select>
                                                </div>
                                            </div><br>
                                        <?php } ?>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabbable Widget -->
    </div>
</div>

