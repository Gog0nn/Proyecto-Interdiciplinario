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
?>

<div class="d-flex justify-content-center w-100 my-4">
    <div class="card shadow-sm mx-auto" style="max-width: 800px; width: 100%;">
        <div class="card-body">
            <form action="<?php echo $target; ?>" method="post" class="needs-validation" novalidate>
                <input type="hidden" name="id_tutor" value="<?php echo $fila['id_tutor'] ?? ''; ?>">
                
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['nombre'] ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['apellido'] ?? ''); ?>" required>
                    </div>

                    <div class="col-12">
                        <label for="contacto" class="form-label">Contacto</label>
                        <input type="text" id="contacto" name="contacto" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['contacto'] ?? ''); ?>" placeholder="981123456" required>
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