<?php

require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";
require_once __DIR__ . "/../../db/lib/jugadores.php";

$db = Conex();
$tutores = new Tutores($db);
$jugadores = new jugadores($db);
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
                <thead>
                    <tr>
                        <th colspan="6" class="text-center">Lista de Tutores</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Nombre y Apellido</th>
                        <th>Contacto</th>
                        <th>Jugadores Asignados</th>
                        <th colspan="2" class="text-center">
                            <a href="nuevo.php" class="btn btn-outline-success btn-sm">Nuevo Tutor</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($fila = $rs->fetch_assoc()) {
                    $jugador_ids = $fila['jugador_ids'] ? explode(',', $fila['jugador_ids']) : [];
                    $jugadores_nombres = [];

                    if (!empty($jugador_ids)) {
                        foreach ($jugador_ids as $jid) {
                            $jrs = $jugadores->getByID((int)$jid);
                            if ($jrs && $jfila = $jrs->fetch_assoc()) {
                                $jugadores_nombres[] = $jfila['apellido'] . ", " . $jfila['nombre'];
                            }
                        }
                    }
                ?>
                <tr>
                    <td><?php echo $fila['id_tutor']; ?></td>
                    <td><?php echo $fila['apellido'] . ", " . $fila['nombre']; ?></td>
                    <td>+595 <?php echo $fila['contacto']; ?></td>
                    <td>
                        <?php if (!empty($jugadores_nombres)): ?>
                            <ul class="mb-0">
                                <?php foreach ($jugadores_nombres as $nombre): ?>
                                    <li><?php echo htmlspecialchars($nombre); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <span class="text-muted">Sin jugadores</span>
                        <?php endif; ?>
                    </td>
                    <td><a href="editar.php?id_tutor=<?php echo $fila['id_tutor']; ?>" class="btn btn-outline-warning btn-sm">Editar</a></td>
                    <td><a href="borrar.php?id_tutor=<?php echo $fila['id_tutor']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrar este tutor?');">Borrar</a></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
<?php include(__DIR__ . "/../../template/parciales/templateEnd.php"); ?>