<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Listado de tareas</h4>
        <div class="row">
            <div class="col-md-12 panel">
                <label>Materias:</label>
                <select class="form-control" name="materia" id="materia">
                    <option value="0">Selecciona una opción</option>
                    <?php echo getCatOpcionesWhere("CatMateria", "materia", $materia, $where); ?>
                </select>
                <br>
            </div>

            <div class="col-md-12">
                <div class="media">
                    <div class="media-body message">
                        <div class="panel panel-default">
                            <table id="example" class="table table-bordered table-hover table-condensed v-middle" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nom.Tarea</th>
                                        <th>Descripción</th>
                                        <th>Fec.Entrega</th>
                                        <th>Archivo</th>
                                        <th>Pagina Web</th>
                                        <th>Tarea Enviada</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tareas as $key => $value) { ?>
                                        <tr>
                                            <td><?php echo $value["NomTarea"]; ?></td>
                                            <td><?php echo $value["Descripcion"]; ?></td>
                                            <td><?php echo FecFormatoView($value["FecEntrega"]); ?></td>
                                            <td>
                                                <?php if (!empty($value["Archivo"])) { ?>
                                                    <a href="<?php echo base_url() . $this->config->item('RutaTarea') . '/' . $value["Archivo"]; ?>" target="_new" class="btn btn-info btn-stroke btn-circle btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('estudiante/descarga/' . $materia . '/' . $value["IDTareas"]) ?>" 
                                                       target="_new" class="btn btn-primary btn-stroke btn-circle btn-xs">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($value["PagConsulta"])) { ?>
                                                    <a href="<?php echo $value["PagConsulta"]; ?>" target="_new" class="btn btn-info btn-stroke btn-circle btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <?php echo $value["PagConsulta"]; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $FileTarea = $this->tarea->getArchivoTarea(
                                                        $value["IDTareas"], $materia, $estudiante[0]['IDEstudiante'], $value["Periodo_IDPeriodo"]
                                                );
                                                if (!empty($FileTarea)) {
                                                    ?>
                                                    <a href="<?php echo $FileTarea; ?>" target="_new" class="btn btn-info btn-stroke btn-circle btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('estudiante/defautlDescarga/' . $value["IDTareas"].'/'.$materia.'/'.$estudiante[0]['IDEstudiante'].'/'.$value["Periodo_IDPeriodo"]) ?>" 
                                                       target="_new" class="btn btn-primary btn-stroke btn-circle btn-xs">
                                                        <i class="fa fa-download"></i>
                                                    </a>
    <?php } else { ?>
                                                    <?php echo $FileTarea; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
    <?php echo form_open_multipart('estudiante/documentoTarea/' . $estudiante[0]['IDExp'] . '/' . $materia . '/' . $value["IDTareas"]); ?>
                                                <input type="file" name="userfile[Doc_Tarea][9]" />
                                                <button class="btn btn-success pull-right" type="submit">
                                                    <i class="fa fa-save floatL t3"></i>
                                                    <span class="hidden-xs floatL l5">
                                                        <b>&nbsp; Guardar</b>
                                                    </span>
                                                    <div class="clear"></div>
                                                </button>
    <?php echo form_close() ?>
                                            </td>
                                        </tr>
<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>