<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";
require_once __DIR__ . "/../validaciones/validar_tutor.php";

$db = Conex();
$tutores = new Tutores($db);
$errores = [];

$fila = [
    "id_tutor" => "",
    "nombre" => "",
    "apellido" => "",
    "contacto" => "",
    "jugador_id" => ""
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = validarTutor($_POST);
    $fila = array_merge($fila, $_POST);

    if (empty($errores)) {
        $rs = $tutores->insert($_POST);
        if ($rs) {
            header("Location: index.php?success=1");
            exit;
        }
        $errores[] = "Error al guardar en la base de datos";
    }
}

$target = "guardar.php";
$titulo_form = "Nuevo Tutor";
include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php";
include_once __DIR__ . "/../../template/parciales/templateEnd.php";
