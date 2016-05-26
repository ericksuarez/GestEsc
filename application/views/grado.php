<div class="row"> 
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
            <label>Turno</label>
            <select class="form-control" id="turno" name="turno">
                <?php foreach ($turno as $key => $value) { ?>
                    <option value="<?php echo $value["id_turno"]; ?>"> <?php echo $value["turno"]; ?></option>
                <?php } ?>
            <input type="hidden" value="<?php echo empty($info["turno_id"]) ? set_value('turno_id') : $info["turno_id"]; ?>" id="sel-turno">
            </select>
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Promedio anterior</label>
            <input type="text" class="form-control" id="promedio_anterior" maxlength="3" size="3" 
                   placeholder="Promedio de termino"
                   name="promedio_anterior"
                   value="<?php echo empty($info["promedio_anterior"]) ? set_value('promedio_anterior') : $info["promedio_anterior"]; ?>">
        </div>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
            <label>Descuento por Beca</label>
            <input type="text" class="form-control" id="beca" maxlength="2" size="2" 
                   placeholder="Procentaje de beca"
                   name="beca"
                   value="<?php echo empty($info["beca"]) ? set_value('beca') : $info["beca"]; ?>">
        </div>
    </div>
    
        <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
                <label>¿Desea el servicio de tranporte escolar?</label><br>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default active" >
                        <input type="radio" name="transporte" id="option2" autocomplete="off" value="SI"  checked="checked"
                            <?php echo (isset($info["transporte"]) && $info["transporte"]=='SI') ? "checked" : ""; ?>
                            <?php echo set_radio('transporte', 'SI')?>> SI
                    </label>
                    <label class="btn btn-default <?php echo (isset($info["transporte"]) && $info["transporte"]=='NO') ? "active" : ""; ?>" >
                        <input type="radio" name="transporte" id="option3" autocomplete="off" value="NO"  
                            <?php echo (isset($info["transporte"]) &&  $info["transporte"]=='NO') ? "checked" : ""; ?>
                           <?php echo  set_radio('transporte', 'NO')?>> NO
                    </label>
                </div>
            </div>
    </div>
    
        <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="form-group">
                <label>¿Desea el servivio de comedor?</label><br>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default active" >
                        <input type="radio" name="comedor" id="option2" autocomplete="off" value="SI"  checked="checked"
                            <?php echo (isset($info["comedor"]) && $info["comedor"]=='SI') ? "checked" : ""; ?>
                            <?php echo set_radio('comedor', 'SI')?>> SI
                    </label>
                    <label class="btn btn-default <?php echo (isset($info["comedor"]) && $info["comedor"]=='NO') ? "active" : ""; ?>" >
                        <input type="radio" name="comedor" id="option3" autocomplete="off" value="NO"  
                            <?php echo (isset($info["comedor"]) &&  $info["comedor"]=='NO') ? "checked" : ""; ?>
                           <?php echo  set_radio('comedor', 'NO')?>> NO
                    </label>
                </div>
            </div>
    </div>
</div>
<br>
