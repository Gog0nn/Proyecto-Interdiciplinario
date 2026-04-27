<?php
require_once "helpers.php";

function validarActividad($data) {
    $errores = [];

    $descripcion = $data['descripcion'] ?? '';
    
    if (!campoRequerido($descripcion)) {
        $errores[] = "La descripción es obligatoria";
    } elseif (!longitudMinima($descripcion, 5)) {
        $errores[] = "La descripción debe tener al menos 5 caracteres";
    } elseif (!longitudMaxima($descripcion, 150)) {
        $errores[] = "La descripción no puede superar 150 caracteres";
    }
}
?>