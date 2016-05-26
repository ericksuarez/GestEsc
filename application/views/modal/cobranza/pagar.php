<div class="modal slide-down fade" id="wizard-reincripcion">
    <div class="modal-dialog">
        <div class="v-cell">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Pagó de Servicios</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div id="resp-reinsc" style="z-index: 100;position: fixed;"></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12" id="listado_servicios">
                                    <h6>Pagar Servicios</h6>
                                    <?php echo getCatOpcionesCheckBoxes("CatServicio", "REservicio[]") ?>
                                </div>
                                <div class="col-md-12">
                                    <h6>Observaciones</h6>
                                    <textarea rows="2" type="text" class="form-control" name="DescBaja" id="DescBaja">N/A</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="REcancelar">Cancelar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="REsalir" style="display: none">Salir</button>
                    <!--<button type="button" class="btn btn-primary" id="RErecibo" style="display: none">Recibo</button>-->
                    <a class="btn btn-primary btnPrint" href="<?php echo site_url('imprimir/recibo_reinscripcion'); ?>" id="RErecibo" style="display: none">Recibo</a>
                    <button type="button" class="btn btn-success" id="REguardar" data-save-ID="">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
