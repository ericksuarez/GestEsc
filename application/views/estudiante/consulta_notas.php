<div id="content">
    <div class="container-fluid">
        <h4 class="page-section-heading">Consultar notas de las Materias</h4>
        <div class="row">
            <div class="col-md-12 panel">
                <label>Materias:</label>
                <select class="form-control" name="materiaNotas" id="materiaNotas">
                    <option value="0">Selecciona una opción</option>
                    <?php echo getCatOpcionesWhere("CatMateria", "materiaNotas", $materia, $where); ?>
                </select>
                <br>
            </div>

        </div>
    </div>
</div>