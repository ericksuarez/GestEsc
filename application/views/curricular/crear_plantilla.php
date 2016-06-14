<div id="content">
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel panel-body">
                <div id="resp-FP" style="z-index: 100;position: fixed;"></div>
        <?php // echo form_open(current_url())?>
                <input type="hidden" value="<?php echo $plantilla['IDPlantilla']; ?>" id="IDPlantilla">
                <label class="center-block">Crear Plantilla de Correos</label>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tipo:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="Tipo" id="Tipo">
                                <?php echo getCatOpciones("CatTipoPlantilla", "Tipo", $TipoPlantilla) ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Descripcion:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="2" name="Desc" id="Desc"><?php echo $plantilla['Explicacion']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="<?php echo site_url('mantenimiento/plantilla_correo') ?>" class="btn btn-primary">
                                            <i class="fa fa-reply floatL t3"></i>
                                            <span class="hidden-xs floatL l5">
                                                <b>&nbsp; Regresar a la lista</b>
                                            </span>
                                            <div class="clear"></div>
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-success" id="SAVE-THEME">
                                            <i class="fa fa-save floatL t3"></i>
                                            <span class="hidden-xs floatL l5">
                                                <b>&nbsp; Guardar</b>
                                            </span>
                                            <div class="clear"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="summernote" name="area_trabajo" id="area_trabajo"><?php echo $plantilla['Tema']; ?></div>
        <?php // echo form_close()?>
            </div>
        </div>
    </div>
</div>