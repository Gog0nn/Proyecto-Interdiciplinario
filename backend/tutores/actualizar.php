<?php 
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";
require_once __DIR__ . "/../validaciones/validar_tutor.php";

$db = Conex();
$tutores = new Tutores($db);
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = validarTutor($_POST);

    if (!empty($errores)) {
        $fila = $_POST;
        $target = "actualizar.php";
        $titulo_form = "Editar Tutor";
        include_once __DIR__ . "/../../template/parciales/templateStart.php";
        include "_form.php";
        include_once __DIR__ . "/../../template/parciales/templateEnd.php";
        exit;
    }

    $rs = $tutores->update($_POST);
    if ($rs) {
        header("Location: index.php?success=1");
    } else {
        header("Location: editar.php?id_tutor=" . $_POST['id_tutor'] . "&error=1");
    }
    exit;
}



?>