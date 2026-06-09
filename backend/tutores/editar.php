<?php 
include "../../db/lib/conex.php";
include "../../db/lib/seguimiento.php";
include "../../db/lib/jugadores.php"; // Lo incluimos para rescatar el nombre del jugador

$db = Conex();
$seguimiento = new Seguimiento($db);
$jugadorObj  = new jugadores($db);

$fila = NULL;
// 1. Validamos que venga el ID del seguimiento que queremos editar
if (isset($_GET['id'])) {
    $id_seguimiento = intval($_GET['id']);
    $rs = $seguimiento->getByID($id_seguimiento); // Asumiendo que tenés este método en tu clase seguimiento
    $fila = $rs->fetch_assoc();
}
// 2. Control de seguridad: Si por alguna razón no se encuentra el registro, volvemos al listado
if (!$fila) {
    header("Location: ../jugadores/index.php");
    exit();
}
// 3. Buscamos los datos del jugador usando el id_jugador guardado en la fila del seguimiento
$id_jugador = $fila['id_jugador'];
$res_jugador = $jugadorObj->getById($id_jugador);
$datos_jugador = $res_jugador->fetch_assoc();

$target = "actualizar.php";
// Personalizamos el título para que sea súper descriptivo
$titulo_form = "Editar Seguimiento Físico de: " . $datos_jugador['nombre'] . " " . $datos_jugador['apellido'];

include_once __DIR__ . "/../../template/parciales/templateStart.php";
include "_form.php"; // Este _form.php va a leer automáticamente los datos de $fila para rellenar los inputs
include_once __DIR__ . "/../../template/parciales/templateEnd.php";
?>