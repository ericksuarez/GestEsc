<div class="st-pusher">
    <!-- this is the wrapper for the content -->
    <div class="st-content">
        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-top-none" id="content" style="padding: 20px;">
		<br>
		<div class="panel panel-default">
		<div class="panel-body">
            <div class="row">
                <h4 class="page-section-heading">Cargar Documentos</h4>
                <div class="pull-left">
                    <a class="btn btn-primary" href='<?php echo site_url(getURIuser() . "/lista"); ?>'> 
                        <i class="fa fa-reply floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Regresar a la lista</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info " href='<?php echo site_url(getURIuser() . "/imprimir/" . getURIparametro()); ?>' 
                       <?php echo ButtonEnable(); ?>>
                        <i class="fa fa-print floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Imprimir Recibos</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
            <br><br>
            <?= form_open_multipart('subirdocumentos/subir/' . getURIuser() . "/" . getURIparametro()); ?>
            <div class="row"> 
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Acta de nacimiento</label>
                        <input type="file" id="acta_nacimiento" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>CURP</label>
                        <input type="file" id="curp" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Certificado medico</label>
                        <input type="file" id="certificado_medico" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>IFE</label>
                        <input type="file" id="ife" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" id="foto" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Cedula profesional</label>
                        <input type="file" id="cedula" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
                    </div>
                </div>
            </div>
            <div class="btn-group btn-group-lg pull-right" role="group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<br><br><br><br>
