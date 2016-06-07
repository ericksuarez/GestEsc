<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Tarea para las Materias</h4>
        <div class="row panel">
            <div class="col-md-6">
                <label>Materias:</label>
                <select class="form-control" name="DocenteTareas" id="DocenteTareas">
                    <option value="0">Todas</option>
                    <?php foreach($materia as $k => $val){ ?>
                        <option value="<?php echo $val['IDMateria']?>" <?php echo set_select('DocenteTareas', $val['IDMateria'], $val['IDMateria'] == $IDMateria ? true : false);?>><?php echo $val['Nombre']?></option>
                    <?php }?>
                </select>
                <br>
            </div>

        </div>
    </div>
</div>