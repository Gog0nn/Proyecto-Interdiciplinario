<?php 
ob_start();
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/entrenadores.php";
require_once __DIR__ . "/../validaciones/validar_entrenador.php";

$db = Conex();
$entrenadores = new Entrenadores($db);
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = validarEntrenador($_POST);

    if (!empty($errores)) {
        $fila = array_merge($_POST, ['id_entrenador' => $_POST['id_entrenador'] ?? '']);
        $target = "actualizar.php";
        $titulo_form = "Editar Entrenador";
        include_once __DIR__ . "/../../template/parciales/templateStart.php";
        include "_form.php";
        include_once __DIR__ . "/../../template/parciales/templateEnd.php";
        exit;
    }

    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    }

    $datos = array_merge($_POST, [
        'foto'          => $foto,
        'id_entrenador' => $_POST['id_entrenador']
    ]);
    $rs = $entrenadores->update($datos);

    if ($rs) {
        header("Location: index.php?success=1");
    } else {
        header("Location: editar.php?id_entrenador=" . $_POST['id_entrenador'] . "&error=1");
    }
    exit;
}



?>