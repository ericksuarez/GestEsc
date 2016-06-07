<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Revisar y Calificar ejercicios</h4>
        <?php echo form_open(current_url()); ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Materia: </label>
                        <select class="form-control" name="Materia" id="Materia">
                            <option value="0">Todas</option>
                            <?php foreach ($materias as $k => $val) { ?>
                                <option value="<?php echo $val['IDMateria'] ?>" 
                                    <?php echo set_select('Materia', $val['IDMateria'], $val['IDMateria'] == $IDMateria ? true : false); ?>>
                                        <?php echo $val['Nombre'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <h4>&nbsp;</h4>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Buscar</b>
                            </span>
                            <div class="clear"></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>