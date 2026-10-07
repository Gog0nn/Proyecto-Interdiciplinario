<?php

require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/entrenadores.php";

$db = Conex();
$entrenadores = new Entrenadores($db);
$rs = $entrenadores->getAll();

?>

<?php include(__DIR__ . "/../../template/parciales/templateStart.php"); ?>
<h1>Entrenadores</h1>
<hr class="border-2 border-success opacity-100">

<?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
    echo "<span style='color: green;'>Entrenador insertado correctamente.</span><br><br>";
    } ?>
    <?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
        echo "<span style='color: green;'>Entrenador actualizado correctamente.</span><br><br>";
    } ?>
    <?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
         echo "<span style='color: green;'>Entrenador eliminado correctamente.</span><br><br>";
    } ?>
    <?php if (isset($_GET['error']) && $_GET['error'] == 3) {
        echo "<span style='color: red;'>Error al eliminar el entrenador.</span><br><br>";
    } ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle" data-datatable data-datatable-no-order="5,6,7">
            <thead>
            <tr>
                <th colspan="8" class="text-center">Lista de entrenadores</th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Entrenador</th>
                <th>Fecha de Nacimiento</th>
                <th>Contacto</th>
                <th>C.I</th>
                <th>Foto</th>
                <th colspan="3" class="text-center">
                    <a href="guardar.php" class="btn btn-outline-success btn-sm">Nuevo Entrenador</a>
                </th>
            </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = $rs->fetch_assoc()) {
                ?>
            <tr>
                <td><?php echo $fila['id_entrenador']; ?></td>
                <td><?php echo $fila['nombre'] . " " . $fila['apellido']; ?></td>
                <td><?php echo $fila['fecha_nac']; ?></td>
                <td><?php echo $fila['nro_contacto']; ?></td>
                <td><?php echo $fila['CI']; ?></td>
                <td><a href="foto.php?id_entrenador=<?php echo $fila['id_entrenador']; ?>" class="btn btn-outline-secondary btn-sm">Ver</a></td>
                <td><a href="editar.php?id_entrenador=<?php echo $fila['id_entrenador']; ?>" class="btn btn-outline-warning btn-sm">Editar</a></td>
                <td><a href="borrar.php?id_entrenador=<?php echo $fila['id_entrenador']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar este entrenador?');">Borrar</a></td>
                
            </tr>
                <?php
                }
                ?>
                
            </tbody>
            
        </table>
        
    </div>
<?php include(__DIR__ . "/../../template/parciales/templateEnd.php"); ?>