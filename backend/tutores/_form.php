<h3 class="h4 mb-3"><?php echo $titulo_form; ?></h3>
<?php if (!empty($errores)) { ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $error) { ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 1) {
    echo "<span style='color: red;'>Error al insertar datos. Por favor, revise los datos ingresados.</span><br><br>";
} ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 2) {
    echo "<span style='color: red;'>Error al actualizar los datos. Por favor, revise los datos ingresados.</span><br><br>";
} ?>

<?php
require_once __DIR__ . "/../../db/lib/jugadores.php";
$con = Conex();
$jugadoresObj = new jugadores($con);
$jugadoresRs = $jugadoresObj->getALL();

// Obtener lista de IDs asignados previamente
$ids_asignados = [];
if (!empty($fila['jugador_ids'])) {
    if (is_array($fila['jugador_ids'])) {
        $ids_asignados = array_map('intval', $fila['jugador_ids']);
    } else {
        $ids_asignados = array_map('intval', explode(',', $fila['jugador_ids']));
    }
}
?>

<div class="d-flex justify-content-center w-100 my-4">
    <div class="card shadow-sm mx-auto" style="max-width: 800px; width: 100%;">
        <div class="card-body">
            <form action="<?php echo $target; ?>" method="post" class="needs-validation">
                <input type="hidden" name="id_tutor" value="<?php echo $fila['id_tutor'] ?? ''; ?>">
                
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['nombre'] ?? ''); ?>" required
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El nombre solo debe contener letras y espacios">
                    </div>

                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['apellido'] ?? ''); ?>" required
                            pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El apellido solo debe contener letras y espacios">
                    </div>

                    <!-- Validación: impide letras y caracteres especiales en contacto -->
                    <div class="col-12">
                        <label for="contacto" class="form-label">Contacto (Teléfono)</label>
                        <input type="text" id="contacto" name="contacto" maxlength="100"
 HEAD
                            class="form-control" value="<?php echo htmlspecialchars($fila['contacto'] ?? ''); ?>" required
                            pattern="[0-9]+" title="El número de teléfono solo debe contener números">
                    </div>

                    <!-- Selector de Jugadores para asignar al Tutor -->
                    <div class="col-12">
                        <label for="jugador_ids" class="form-label">Seleccionar Jugador(es) a asignar</label>
                        <select name="jugador_ids[]" id="jugador_ids" class="form-select" multiple size="5">
                            <?php if ($jugadoresRs && $jugadoresRs->num_rows > 0): ?>
                                <?php while ($j = $jugadoresRs->fetch_assoc()): ?>
                                    <option value="<?= $j['id_jugador'] ?>" <?= in_array((int)$j['id_jugador'], $ids_asignados, true) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($j['apellido'] . ', ' . $j['nombre'] . ' (CI: ' . $j['CI'] . ')') ?>
                                    </option>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <option value="" disabled>No hay jugadores registrados</option>
                            <?php endif; ?>
                        </select>
                        <small class="text-muted">Mantenga presionada la tecla <kbd>Ctrl</kbd> (o <kbd>Cmd</kbd> en Mac) para seleccionar varios jugadores.</small>
                    </div>

                    <div class="col-12 d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy"></i> Guardar Tutor
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">Volver</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>