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

<form action="<?php echo $target; ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <input type="hidden" name="id_entrenador" value="<?php echo $fila['id_entrenador'] ?? ''; ?>">
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
        <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
        <input type="date" id="fecha_nac" name="fecha_nac" maxlength="100"
            class="form-control" value="<?php echo $fila['fecha_nac'] ?? ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="nro_contacto" class="form-label">Contacto</label>
        <input type="number" id="nro_contacto" name="nro_contacto" maxlength="100"
            class="form-control" value="<?php echo $fila['nro_contacto'] ?? ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="CI" class="form-label">Cedula de Identidad</label>
        <input type="number" id="CI" name="CI" maxlength="100"
            class="form-control" value="<?php echo $fila['CI'] ?? ''; ?>" required>
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" id="foto" name="foto" accept="image/*" class="form-control">
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Guardar Tutor</button>
        <a href="index.php" class="btn btn-outline-secondary">Volver</a>
    </div>
</form>