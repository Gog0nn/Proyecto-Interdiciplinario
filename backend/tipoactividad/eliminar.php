<?php
include("../../conex.php");
$con = Conex();

$id = $_GET["id"];

$check = mysqli_query($con, "SELECT COUNT(*) AS total FROM Actividad WHERE id_tipo = $id");
$row = mysqli_fetch_assoc($check);

if ($row['total'] > 0) {
    header("Location: index.php?error=" . urlencode("No se puede eliminar: este tipo de actividad está siendo usado por una o mas actividades."));
    exit;
}

$sql = "DELETE FROM TipoActividad WHERE id_tipo = $id";
$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: index.php?exito=" . urlencode("Tipo de actividad eliminado correctamente."));
} else {
    header("Location: index.php?error=" . urlencode("Error al eliminar el tipo de actividad."));
}
exit;