<?php

require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";

$db = Conex();
$tutores = new Tutores($db);
$rs = $tutores->getAll();

$nombre = "Administrador de Tutores";
?>
<?php include(__DIR__ . "/../../template/parciales/templateStart.php"); ?>
    <h3>Bienvenido, elija su tutor: <?php echo $nombre; ?></h3>

        <?php if (isset($_GET['ok']) && $_GET['ok'] == 1) {
            echo "<span style='color: green;'>Tutor insertado correctamente.</span><br><br>";
        } ?>
        <?php if (isset($_GET['ok']) && $_GET['ok'] == 2) {
            echo "<span style='color: green;'>Tutor actualizado correctamente.</span><br><br>";
        } ?>
        <?php if (isset($_GET['ok']) && $_GET['ok'] == 3) {
            echo "<span style='color: green;'>Tutor eliminado correctamente.</span><br><br>";
        } ?>
        <?php if (isset($_GET['error']) && $_GET['error'] == 3) {
            echo "<span style='color: red;'>Error al eliminar el tutor.</span><br><br>";
        } ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <tr>
                    <th colspan="9" class="text-center">Lista de Tutores</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Nombre Y Apellido</th>
                    <th>Contacto</th>
                    <th>Jugador ID</th>
                    <th colspan="3" class="text-center">
                        <a href="guardar.php" class="btn btn-outline-success btn-sm">Nuevo Tutor</a>
                    </th>
                </tr>
                <?php
                while ($fila = $rs->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $fila['id_tutor']; ?></td>
                    <td><?php echo $fila['apellido'] . ", " . $fila['nombre']; ?></td>
                    <td>+595 <?php echo $fila['contacto']; ?></td>
                    <td><?php echo $fila['id_jugador']; ?></td>
                    <td><a href="editar.php?id_tutor=<?php echo $fila['id_tutor']; ?>" class="btn btn-outline-warning btn-sm">Editar</a></td>
                    <td><a href="borrar.php?id_tutor=<?php echo $fila['id_tutor']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar este tutor?');">Borrar</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
<?php include(__DIR__ . "/../../template/parciales/templateEnd.php"); ?>