<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/Jugador.php";

$db = Conex();
$objetoJugador = new Jugador($db);
$rs = $objetoJugador->getAll();

include_once __DIR__ . "/../../template/parciales/templateStart.php";
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Gestión de Jugadores - Club Atlético Sacachispas</h3>
    </div>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Estado del jugador actualizado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Jugador</th>
                    <th>CI</th>
                    <th>Contacto</th>
                    <th>Género</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rs && $rs->num_rows > 0): ?>
                    <?php while ($fila = $rs->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $fila['id_jugador']; ?></td>
                        <td><?php echo htmlspecialchars(($fila['apellido'] ?? '') . ", " . ($fila['nombre'] ?? '')); ?></td>
                        <td><?php echo htmlspecialchars($fila['CI'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($fila['nro_contacto'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($fila['genero_texto'] ?? 'No asignado'); ?></td>
                        <td>
                            <?php if (($fila['activo'] ?? 1) == 1): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if (($fila['activo'] ?? 1) == 1): ?>
                                <a href="estado.php?id=<?php echo $fila['id_jugador']; ?>&accion=0" class="btn btn-outline-danger btn-sm">Dar de Baja</a>
                            <?php else: ?>
                                <a href="estado.php?id=<?php echo $fila['id_jugador']; ?>&accion=1" class="btn btn-outline-success btn-sm">Dar de Alta</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay jugadores registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once __DIR__ . "/../../template/parciales/templateEnd.php"; ?>