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
$jugadoresObj = new jugadores($db);
$jugadoresRs = $jugadoresObj->getALL();
?>

<form action="<?php echo $target; ?>" method="post" class="needs-validation" novalidate>
    <input type="hidden" name="id_tutor" value="<?php echo $fila['id_tutor'] ?? ''; ?>">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" id="nombre" name="nombre" maxlength="100"
            class="form-control" value="<?php echo $fila['nombre'] ?? ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="text" id="apellido" name="apellido" maxlength="100"
            class="form-control" value="<?php echo $fila['apellido'] ?? ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="contacto" class="form-label">Contacto</label>
        <input type="text" id="contacto" name="contacto" maxlength="100"
            class="form-control" value="<?php echo $fila['contacto'] ?? ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="jugador_ids" class="form-label">Asignar Jugador(es) <span class="text-danger">*</span></label>
        <select id="jugador_ids" name="jugador_ids[]" class="form-select" multiple required>
            <?php
            if ($jugadoresRs) {
                $jugador_ids = isset($fila['jugador_ids']) && $fila['jugador_ids'] ?
                    explode(',', $fila['jugador_ids']) : [];
                while ($jugador = $jugadoresRs->fetch_assoc()) {
                    $selected = in_array($jugador['id_jugador'], $jugador_ids) ? 'selected' : '';
                    echo "<option value='{$jugador['id_jugador']}' $selected>";
                    echo htmlspecialchars($jugador['apellido'] . ", " . $jugador['nombre']);
                    echo "</option>";
                }
            }
            ?>
        </select>
        <small class="form-text text-muted">Selecciona al menos un jugador. Usa Ctrl+Click para múltiples.</small>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar Tutor</button>
        <a href="index.php" class="btn btn-outline-secondary">Volver</a>
    </div>
</form>