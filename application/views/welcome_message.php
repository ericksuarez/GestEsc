<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">

        <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Control Escolar</title>
        <!--font-awesome-->
        <link href="<?php echo base_url() ?>recursos/font-awesome/css/font-awesome.min.css" rel="stylesheet"> 
        <!--Theme kit-->
	<link href="<?php echo base_url() ?>frontend/css/vendor/all.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>frontend/css/app/desarrollo.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
      WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body class="login">

        <div id="content">
            <div class="container-fluid">

                <div class="lock-container">
                    <h1>Acceso al Sistema</h1>
                    <div class="panel panel-default text-center">
                        <img src="<?php echo base_url() ?>images/woman-5.jpg" class="img-circle">
                        <div class="panel-body">
                            <input class="form-control" type="text" placeholder="Matricula">
                            <input class="form-control" type="password" placeholder="Contraseña">

                            <a href="http://localhost/ControlEscolar/index.php/alumno/lista" class="btn btn-primary">Acceder <i class="fa fa-fw fa-unlock-alt"></i></a>
                            <a href="#" class="forgot-password" data-toggle="modal" data-target="#modal-slide-down">
                                Recuperar contraseña</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal slide-down fade" id="modal-slide-down">
            <div class="modal-dialog">
                <div class="v-cell">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Recuperar contraseña</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row"> 
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Matricula</label>
                                        <input type="text" class="form-control" id="usuario" 
                                               placeholder="Matricula"
                                               name="matricula"
                                               value="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="contrasena" 
                                               placeholder="Email"
                                               name="email"
                                               value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Recuperar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url() ?>bootstrap/js/jquery-1.11.3.min.js"></script>
        <script src="<?php echo base_url() ?>bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>