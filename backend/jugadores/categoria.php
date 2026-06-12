<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";
$con     = Conex();
$jugador = new jugadores($con);

// --- Parámetros desde la URL ---
$genero_slug = $_GET['genero'] ?? '';
$cat_nombre  = $_GET['cat']    ?? '';

$generos   = ['masculino' => 1, 'femenino' => 2];
$id_genero = (int)($generos[$genero_slug] ?? 0);

if (!$id_genero || !$cat_nombre) {
    header('Location: index.php');
    exit;
}

// --- Categoría ---
$cat_safe = $con->real_escape_string($cat_nombre);
$cat_row  = $con->query("SELECT * FROM Categoria WHERE nombre = '$cat_safe'")->fetch_assoc();

if (!$cat_row) {
    header('Location: index.php');
    exit;
}

$edad_min   = (int)$cat_row['edad_min'];
$edad_max   = (int)$cat_row['edad_max'];
$titulo_gen = ucfirst($genero_slug);

// --- Jugadores ---
$sql = "SELECT j.*,
               TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) AS edad
        FROM Jugadores j
        WHERE j.genero = $id_genero
          AND TIMESTAMPDIFF(YEAR, j.fecha_nac, CURDATE()) BETWEEN $edad_min AND $edad_max
        ORDER BY j.apellido";

$filas = $con->query($sql)->fetch_all(MYSQLI_ASSOC);
?>

<?php include_once '../../template/parciales/templateStart.php'; ?>

<div class="d-flex align-items-center gap-3 mb-3">
  <a href="index.php" class="btn btn-outline-secondary btn-sm">
    <i class="bi bi-arrow-left"></i> Volver
  </a>
  <h3 class="mb-0">
    <?php if ($genero_slug === 'masculino'): ?>
      <i class="bi bi-gender-male text-primary"></i>
    <?php else: ?>
      <i class="bi bi-gender-female text-danger"></i>
    <?php endif; ?>
    <?= htmlspecialchars($titulo_gen) ?> — <?= htmlspecialchars($cat_row['nombre']) ?>
    <span class="badge bg-secondary"><?= count($filas) ?></span>
  </h3>
</div>

<?php if (empty($filas)): ?>
  <p>No hay jugadores en esta categoría.</p>
<?php else: ?>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Apellido</th><th>Nombre</th><th>CI</th>
        <th>Fecha nac.</th><th>Edad</th><th>Contacto</th>
        <th>Dirección</th><th>Lugar nac.</th><th>Tipo sangre</th>
        <th colspan="2"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($filas as $fila): ?>
      <tr>
        <td><?= htmlspecialchars($fila['apellido']) ?></td>
        <td><?= htmlspecialchars($fila['nombre']) ?></td>
        <td><?= htmlspecialchars($fila['CI']) ?></td>
        <td><?= $fila['fecha_nac'] ?></td>
        <td><?= $fila['edad'] ?></td>
        <td><?= htmlspecialchars($fila['nro_contacto']) ?></td>
        <td><?= htmlspecialchars($fila['direccion']) ?></td>
        <td><?= htmlspecialchars($fila['lugar_nac']) ?></td>
        <td><?= htmlspecialchars($fila['tipo_sangre']) ?></td>
        <td>
          <a href="editar.php?id_jugador=<?= $fila['id_jugador'] ?>"
             class="btn btn-outline-warning btn-sm">Editar</a>
        </td>
        <td>
          <a href="borrar.php?id_jugador=<?= $fila['id_jugador'] ?>"
             class="btn btn-outline-danger btn-sm">Borrar</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php include_once '../../template/parciales/templateEnd.php'; ?>