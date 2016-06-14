<!DOCTYPE html>

<html class="ls-top-navbar show-sidebar sidebar-l2" lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gestión Escolar</title>
        <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>bootstrap/css/vendor/all.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>bootstrap/css/app/app.css" rel="stylesheet">
        <!--summernote-->
	<link href="<?php echo base_url() ?>bootstrap/summernote/dist/summernote.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    </head>

    <body>
        <!-- Fluid navbar -->
        <div class="navbar navbar-main navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" data-toggle="sidebar-menu" class="toggle pull-left visible-xs">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a class="navbar-brand navbar-brand-primary" href="index.html">Layout Kit</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo site_url('login/cerrar_sesion')?>">Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Se manda a llamar al menu lateral del sistema-->         
        <?php $this->load->view("common/menu"); ?>
        <div id="content" style="z-index: 100;position: fixed;">
            <div class="container-fluid pull-right">
                <?php if(!empty(validation_errors())){?>
                <div class="alert alert-danger alert-dismissible" role="alert" style="box-shadow: 5px 5px 7px #888888;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                </div>
                <?php }?>
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