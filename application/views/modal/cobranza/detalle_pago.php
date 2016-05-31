<div class="modal slide-down fade" id="detalle-pago">
    <div class="modal-dialog">
        <div class="v-cell">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Detalle de Pago</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div id="resp-FP" style="z-index: 100;position: fixed;"></div>
                        <div class="panel-body">
                            <div class="row">
                                <table class="table" id="lista_detalles">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <!--<th>Fec.Pago</th>-->
                                            <th>Unidad</th>
                                            <th>Nombre</th>
                                            <th>Descuento</th>
                                            <th>Recargo</th>
                                            <th>Subtotal</th>
                                            <th>IVA</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="FP-IDExp" value="">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="DPcancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>
