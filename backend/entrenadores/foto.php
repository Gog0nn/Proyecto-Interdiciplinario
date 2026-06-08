<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/entrenadores.php";

$db = Conex();
$entrenadores = new Entrenadores($db);
$rs = $entrenadores->getbyid($_GET['id_entrenador']);
$fila = $rs->fetch_assoc();

include __DIR__ . "/../../template/parciales/templateStart.php";
?>

<div class="card mx-auto mt-4" style="max-width: 700px;">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-6 border-end">
                <h5 class="fw-bold"><?php echo $fila['nombre'] . " " . $fila['apellido']; ?></h5>
                <p class="text-muted mb-3">Entrenador</p>
                <hr>
                <p><strong>Fecha de nac.:</strong> <?php echo $fila['fecha_nac']; ?></p>
                <p><strong>Contacto:</strong> <?php echo $fila['nro_contacto']; ?></p>
                <p><strong>C.I.:</strong> <?php echo $fila['CI']; ?></p>
                <a href="index.php" class="btn btn-outline-secondary mt-2">Volver</a>
            </div>
            <div class="col-6 text-center">
                <?php if (!empty($fila['foto'])) { ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fila['foto']); ?>"
                         class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                <?php } else { ?>
                    <p class="text-muted">Sin foto</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../../template/parciales/templateEnd.php"; ?>