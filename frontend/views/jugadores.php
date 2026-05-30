<?php
require_once __DIR__ . "/../../backend/genero/genero.php";
require_once __DIR__ . "/../../db/lib/conex.php";
 
$con = Conex();
 
$id_genero   = isset($_GET['genero'])    ? (int)$_GET['genero']    : 0;
$id_categoria = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;

$generoActual = $id_genero ? getById($id_genero) : null;
 

$categoriaActual = null;
if ($id_categoria) {
    $stmt = $con->prepare("SELECT * FROM Categoria WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);
    $stmt->execute();
    $categoriaActual = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
 
// Traer jugadores filtrados
$jugadores = [];
if ($id_genero && $id_categoria) {
    $stmt = $con->prepare("
        SELECT id_jugador, apellido, nombre, CI, fecha_nac, nro_contacto
        FROM Jugadores
        WHERE genero = ?
        ORDER BY apellido, nombre
    ");
    $stmt->bind_param("i", $id_genero);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $jugadores[] = $row;
    }
    $stmt->close();
} elseif ($id_genero) {
    $stmt = $con->prepare("
        SELECT id_jugador, apellido, nombre, CI, fecha_nac, nro_contacto
        FROM Jugadores
        WHERE genero = ?
        ORDER BY apellido, nombre
    ");
    $stmt->bind_param("i", $id_genero);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $jugadores[] = $row;
    }
    $stmt->close();
}
 
$con->close();
?>
<?php include(__DIR__ . "/../../template/parciales/templateStart.php"); ?>
 
    <h1 class="mb-1">Jugadores</h1>
 
    <?php if ($generoActual || $categoriaActual): ?>
    <p class="text-muted mb-4">
        <?php if ($generoActual): ?>
            <span class="badge bg-secondary"><?= htmlspecialchars($generoActual['descripcion']) ?></span>
        <?php endif; ?>
        <?php if ($categoriaActual): ?>
            <span class="badge bg-dark"><?= htmlspecialchars($categoriaActual['descripcion']) ?></span>
        <?php endif; ?>
    </p>
    <?php endif; ?>
 
    <?php if (!$id_genero): ?>
        <div class="alert alert-info">Seleccioná un género y categoría desde el panel de Acciones.</div>
    <?php elseif (empty($jugadores)): ?>
        <div class="alert alert-warning">No hay jugadores registrados para este filtro.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover crud-table">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>Fecha Nac.</th>
                    <th>Contacto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $j): ?>
                <tr>
                    <td><?= $j['id_jugador'] ?></td>
                    <td><?= htmlspecialchars($j['apellido']) ?></td>
                    <td><?= htmlspecialchars($j['nombre']) ?></td>
                    <td><?= htmlspecialchars($j['CI']) ?></td>
                    <td><?= htmlspecialchars($j['fecha_nac']) ?></td>
                    <td><?= htmlspecialchars($j['nro_contacto']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
 
<?php include(__DIR__ . "/../../template/parciales/templateEnd.php"); ?>