<?php
require_once "genero.php";
$generos = getAll();
?>
<?php include(__DIR__ . "/../../template/parciales/templateStart.php"); ?>

    <h1 class="mb-4">Géneros</h1>

    <table class="table table-bordered table-hover crud-table">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($generos)): ?>
                <tr>
                    <td colspan="2" class="text-center text-muted">No hay géneros registrados.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($generos as $g): ?>
                <tr>
                    <td><?= $g['id_genero'] ?></td>
                    <td><?= htmlspecialchars($g['descripcion']) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

<?php include(__DIR__ . "/../../template/parciales/templateEnd.php"); ?>
