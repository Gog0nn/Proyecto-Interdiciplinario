<?php
include "../../db/lib/conex.php"; // incluimos conexion
include "../../db/lib/Actividad.php";
$con = Conex(); // conectamos a la db
$evento = new Actividad($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validaciones
    include_once "validar_actividad.php";
    $errores = validarActividad($_POST);

    // Si hay errores, mostrarlos
    if (empty($errores)) {
        $evento->insert($_POST);
        header("Location: index.php?ok=1");
        exit();
    } else {
        $fila = $_POST;
        $target = "guardar.php";
        $titulo_form = "Registrar Actividad";
        include_once '../../template/parciales/templateStart.php';
        include "_form.php";
        include_once '../../template/parciales/templateEnd.php';
        exit();
    }
}
?>