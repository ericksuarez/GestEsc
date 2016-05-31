<div id="content">
    <div class="container-fluid">
        <!--Busqueda-->
        <div class="panel-body">
        <h4 class="page-section-heading">Cuentas</h4>
        </div>
        <div class="panel panel-default">
            <?php echo form_open(current_url()); ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Nombre Alumno</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s) Apellido paterno Apellido materno" value="<?php echo set_value('nombre'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Nombre Tutor</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombreTutor" id="nombreTutor" placeholder="Nombre(s) Apellido paterno Apellido materno" value="<?php echo set_value('nombreTutor'); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5>No.Cuenta</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="cuenta" id="cuenta" placeholder="123456789120" value="<?php echo set_value('cuenta'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Matricula</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" name="matricula" id="matricula" placeholder="XXXX0000" value="<?php echo set_value('matricula'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5>Turno</h5>
                        <select class="form-control" name="turno" id="turno">
                            <option value="0">Selecciona una opción</option>
                            <?php echo getCatOpciones("CatTurno", "turno"); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <h5>Grado / Grupo</h5>
                        <select class="form-control" name="grupo" id="grupo">
                            <option value="0">Selecciona una opción</option>
                            <?php echo getCatOpciones("CatGrado", "grupo") ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
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
        <!--Busqueda-->

        <div class="panel panel-default">
            <div class="panel-heading panel-heading-gray">
                <i class="fa fa-fw fa-info-circle"></i> Listado de Cuentas
            </div>
            <div class="panel-body">
                <div class="panel panel-default">
                    <table id="example" class="table table-bordered table-hover table-condensed v-middle" cellspacing="0">
                        <thead>
                            <tr>
                                <th><b>No.Cuenta</b></th>
                                <th><b>Nombres</b></th>
                                <th><b>Fechas Pago</b></th>
                                <th><b>Acción</b></th>
                                <th><b>Saldo en la Cuenta</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cuentas as $key => $value) { ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo site_url("cobranza/mi_cuenta/" . $value['IDExp']) ?>">
                                            <?php echo $value['IDCuenta']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <p class="text"><b>Nombre estudiante: </b><?php echo $value['NomEstudiante'] ?></p>
                                        <p class="text"><b>Nombre tutor: </b><?php echo $value['NomTutor'] ?></p>
                                    </td>
                                    <td>
                                        <p><b>Fecha limite de pago: </b><br>
                                            <i id="fecha_limite_pago_<?php echo $value['IDExp']?>">
                                                <?php echo GeneraFechaPago($value['FrecPago'], $value['Dia']); ?></i></p>
                                        <p><b>Fecha último pago: </b><br>
                                            <i><?php
                                                $fechaUltimoPago = FechaUltimoPago($value['IDExp']);
                                                $date = new DateTime($fechaUltimoPago);
                                                echo $date->format('d/m/Y g:i A');
                                                ?></p><i>
                                    </td>
                                    <td>
                                     <?php if ($date->format('Y-m-d') < date('Y-m-d')) { ?>
                                            <p>
                                                <button data-mood='create' 
                                                        data-backdrop='static' 
                                                        data-keyboard='false'
                                                        data-ID='<?php echo $value['IDExp']; ?>' 
                                                        data-User='<?php echo $value['Usuario_IDUsuario']; ?>'
                                                        data-Descuento='<?php echo $value['DescntoColegiatura']; ?>' 
                                                        data-Recargo='<?php echo CalculaRecargo($value['IDExp'], $value['Usuario_IDUsuario']); ?>'
                                                        data-FrecPago='<?php echo $value['FrecPago']; ?>'
                                                        data-toggle="modal" data-target="#wizard-reincripcion" data-content-options="modal-lg" 
                                                        class="PAGARSERV btn btn-primary btn-stroke btn-xs"><i class="fa fa-exclamation-circle"></i>
                                                    &nbsp; Pagar Servicio</button>        
                                            </p>
                                        <?php } else { ?>
                                            <p><label class="success text-center">Pagado</label></p>
                                     <?php } ?>
                                        <p>
                                            <button 
                                                data-backdrop='static' 
                                                data-keyboard='false'
                                                data-ID='<?php echo $value['IDExp']; ?>'
                                                data-Cuenta='<?php echo $value['IDCuenta']; ?>'
                                                data-IDEstudiante='<?php echo $value['IDEstudiante']; ?>'
                                                data-IDTutor='<?php echo $value['IDPadFam']; ?>'
                                                data-FrecPago='<?php echo $value['FrecPago']; ?>'
                                                data-Dia='<?php echo $value['Dia']; ?>'
                                                data-toggle="modal" data-target="#forma-pago" data-content-options="modal-lg" 
                                                class="FORMAPAGO btn btn-warning btn-stroke btn-xs"><i class="fa fa-exclamation-circle"></i>
                                                &nbsp; Forma de Pago</button>        
                                        </p>
                                    </td> 
                                     <?php if ($value['Saldo'] - $value['Debe'] >= 0) { ?>
                                        <td class="text-center">
                                            <label><?php echo $value['Saldo'] - $value['Debe'] ?></label>
                                        </td>
                                     <?php } else { ?>
                                        <td class="danger text-center">
                                            <label style="color: white">
                                                $ <?php echo $value['Saldo'] - $value['Debe'] ?></label>
                                        </td>
                                <?php } ?>
                                </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>