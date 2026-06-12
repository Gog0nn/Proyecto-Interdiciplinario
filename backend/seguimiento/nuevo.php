<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/seguimiento.php";
include __DIR__ . "/../../db/lib/jugadores.php"; 
$con         = Conex();
$seguimiento = new Seguimiento($con);
$jugadorObj  = new jugadores($con);
// 1. Validamos que venga el ID del jugador al que le haremos el seguimiento
if (!isset($_GET['id_jugador']) || empty($_GET['id_jugador'])) {
    header("Location: ../jugadores/index.php");
    exit();
}
$id_jugador = intval($_GET['id_jugador']);

$res_jugador = $jugadorObj->getById($id_jugador); // Asumiendo que tenés este método en tu clase jugadores
$datos_jugador = $res_jugador->fetch_assoc();

// Cálculo automático de la edad actual del jugador
$fecha_nac = new DateTime($datos_jugador['fecha_nac']);
$hoy = new DateTime();
$edad_actual = $hoy->diff($fecha_nac)->y;

$target      = "guardar.php";
$titulo_form = "Registrar Seguimiento Físico para: " . $datos_jugador['nombre'] . " " . $datos_jugador['apellido'];
$errores     = [];
$fila = [
    "id_seguimiento" => "",
    "id_jugador"     => $id_jugador,
    "fecha"          => date('Y-m-d'),
    "edad"           => $edad_actual,
    "peso"           => "",
    "altura"         => "",
];

include_once '../../template/parciales/templateStart.php';
include "_form.php"; // El _form.php de la carpeta seguimiento
include_once '../../template/parciales/templateEnd.php';
?>