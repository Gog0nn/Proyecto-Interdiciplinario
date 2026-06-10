<?php 
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/seguimiento.php";

$db = Conex();
$seguimiento = new Seguimiento($db);
$fila= NULL;
if (isset($_GET['id']) && isset($_GET['id_jugador'])) {
    $id_seguimiento = intval($_GET['id']);
    $id_jugador = intval($_GET['id_jugador']);
    
    $fila = $seguimiento->getById($id_seguimiento);
    
    if (!$fila) {
        die("Seguimiento no encontrado");
    }
} else {
    die("Parámetros inválidos");
}
$target = "actualizar.php";
$titulo_form = "Editar Seguimiento";

include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php";
include_once __DIR__ . "/../../template/parciales/templateEnd.php";
?>