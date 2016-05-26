<table class="table table-bordered table-hover table-condensed v-middle" cellspacing="0">
    <thead>
        <tr>
            <th>Hora</th>
            <?php foreach (DiasSemana() as $key => $dia) { ?>
                <th><?php echo $dia ?></th>
            <?php } ?>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Hora</th>
            <?php foreach (DiasSemana() as $key => $dia) { ?>
                <th><?php echo $dia ?></th>
            <?php } ?>
        </tr>
    </tfoot>
    <tbody>
        <?php
        foreach ($horas as $key => $value) {
            if ($Receso == $value["Hora"]) {
                ?>
                <tr class="alerta-warning">
                    <td><?php echo $value["Hora"]; ?></td>
                    <?php foreach (DiasSemana() as $key => $dia) { ?>
                        <th>Receso</th>
                    <?php } ?>
                </tr>
            <?php } else { ?>
                <tr>
                    <td><p class="text-nowrap"><?php echo $value["Hora"]; ?></p></td>
                    <?php foreach (DiasSemana() as $k => $dia) { ?>
                        <td>
                            <div class="timeline-block text-center" id="<?php echo $dia . $key ?>_Doc">
                                <?php
                                foreach ($horarios as $horario) {
                                    if ($horario['Dia'] == $dia && $value["Hora"] == $horario['Hora']) {
                                        $HrsMateria = $horario['IDMateria'];
                                        ?>
                                        <?php
                                        $splitImagenes = explode(',', $horario['Expedientes']);
                                        foreach ($splitImagenes as $key => $val) {
                                            ?>
                                            <img src="<?php echo getNombreDocumentoExp($val, 4); ?>" width="50" alt="Docente">
                                        <?php } ?>
                                        <p class="text"><?php echo $horario['Docentes'] ?></p>
                                        <?php
                                        break;
                                    } else {
                                        $HrsMateria = 0;
                                    }
                                }
                                ?>
                            </div>
                            <select class="horario form-control" 
                                    data-hrs="<?php echo $value["Hora"] ?>" 
                                    data-dia="<?php echo $dia ?>" 
                                    name="materia<?php echo $key ?>" 
                                    id="<?php echo $dia . $key ?>">
                                <option value="0">-Materia-</option>
            <?php echo getCatOpcionesWhere("CatMateria", "materia" . $key, $HrsMateria, $where_materias) ?>
                            </select>
                        </td>
                <?php } ?>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>