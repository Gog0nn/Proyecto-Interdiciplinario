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

// Cálculo de límites para la fecha de nacimiento (entre 5 y 80 años)
$hace80Anos = date('Y-m-d', strtotime('-80 years'));
$hace5Anos  = date('Y-m-d', strtotime('-5 years'));

$errores = [];

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Validaciones del servidor mediante el archivo validar_jugador.php
    include_once __DIR__ . "/validar_jugador.php";
    $errores = validarJugador($_POST);

    // Validación de foto si fue adjuntada
    $hasFoto = isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE;
    if ($hasFoto) {
        $fotoError = $_FILES['foto']['error'];
        $fotoSize  = $_FILES['foto']['size'];
        $tmpName   = $_FILES['foto']['tmp_name'];

        if ($fotoError !== UPLOAD_ERR_OK || $fotoSize > 2 * 1024 * 1024 || empty($tmpName) || @getimagesize($tmpName) === false) {
            $errores[] = "La foto debe ser una imagen válida de hasta 2 MB.";
        }
    }

    // 2. Si no hay errores de validación, procedemos a guardar
    if (empty($errores)) {
        $datos = [
            'id_jugador'        => $id,
            'apellido'          => $_POST['apellido']          ?? '',
            'nombre'            => $_POST['nombre']            ?? '',
            'CI'                => $_POST['CI']                ?? '',
            'fecha_nac'         => $_POST['fecha_nac']         ?? '',
            'nro_contacto'      => $_POST['nro_contacto']      ?? '',
            'genero'            => $_POST['genero']            ?? 0,
            'direccion'         => $_POST['direccion']         ?? '',
            'lugar_nac'         => $_POST['lugar_nac']         ?? '',
            'tipo_sangre'       => $_POST['tipo_sangre']       ?? '',
            'alergias'          => $_POST['alergias']          ?? '',
            'enfermedades_base' => $_POST['enfermedades_base'] ?? '',
        ];

        if ($hasFoto && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $datos['foto'] = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $relaciones = json_decode($_POST['tutor_relaciones'] ?? '[]', true);
        $ok = false;

        try {
            $con->begin_transaction();
            $ok = $jugador->update($datos);
            if (!$ok) {
                throw new RuntimeException('No se pudo actualizar el jugador.');
            }
            $tutores->guardarRelaciones($id, $relaciones);
            $con->commit();
            
            header('Location: index.php?ok=' . ($ok ? 2 : 0));
            exit;
        } catch (Throwable $error) {
            $con->rollback();
            $errores[] = "Error al guardar los cambios: " . $error->getMessage();
        }
    }
}

// Cargar datos del jugador (o recuperar los enviados si hubo un error)
$rs   = $jugador->getByID($id);
$fila = $rs ? $rs->fetch_assoc() : null;

if (!$fila) {
    header('Location: index.php');
    exit;
}

// Si hubo un error en la validación POST, conservamos los datos que intentó enviar el usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fila = array_merge($fila, $_POST);
}

// Obtener relaciones completas para prellenar el módulo de tutores.
$relaciones_tutores = [];
$result = $tutores->obtenerRelacionesPorJugador($id);
while ($row = $result->fetch_assoc()) {
    $relaciones_tutores[] = $row;
}
?>

<?php include_once '../../template/parciales/templateStart.php'; ?>

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="index.php" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
    <h3 class="mb-0">Editar jugador</h3>
</div>

<!-- Mostrar errores de validación si existen -->
<?php if (!empty($errores)): ?>
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
            <?php foreach ($errores as $err): ?>
                <li><?= htmlspecialchars($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-center w-100 my-4">
    <div class="card shadow-sm mx-auto" style="max-width: 900px; width: 100%;">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row g-3">

                    <!-- Apellido: Solo letras y espacios -->
                    <div class="col-6">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control"
                               value="<?= htmlspecialchars($fila['apellido'] ?? '') ?>" required
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El apellido solo debe contener letras y espacios">
                    </div>

                    <!-- Nombre: Solo letras y espacios -->
                    <div class="col-6">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control"
                               value="<?= htmlspecialchars($fila['nombre'] ?? '') ?>" required
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+" title="El nombre solo debe contener letras y espacios">
                    </div>

                    <!-- CI: Solo números -->
                    <div class="col-6">
                        <label class="form-label">CI</label>
                        <input type="text" name="CI" class="form-control"
                               value="<?= htmlspecialchars($fila['CI'] ?? '') ?>" required
                               pattern="[0-9]+" title="La CI solo debe contener números">
                    </div>

                    <!-- Fecha de Nacimiento: Rango de 5 a 80 años -->
                    <div class="col-6">
                        <label class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nac" class="form-control"
                               value="<?= htmlspecialchars($fila['fecha_nac'] ?? '') ?>" required
                               min="<?= $hace80Anos ?>" max="<?= $hace5Anos ?>"
                               title="La edad debe estar entre 5 y 80 años">
                    </div>

                    <!-- Nro. contacto: Solo números -->
                    <div class="col-6">
                        <label class="form-label">Nro. contacto</label>
                        <input type="text" name="nro_contacto" class="form-control"
                               value="<?= htmlspecialchars($fila['nro_contacto'] ?? '') ?>"
                               pattern="[0-9]+" title="El número de contacto solo debe contener números">
                    </div>

                    <div class="col-6">
                        <label class="form-label">Género</label>
                        <select name="genero" class="form-select" required>
                            <option value="1" <?= ($fila['genero'] ?? 0) == 1 ? 'selected' : '' ?>>Masculino</option>
                            <option value="2" <?= ($fila['genero'] ?? 0) == 2 ? 'selected' : '' ?>>Femenino</option>
                        </select>
                    </div>

                    <!-- Dirección: Letras, números, espacios y la barra '/' -->
                    <div class="col-12">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control"
                               value="<?= htmlspecialchars($fila['direccion'] ?? '') ?>"
                               pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\/]+" title="La dirección solo admite letras, números, espacios y '/'">
                    </div>

                    <div class="col-6">
                        <label class="form-label">Lugar de nacimiento</label>
                        <input type="text" name="lugar_nac" class="form-control"
                               value="<?= htmlspecialchars($fila['lugar_nac'] ?? '') ?>">
                    </div>

                    <div class="col-6">
                        <label class="form-label">Tipo de sangre</label>
                        <select name="tipo_sangre" class="form-select">
                            <option value="">— Sin especificar —</option>
                            <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $ts): ?>
                                <option value="<?= $ts ?>" <?= ($fila['tipo_sangre'] ?? '') === $ts ? 'selected' : '' ?>>
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
                        <label class="form-label d-block">Foto del Jugador</label>
                        
                        <?php if (!empty($fila['foto'])): ?>
                            <div class="mb-2 d-flex align-items-center gap-3">
                                <img src="data:image/jpeg;base64,<?= base64_encode($fila['foto']) ?>" 
                                     alt="Foto actual" 
                                     class="img-thumbnail" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                <span class="text-muted small">
                                    <i class="bi bi-info-circle"></i> Foto actual. Selecciona una nueva solo si deseas cambiarla.
                                </span>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="foto" class="form-control" accept="image/*">
                    </div>

                    <?php include __DIR__ . '/_tutores_edicion.php'; ?>

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
</div>

<?php include_once '../../template/parciales/templateEnd.php'; ?>