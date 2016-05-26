<div class="st-pusher" id="content">
    <div class="st-content">
        <div class="st-content-inner">
            <div class="container">
                <div id="filter">
                    <form class="form-inline">
                        <label>Buscar:</label>
                        <div id="users-filter-trigger">
                            <label>Grupo:</label>
                            <div class="select-friends">
                                <select name="users-filter-friends" class="selectpicker" data-style="btn-primary" data-live-search="true">
                                    <option value="0">Select Friend</option>
                                    <option value="1">Mary D.</option>
                                    <option value="2">Michelle S.</option>
                                    <option value="3">Adrian Demian</option>
                                </select>
                            </div>
                            <div class="search-name hidden">
                                <input type="text" class="form-control" name="user-first" placeholder="First Last Name" id="name" />
                                <a href="#" class="btn btn-default hidden" id="user-search-name"><i class="fa fa-search"></i> Search</a>
                            </div>
                        </div>
                        <div id="users-filter-trigger">
                            <label>Materia:</label>
                            <div class="select-friends">
                                <select name="users-filter-friends" class="selectpicker" data-style="btn-primary" data-live-search="true">
                                    <option value="0">Select Friend</option>
                                    <option value="1">Mary D.</option>
                                    <option value="2">Michelle S.</option>
                                    <option value="3">Adrian Demian</option>
                                </select>
                            </div>
                            <div class="search-name hidden">
                                <input type="text" class="form-control" name="user-first" placeholder="First Last Name" id="name" />
                                <a href="#" class="btn btn-default hidden" id="user-search-name"><i class="fa fa-search"></i> Search</a>
                            </div>
                        </div>

                    </form>
                </div>
				<label>Descripción de la tarea</label>
				<div class="pull-right">
                        <a class="btn btn-primary" href='<?php echo site_url(getURIuser() . "/lista"); ?>'> 
                            <i class="fa fa-send floatL t3"></i>
                            <span class="hidden-xs floatL l5">
                                <b>&nbsp; Enviar</b>
                            </span>
                            <div class="clear"></div>
                        </a>
                        </div>
<div id="users-filter-trigger">
                            <label>Agregar un archivo:</label>
                        <input type="file" id="acta_nacimiento" name="userfile[]">
                        <p class="help-block">Seleccione un archivo .PDF |.jpge |.png .</p>
						
                    </div>
					
					
				<div class="summernote"></div>
            </div>
        </div>
    </div>
</div>
