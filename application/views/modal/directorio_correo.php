<div class="modal slide-down fade" id="DIRECTORIO_CORREO">
    <div class="modal-dialog">
        <div class="v-cell">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Seleccionar contactos</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="0">Mis contactos</option>
                                <option value="padresfam">Padres de Familia</option>
                                <option value="estudiante">Estudiantes</option>
                                <option value="docente">Docentes</option>
                                <option value="empleado">Recursos Humanos</option>
                            </select>
                            <input  type="checkbox" value="todos" id="SeleccionarTodos" data-dismiss="modal">Seleccionar todos
                        </div>
                        <div class="col-md-6" id="verGrupos" style="display: none">
                            <select class="form-control" name="Egrupo" id="Egrupo">
                                <option value="0">Grado/Grupo</option>
                                <?php echo getCatOpciones("CatGrado","Egrupo") ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" value="" name="BpEmail" id="BpEmail">
                                <span class="input-group-btn">
                                    <button class="btn btn-info BEmail" >
                                        <i class="fa fa-search floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <b>&nbsp; Buscar</b>
                                        </span>
                                        <div class="clear"></div>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <!-- Progress table -->
                    <div class="table-responsive">
                        <table class="table v-middle" id="Pcontenido">
                        </table>
                    </div>
                    <!-- // Progress table -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="seleccionarEmails">Seleccionar</button>
                </div>
            </div>
        </div>
    </div>
</div>