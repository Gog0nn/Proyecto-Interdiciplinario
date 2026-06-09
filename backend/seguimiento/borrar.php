<?php 
require_once '../../db/lib/conex.php';
require_once '../../db/lib/seguimiento.php';

$con = Conex();
$seguimiento = new Seguimiento($con);

// Validamos que vengan tanto el ID del seguimiento como el ID del jugador
if (isset($_GET['id']) && isset($_GET['id_jugador'])) {
    $id = intval($_GET['id']);
    $id_jugador = intval($_GET['id_jugador']);
    
    // Ejecuta el borrado en la base de datos
    $seguimiento->delete($id);
    
    // REDIRECCIÓN CORRECTA: Volvemos al historial de ese jugador en específico
    header("Location: index.php?id_jugador=" . $id_jugador . "&message=eliminado");
    exit();
} else {
    // Si falta alguno de los dos parámetros, mostramos el error de forma segura
    echo "<p style='color:red;'>Error: ID de seguimiento o ID de jugador no proporcionado.</p>";
    echo "<a href='../jugadores/index.php'>Volver a Jugadores</a>";
}
?>