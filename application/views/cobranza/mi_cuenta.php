<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Mi Cuenta</h4>
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-gray">
                <i class="fa fa-fw fa-info-circle"></i> Detalle de Movimientos 
            </div>
            <?php echo form_open(current_url()); ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6>Seleccione una Fecha:</h6>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="FecsPago" id="reservationtime" 
                                   class="form-control daterangepicker-reservation" 
                                   value="<?php echo date("m/d/Y") ?> 12:00 AM - <?php echo date("m/d/Y") ?> 12:00 PM"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>&nbsp;</h5>
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-search floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Buscar</b>
                            </span>
                            <div class="clear"></div>
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-gray">
                        <i class="fa fa-fw fa-info-circle"></i> Listado de Pagos
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <table id="example" class="table table-bordered table-hover table-condensed v-middle" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fec.Pago</th>
                                        <th>Descuento</th>
                                        <th>Recargo</th>
                                        <th>Subtotal</th>
                                        <th>IVA</th>
                                        <th>Total</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($movimientos as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $value['IDPago'] ?></td>
                                            <td><?php echo $value['FecPago'] ?></td>
                                            <td><?php echo $value['Descuento'] ?></td>
                                            <td><?php echo $value['Recargo'] ?></td>
                                            <td><?php echo $value['SubTotal'] ?></td>
                                            <td><?php echo $value['IVA'] ?></td>
                                            <td><?php echo $value['Total'] ?></td>
                                            <td>
                                                <button data-backdrop='static' data-keyboard='false'
                                                        data-IDExp='<?php echo $value['Expediente_IDExp']; ?>' 
                                                        data-IDPago='<?php echo $value['IDPago']; ?>' 
                                                        data-target="#detalle-pago" data-toggle="modal" 
                                                        data-content-options="modal-lg" 
                                                        class="DETALLEPAGO btn btn-info btn-stroke btn-circle btn-xs">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-gray">
                        <i class="fa fa-fw fa-info-circle"></i> Servicios Contratados
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <ul>
                                <?php foreach ($servicios as $key => $value) { ?>
                                    <li><?php echo $value['Nombre']; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>