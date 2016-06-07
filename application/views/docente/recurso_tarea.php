<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Documentos de ayuda</h4>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Materia: </label>
                        <select class="form-control" name="RecursoTarea" id="RecursoTarea" disabled="">
                            <option value="0">Todas</option>
                            <?php echo getCatOpcionesWhere("CatMateria", "RecursoTarea", $tarea[0]['Materia_IDMateria']); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Grado/Grupo: </label>
                        <select class="form-control" name="CatGrado" id="CatGrado" disabled="">
                            <option value="0">Todas</option>
                            <?php echo getCatOpcionesWhere("CatGrado", "grupo", $tarea[0]['IDGrado']); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <h5>Nombre Tarea: </h5>
                        <p><?php echo $tarea[0]['NomTarea'] ?></p>
                    </div>
                    <div class="col-md-3">
                        <h5>&nbsp;</h5>
                        <a href="<?php echo site_url('mantenimiento/tareas') ?>" class="btn btn-primary">
                            <i class="fa fa-reply floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Regresar a Tareas</b>
                            </span>
                            <div class="clear"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>