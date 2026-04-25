<?php
require_once "../validaciones/helpers.php";

function validarTipoActividad($data) {
    $errores = [];

    $descripcion = $data['descripcion'] ?? '';

    if (!campoRequerido($descripcion)) {
        $errores[] = "La descripción es obligatoria";
    } elseif (!longitudMinima($descripcion, 3)) {
        $errores[] = "La descripción debe tener al menos 3 caracteres";
    } elseif (!longitudMaxima($descripcion, 100)) {
        $errores[] = "La descripción no puede superar 100 caracteres";
    }

    return $errores;
}