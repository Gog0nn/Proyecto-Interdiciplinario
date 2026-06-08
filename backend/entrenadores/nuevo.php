<?php  
$target = "guardar.php";
$titulo_form = "Nuevo entrenador";

$fila = [
    "id_entrenador" => "",
    "apellido" => "",
    "nombre" => "",
    "fecha_nac" => "",
    "nro_contacto" => "",
    "CI" => "",
    "foto" => ""
];
include "../../template/parciales/templateStart.php";
include "_form.php";
include "../../template/parciales/templateEnd.php";
?>