<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Mi Cuenta</h4>
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-gray">
                <i class="fa fa-fw fa-info-circle"></i> Detalle de Movimientos 
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6>Seleccione una Fecha:</h6>
                        <div class="form-group daterangepicker-report" id="reportrange">
                            <div class="form-control">
                                <i class="fa fa-calendar fa-fw"></i>
                                <span><?php echo date("F j, Y, g:i a")?></span>
                                <input type="hidden" name="fecha" value="">
                                <b class="caret"></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5 class="hidden-xs">&nbsp;</h5>
                        <a type="submit" class="btn btn-info">
                            <i class="fa fa-search floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Buscar</b>
                            </span>
                            <div class="clear"></div>
                        </a>
                    </div>
                </div>
                <??>
            </div>
        </div>
    </div>
</div>