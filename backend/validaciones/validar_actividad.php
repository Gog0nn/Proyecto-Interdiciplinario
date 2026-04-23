<?php
require_once "helpers.php";

function validarActividad($data) {
    $errores = [];

    $nombre = $data['nombre'] ?? '';
    $descripcion = $data['descripcion'] ?? '';
    $tipoactividad_id = $data['tipoactividad_id'] ?? '';

    // 🔹 NOMBRE
    if (!campoRequerido($nombre)) {
        $errores[] = "El nombre es obligatorio";
    } elseif (!longitudMinima($nombre, 3)) {
        $errores[] = "El nombre debe tener al menos 3 caracteres";
    } elseif (!longitudMaxima($nombre, 50)) {
        $errores[] = "El nombre no puede superar 50 caracteres";
    }

    // 🔹 DESCRIPCIÓN
    if (!campoRequerido($descripcion)) {
        $errores[] = "La descripción es obligatoria";
    } elseif (!longitudMinima($descripcion, 5)) {
        $errores[] = "La descripción debe tener al menos 5 caracteres";
    } elseif (!longitudMaxima($descripcion, 150)) {
        $errores[] = "La descripción no puede superar 150 caracteres";
    }

    // 🔹 TIPO ACTIVIDAD (FK)
    if (!campoRequerido($tipoactividad_id)) {
        $errores[] = "Debe seleccionar un tipo de actividad";
    } elseif (!esEnteroPositivo($tipoactividad_id)) {
        $errores[] = "El tipo de actividad debe ser válido";
    }

    return $errores;
}