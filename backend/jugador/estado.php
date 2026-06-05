<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/Jugador.php";

if (isset($_GET['id']) && isset($_GET['accion'])) {
    $db = Conex();
    $objetoJugador = new Jugador($db);
    
    $id = $_GET['id'];
    $nuevoEstado = $_GET['accion']; 

    $rs = $objetoJugador->cambiarEstado($id, $nuevoEstado);
    
    if ($rs) {
        header("Location: index.php?status=success");
        exit();
    }
}

header("Location: index.php?status=error");
exit();
?>