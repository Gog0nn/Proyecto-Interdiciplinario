<?php
require_once "helpers.php";

function validarCategoria($data) {
    $errores = [];

    $descripcion   = $data['descripcion'] ?? '';
    $edad          = $data['edad'] ?? '';
    $genero_id     = $data['genero_id'] ?? '';
    $entrenador_id = $data['entrenador_id'] ?? '';

    // DESCRIPCIÓN
    if (!campoRequerido($descripcion)) {
        $errores[] = "La descripción es obligatoria";
    } elseif (!longitudMinima($descripcion, 3)) {
        $errores[] = "La descripción debe tener al menos 3 caracteres";
    } elseif (!longitudMaxima($descripcion, 100)) {
        $errores[] = "La descripción no puede superar 100 caracteres";
    }

    // EDAD (límite de categoría)
    if (!campoRequerido($edad)) {
        $errores[] = "La edad límite es obligatoria";
    } elseif (!esEnteroPositivo($edad)) {
        $errores[] = "La edad límite debe ser un número entero positivo";
    } elseif ((int)$edad > 99) {
        $errores[] = "La edad límite no puede superar 99 años";
    }

    // GÉNERO 
    if (!campoRequerido($genero_id)) {
        $errores[] = "Debe seleccionar un género";
    } elseif (!esEnteroPositivo($genero_id)) {
        $errores[] = "El género seleccionado no es válido";
    }

    // ENTRENADOR
    if (!campoRequerido($entrenador_id)) {
        $errores[] = "Debe seleccionar un entrenador";
    } elseif (!esEnteroPositivo($entrenador_id)) {
        $errores[] = "El entrenador seleccionado no es válido";
    }

    return $errores;
}