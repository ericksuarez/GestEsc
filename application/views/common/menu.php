<div class="sidebar left sidebar-size-2 sidebar-offset-0 sidebar-skin-dark sidebar-visible-desktop sidebar-visible-mobile" id=sidebar-menu data-type=dropdown>
    <div class="split-vertical">
        <div class="sidebar-block">
            <h4 class="category"><?php echo $this->session->userdata('NomUsuario'); ?></h4>
        </div>
        <div class="split-vertical-body">
            <div class="split-vertical-cell">
                <div data-scrollable>
                    <ul class="sidebar-menu">
                        <li class="category">Expedientes</li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-graduation-cap"></i> <span>Estudiante</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('estudiante/alta'); ?>"><i class="fa fa-user-plus"></i> <span>Inscripción</span></a></li>
                                <li><a href="<?php echo site_url('estudiante/reinscripcion'); ?>"><i class="fa fa-user-plus"></i> <span>Reinscripción</span></a></li>
                                <li><a href="<?php echo site_url('estudiante/lista'); ?>"><i class="fa fa-list"></i> <span>Lista</span></a></li>
                            </ul>
                        </li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-user"></i> <span>Docente</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('docente/alta'); ?>"><i class="fa fa-user-plus"></i> <span>Agregar</span></a></li>
                                <li><a href="<?php echo site_url('docente/carga_materia'); ?>"><i class="fa fa-plus-circle"></i> <span>Carga Materias</span></a></li>
                                <li><a href="<?php echo site_url('docente/lista'); ?>"><i class="fa fa-list"></i> <span>Lista</span></a></li>
                            </ul>
                        </li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-map-signs"></i> <span>Mapa Curricular</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('curricular/grupos'); ?>"><i class="fa fa-object-group"></i> <span>Asignar Grupos</span></a></li>
                                <li><a href="<?php echo site_url('curricular/horario_grupal'); ?>"><i class="fa fa-calendar"></i> <span>Horario Grupal</span></a></li>
                            </ul>
                        </li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-user-secret"></i> <span>Empleado</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('empleado/alta'); ?>"><i class="fa fa-user-plus"></i> <span>Agregar</span></a></li>
                                <li><a href="<?php echo site_url('empleado/lista'); ?>"><i class="fa fa-list"></i> <span>Lista</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="sidebar-menu">
                        <li class="category">Cobranza</li>
                        <li><a href="<?php echo site_url('cobranza/cuentas'); ?>"><i class="fa fa-dollar"></i> <span>Cuentas</span></a></li>
                        <li><a href="<?php echo site_url('cobranza/reportes'); ?>"><i class="fa fa-print"></i> <span>Reportes</span></a></li>
                    </ul>
                    <!-- MENU PARA LOS ALUMNOS -->
                    <ul class="sidebar-menu">
                        <li class="category">Estudiante</li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-graduation-cap"></i> <span>Académicos</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('estudiante/kardex'); ?>"><i class="fa fa-outdent"></i> <span>Kárdex</span></a></li>
                                <li><a href="<?php echo site_url('estudiante/agenda_escolar'); ?>"><i class="fa fa-calendar"></i> <span>Agenda Escolar</span></a></li>
                            </ul>
                        </li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-edit"></i> <span>Inscripción</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('curricular/horario_individual'); ?>"><i class="fa fa-clock-o"></i> <span>Horario</span></a></li>
                                <li><a href="<?php echo site_url('estudiante/calificaciones'); ?>"><i class="fa fa-list-ol"></i> <span>Califaciones</span></a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo site_url('estudiante/evaluacion_docente'); ?>"><i class="fa fa-pencil"></i> <span>Evaluación Docente</span></a></li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-search"></i> <span>Consultar</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('estudiante/tarea'); ?>"><i class="fa fa-book"></i> <span>Tareas</span></a></li>
                                <li><a href="<?php echo site_url('mantenimiento/notas'); ?>"><i class="fa fa-bookmark"></i> <span>Notas</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- MENU PARA LOS PROFESORES -->
                    <ul class="sidebar-menu">
                        <li class="category">Docente</li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-graduation-cap"></i> <span>Académico</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('mantenimiento/tareas'); ?>"><i class="fa fa-book"></i> <span>Tareas</span></a></li>
                                <li><a href="<?php echo site_url('mantenimiento/notas'); ?>"><i class="fa fa-bookmark"></i> <span>Notas</span></a></li>
                                <li><a href="<?php echo site_url('mantenimiento/evaluacion_continua'); ?>"><i class="fa fa-pencil"></i> <span>Calificar</span></a></li>
                            </ul>
                        <li><a href="<?php echo site_url('curricular/horario_individual'); ?>"><i class="fa fa-calendar"></i> <span>Horario</span></a></li>
                        <li><a href="<?php echo site_url('docente/citatorio/0'); ?>"><i class="fa fa-send"></i> <span>Enviar Citatorio</span></a></li>
                        <li><a href="<?php echo site_url('docente/mi_evaluacion'); ?>"><i class="fa fa-search"></i> <span>Consulta Evaluación</span></a></li>
                        </li>
                    </ul>
                    <!-- MENU PARA LOS PADRES -->
                    <ul class="sidebar-menu">
                        <li class="category">Padres de Familia</li>
                        <li><a href="<?php echo site_url('cobranza/mi_cuenta/'.$this->session->userdata('IDExp')); ?>"><i class="fa fa-bookmark"></i> <span>Mi Cuenta</span></a></li>
                    </ul>
                    <!-- MENU PARA LOS HIJOS -->
                    <?php $hijos = getHijos($this->session->userdata('IdUsuario'));
                    foreach($hijos as $k => $val){?>
                    <ul class="sidebar-menu">
                        <li class="category"><?php echo $val['NomEstudiante']?></li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-graduation-cap"></i> <span>Académico</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('estudiante/kardex/'.$val['Usuario_IdUsuario']); ?>"><i class="fa fa-outdent"></i> <span>Kárdex</span></a></li>
                                <li><a href="<?php echo site_url('estudiante/agenda_escolar'); ?>"><i class="fa fa-calendar"></i> <span>Agenda Escolar</span></a></li>
                            </ul>
                        </li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-edit"></i> <span>Inscripción</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('curricular/horario_individual/'.$val['Usuario_IdUsuario']); ?>"><i class="fa fa-clock-o"></i> <span>Horario</span></a></li>
                                <li><a href="<?php echo site_url('estudiante/calificaciones/'.$val['Usuario_IdUsuario']); ?>"><i class="fa fa-list-ol"></i> <span>Califaciones</span></a></li>
                            </ul>
                        </li>
                        <li class="hasSubmenu">
                            <a href="#submenu"><i class="fa fa-search"></i> <span>Consultar</span></a>
                            <ul id="submenu">
                                <li><a href="<?php echo site_url('estudiante/tarea/0/'.$val['Usuario_IdUsuario']); ?>"><i class="fa fa-book"></i> <span>Tareas</span></a></li>
                                <li><a href="<?php echo site_url('mantenimiento/notas'); ?>"><i class="fa fa-bookmark"></i> <span>Notas</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php }?>
                    <!-- CONFIGURACION DEL SISTEMA -->    
                    <ul class="sidebar-menu">
                        <li class="category"><i class="fa fa-cogs"></i>Configuración</li>
                        <li><a href="<?php echo site_url('mantenimiento/periodo'); ?>"><i class="fa fa-calendar"></i> <span>Periodo</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/materia'); ?>"><i class="fa fa-book"></i> <span>Materia</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/servicio'); ?>"><i class="fa fa-server"></i> <span>Servicio</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/plantilla_correo'); ?>"><i class="fa fa-file"></i> <span>Plantiila Correo</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/recargo'); ?>"><i class="fa fa-dollar"></i> <span>Recargo</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/grado_escolar'); ?>"><i class="fa fa-sort-asc"></i> <span>Grados Escolares</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/grado'); ?>"><i class="fa fa-sort-alpha-asc"></i> <span>Grado y Grupo</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/documento_usuario'); ?>"><i class="fa fa-user-times"></i> <span>Docs. por Usuario</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/tipodocumento'); ?>"><i class="fa fa-file-archive-o"></i> <span>Tipo Documento</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/pais'); ?>"><i class="fa fa-flag"></i> <span>Pais</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/estado'); ?>"><i class="fa fa-flag-o"></i> <span>Estado</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/delegacion'); ?>"><i class="fa fa-tag"></i> <span>Delegación</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/colonia'); ?>"><i class="fa fa-tags"></i> <span>Colonia</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/unidades'); ?>"><i class="fa fa-calculator"></i> <span>Unidades</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/turno'); ?>"><i class="fa fa-unlock"></i> <span>Turno</span></a></li>
                        <li><a href="<?php echo site_url('mantenimiento/tipousuario'); ?>"><i class="fa fa-group"></i> <span>Tipo Usuario</span></a></li>
                    </ul>
                    <!-- MENU GENERALES -->
                    <li><a href="<?php echo site_url('mantenimiento/periodo'); ?>" target="_new"><i class="fa fa-calendar"></i> <span>Calendario Escolar</span></a></li>
                    <li><a href="<?php echo site_url('mantenimiento/periodo'); ?>" target="_new"><i class="fa fa-book"></i> <span>Reglamento</span></a></li>
                </div>
            </div>
        </div>
        <div class="sidebar-block">
            <p><small><i></i>Sistema Administrado por ....</small></p>
        </div>
    </div>
</div>