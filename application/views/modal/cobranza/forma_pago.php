<div class="modal slide-down fade" id="forma-pago">
    <div class="modal-dialog">
        <div class="v-cell">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Forma de Pago</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div id="resp-reinsc" style="z-index: 100;position: fixed;"></div>
                        <div class="panel-body">
                            <div class="row">
                                <p>
                                    Seleccione la frecuencia con la que se realizaran los pagos de Colegiatura
                                    asi como de otros servicios.
                                </p>
                                <p>
                                    NOTA: En pago mensual se define el último día habíl permitido para realizar el pago.
                                </p>
                                <div class="col-md-12">
                                    <h6>Frecuencia de Pagos</h6>
                                    <select class="form-control" name="frecpago" id="frecpago">
                                        <option value="0">Selecciona una opción</option>
                                        <?php foreach (PeriodosPago() as $k => $value){?>
                                        <option value="<?php echo $k?>"><?php echo $value?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-12" id="FP_diasemanal" style="display: none">
                                    <h6>Dias de la semana</h6>
                                    <select class="form-control" name="diasemanal" id="diasemanal" >
                                        <option value="0">Selecciona una opción</option>
                                        <?php foreach (DiasSemana() as $k => $value){?>
                                        <option value="<?php echo $k?>"><?php echo $value?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-12" id="FP_diahabil" style="display: none">
                                    <h6>Dia</h6>
                                    <select class="form-control" name="diahabil" id="diahabil" >
                                        <option value="0">Selecciona una opción</option>
                                        <?php for ($i=1; $i<=31; $i++){?>
                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <p id="desc_quincenal" style="display: none">
                                El pago se debera realizar los días 15,30,31 según 
                                correspondan al mes. Si no son días habiles deberan realizar su pago un día 
                                antes o despues, de lo contrario se generan cargos por demora.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="FPcancelar">Cancelar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="FPsalir" style="display: none">Salir</button>
                    <button type="button" class="btn btn-success" id="FPguardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
