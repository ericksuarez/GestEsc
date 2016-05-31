<div id="content">
    <div class="container-fluid">
        <!--<div class="page-section">-->
        <div class="row">

            <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                <h4 class="page-section-heading">
                    <img src="<?= base_url(); ?>images/logo.jpg" width="100" alt="Logo" class="img-responsive pull-left" />
                    <p><label><?php echo $this->config->item('NomEscuela'); ?></label></p>
                    <p>
                        <small>Kardéx</small></p>

                </h4>	

                <?php echo $export_buttons;?>

                <div class="panel-heading panel-heading-white">
                    <br><br>
                    <p><label>Matricula: </label>&nbsp; <?php echo $estudiante[0]['Matricula'] ?></p>
                    <p><label>Nombre: </label>&nbsp; <?php echo $estudiante[0]['NomCompleto'] ?></p>
                </div>


                <div class="table-responsive">
                    <?php
                    $grados = $this->catalogo->CatGradoEsc();
                    foreach ($grados as $k => $v) {
                        ?>
                        <label><?php echo $v['opcion']; ?></label>
                        <!-- Pricing table -->
                        <table class="table panel panel-default table-pricing">
                            <!-- Table heading -->
                            <thead>
                                <tr>
                                    <th>Materia</th>
                                    <th>Calificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $grados_escolares = $this->study->getMateriasGradoEsc($v['index']);
                                foreach ($grados_escolares as $key => $valu) {
                                    ?>    
                                    <tr>
                                        <td><?php echo $valu['Nombre'] ?></td>
                                        <?php
                                        $kardex = $this->study->getKardex($estudiante[0]['IDEstudiante'], $valu['IDMateria']);
                                        if(count($kardex) > 0) {
                                        foreach ($kardex as $ke => $val) {
                                            ?>
                                            <td><?php echo $val['Promedio'] ?></td>
                                <?php }} else { ?>
                                            <td>0.00</td>
                                <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

