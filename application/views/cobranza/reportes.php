<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Mi Cuenta</h4>
        <div id="filter">
            <form class="form-inline">
                <label>Visualizar:</label>
                <div class="pull-right">
                    <a class="btn btn-primary" href='<?php // echo site_url("reportes/".$uri."/export");       ?>' target="_new" id="export"> 
                        <i class="fa fa-file-pdf-o floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; PDF</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                    <a class="btnPrint btn btn-primary " href='<?php // echo site_url("reportes/".$uri);       ?>' id="print">
                        <i class="fa fa-print floatL t3"></i>
                        <span class="hidden-xs floatL l5">
                            <b>&nbsp; Imprimir</b>
                        </span>
                        <div class="clear"></div>
                    </a>
                </div>
            </form>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-9">
                        <h6>Seleccione una Fecha:</h6>
                        <div class="form-group daterangepicker-report" id="reportrange">
                            <div class="form-control">
                                <i class="fa fa-calendar fa-fw"></i>
                                <span>December 10, 2014 - January 9, 2015</span>
                                <b class="caret"></b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>&nbsp;</h5>
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