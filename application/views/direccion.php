<div class="row"> 
    
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Calle</label>
        <input type="text" class="form-control capitalize" id="calle<?=$hashcode?>" 
               placeholder="Calle"
               name="calle<?=$hashcode?>"
               value="<?php echo empty($info["calle"]) ? set_value('calle'.$hashcode) : $info["calle"]; ?>">
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Num. interior</label>
        <input type="text" class="form-control capitalize" id="num_interior<?=$hashcode?>" 
               placeholder="Numero interior"
               name="num_interior<?=$hashcode?>"
               value="<?php echo empty($info["num_interior"]) ? set_value('num_interior'.$hashcode) : $info["num_interior"]; ?>">
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Num. exterior</label>
        <input type="text" class="form-control capitalize" id="num_exterior<?=$hashcode?>" 
               placeholder="Numero exterior"
               name="num_exterior<?=$hashcode?>"
               value="<?php echo empty($info["num_exterior"]) ? set_value('num_exterior'.$hashcode) : $info["num_exterior"]; ?>">
    </div>
</div>
<?php if(getURIuser() != "alumno"){?>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Numero celular</label>
        <input type="text" class="form-control" id="celular<?=$hashcode?>" maxlength="10" size="10"
               placeholder="Numero celular"
               name="celular<?=$hashcode?>"
               value="<?php echo empty($info["celular"]) ? set_value('celular'.$hashcode) : $info["celular"]; ?>">
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Telefonos de recados</label>
        <input type="text" class="form-control" id="tel_recados<?=$hashcode?>" maxlength="10" size="10"
               placeholder="Telefonos de recados"
               name="tel_recados<?=$hashcode?>"
               value="<?php echo empty($info["tel_recados"]) ? set_value('tel_recados'.$hashcode) : $info["tel_recados"]; ?>">
    </div>
</div>
<?php }?>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Pais</label>
        <input type="text" class="form-control" id="pais<?=$hashcode?>" 
               placeholder="Telefonos de recados"
               name="pais<?=$hashcode?>"
               value="México" readonly="<?php echo empty($info["pais"]) ? set_value('pais'.$hashcode) : $info["pais"]; ?>">
    </div>
</div>

    <?php echo $estados;?>
</div>
    
<br><br><br><br>
