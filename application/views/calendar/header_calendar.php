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
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('calendar/agenda') ?>">Calendario</a></li>
            <li><a href="<?php echo site_url('events') ?>">Agendar Cita</a></li>
        </ol>

        <div id="content" style="z-index: 100;position: fixed;">
            <div class="container-fluid pull-right">
                <?php if (!empty(validation_errors())) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo validation_errors(); ?>
                    </div>
                <?php } ?>
                <?php
                $exito = $this->session->userdata('exito');
                if (!empty($exito)) {
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Exito!</strong> <?php echo $exito ?>
                    </div>
                <?php } ?>
                <?php
                $error = $this->session->userdata('error');
                if (!empty($error)) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $error ?>
                    </div>
                <?php } ?>
            </div>
        </div>
