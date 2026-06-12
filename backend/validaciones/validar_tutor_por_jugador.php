<?php
require_once __DIR__ . "/helpers.php";

function validarTutorPorJugador($db, $jugador_id) {
    $errores = [];

    // VALIDAR QUE JUGADOR_ID SEA VÁLIDO
    if (!esEnteroPositivo($jugador_id)) {
        $errores[] = "El ID del jugador no es válido";
        return $errores;
    }

    // VERIFICAR QUE EL JUGADOR EXISTA
    $sqlVerificarJugador = "SELECT id_jugador FROM jugadores WHERE id_jugador = ?";
    $stmt = $db->prepare($sqlVerificarJugador);
    $stmt->bind_param("i", $jugador_id);
    $stmt->execute();
    $resultJugador = $stmt->get_result();

    if ($resultJugador->num_rows === 0) {
        $errores[] = "El jugador no existe";
        return $errores;
    }

    // VERIFICAR QUE EL JUGADOR TENGA AL MENOS UN TUTOR
    $sqlVerificarTutores = "SELECT COUNT(*) as total_tutores FROM tutores WHERE jugador_id = ?";
    $stmt = $db->prepare($sqlVerificarTutores);
    $stmt->bind_param("i", $jugador_id);
    $stmt->execute();
    $resultTutores = $stmt->get_result();
    $fila = $resultTutores->fetch_assoc();

    if ($fila['total_tutores'] < 1) {
        $errores[] = "El jugador debe tener al menos un tutor asignado";
    }

    return $errores;
}
