<?php 
include "../../db/lib/conex.php";
include "../../db/lib/tutores.php";
$db = Conex();
$tutores = new Tutores($db);


$fila = NULL;
if (isset($_GET['id_tutor'])) {
    $rs= $tutores->getByID($_GET['id_tutor']);
    $fila = $rs->fetch_assoc();
}

$target = "actualizar.php";
$titulo_form = "Editar Tutor";

include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php";
include_once __DIR__ . "/../../template/parciales/templateEnd.php";