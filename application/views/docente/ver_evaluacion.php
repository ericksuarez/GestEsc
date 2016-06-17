<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Evaluación de Desempeño</h4>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load("current", {packages: ["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Docente', <?php echo "'".$NomDocente."'";?>],
                                ['OCUPACIONAL', <?php echo $PP30?>],
                                ['PROCESO ENSEÑANZA-APRENDIZAJE', <?php echo $PP70?>],
                                ['AREA DE OPORTUNIDAD', <?php echo 100 - ($PP30 + $PP70)?>]
                            ]);

                            var options = {
                                title: 'DOCENTE: ' + <?php echo "'".  strtoupper($NomDocente)."'";?>,
                                is3D: true,
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('grafico'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="grafico" style="width: 100%; height: 300px">
                        <i class="fa fa-spinner fa-pulse"></i> Creando grafico por favor
                        espere.
                    </div>
                    <div class="row">
                        <h6>Observaciones</h6>
                        <?php foreach($comentarios as $k => $opinon){ ?>
                        <div class="col-md-6">
                            <p><?php echo ++$k.'.- '.$opinon?></p>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>