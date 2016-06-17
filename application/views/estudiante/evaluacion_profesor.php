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
                                    <li class="list-group-item <?php echo set_value('docente-carga')==$value["NomCompleto"] ? "active" : ""; ?>"
                                        style="<?php echo TieneEvaluacion($value["IDDocente"]);?>">
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
                                    <?php echo form_open(current_url()); ?>
                            <div class="panel panel-default">
                                <div class="panel-heading panel-heading-white">
                                    <h3><input type="text" class="form-control" name="docente-carga" id="docente-carga" 
                                   value="<?php echo set_value('docente-carga'); ?>" readonly="">
                                       </h3>
                                </div>
                                <div class="panel-body" id="ver-encuesta">
                                    <input name="IDDocente" type="hidden" value="" id="IDDocente">
                                    <?php foreach ($encuesta as $k => $val) { ?>
                                    <input name="encuesta[<?php echo $k?>][pregunta]" type="hidden" value="<?php echo $val['IDEncuesta']?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="text-justify">
                                                    <?php echo $val['Pregunta'] ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" name="encuesta[<?php echo $k?>][respuesta]" id="respuestas">
                                                    <option value="">Selecciona una opción</option>
                                                    <?php echo getCatOpciones("CatTipoRespuestas","encuesta[".$k."][respuesta]") ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <label>Comentarios:</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="comentario" rows="3"></textarea>
                                        </div>
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
                                </div>
                            </div>
                                    <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabbable Widget -->
    </div>
</div>

