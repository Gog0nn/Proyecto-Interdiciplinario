<?php
require_once "helpers.php";

function validarGenero($data) {
    $errores = [];

    $descripcion = $data['descripcion'] ?? '';

    if (!campoRequerido($descripcion)) {
        $errores[] = "La descripción es obligatoria";
    } elseif (!longitudMinima($descripcion, 2)) {
        $errores[] = "Debe tener mínimo 2 caracteres";
    } elseif (!longitudMaxima($descripcion, 50)) {
        $errores[] = "Máximo 50 caracteres";
    } elseif (!soloTexto($descripcion)) {
        $errores[] = "Solo se permiten letras";
    }

    return $errores;
}