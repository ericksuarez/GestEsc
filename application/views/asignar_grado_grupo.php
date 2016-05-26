<div class="row"> 
<label>Asignar grupos:</label>
<a class="btn btn-success" href='<?php echo site_url(getURIuser() . "/lista"); ?>'> 
                            <i class="fa fa-plus floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Agregar</b>
                            </span>
                            <div class="clear"></div>
                        </a><br><br>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Grado y Grupo</label>
            <select class="form-control" id="grado" name="grado">
                <?php foreach ($grado as $key => $value) { ?>
                    <option value="<?php echo $value["id_grado"]; ?>"> <?php echo $value["grado"] . " - " . $value["grupo"]; ?></option>
                <?php } ?>
            <input type="hidden" value="<?php echo empty($info["grado_id"]) ? set_value('grado_id') : $info["grado_id"]; ?>" id="sel-grado">    
            </select>
        </div>
    </div>

	<div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Materia</label>
            <select class="form-control" id="grado" name="grado">
                <?php foreach ($grado as $key => $value) { ?>
                    <option value="<?php echo $value["id_grado"]; ?>"> <?php echo $value["grado"] . " - " . $value["grupo"]; ?></option>
                <?php } ?>
            <input type="hidden" value="<?php echo empty($info["grado_id"]) ? set_value('grado_id') : $info["grado_id"]; ?>" id="sel-grado">    
            </select>
        </div>
    </div>
	
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Turno</label>
            <select class="form-control" id="turno" name="turno">
                <?php foreach ($turno as $key => $value) { ?>
                    <option value="<?php echo $value["id_turno"]; ?>"> <?php echo $value["turno"]; ?></option>
                <?php } ?>
            <input type="hidden" value="<?php echo empty($info["turno_id"]) ? set_value('turno_id') : $info["turno_id"]; ?>" id="sel-turno">
            </select>
        </div>
    </div>

</div>
<br>
