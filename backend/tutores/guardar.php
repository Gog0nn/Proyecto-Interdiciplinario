<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";
require_once __DIR__ . "/../validaciones/validar_tutor.php";

$db = Conex();
$tutoresObj = new Tutores($db);
$errores = [];

$fila = [
    "id_tutor" => "",
    "nombre" => "",
    "apellido" => "",
    "contacto" => "",
    "jugador_ids" => []
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = validarTutor($_POST);

    // Validar que tenga al menos un jugador asignado
    if (empty($_POST['jugador_ids']) || !is_array($_POST['jugador_ids']) || count($_POST['jugador_ids']) === 0) {
        $errores[] = "Debe asignar al menos un jugador al tutor";
    }

    $fila = array_merge($fila, $_POST);

    if (empty($errores)) {
        $datos = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido' => $_POST['apellido'] ?? '',
            'contacto' => $_POST['contacto'] ?? '',
            'jugador_ids' => $_POST['jugador_ids'] ?? []
        ];

        $rs = $tutoresObj->insert($datos);
        if ($rs) {
            header("Location: index.php?ok=1");
            exit;
        }
        $errores[] = "Error al guardar en la base de datos";
    }
}

$target = "guardar.php";
$titulo_form = "Nuevo Tutor";
$db = Conex();
include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php";
include_once __DIR__ . "/../../template/parciales/templateEnd.php";
