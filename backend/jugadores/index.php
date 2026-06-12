<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";
$con     = Conex();
$jugador = new jugadores($con);

$id_categoria = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
$id_genero = isset($_GET['genero']) ? (int)$_GET['genero'] : 0;
$rs = $jugador->getFiltered($id_categoria, $id_genero);
$jugadores = [];
while ($fila = $rs->fetch_assoc()) {
  $fila['genero_txt'] = match((int)$fila['genero']) {
    1 => 'Masculino',
    2 => 'Femenino',
    default => 'Sin género'
  };
  $fila['categoria_txt'] = $fila['categoria_nombre'] ?? 'Sin categoría';
  $jugadores[] = $fila;
}
?>

<?php include_once '../../template/parciales/templateStart.php'; ?>

<div class="d-flex flex-column flex-lg-row min-vh-100">

  <?php include_once '../../template/parciales/aside1.php'; ?>

  <div class="flex-grow-1 p-4 bg-light">

    <div class="card border-0 shadow-sm p-4 bg-white">
      <main>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <h1 class="h3 mb-0 fw-bold text-dark">Jugadores</h1>
          <a href="nuevo.php" class="btn btn-primary btn-sm px-3 shadow-sm">
            <i class="bi bi-person-plus me-1"></i> Nuevo jugador
          </a>
        </div>

        <?php if (isset($_GET['ok'])): ?>
          <?php $msgs = [1 => 'insertado', 2 => 'actualizado', 3 => 'eliminado']; ?>
          <div class="alert alert-success py-2 shadow-sm" role="alert">
            Jugador <?= $msgs[$_GET['ok']] ?? '' ?> correctamente.
          </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error']) && $_GET['error'] == 3): ?>
          <div class="alert alert-danger py-2 shadow-sm" role="alert">
            Error al eliminar el jugador.
          </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
          <div class="alert alert-success py-2 shadow-sm" role="alert">
            Estado del jugador actualizado correctamente.
          </div>
        <?php endif; ?>
        
        <?php if (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
          <div class="alert alert-danger py-2 shadow-sm" role="alert">
            No se pudo actualizar el estado del jugador.
          </div>
        <?php endif; ?>

        <form method="get" class="mb-3 d-flex gap-2 align-items-center">
            <select name="categoria" class="form-control w-auto">
                <option value="">Todas las categorías</option>
                <option value="1" <?= $id_categoria==1?'selected':'' ?>>Sub-10</option>
                <option value="2" <?= $id_categoria==2?'selected':'' ?>>Sub-13</option>
                <option value="3" <?= $id_categoria==3?'selected':'' ?>>Sub-15</option>
                <option value="4" <?= $id_categoria==4?'selected':'' ?>>Sub-17</option>
                <option value="5" <?= $id_categoria==5?'selected':'' ?>>Sub-20</option>
            </select>
            <select name="genero" class="form-control w-auto">
                <option value="">Todos los géneros</option>
                <option value="1" <?= $id_genero==1?'selected':'' ?>>Masculino</option>
                <option value="2" <?= $id_genero==2?'selected':'' ?>>Femenino</option>
                <option value="3" <?= $id_genero==3?'selected':'' ?>>Mixto</option>
            </select>
            <button type="submit" class="btn btn-primary btn-sm px-3 shadow-sm">
                <i class="bi bi-filter me-1"></i> Filtrar
            </button>
            <a href="index.php" class="btn btn-outline-secondary btn-sm px-3 shadow-sm">
                <i class="bi bi-trash3 me-1"></i> Limpiar
            </a>
        </form>

        <?php if (empty($jugadores)): ?>
          <div class="text-center py-5">
            <i class="bi bi-people text-muted fs-1"></i>
            <p class="mt-2 text-muted">No hay jugadores registrados en el sistema.</p>
          </div>
        <?php else: ?>

          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-secondary px-2.5 py-1.5 fs-6"><?= count($jugadores) ?></span>
            <span class="text-muted small fw-semibold">jugadores ordenados por categoría ascendente</span>
          </div>

          <div class="table-responsive">
            <table class="table table-hover align-middle border-light">
              <thead class="table-light text-secondary">
                <tr>
                  <th>Estado</th>
                  <th>Categoría</th>
                  <th>Género</th>
                  <th>Apellido</th>
                  <th>Nombre</th>
                  <th>CI</th>
                  <th>Fecha nac.</th>
                  <th>Edad</th>
                  <th>Contacto</th>
                  <th>Dirección</th>
                  <th>Lugar nac.</th>
                  <th>Tipo sangre</th>
                  <th class="text-center">Acciones</th>
                  <th>Seguimiento del jugador</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($jugadores as $fila): ?>
                <tr>
                  <td>
                    <?php if (($fila['activo'] ?? 1) == 1): ?>
                      <span class="badge bg-success bg-opacity-10 text-success px-2 py-1.5 border border-success border-opacity-25 rounded-pill">Activo</span>
                    <?php else: ?>
                      <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1.5 border border-danger border-opacity-25 rounded-pill">Inactivo</span>
                    <?php endif; ?>
                  </td>
                  <td class="fw-medium text-dark"><?= htmlspecialchars($fila['categoria_txt']) ?></td>
                  <td>
                    <?php if ($fila['genero_txt'] === 'Masculino'): ?>
                      <i class="bi bi-gender-male text-primary me-1"></i>
                    <?php elseif ($fila['genero_txt'] === 'Femenino'): ?>
                      <i class="bi bi-gender-female text-danger me-1"></i>
                    <?php endif; ?>
                    <?= htmlspecialchars($fila['genero_txt']) ?>
                  </td>
                  <td><?= htmlspecialchars($fila['apellido']) ?></td>
                  <td><?= htmlspecialchars($fila['nombre']) ?></td>
                  <td class="text-secondary"><?= htmlspecialchars($fila['CI']) ?></td>
                  <td class="text-nowrap"><?= $fila['fecha_nac'] ?></td>
                  <td class="fw-bold"><?= $fila['edad'] ?></td>
                  <td><?= htmlspecialchars($fila['nro_contacto']) ?></td>
                  <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($fila['direccion']) ?></td>
                  <td><?= htmlspecialchars($fila['lugar_nac']) ?></td>
                  <td class="text-center"><span class="badge bg-light text-dark border"><?= htmlspecialchars($fila['tipo_sangre']) ?></span></td>
                  <td>
                    <div class="d-flex flex-nowrap gap-1 justify-content-center">
                      <a href="detalle.php?id_jugador=<?= $fila['id_jugador'] ?>"
                        class="btn btn-outline-info py-1 px-2"><i class="bi bi-eye"></i></a>
                      <a href="editar.php?id_jugador=<?= $fila['id_jugador'] ?>"
                         class="btn btn-outline-warning py-1 px-2"><i class="bi bi-pencil-square"></i></a>
                      <a href="borrar.php?id_jugador=<?= $fila['id_jugador'] ?>"
                         class="btn btn-outline-danger py-1 px-2"><i class="bi bi-trash"></i></a>
                      <?php if (($fila['activo'] ?? 1) == 1): ?>
                        <a href="estado.php?id=<?= $fila['id_jugador'] ?>&accion=0"
                           class="btn btn-light border text-danger py-1 px-2 fw-semibold">Baja</a>
                      <?php else: ?>
                        <a href="estado.php?id=<?= $fila['id_jugador'] ?>&accion=1"
                           class="btn btn-success py-1 px-2 fw-semibold">Alta</a>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td>
                    <a href="../seguimiento/index.php?id_jugador=<?= $fila['id_jugador'] ?>" class="btn btn-outline-info py-1 px-2">
                      <i class="bi bi-binoculars"></i> Ver Seguimiento
                    </a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div> 
        <?php endif; ?>

      </main>
    </div> 
  </div> 
</div> 

<?php include_once '../../template/parciales/templateEnd.php'; ?>