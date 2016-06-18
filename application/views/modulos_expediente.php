<div id="content">
    <div class="container-fluid">
        <!--<div class="jumbotron bg-transparent text-center margin-none">-->
        <h3 class="text-center">Modulos del Expediente</h3>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <i class="fa fa-fw fa-user"></i> Datos Generales
                    </div>
                    <div class="panel-body">
                        <p class="text-justify">Puede modificar la información general 
                            del estudiante como son los datos DEL ESTUDIANTE, PADRES, DOCUMENTOS Y COMPROBANTES.</p>
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('expediente/consultar/' . $IDExp) ?>" class="btn btn-xs btn-stroke btn-info">
                                            Consultar</a></div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('expediente/modificar/' . $IDExp) ?>" class="btn btn-xs btn-stroke btn-success">
                                            Modificar</a></div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('expediente/eliminar/' . $IDExp) ?>" class="btn btn-xs btn-stroke btn-danger">
                                            Eliminar</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <i class="fa fa-fw fa-registered"></i> Reinscripción 
                    </div>
                    <div class="panel-body">
                        <p class="text-justify">En este modulo usted puede reinscribir al estudiante al siguiente curso escolar</p>
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('estudiante/reinscripcion') ?>" class="btn btn-xs btn-stroke btn-info">
                                            Reinscribir</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <i class="fa fa-fw fa-info"></i> Información Academica
                    </div>
                    <div class="panel-body">
                        <p class="text-justify">En este modulo se puede checar la información academica del estudiante. Como es su
                            KARDEX, AGENDA ESCOLAR, HORARIO, CALIFICACIONES.</p>
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('estudiante/kardex/' . $IDUsuario) ?>" class="btn btn-xs btn-stroke btn-info">
                                            Kardex</a></div>
                                    <div class="col-sm-8">
                                        <a href="<?php echo site_url('estudiante/agenda_escolar/' . $IDUsuario) ?>" class="btn btn-xs btn-stroke btn-success">
                                            Agenda Escolar</a></div>
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('curricular/horario_individual/' . $IDUsuario) ?>" class="btn btn-xs btn-stroke btn-primary">
                                            Horario</a></div>
                                    <div class="col-sm-8">
                                        <a href="<?php echo site_url('estudiante/calificaciones/' . $IDUsuario) ?>" class="btn btn-xs btn-stroke btn-warning">
                                            Calificaciones</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <i class="fa fa-fw fa-road"></i> Actividades
                    </div>
                    <div class="panel-body">
                        <p class="text-justify">En este moduló podra realizar la evaluación docente si el alumno no la a realizado
                            y observar el avance con las tareas que este a entregado.</p>
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('estudiante/tarea/0/' . $IDUsuario) ?>" class="btn btn-xs btn-stroke btn-info">
                                            Tareas</a></div>
                                    <div class="col-sm-8">
                                        <a href="<?php echo site_url('estudiante/evaluacion_docente/'. $IDUsuario) ?>" class="btn btn-xs btn-stroke btn-success">
                                            Evaluación Docente</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading panel-heading-white">
                        <i class="fa fa-fw fa-credit-card"></i> Cobranza
                    </div>
                    <div class="panel-body">
                        <p class="text-justify">Este modulo podra ver los detalles de la cuenta del estudiante. Y observar si tienen
                            adeudos al dia de hoy.</p>
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <a href="<?php echo site_url('cobranza/mi_cuenta/' . $IDExp) ?>" class="btn btn-xs btn-stroke btn-info">
                                            Cuenta</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
