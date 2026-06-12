<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";
include __DIR__ . "/../../db/lib/tutores.php";

$con     = Conex();
$jugador = new jugadores($con);
$tutoresObj = new Tutores($con);

$target      = "guardar.php";
$titulo_form = "Registrar Jugador";
$errores     = [];

// Obtener lista de tutores disponibles
$tutores_rs = $tutoresObj->getall();

$fila = [
    "id_jugador"   => "",
    "apellido"     => "",
    "nombre"       => "",
    "CI"           => "",
    "fecha_nac"    => "",
    "nro_contacto" => "",
    "genero"       => "",
    "direccion"    => "",
    "lugar_nac"    => "",
    "tipo_sangre"  => "",
    "tutores"      => [],
];

include_once '../../template/parciales/templateStart.php';
include "_form.php";
include_once '../../template/parciales/templateEnd.php';
?>
