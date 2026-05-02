<?php
require_once "helpers.php";

function validarTutor($data) {
    $errores = [];

    $apellido   = $data['apellido'] ?? '';
    $nombre     = $data['nombre'] ?? '';
    $contacto   = $data['contacto'] ?? '';
    $jugador_id = $data['jugador_id'] ?? '';

    // APELLIDO
    if (!campoRequerido($apellido)) {
        $errores[] = "El apellido es obligatorio";
    } elseif (!longitudMinima($apellido, 2)) {
        $errores[] = "El apellido debe tener al menos 2 caracteres";
    } elseif (!longitudMaxima($apellido, 100)) {
        $errores[] = "El apellido no puede superar 100 caracteres";
    } elseif (!soloTexto($apellido)) {
        $errores[] = "El apellido solo puede contener letras";
    }

    // NOMBRE
    if (!campoRequerido($nombre)) {
        $errores[] = "El nombre es obligatorio";
    } elseif (!longitudMinima($nombre, 2)) {
        $errores[] = "El nombre debe tener al menos 2 caracteres";
    } elseif (!longitudMaxima($nombre, 100)) {
        $errores[] = "El nombre no puede superar 100 caracteres";
    } elseif (!soloTexto($nombre)) {
        $errores[] = "El nombre solo puede contener letras";
    }

    // CONTACTO
    if (!campoRequerido($contacto)) {
        $errores[] = "El contacto es obligatorio";
    } elseif (!longitudMaxima($contacto, 50)) {
        $errores[] = "El contacto no puede superar 50 caracteres";
    }

    // JUGADOR
    if (!campoRequerido($jugador_id)) {
        $errores[] = "Debe asociar el tutor a un jugador";
    } elseif (!esEnteroPositivo($jugador_id)) {
        $errores[] = "El jugador seleccionado no es válido";
    }

    return $errores;
}