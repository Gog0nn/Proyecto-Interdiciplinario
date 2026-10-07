<?php
include '../../db/lib/conex.php';
require_once '../../db/lib/seguimiento.php';
require_once '../../db/lib/jugadores.php';

$con = Conex();
$seguimiento = new Seguimiento($con);
$jugadorObj = new jugadores($con);

// 1. Validamos que en la URL venga el ID del jugador (Ej: index.php?id_jugador=5)
if (!isset($_GET['id_jugador']) || empty($_GET['id_jugador'])) {
    // Si no viene, lo mandamos de vuelta al CRUD de jugadores para que elija uno
    header("Location: ../jugadores/index.php");
    exit();
}

$id_jugador = intval($_GET['id_jugador']);

// Obtenemos los datos del jugador para mostrar su nombre en el título
$resJugador = $jugadorObj->getByID($id_jugador);
$infoJugador = $resJugador->fetch_assoc();

if (!$infoJugador) {
    header("Location: ../jugadores/index.php");
    exit();
}

// 2. Ejecutamos la consulta específica usando la función que creamos en la clase
$rs = $seguimiento->getByJugador($id_jugador);
?> 
<?php include_once '../../template/parciales/templateStart.php'; ?>

<div class="container-fluid py-4 px-3 px-lg-5">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 border-bottom pb-4 mb-4">
        <div>
            <a href="../jugadores/index.php" class="btn btn-link p-0 mb-3 text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Volver a jugadores</a>
            <span class="d-block text-success fw-semibold small text-uppercase">Control deportivo</span>
            <h1 class="h2 fw-bold mb-1">Seguimiento de <?= htmlspecialchars($infoJugador['nombre'] . ' ' . $infoJugador['apellido']) ?></h1>
            <p class="text-secondary mb-0">Historial de peso, altura y edad registrada en cada control.</p>
        </div>
        <a href="nuevo.php?id_jugador=<?= $id_jugador ?>" class="btn btn-success"><i class="bi bi-plus-lg me-2"></i>Nuevo control</a>
    </div>

    <?php if (isset($_GET['success'])): ?><div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>El seguimiento se guardó correctamente.</div><?php endif; ?>
    <?php if (isset($_GET['error'])): ?><div class="alert alert-danger"><i class="bi bi-exclamation-circle me-2"></i>No se pudo guardar el seguimiento.</div><?php endif; ?>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="border rounded-3 overflow-hidden">
                <div class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center"><h2 class="h5 mb-0 fw-bold">Historial de controles</h2><span class="text-secondary small"><?= $rs ? $rs->num_rows : 0 ?> registros</span></div>
                <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" data-datatable data-datatable-no-order="6">
            <thead>
                <tr>
                    <th>Control</th>
                    <th>Fecha</th>
                    <th>Edad</th>
                    <th>Peso (kg)</th>
                    <th>Altura (m)</th>
                    <th>Observación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Controlamos si la base de datos devolvió registros
                if ($rs && $rs->num_rows > 0) {
                    $tiene_registros = false;

                    while ($fila = $rs->fetch_assoc()) {
                        // Si el id_seguimiento es NULL significa que es el registro vacío del LEFT JOIN
                        if ($fila['id_seguimiento'] === null) {
                            continue; 
                        }
                        $tiene_registros = true;
                ?>
                    <tr>
                        <td><?php echo $fila['id_seguimiento']; ?></td>
                        <td><?php echo $fila['fecha_seguimiento']; ?></td>
                        <td><?php echo $fila['edad']; ?></td>
                        <td><?php echo $fila['peso']; ?></td>
                        <td><?php echo $fila['altura']; ?></td>
                        <td class="text-secondary"><?php echo htmlspecialchars($fila['observacion'] ?: 'Sin observación'); ?></td>

                        <td>
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="editar.php?id=<?php echo $fila['id_seguimiento']; ?>&id_jugador=<?php echo $id_jugador; ?>" class="btn btn-sm btn-outline-warning" title="Editar control"><i class="bi bi-pencil"></i></a>
                                <a href="borrar.php?id=<?php echo $fila['id_seguimiento']; ?>&id_jugador=<?php echo $id_jugador; ?>" class="btn btn-sm btn-outline-danger" title="Eliminar control" onclick="return confirm('¿Estás seguro de eliminar este control?');"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php 
                    }
                    
                    // Si el bucle terminó y nunca encontró un id_seguimiento real
                    if (!$tiene_registros) {
                        echo '<tr><td class="text-center text-muted py-4">Sin registros</td><td class="text-center text-muted py-4">-</td><td class="text-center text-muted py-4">-</td><td class="text-center text-muted py-4">-</td><td class="text-center text-muted py-4">-</td><td class="text-center text-muted py-4">-</td><td class="text-center text-muted py-4">Este jugador todavía no cuenta con controles.</td></tr>';
                    }
                } else {
                ?>
                    <tr>
                        <td class="text-center text-muted py-4">Sin registros</td>
                        <td class="text-center text-muted py-4">-</td>
                        <td class="text-center text-muted py-4">-</td>
                        <td class="text-center text-muted py-4">-</td>
                        <td class="text-center text-muted py-4">-</td>
                        <td class="text-center text-muted py-4">-</td>
                        <td class="text-center text-muted py-4">El jugador no existe o hubo un error.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bg-light border rounded-3 p-4 h-100">
                <h2 class="h5 fw-bold mb-3"><i class="bi bi-clipboard2-pulse text-success me-2"></i>Resumen del jugador</h2>
                <dl class="row mb-0 small">
                    <dt class="col-6 text-secondary">Nombre</dt><dd class="col-6 text-end fw-semibold"><?= htmlspecialchars($infoJugador['nombre']) ?></dd>
                    <dt class="col-6 text-secondary">Apellido</dt><dd class="col-6 text-end fw-semibold"><?= htmlspecialchars($infoJugador['apellido']) ?></dd>
                    <dt class="col-6 text-secondary">Categoría</dt><dd class="col-6 text-end fw-semibold">Ficha del jugador</dd>
                </dl>
                <hr>
                <p class="small text-secondary mb-0"><i class="bi bi-info-circle me-1"></i>Usá los controles periódicos para observar la evolución física del jugador.</p>
            </div>
        </div>
    </div>
</div>

<?php include_once '../../template/parciales/templateEnd.php'; ?>