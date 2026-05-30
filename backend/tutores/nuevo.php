<?php  
$target = "guardar.php";
$titulo_form = "Nuevo Tutor";

$fila = [
    "id_tutor" => "",
    "nombre" => "",
    "apellido" => "",
    "contacto" => "",
    "jugador_id" => ""
];
include "../../template/parciales/templateStart.php";
include "_form.php";
include "../../template/parciales/templateEnd.php";
?>