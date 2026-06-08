<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/entrenadores.php";
require_once __DIR__ . "/../validaciones/validar_entrenador.php";

$db = Conex();
$entrenadores = new Entrenadores($db);
$errores = [];

$fila = [
    "id_entrenador" => "",
    "apellido" => "",
    "nombre" => "",
    "fecha_nac" => "",
    "nro_contacto" => "",
    "CI" => "",
    "foto" => ""
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errores = validarEntrenador($_POST);
    $fila = array_merge($fila, $_POST);

    if (empty($errores)) {
        // Procesar foto
        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $datos = array_merge($_POST, ['foto' => $foto]);
        $rs = $entrenadores->insert($datos);
        if ($rs) {
            header("Location: index.php?success=1");
            exit;
        }
        $errores[] = "Error al guardar en la base de datos";
    }
}

$target = "guardar.php";
$titulo_form = "Nuevo Entrenador";
include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php";
include_once __DIR__ . "/../../template/parciales/templateEnd.php";
