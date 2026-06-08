<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";
$con     = Conex();
$jugador = new jugadores($con);

$id = (int)($_GET['id_jugador'] ?? 0);
if (!$id) {
    header('Location: index.php');
    exit;
}

// Cargar datos para mostrar en confirmación
$rs   = $jugador->getByID($id);
$fila = $rs ? $rs->fetch_assoc() : null;

if (!$fila) {
    header('Location: index.php');
    exit;
}

// Confirmar eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = $jugador->delete($id);
    header('Location: index.php?ok=' . ($ok ? 3 : 0) . ($ok ? '' : '&error=3'));
    exit;
}
?>

<?php include_once '../../template/parciales/templateStart.php'; ?>

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="index.php" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
    <h3 class="mb-0">Eliminar jugador</h3>
</div>

<div class="card border-danger" style="max-width: 500px;">
    <div class="card-body">
        <p class="mb-1">¿Estás seguro que querés eliminar a este jugador?</p>
        <p class="fs-5 fw-bold mb-4">
            <?= htmlspecialchars($fila['apellido']) ?>, <?= htmlspecialchars($fila['nombre']) ?>
            <span class="text-muted fs-6">(CI: <?= htmlspecialchars($fila['CI']) ?>)</span>
        </p>
        <form method="POST" class="d-flex gap-2">
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Sí, eliminar
            </button>
            <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php include_once '../../template/parciales/templateEnd.php'; ?>