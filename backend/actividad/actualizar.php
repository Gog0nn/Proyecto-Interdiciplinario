<?php
include "../../db/lib/conex.php"; // incluimos conexion
include "../../db/lib/Actividad.php";
$con = Conex(); // conectamos a la db
$actividad = new Actividad($con);

// $_REQUEST $_GET $_POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validaciones
    include_once "validar_actividad.php";
    $errores = validarActividad($_POST);

    if (empty($errores)) {
        $actividad->update($_POST);
        header("Location: index.php?ok=2");
        exit();
    } else {
        $fila = $_POST;
        $target = "actualizar.php";
        $titulo_form = "Editar Actividad";
        include_once '../../template/parciales/templateStart.php';
        include "_form.php";
        include_once '../../template/parciales/templateEnd.php';
        exit();
    }
} else {
    echo "No llegaron valores por POST";
}
?>
