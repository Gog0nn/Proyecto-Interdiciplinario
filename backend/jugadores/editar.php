<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";
include __DIR__ . "/../../db/lib/tutores.php";

$con     = Conex();
$jugador = new jugadores($con);
$tutores = new Tutores($con);

$id = (int)($_GET['id_jugador'] ?? 0);
if (!$id) {
    header('Location: index.php');
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $foto = null;
    // Verificamos si se subió una foto correctamente
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $datos = [
        'id_jugador'   => $id,
        'apellido'     => $_POST['apellido']     ?? '',
        'nombre'       => $_POST['nombre']       ?? '',
        'CI'           => $_POST['CI']           ?? '',
        'fecha_nac'    => $_POST['fecha_nac']    ?? '',
        'nro_contacto' => $_POST['nro_contacto'] ?? '',
        'genero'       => $_POST['genero']       ?? 0,
        'direccion'    => $_POST['direccion']    ?? '',
        'lugar_nac'    => $_POST['lugar_nac']    ?? '',
        'tipo_sangre'  => $_POST['tipo_sangre']  ?? '',
        'alergias'     => $_POST['alergias']     ?? '',
        'enfermedades_base' => $_POST['enfermedades_base'] ?? '',
        'foto'         => $foto
    ];

    $ok = $jugador->update($datos);

    // Procesar tutores asignados
    if ($ok && isset($_POST['tutores'])) {
        // Eliminar tutores previos
        $con->query("DELETE FROM jugador_tutor WHERE id_jugador = $id");

        // Asignar nuevos tutores
        foreach ($_POST['tutores'] as $tutor_id) {
            $tutor_id = (int)$tutor_id;
            $con->query("INSERT IGNORE INTO jugador_tutor (id_jugador, id_tutor) VALUES ($id, $tutor_id)");
        }
    }

    header('Location: index.php?ok=' . ($ok ? 2 : 0));
    exit;
}

// Cargar datos del jugador
$rs   = $jugador->getByID($id);
$fila = $rs ? $rs->fetch_assoc() : null;

if (!$fila) {
    header('Location: index.php');
    exit;
}

// Obtener tutores disponibles
$tutores_disponibles = $tutores->getall();

// Obtener tutores asignados al jugador actual
$tutores_asignados = [];
$result = $con->query("SELECT id_tutor FROM jugador_tutor WHERE id_jugador = $id");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $tutores_asignados[] = $row['id_tutor'];
    }
}
?>

<?php include_once '../../template/parciales/templateStart.php'; ?>

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="index.php" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
    <h3 class="mb-0">Editar jugador</h3>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="row g-3">

                <div class="col-6">
                    <label class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control"
                           value="<?= htmlspecialchars($fila['apellido']) ?>" required>
                </div>

                <div class="col-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                           value="<?= htmlspecialchars($fila['nombre']) ?>" required>
                </div>

                <div class="col-6">
                    <label class="form-label">CI</label>
                    <input type="text" name="CI" class="form-control"
                           value="<?= htmlspecialchars($fila['CI']) ?>" required>
                </div>

                <div class="col-6">
                    <label class="form-label">Fecha de nacimiento</label>
                    <input type="date" name="fecha_nac" class="form-control"
                           value="<?= $fila['fecha_nac'] ?>" required>
                </div>

                <div class="col-6">
                    <label class="form-label">Nro. contacto</label>
                    <input type="text" name="nro_contacto" class="form-control"
                           value="<?= htmlspecialchars($fila['nro_contacto']) ?>">
                </div>

                <div class="col-6">
                    <label class="form-label">Género</label>
                    <select name="genero" class="form-select" required>
                        <option value="1" <?= $fila['genero'] == 1 ? 'selected' : '' ?>>Masculino</option>
                        <option value="2" <?= $fila['genero'] == 2 ? 'selected' : '' ?>>Femenino</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control"
                           value="<?= htmlspecialchars($fila['direccion']) ?>">
                </div>

                <div class="col-6">
                    <label class="form-label">Lugar de nacimiento</label>
                    <input type="text" name="lugar_nac" class="form-control"
                           value="<?= htmlspecialchars($fila['lugar_nac']) ?>">
                </div>

                <div class="col-6">
                    <label class="form-label">Tipo de sangre</label>
                    <select name="tipo_sangre" class="form-select">
                        <option value="">— Sin especificar —</option>
                        <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $ts): ?>
                            <option value="<?= $ts ?>" <?= $fila['tipo_sangre'] === $ts ? 'selected' : '' ?>>
                                <?= $ts ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-6">
                    <label class="form-label">Alergias</label>
                    <input type="text" name="alergias" class="form-control"
                           value="<?= htmlspecialchars($fila['alergias'] ?? '') ?>">
                </div>

                <div class="col-6">
                    <label class="form-label">Enfermedades Base</label>
                    <input type="text" name="enfermedades_base" class="form-control"
                           value="<?= htmlspecialchars($fila['enfermedades_base'] ?? '') ?>">
                </div>

                <div class="col-12">
                    <label class="form-label">Foto del Jugador</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                </div>

                <div class="col-12">
                    <label class="form-label">Tutores Asignados <span class="text-danger">*</span></label>
                    <select name="tutores[]" class="form-select" multiple required>
                        <?php
                        if ($tutores_disponibles) {
                            while ($tutor = $tutores_disponibles->fetch_assoc()) {
                                $selected = in_array($tutor['id_tutor'], $tutores_asignados) ? 'selected' : '';
                                echo "<option value='{$tutor['id_tutor']}' $selected>";
                                echo htmlspecialchars($tutor['apellido'] . ", " . $tutor['nombre']);
                                echo "</option>";
                            }
                        }
                        ?>
                    </select>
                    <small class="form-text text-muted">Selecciona al menos un tutor. Usa Ctrl+Click para múltiples.</small>
                </div>

                <div class="col-12 d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-floppy"></i> Guardar cambios
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                </div>

            </div>
        </form>
    </div>
</div>

<?php include_once '../../template/parciales/templateEnd.php'; ?>
