<?php
require_once "../../db/lib/app.php";
require_once "../../db/lib/conex.php";
require_once "../../db/lib/jugadores.php";

$db = Conex();
$jugadorObj = new jugadores($db);

// 1. Validar que exista el ID del jugador (usando el nombre exacto que viene de index.php)
$id_jugador = (int)($_GET['id_jugador'] ?? 0);

if (!$id_jugador) {
    header("Location: index.php");
    exit;
}

// 2. Obtener datos del jugador usando la clase
$res = $jugadorObj->getByID($id_jugador);
$jugador = $res->fetch_assoc();

if (!$jugador) {
    header("Location: index.php?error=notfound");
    exit;
}

// 3. Obtener tutores (Relación directa en la tabla Tutores según tu modelo)
$rs_tutores = $db->query("
    SELECT * 
    FROM Tutores 
    WHERE id_jugador = $id_jugador
");

$tutores = [];
if ($rs_tutores) {
    while ($fila = $rs_tutores->fetch_assoc()) {
        $tutores[] = $fila;
    }
}

// 4. Datos adicionales usando los métodos de la clase
$categoria_info = $jugadorObj->getCategoriaByEdad($jugador['fecha_nac']);

include_once '../../template/parciales/templateStart.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Detalles del Jugador</h1>
        <a href="index.php" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>

    <div class="row">
        <!-- Columna de Perfil rápido -->
        <div class="col-md-4 text-center mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <?php 
                    $foto_src = "../../assets/img/user-placeholder.png";
                    if (!empty($jugador['foto'])) {
                        // Convertimos el binario (BLOB) a base64 para que el navegador lo interprete
                        $foto_base64 = base64_encode($jugador['foto']);
                        $foto_src = "data:image/jpeg;base64," . $foto_base64;
                    }
                    ?>
                    <img src="<?= $foto_src ?>" class="img-fluid rounded-circle mb-3 border" style="width: 120px; height: 120px; object-fit: cover;" alt="Foto">
                    <h4 class="fw-bold"><?= htmlspecialchars($jugador['nombre'] . " " . $jugador['apellido']) ?></h4>
                    <span class="badge <?= $jugador['activo'] ? 'bg-success' : 'bg-danger' ?> mb-2">
                        <?= $jugador['activo'] ? 'Activo' : 'Inactivo' ?>
                    </span>
                    <p class="text-muted">Categoría: <?= htmlspecialchars($categoria_info['nombre']) ?></p>
                </div>
            </div>
        </div>

        <!-- Columna de Información Detallada -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-person-vcard me-2"></i>Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Cédula de Identidad</label>
                            <span class="fw-medium"><?= htmlspecialchars($jugador['CI']) ?></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Fecha de Nacimiento</label>
                            <span><?= $jugador['fecha_nac'] ?></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Género</label>
                            <span class="text-capitalize"><?= $jugadorObj->getGeneroSlug($jugador['genero']) ?></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="small text-muted d-block">Tipo de Sangre</label>
                            <span class="badge bg-light text-dark border"><?= !empty($jugador['tipo_sangre']) ? $jugador['tipo_sangre'] : 'N/A' ?></span>
                        </div>
                        <div class="col-12">
                            <label class="small text-muted d-block">Dirección</label>
                            <span><?= htmlspecialchars($jugador['direccion']) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección de Tutores -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-primary fw-bold"><i class="bi bi-people me-2"></i>Tutores Responsables</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($tutores)): ?>
                        <div class="alert alert-light border text-center">
                            No hay tutores vinculados a este jugador.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th>Nombre y Apellido</th>
                                        <th>Contacto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tutores as $t): ?>
                                    <tr>
                                        <td class="fw-medium"><?= htmlspecialchars($t['nombre'] . ' ' . $t['apellido']) ?></td>
                                        <td>
                                            <a href="tel:<?= $t['contacto'] ?>" class="text-decoration-none">
                                                <i class="bi bi-telephone me-1"></i> <?= htmlspecialchars($t['contacto']) ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../../template/parciales/templateEnd.php'; ?>