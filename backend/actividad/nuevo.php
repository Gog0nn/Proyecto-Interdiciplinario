<?php
$target="guardar.php";
$titulo_form="Registrar Actividad";   

$fila = [
    "id_actividad" => "",
    "nombre" => "",
    "descripcion" => "",
    "fecha" => "",
    "hora" => "",
    "lugar" => "",
    "id_genero" => "",
    "id_categoria" => "",
    "id_tipo" => "",

];

include_once '../../template/parciales/templateStart.php'; 
include "_form.php";
include_once '../../template/parciales/templateEnd.php';

?>