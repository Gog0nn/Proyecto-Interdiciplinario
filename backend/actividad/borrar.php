<?php
include "../../db/lib/conex.php"; // incluimos conexion
include "../../db/lib/Actividad.php";
$con = Conex(); // conectamos a la db
$actividad = new Actividad($con);

if (isset($_GET['id_actividad'])) {
    if ($actividad->delete($_GET['id_actividad'])) {
        header("Location: index.php?ok=3");
        exit(); 
    } else {
        header("Location: index.php?error=3");
        exit();
    }
} else {
    header("Location: index.php?error=3");
    exit();
}
?>
