<div class="st-pusher">
    <!-- this is the wrapper for the content -->
    <div class="st-content">
        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-top-none" id="content" style="padding: 20px;">
		<br>
		<div class="panel panel-default">
		<div class="panel-body">
            <div class="row">
                <h4 class="page-section-heading">Impresión de Documentos</h4>
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
                    <a class="btn btn-warning" href='<?php echo site_url(getURIuser() . "/papeles/" . getURIparametro()); ?>' > 
                        <i class="fa fa-cloud-upload floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Actualizar Documentos</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                </div>
            </div>
            <br><br>
            <div class="row">
				<div class="panel panel-default">
                    <div class="panel-body">
					<div class="col-xs-12 col-sm-4 col-md-4">
					<h5 class="page-section-heading">Lista de tipos de documentos</h5>
					<div data-toggle="tree" data-tree-checkbox data-tree-select="3">
                        <ul style="display: none;">     
							<?php foreach($docs as $key => $value){?>
                          <li class="folder">
                            <?=$key;?>
                            <ul>
							<?php foreach($value as $k => $val){?>
                              <li><?=$val;?></li>
							  <?php }?>
                            </ul>
                          </li>
							<?php }?>
                        </ul>
                      </div>
					</div>
			<?= form_open("buscar/usuario/".getURIuser() . "/" . getURIparametro()); ?>
						<div class="col-xs-12 col-sm-8 col-md-8">
							<div class="form-group">
								<div class="input-group">
								  <input type="text" class="form-control" placeholder="Ingresa el nombre o matricula ...">
								  <span class="input-group-btn">
									<button type="submit" class="btn btn-default"> 
										<i class="fa fa-search floatL t3"></i>
										<span class="hidden-xs floatL l5">
											<b>&nbsp; Buscar</b>
										</span>
										<div class="clear"></div>
									</button>
								  </span>
								</div><!-- /input-group -->
							</div>
							<div class="media">
                  <div class="media-left">
                    <a href="#">
                      <img src="<?=base_url();?>images/pdf-thumbnail.png" width="60" alt="woman" class="media-object" />
                    </a>
                  </div>
                  <div class="media-body message">
                    <div class="panel panel-default">
                      <div class="panel-heading panel-heading-white">
                        <div class="pull-right">
                          <small class="text-muted">fecha de modificación 2015-11-19</small>
                        </div>
                        <a>Nombre del usuario</a>
                      </div>
                      <div class="panel-body">
							<div class="input-group">
								  <span class="input-group-btn">
									<button type="submit" class="btn btn-info"> 
										<i class="fa fa-eye floatL t3"></i>
										<span class="hidden-xs floatL l5">
											<b>&nbsp; Ver</b>
										</span>
										<div class="clear"></div>
									</button>
									<a class="btn btn-success" > 
										<i class="fa fa-print floatL t3"></i>
										<span class="hidden-xs floatL l5">
											<b>&nbsp; Impresión</b>
										</span>
										<div class="clear"></div>
									</a>
								  </span>
								  <em>&nbsp;&nbsp; Nombre del archivo.</em>
								</div><!-- /input-group -->
                      </div>
                    </div>
                  </div>
                </div>
						</div>
			</form>
                    </div>
                  </div>
            </div>
            
        </div>
    </div>
</div>
</div>
</div>
<br><br><br><br>
