<?php
include '../../db/lib/conex.php';
require_once '../../db/lib/seguimiento.php';

$con = Conex();
$seguimiento = new Seguimiento($con);

// 1. Validamos que en la URL venga el ID del jugador (Ej: index.php?id_jugador=5)
if (!isset($_GET['id_jugador']) || empty($_GET['id_jugador'])) {
    // Si no viene, lo mandamos de vuelta al CRUD de jugadores para que elija uno
    header("Location: ../jugadores/index.php");
    exit();
}

$id_jugador = intval($_GET['id_jugador']);

// 2. Ejecutamos la consulta específica usando la función que creamos en la clase
$rs = $seguimiento->getByJugador($id_jugador);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Seguimiento</title>
    <link rel="stylesheet" href="../../assets/Bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5" class ="table-responsive">
        <h1 class="mb-4">Historial de Seguimiento</h1>
        
        <a href="nuevo.php?id_jugador=<?php echo $id_jugador; ?>" class="btn btn-outline-success btn-sm">
            Crear Nuevo Seguimiento
        </a>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID Seguimiento</th>
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
                        <td><?php echo $fila['observacion']; ?></td>

                        <td>
                            <a href="editar.php?id=<?php echo $fila['id_seguimiento']; ?>&id_jugador=<?php echo $id_jugador; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="borrar.php?id=<?php echo $fila['id_seguimiento']; ?>&id_jugador=<?php echo $id_jugador; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>
                        </td>
                    </tr>
                <?php 
                    }
                    
                    // Si el bucle terminó y nunca encontró un id_seguimiento real
                    if (!$tiene_registros) {
                        echo '<tr><td colspan="6" class="text-center text-muted py-4">Este jugador no cuenta con registros físicos actualmente.</td></tr>';
                    }
                } else { 
                ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            El jugador no existe o hubo un error.
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <a href="../jugadores/index.php" class="btn btn-secondary mt-3">Volver a Jugadores</a>
    </div>
    <script src="../../assets/Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>