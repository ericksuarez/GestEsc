<!DOCTYPE html>
<html>
    <head>
        <title>Crear un nuevo evento</title>
        <meta charset="utf-8">
    <head>
        <link href="<?php echo base_url() ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
        <script src="<?php echo base_url() ?>bower_components/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>bower_components/moment/moment.js"></script>
        <script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo base_url() ?>bower_components/eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.es.js"></script>
    </head>
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col-sm-8 col-sm-offset-2" style="height:100px;">
                <div class="row">
                    <div class=" col-md-3 pull-right">
                        <?php echo form_open(site_url('events/eliminar')) ?>
                        <button type="submit" class="btn btn-danger"  id="delete-agenda">Eliminar</button>
                        <input type="hidden" value="<?php echo $info["id"] ?>" name="ID" id="ID">
                        <?php echo form_close() ?>
                    </div>
                    <div class=" col-md-3 pull-right">
                        <?php echo form_open(site_url('events/editar')) ?>
                        <button type="submit" class="btn btn-success" id="update-agenda">Guardar</button>
                    </div>
                </div>
                <br>
                <div class='col-md-3'>
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $info["id"] ?>" name="ID" id="ID">
                        <input type="hidden" value="<?php echo $info["url"] ?>" name="url" id="url">
                        <input type="hidden" value="<?php echo $info["fechaIni"] ?>" name="fechaIni" id="fechaIni">
                        <input type="hidden" value="<?php echo $info["fechaFin"] ?>" name="fechaFin" id="fechaFin">
                        <input type="hidden" value="<?php echo $info["class"] ?>" name="class" id="class">
                        <div class='input-group date' id='from'>
                            <input type='text' name="from" class="form-control" readonly 
                                   value="<?php echo $info["fechaIni"] ?>"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="form-group">
                        <div class='input-group date' id='to'>
                            <input type='text' name="to" class="form-control" readonly value="<?php echo $info["fechaFin"] ?>"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-12 control-label">Tipo de evento</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="class">
                            <option value="event-warning" <?php echo $info["class"] == "event-warning" ? 'selected="selected"' : '' ?>>Alerta</option>
                            <option value="event-inverse" <?php echo $info["class"] == "event-inverse" ? 'selected="selected"' : '' ?>>Cancelada</option>
                            <option value="event-special" <?php echo $info["class"] == "event-special" ? 'selected="selected"' : '' ?>>Especial</option>
                            <option value="event-important" <?php echo $info["class"] == "event-important" ? 'selected="selected"' : '' ?>>Importante</option>
                            <option value="event-info" <?php echo $info["class"] == "event-info" ? 'selected="selected"' : '' ?>>Información</option>
                            <option value="event-success" <?php echo $info["class"] == "event-success" ? 'selected="selected"' : '' ?>>Reunión</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-12 control-label">Nom. Corto</label>
                    <div class="col-sm-12">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Introduce un título" value="<?php echo $info["title"] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-12 control-label">Desc. Evento</label>
                    <div class="col-sm-12">
                        <textarea id="body" name="event" class="form-control" rows="3"><?php echo $info["body"] ?></textarea>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(function () {
            $('#from').datetimepicker({
                language: 'es',
                minDate: new Date()
            });
            $('#to').datetimepicker({
                language: 'es',
                minDate: new Date()
            });

        });
    </script>
</div>
</body>
</html>