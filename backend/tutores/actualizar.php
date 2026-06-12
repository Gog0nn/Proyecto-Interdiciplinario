<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";
require_once __DIR__ . "/../validaciones/validar_tutor.php";

$db = Conex();
$tutoresObj = new Tutores($db);
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = validarTutor($_POST);

    // Validar que tenga al menos un jugador asignado
    if (empty($_POST['jugador_ids']) || !is_array($_POST['jugador_ids']) || count($_POST['jugador_ids']) === 0) {
        $errores[] = "Debe asignar al menos un jugador al tutor";
    }

    if (!empty($errores)) {
        $fila = $_POST;
        $fila['jugador_ids'] = isset($_POST['jugador_ids']) ? implode(',', $_POST['jugador_ids']) : '';
        $target = "actualizar.php";
        $titulo_form = "Editar Tutor";
        include_once __DIR__ . "/../../template/parciales/templateStart.php";
        include "_form.php";
        include_once __DIR__ . "/../../template/parciales/templateEnd.php";
        exit;
    }

    $datos = [
        'id_tutor' => $_POST['id_tutor'] ?? 0,
        'nombre' => $_POST['nombre'] ?? '',
        'apellido' => $_POST['apellido'] ?? '',
        'contacto' => $_POST['contacto'] ?? '',
        'jugador_ids' => $_POST['jugador_ids'] ?? []
    ];

    $rs = $tutoresObj->update($datos);
    if ($rs) {
        header("Location: index.php?ok=2");
    } else {
        header("Location: editar.php?id_tutor=" . $_POST['id_tutor'] . "&error=1");
    }
    exit;
}

?>
