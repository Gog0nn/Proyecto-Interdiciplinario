<?php
include "../../db/lib/conex.php"; // incluimos conexion
include "../../db/lib/Actividad.php";
$con = Conex(); // conectamos a la db
$evento = new Actividad($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "validar_actividad.php";
    $errores = validarActividad($_POST);

    if (empty($errores)) {
        try {
            $evento->insert($_POST);
            header("Location: index.php?ok=1");
            exit();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());   // el detalle queda en el log, no en pantalla
            $errores[] = "No se pudo guardar la actividad. Revisa los datos e intenta de nuevo.";
        }
    }

    $fila = $_POST;
    $target = "guardar.php";
    $titulo_form = "Registrar Actividad";
    include_once '../../template/parciales/templateStart.php';
    include "_form.php";
    include_once '../../template/parciales/templateEnd.php';
    exit();
}
?>