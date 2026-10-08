<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Actividades</title>
</head>
<body>
<?php
include_once __DIR__ . '/validar_actividad.php';
[$fecha_min, $fecha_max] = rangoFechaActividad();

if (!isset($target)) {
    $target = "guardar.php";
}
?>

<div class="d-flex justify-content-center w-100 my-4">
    <div class="card shadow-sm mx-auto" style="max-width: 800px; width: 100%;">
        <div class="card-body">
            
            <h3 class="h4 mb-3"><?php echo htmlspecialchars($titulo_form ?? 'Formulario de Actividades'); ?></h3>

            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                <div class="alert alert-danger" role="alert">
                    Error al insertar datos de la actividad.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] == 2): ?>
                <div class="alert alert-danger" role="alert">
                    Error al actualizar la actividad.
                </div>
            <?php endif; ?>

            <form action="<?php echo $target; ?>" method="post" class="needs-validation" novalidate>
                <!-- Campo oculto para id_actividad -->
                <input type="hidden" name="id_actividad" value="<?php echo htmlspecialchars($fila["id_actividad"] ?? ''); ?>">
                
                <div class="row g-3">

                    <div class="col-12">
                        <label for="nombre" class="form-label">Nombre de la Actividad</label>
                        <input type="text" id="nombre" name="nombre" maxlength="100" required class="form-control" 
                            value="<?php echo htmlspecialchars($fila["nombre"] ?? ''); ?>" placeholder="Ej: Práctica Táctica">
                    </div>

                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" maxlength="100" required class="form-control" 
                            value="<?php echo htmlspecialchars($fila["descripcion"] ?? ''); ?>" placeholder="Ej: Trabajo en bloque defensivo">
                    </div>

                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" id="fecha" name="fecha" required class="form-control" 
                            value="<?= htmlspecialchars($fila['fecha'] ?? '') ?>"
                            min="<?= $fecha_min ?>" max="<?= $fecha_max ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" id="hora" name="hora" required class="form-control"
                            value="<?= htmlspecialchars($fila['hora'] ?? '') ?>">
                    </div>

                    <div class="col-12">
                        <label for="lugar" class="form-label">Lugar</label>
                        <input type="text" id="lugar" name="lugar" maxlength="191" required class="form-control"
                            value="<?= htmlspecialchars($fila['lugar'] ?? '') ?>" placeholder="Ej: Cancha A o Estadio Central">
                    </div>

                    <div class="col-md-4">
                        <label for="id_genero" class="form-label">Género</label>
                        <select id="id_genero" name="id_genero" required class="form-select">
                            <option value="1" <?php echo (($fila["id_genero"] ?? 0) == 1) ? "selected" : ""; ?>>Masculino</option>
                            <option value="2" <?php echo (($fila["id_genero"] ?? 0) == 2) ? "selected" : ""; ?>>Femenino</option>
                            <option value="3" <?php echo (($fila["id_genero"] ?? 0) == 3) ? "selected" : ""; ?>>Mixto</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select id="id_categoria" name="id_categoria" required class="form-select">
                            <option value="1" <?php echo (($fila["id_categoria"] ?? 0) == 1) ? "selected" : ""; ?>>Sub-10</option>
                            <option value="2" <?php echo (($fila["id_categoria"] ?? 0) == 2) ? "selected" : ""; ?>>Sub-13</option>
                            <option value="3" <?php echo (($fila["id_categoria"] ?? 0) == 3) ? "selected" : ""; ?>>Sub-15</option>
                            <option value="4" <?php echo (($fila["id_categoria"] ?? 0) == 4) ? "selected" : ""; ?>>Sub-17</option>
                            <option value="5" <?php echo (($fila["id_categoria"] ?? 0) == 5) ? "selected" : ""; ?>>Sub-20</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="id_tipo" class="form-label">Tipo</label>
                        <select id="id_tipo" name="id_tipo" required class="form-select">
                            <option value="1" <?php echo (($fila["id_tipo"] ?? 0) == 1) ? "selected" : ""; ?>>Práctica</option>
                            <option value="2" <?php echo (($fila["id_tipo"] ?? 0) == 2) ? "selected" : ""; ?>>Partido</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy"></i> Guardar Actividad
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">Volver al listado</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>