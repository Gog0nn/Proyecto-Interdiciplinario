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
        <label for="jugador_id" class="form-label">ID del Jugador</label>
        <input type="number" id="jugador_id" name="jugador_id" min="1"
            class="form-control" value="<?php echo $fila['jugador_id'] ?? ''; ?>" required>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar Tutor</button>
        <a href="index.php" class="btn btn-outline-secondary">Volver</a>
    </div>
</form>