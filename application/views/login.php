<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Gestión Escolar</title>
        <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>bootstrap/css/vendor/all.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>bootstrap/css/app/app_login.css" rel="stylesheet">
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    </head>
    <body class="login">
        <div id="content">
            <div class="container-fluid">
                <div class="message">
                        <div class="inner-message">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            ','</div></div>'); ?>
                    <?php
                    $exito = $this->session->userdata('exito');
                    if (!empty($exito)) {
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Exito!</strong> <?php echo $exito?>
                        </div>
                    <?php } ?>
                    <?php
                    $error = $this->session->userdata('error');
                    if (!empty($error)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong> <?php echo $error?>
                        </div>
                    <?php } ?>
                        </div>
                        </div>
                <div class="lock-container">
                    <h1>Acceso al Sistema</h1>
    <?php echo form_open('login'); ?>
                        <div class="panel panel-default text-center">
                            <img src="<?php echo base_url() ?>images/people/110/guy-6.jpg" class="img-circle">
                            <div class="panel-body">
                                <input class="form-control" name="user" type="text" placeholder="Clave de Usuario">
                                <input class="form-control" name="pass"  type="password" placeholder="Contraseña">
                                <button type="submit"  class="btn btn-primary">Ingresar 
                                    <i class="fa fa-fw fa-unlock-alt"></i>
                                </button>
                                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>
    <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <strong>Nombre Empresa</strong> v4.0.0 &copy; Copyright 2016
            </footer>
            <!-- // Footer -->
            <!-- Inline Script for colors and config objects; used by various external scripts; -->
            <script>
                var colors = {
                    "danger-color": "#e74c3c",
                    "success-color": "#81b53e",
                    "warning-color": "#f0ad4e",
                    "inverse-color": "#2c3e50",
                    "info-color": "#2d7cb5",
                    "default-color": "#6e7882",
                    "default-light-color": "#cfd9db",
                    "purple-color": "#9D8AC7",
                    "mustard-color": "#d4d171",
                    "lightred-color": "#e15258",
                    "body-bg": "#f6f6f6"
                };
                var config = {
                    theme: "social-1",
                    skins: {
                        "default": {
                            "primary-color": "#16ae9f"
                        },
                        "orange": {
                            "primary-color": "#e74c3c"
                        },
                        "blue": {
                            "primary-color": "#4687ce"
                        },
                        "purple": {
                            "primary-color": "#af86b9"
                        },
                        "brown": {
                            "primary-color": "#c3a961"
                        }
                    }
                };
            </script>

            <script src="<?php echo base_url() ?>bootstrap/js/vendor/all.js"></script>
            <script src="<?php echo base_url() ?>bootstrap/js/app/app.js"></script>
    </body>
</html>