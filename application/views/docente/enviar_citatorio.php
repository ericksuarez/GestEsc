<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Enviar Citatorios</h4>
        <input type="hidden" value="" id="func">
        <div class="panel panel-default">
            <div class="panel panel-body">
                <form class="form-horizontal" role="form" method="post" action="<?php echo site_url('docente/enviar_Citatorio')?>">
                    <div class="form-group">
                        <div class="col-sm-2 control-label">
                            <button data-backdrop='static' data-keyboard='false'
                                    data-toggle="modal" data-target="#DIRECTORIO_CORREO" 
                                    data-content-options="modal-lg" 
                                    data-func="PARA" 
                                    type="button" class="DIRECTORIO_CORREO btn btn-primary">
                                <i class="fa fa-plus floatL t3"></i>
                                <span class="hidden-xs floatL l5">
                                    <b>&nbsp; Para</b>
                                </span>
                                <div class="clear"></div>
                            </button>
                        </div>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="2" name="PARA" id="PARA"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 control-label">
                            <button data-backdrop='static' data-keyboard='false'
                                    data-toggle="modal" data-target="#DIRECTORIO_CORREO" 
                                    data-content-options="modal-lg" 
                                    data-func="CC"
                                    type="button" class="DIRECTORIO_CORREO btn btn-primary">
                                <i class="fa fa-plus floatL t3"></i>
                                <span class="hidden-xs floatL l5">
                                    <b>&nbsp; Cc</b>
                                </span>
                                <div class="clear"></div>
                            </button>
                        </div>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="2" name="CC" id="CC"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asunto:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Asunto" id="Asunto" value="<?php echo set_value('Asunto'); ?>" placeholder="...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-send floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <b>&nbsp; Enviar</b>
                                        </span>
                                        <div class="clear"></div>
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="collapse" data-target="#collapseExample" 
                                            aria-expanded="false" aria-controls="collapseExample">
                                        <i class="fa fa-paperclip floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <b>&nbsp; Adjunto</b>
                                        </span>
                                        <div class="clear"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Plantilla:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="plantilla" id="plantilla">
                                        <option value="0">Tipo de Citatorio</option>
                                        <?php echo getCatOpciones("CatTipoPlantilla", "plantilla", $IDPlantilla) ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="collapse" id="collapseExample">
                        <?php $this->load->view('example_sin_div.php', $output);?>
                </div>
                <br>
                <!--<div class="summernote"></div>-->
                <textarea name="editor" id="editor" rows="10" cols="80">
                    <?php echo $plantilla['Tema']; ?>
                </textarea>
                </form>
            </div>
        </div>
    </div>
</div>
<p id="PARAHide"></p>
<p id="CCHide"></p>
<?php $this->load->view('modal/directorio_correo'); ?>
<script>
    function PARA(correo) {
        var correos = $("#PARAHide").text();
        correos += correo;
        $("#PARAHide").text(correos);
    }
    function CC(correo) {
        var correos = $("#CCHide").text();
        correos += correo;
        $("#CCHide").text(correos);
    }
</script>