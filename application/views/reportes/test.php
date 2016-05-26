<!DOCTYPE html>
<html class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l1 sidebar-r1-xs" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Control Escolar</title>
        <!--font-awesome--> 
        <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!--Bootstrap--> 
        <link href="<?php echo base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!--Theme kit-->
        <link href="<?php echo base_url() ?>bootstrap/css/app/app.css" rel="stylesheet">
        <!--dataTables.min.css-->
        <link href="<?php echo base_url() ?>datatable/css/dataTables.min.css" rel="stylesheet">
        <!--         HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
              WARNING: Respond.js doesn't work if you view the page via file:// 
                 If you don't need support for Internet Explorer <= 8 you can safely remove these 
                [if lt IE 9]>-->
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <!--<![endif]-->
    </head>
    <body>
        <!--Wrapper required for sidebar transitions--> 
        <div class="st-container">
            <div align="center">
                <h3>Impresión de formulario</h3><br />
                Siga con m&aacute;s tutoriales de bloguero-ec
                : <a target="_blank" href="http://tutoriales.bloguero-ec.com/" title="Tutoriales consultas lo hacemos por usted mantenimiento y reparación de computadoras y más">tutoriales.bloguero-ec.com </a>
                <p>Dé clic en la imagen y vea por usted mismo recuerde utilizar este script con licencia MIT y modificarlo a su manera....!</p>

                <!-- fin de publicidad -->
                <p><a class="btnPrint" href='http://localhost/ControlEscolar/index.php/reportes/doc'><img src="images/imp.png" title="Imprimir esta documento..." /></a></p>


            </div>
        </div>    
        <!--Inline Script for colors and config objects; used by various external scripts;--> 
        <script>
            var config = {
                theme: "real-estate",
                skins: {
                    "default": {
                        "primary-color": "#3498db"
                    }
                }
            };
        </script>
        <!--         Vendor Scripts Bundle
                  Includes all of the 3rd party JavaScript libraries above.
                  The bundle was generated using modern frontend development tools that are provided with the package
                  To learn more about the development process, please refer to the documentation.
                  Do not use it simultaneously with the separate bundles above. -->
        <script src="<?php echo base_url() ?>bootstrap/js/vendor/all.js"></script>

        <!--App Scripts Bundle-->  
       <!--<script src="<?php echo base_url() ?>bootstrap/js/jquery-1.11.3.min.js"></script>-->
        <!--Includes Custom Application JavaScript used for the current theme/module;
        Do not use it simultaneously with the standalone modules below. -->
                <script src="<?php echo base_url() ?>bootstrap/js/app/app.js"></script>
        <!--Data Table-->
        <script src="<?php echo base_url() ?>datatable/js/dataTables.min.js"></script>
        <!--Function para cargar los catalogos-->
        <?php JS_alumno($this->uri->segment(1, 0), $this->uri->segment(2, 0)); ?>
        <!--Script para las acciones de las lista Imprimir y Exportar--> 
        <script src="<?php echo base_url() ?>ajax/acciones_lista.js"></script>
        <script src="<?php echo base_url() ?>ajax/Reportes.js"></script>
        <script src="<?php echo base_url() ?>ajax/jquery.printPage.js"></script>
<!--        <script>
            $(document).ready(function () {
                $('#example').DataTable();
            });
        </script>-->
        <script>
            $(document).ready(function () {
                $(".btnPrint").printPage();
                $('#example').DataTable();
            });
        </script>
    </body>
</html>
