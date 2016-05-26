    <div class="row"> 
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control capitalize" id="nombre" 
                       placeholder="Nombre"
                       name="nombre"
                       value="<?php echo empty($info["nombre"]) ? set_value('nombre') : $info["nombre"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Apellido Paterno</label>
                <input type="text" class="form-control capitalize" id="apaterno" 
                       placeholder="Apellido Paterno"
                       name="apaterno"
                       value="<?php echo empty($info["apaterno"]) ? set_value('apaterno') : $info["apaterno"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Apellido Materno</label>
                <input type="text" class="form-control capitalize" id="amaterno" 
                       placeholder="Apellido Materno"
                       name="amaterno"
                       value="<?php echo empty($info["amaterno"]) ? set_value('amaterno') : $info["amaterno"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Fecha de nacimiento</label><br>
                <input type="hidden" class="form-control capitalize" id="fecha_nacimiento" 
                       name="fecha_nacimiento"
                       value="<?php echo empty($info["fecha_nacimiento"]) ? set_value('fecha_nacimiento') : $info["fecha_nacimiento"]; ?>">
                <div class="row">
                <select class="form-control col-xs-3 col-sm-3 col-md-3" id="anio" name="anio" style="width: 33%">
                    <?php $anio = getAnios();
                    foreach ($anio as $key => $value) { ?>
                        <option value="<?php echo $value; ?>"> <?php echo $value; ?></option>
                    <?php } ?>
                </select>
                <select class="form-control col-xs-3 col-sm-3 col-md-3" id="mes" name="mes" style="width: 36%">
                    <?php $mes = getMeses();
                    foreach ($mes as $key => $value) { ?>
                        <option value="<?php echo $key; ?>"> <?php echo $value; ?></option>
                    <?php } ?>
                </select>
                <select class="form-control col-xs-3 col-sm-3 col-md-3" id="dia" name="dias" style="width: 30%">
                    <?php $dias = getDias();
                    foreach ($dias as $key => $value) { ?>
                        <option value="<?php echo $value; ?>"> <?php echo $value; ?></option>
                    <?php } ?>
                </select>
            </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Folio del acta</label>
                <input type="text" class="form-control capitalize" id="folio_acta_nac" 
                       placeholder="Folio acta de nacimiento"
                       name="folio_acta_nac"
                       value="<?php echo empty($info["folio_acta_nac"]) ? set_value('folio_acta_nac') : $info["folio_acta_nac"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Lugar nacimiento</label>
                <input type="text" class="form-control capitalize" id="lugar_nacimineto" 
                       placeholder="Lugar de nacimiento"
                       name="lugar_nacimineto"
                       value="<?php echo empty($info["lugar_nacimineto"]) ? set_value('lugar_nacimineto') : $info["lugar_nacimineto"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Género</label><br>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default <?php echo (isset($info["genero"]) && $info["genero"]=='M') ? "active" : ""; ?>" >
                        <input type="radio" name="genero" id="option2" autocomplete="off" value="M"  <?php echo (isset($info["genero"]) && $info["genero"]=='M') ? "checked" : ""; ?>
                            <?php echo set_radio('genero', 'M')?>> M
                    </label>
                    <label class="btn btn-default <?php echo (isset($info["genero"]) && $info["genero"]=='F') ? "active" : ""; ?>" >
                        <input type="radio" name="genero" id="option3" autocomplete="off" value="F"  <?php echo (isset($info["genero"]) &&  $info["genero"]=='F') ? "checked" : ""; ?>
                           <?php echo  set_radio('genero', 'M')?>> F
                    </label>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group curp">
                <label>CURP</label>
                <input type="text" class="form-control uppercase" id="curp"
                       placeholder="CURP"
                       name="curp"
                       value="<?php echo empty($info["curp"]) ? set_value('curp') : $info["curp"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Matricula</label>
                <input type="text" class="form-control uppercase" id="matricula" readonly="" 
                       placeholder="Matricula"
                       name="matricula"
                       value="<?php echo empty($info["matricula"]) ? set_value('matricula') : $info["matricula"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Discapacidad</label>
                <input type="text" class="form-control capitalize" id="discapacidad" 
                       placeholder="discapacidad"
                       name="discapacidad"
                       value="<?php echo empty($info["discapacidad"]) ? set_value('discapacidad') : $info["discapacidad"]; ?>">
            </div>
        </div>
        <?php if (getURIuser() != "alumno") { ?>    
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="form-group">
                    <label>Identificacion</label>
                    <input type="text" class="form-control uppercase" id="identificacion" 
                           placeholder="identificacion"
                           name="identificacion"
                           value="<?php echo empty($info["identificacion"]) ? set_value('identificacion') : $info["identificacion"]; ?>">
                </div>
            </div>
        <?php } ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control lowercase" id="email" 
                       placeholder="Email"
                       name="email"
                       value="<?php echo empty($info["email"]) ? set_value('email') : $info["email"]; ?>">
            </div>
        </div>
        <?php if (getURIuser() == "profesor") { ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Licenciatura</label>
                <input type="text" class="form-control capitalize" id="licenciatura" 
                       placeholder="Licenciatura"
                       name="licenciatura"
                       value="<?php echo empty($info["licenciatura"]) ? set_value('licenciatura') : $info["licenciatura"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Cedula</label>
                <input type="text" class="form-control" id="cedula" 
                       placeholder="cedula"
                       name="cedula"
                       value="<?php echo empty($info["cedula"]) ? set_value('cedula') : $info["cedula"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Escuela procedencia</label>
                <input type="text" class="form-control capitalize" id="escuela_procedencia" 
                       placeholder="escuela_procedencia"
                       name="escuela_procedencia"
                       value="<?php echo empty($info["escuela_procedencia"]) ? set_value('escuela_procedencia') : $info["escuela_procedencia"]; ?>">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="form-group">
                <label>Certificaciones</label>
                <input type="text" class="form-control capitalize" id="certificaciones" 
                       placeholder="Certificaciones"  
                       name="certificaciones"
                       value="<?php echo empty($info["certificaciones"]) ? set_value('certificaciones') : $info["certificaciones"]; ?>">
            </div>
        </div>
        <?php } ?>
    </div>


<br><br><br><br>
