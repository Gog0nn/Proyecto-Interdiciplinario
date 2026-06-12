<?php
require_once __DIR__ . "/../../db/lib/conex.php";
$target = "guardar.php";
$titulo_form = "Nuevo Tutor";
$db = Conex();

$fila = [
    "id_tutor" => "",
    "nombre" => "",
    "apellido" => "",
    "contacto" => "",
    "jugador_ids" => ""
];
include "../../template/parciales/templateStart.php";
include "_form.php";
include "../../template/parciales/templateEnd.php";
?>
