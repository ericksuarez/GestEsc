<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Forma de Pago</h4>
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-gray">
                <i class="fa fa-fw fa-info-circle"></i> Seleccione la forma de pago y la periodicidal con la que se realizaran.
            </div>
            <div class="panel-body">
                <?php foreach ($estudiante as $key => $info) {?>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text">Nombre del estudiante: <b><?php echo $info['NomCompleto']?></b></p>
                        <p class="text">Nombre del tutor: </p>
                        <p class="text">Cuenta: </p>
                    </div>
                    <input type="hidden" id="FP"
                           data-mood='create' 
                           data-ID='<?php echo $info['IDExp'];?>' 
                           data-User='<?php echo $info['IdUsuario'];?>'
                           data-Descuento='<?php echo $info['DescntoColegiatura'];?>' 
                           data-Recargo='<?php echo CalculaRecargo($info['IDExp']);?>'>
                    <input type="hidden" id="REguardar" value="">
                    
                    <div class="col-md-12" id="listado_servicios">
                        <h6>Servicios Contratados</h6>
                        <?php echo getCatOpcionesCheckBoxes("CatServicio", "REservicio[]") ?>
                    </div>
                    <div class="col-md-12">
                        <h5 class="hidden-xs">&nbsp;</h5>
                        <button class="btn btn-success pull-right" id="REguardar" data-save-ID="">
                            <i class="fa fa-save floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Guardar</b>
                            </span>
                            <div class="clear"></div>
                        </button>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>