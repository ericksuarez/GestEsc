<div id="content">
    <div class="container-fluid">
        <!-- Tabbable Widget -->
        <div class="row">
            <h4 class="page-section-heading">Asignar Materias a Profesores</h4>
            <div class="media  media-clearfix-xs-min media-grid col-xs-12 col-sm-12 col-md-12">
                <div class="media-left">
                    <label>Profesores:</label>
                    <div class="messages-list">
                        <div class="panel panel-default">
                            <ul class="list-group">
                                <?php foreach ($docente as $key => $value) { ?>
                                    <li class="list-group-item ">
                                        <a data-exp="<?php echo $value["IDDocente"] ?>" 
                                           data-nombre="<?php echo $value["NomCompleto"] ?>"
                                           data-turno="<?php echo $value["Turno_IDTurno"] ?>"
                                           class="Docente" type="button" style="cursor: pointer">
                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="<?php echo getNombreDocumentoExp($value["IDExp"], 4); ?>" width="50" alt="" class="media-object" />
                                                </div>
                                                <div class="media-body">
                                                    <span class="user"><?php echo $value["NomCompleto"] ?></span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="media-body">
                    <?php echo form_open(current_url()); ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Nombre completo</h6>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s) Apellido paterno Apellido materno" value="<?php echo set_value('nombre'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h6>Turno</h6>
                                    <select class="form-control" name="turno" id="turno">
                                        <option value="0">Selecciona una opción</option>
                                        <?php echo getCatOpciones("CatTurno", "turno"); ?>
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
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="media">
                        <div class="media-body message">
                            <div id="espera" style="z-index: 100; position: fixed"></div>
                            <div class="panel panel-default">
                                <div class="panel-heading panel-heading-white">
                                    <h3><label class="control-label" id="docente-carga">
                                            -- No ha seleccionado a un profesor --</label></h3>
                                </div>
                                <div class="panel-body">
                                    <?php echo form_open(current_url()); ?>
                                    <input type="hidden" name="nombre" value="<?php echo set_value('nombre'); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Listar las materias por Grado/Grupo</h6>
                                            <select class="form-control" name="grupo" id="grupo">
                                                <option value="0">Todos los grupos</option>
                                                <?php echo getCatOpciones("CatGradoEsc", "grupo") ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>&nbsp;</h5>
                                            <button type="submit" class="btn btn-primary btn-sm" style="width: 100%">
                                                <i class="fa fa-list floatL t3"></i>
                                                <span class="hidden-xs floatL l5">
                                                    <b>&nbsp; Listar</b>
                                                </span>
                                                <div class="clear"></div>
                                            </button>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    <?php echo form_open(current_url()); ?>
                                    <input type="hidden" id="IDDocente" name="IDDocente" value="">
                                    <input type="hidden" id="Eturno" name="Eturno" value="" >
                                    <div class="row"><br>
                                        <label class="control-label">Lista de materias</label><br>
                                        <?php echo getCatOpcionesCheckBoxesWhere("CatMateria", "Materias[]", "", $where) ?>
                                    </div>
                                    <br>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-save floatL t3"></i>
                                            <span class="hidden-xs floatL l5">
                                                <b>&nbsp; Guardar</b>
                                            </span>
                                            <div class="clear"></div>
                                        </button>
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

