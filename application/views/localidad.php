<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Estado</label>
        <select class="form-control localidad" id="estado<?=$hashcode?>" name="estado<?=$hashcode?>">
            <?php foreach ($estado as $key => $value) { ?>
                <option value="<?php echo $value["cve_edo"]; ?>"> <?php echo $value["nom_edo"]; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Localidad</label>
        <input type="text" class="form-control capitalize" id="localidad<?=$hashcode?>" 
               placeholder="Localidad"
               name="localidad<?=$hashcode?>"
               value="<?php echo empty($info["localidad"]) ? set_value('localidad'.$hashcode) : $info["localidad"]; ?>">
    </div>
</div>
<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Delegacion / Municipio</label>
		<span class="btn btn-small pull-right" style="display: none" id="editDELMUN<?=$hashcode?>">
            <i class="fa fa-pencil fa-fw text-info"></i>
            <small class="text-info"> Editar</small>
        </span>
        <span class="pull-right" style="display: none" id="carga1<?=$hashcode?>">
            <i class="fa fa-spinner fa-spin text-info"></i>
            <small class="text-info"> Cargando ...</small>
        </span>
        <select class="form-control" id="delmun<?=$hashcode?>" name="delmun" readonly="">
            <option value="<?php echo isset($colonia) ? $colonia[0]['ID_Del_Mun'] : "0"?> " >
                <?php echo isset($colonia) ? $colonia[0]['Desc_Del_Mun'] : "--- Seleciona una opcion ---"?></option>
        </select>
    </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>C.P.</label>
        <span class="pull-right" style="display: none" id="error-cp<?=$hashcode?>">
            <i class="fa fa-times text-danger"></i>
            <small class="text-danger"> El C.P. es invalido</small>
        </span>
        <input type="text" class="form-control" id="cp<?=$hashcode?>" maxlength="5" size="5" readonly=""
               placeholder="C.P."
               name="cp<?=$hashcode?>"
               value="<?php echo empty($info["cp"]) ? set_value('cp'.$hashcode) : $info["cp"]; ?>">
    </div>
</div>

<div class="col-xs-12 col-sm-6 col-md-3">
    <div class="form-group">
        <label>Colonia</label>
		<span class="btn btn-small pull-right" style="display: none" id="editCOL<?=$hashcode?>">
            <i class="fa fa-pencil fa-fw text-info"></i>
            <small class="text-info"> Editar</small>
        </span>
        <span class="pull-right" style="display: none" id="carga2<?=$hashcode?>">
            <i class="fa fa-spinner fa-spin text-info"></i>
            <small class="text-info"> Cargando ...</small>
        </span>
        <select class="form-control" id="colonia<?=$hashcode?>" name="colonia<?=$hashcode?>" readonly="">
            <option value="<?php echo isset($colonia) ? $colonia[0]['ID'] : "0"?> " >
                <?php echo isset($colonia) ? $colonia[0]['Desc_Colonia'] : "--- Seleciona una opcion ---"?></option>
        </select>
    </div>
</div>
<input type="hidden" value="<?php echo empty($colonia[0]["ID_Cod_Pos"]) ? set_value('cp') : $colonia[0]["ID_Cod_Pos"]; ?>" id="ID_Cod_Pos">
<?php 
if(isset($colonia)){
foreach ($colonia as $key => $value) { ?>
<input type="hidden" value="<?php echo $value['ID']; ?>" id="ID<?=$hashcode?>">
<input type="hidden" value="<?php echo $value['ID_Del_Mun']; ?>" id="'ID_Del_Mun<?=$hashcode?>">
<input type="hidden" value="<?php echo $value['ID_Estado']; ?>" id="ID_Estado<?=$hashcode?>">
<input type="hidden" value="<?php echo $value['cve_pais']; ?>" id="cve_pais<?=$hashcode?>"> 
<?php } } ?>