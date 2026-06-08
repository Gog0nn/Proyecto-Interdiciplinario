<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/jugadores.php";

if (isset($_GET['id']) && isset($_GET['accion'])) {
    $db = Conex();
    $objetoJugador = new jugadores($db);

    $id = (int)$_GET['id'];
    $nuevoEstado = (int)$_GET['accion'];

    $rs = $objetoJugador->cambiarEstado($id, $nuevoEstado);

    if ($rs) {
        header("Location: index.php?status=success");
        exit();
    }
}

header("Location: index.php?status=error");
exit();