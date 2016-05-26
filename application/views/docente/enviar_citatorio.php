<div class="st-pusher">
    <!-- this is the wrapper for the content -->
    <div class="st-content">
        <!-- extra div for emulating position:fixed of the menu -->
        <div class="st-content-inner padding-top-none" id="content" style="padding: 20px;">
		<h4 class="page-section-heading">Citatorio</h4>
		
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
                                <input type="text" class="form-control" name="user-first" placeholder="Nombre del alumno..." id="name" />
                                <a href="#" class="btn btn-default hidden" id="user-search-name"><i class="fa fa-search"></i> Buscar</a>
                            </div>
                        </div>
						<div class="panel panel-default share" id="users-filter-trigger">
                  <div class="input-group">
                    <div class="input-group-btn">
                      <a class="btn btn-primary" href="#">
                        <i class="fa fa-search"></i> Buscar
                      </a>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control share-text" placeholder="Nombre del alumno...">
                  </div>
                    </form>
                </div>
</div>


                <div class="media messages-container media-clearfix-xs-min media-grid">
                    <div class="media-left">
                        <div class="messages-list">
                            <div class="panel panel-default">
                                <ul class="list-group">
                                    <li class="list-group-item active">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="<?php echo base_url(); ?>images/woman-6.jpg" width="50" alt="" class="media-object" />
                                                </div>
                                                <div class="media-body">
                                                    <div class="message">Nombre del alumno</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="#">
                                            <div class="media">
                                                <div class="media-left">
                                                    <img src="<?php echo base_url(); ?>images/woman-6.jpg" height="50" alt="" class="media-object" />
                                                </div>
                                                <div class="media-body">
                                                    <div class="message">Nombre del alumno</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="media-body">
                        <div class="media">
                            <div class="media-body message">
							<div class="panel panel-default share">
											  <div class="input-group">
												<div class="input-group-btn">
												  <a class="btn btn-primary" href="#">
													<i class="fa fa-send"></i>&nbsp;&nbsp;  Enviar a:
												  </a>
												</div>
												<!-- /btn-group -->
												<input type="text" class="form-control share-text" placeholder="Correo de los padres...">
											  </div>
											</div>
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                        <div class="summernote"></div>

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
</div>
</div>
<br><br>