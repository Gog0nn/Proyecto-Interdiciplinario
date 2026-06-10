<?php 
include_once __DIR__ . "/../../db/lib/conex.php";
include_once __DIR__ . "/../../db/lib/tutores.php";

$db = Conex();
$tutores = new Tutores($db);
$fila = NULL;
if (isset($_GET['id_tutor'])){
    $rs=$tutores->getByID($_GET['id_tutor']);
    $fila= $rs->fetch_assoc();
    
    if (!$fila) {
        header("Location: index.php?error=not_found");
        exit;
    }
}   
$target="actualizar.php";
$titulo_form="Editar Tutor";   
include_once '../../template/parciales/templateStart.php';
include "_form.php";
include_once '../../template/parciales/templateEnd.php';
?>