<div id="content">
    <div class="container-fluid">
        <!-- Tabbable Widget -->
        <div class="row">
            <h4 class="page-section-heading">Evaluación a Profesores</h4>
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

