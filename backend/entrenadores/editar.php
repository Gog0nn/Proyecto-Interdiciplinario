<?php 
include "../../db/lib/conex.php";
include "../../db/lib/entrenadores.php";
$db = Conex();
$entrenadores = new Entrenadores($db);


$fila = NULL;
if (isset($_GET['id_entrenador'])) {
    $rs= $entrenadores->getByID($_GET['id_entrenador']);
    $fila = $rs->fetch_assoc();
}

$target = "actualizar.php";
$titulo_form = "Editar Entrenador";

include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php";
include_once __DIR__ . "/../../template/parciales/templateEnd.php";