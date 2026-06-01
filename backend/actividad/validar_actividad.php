<?php
// Requerimos las funciones de ayuda para las validaciones
require_once __DIR__ . "/../validaciones/helpers.php";

function validarActividad($data) {
    $errores = [];

    // Capturamos los campos
    $nombre          = $data['nombre'] ?? '';
    $descripcion     = $data['descripcion'] ?? '';
    $fecha           = $data['fecha'] ?? '';
    $hora            = $data['hora'] ?? '';
    $lugar           = $data['lugar'] ?? '';
    $id_genero       = $data['id_genero'] ?? '';
    $id_categoria    = $data['id_categoria'] ?? '';
    $id_tipo         = $data['id_tipo'] ?? '';

    // 🔹 VALIDACIÓN: NOMBRE
    if (!campoRequerido($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    } elseif (!longitudMinima($nombre, 3)) {
        $errores[] = "El nombre debe tener al menos 3 caracteres.";
    } elseif (!longitudMaxima($nombre, 100)) {
        $errores[] = "El nombre no puede superar los 100 caracteres.";
    }

    // 🔹 VALIDACIÓN: DESCRIPCIÓN
    if (!campoRequerido($descripcion)) {
        $errores[] = "La descripción es obligatoria.";
    } elseif (!longitudMinima($descripcion, 5)) {
        $errores[] = "La descripción debe tener al menos 5 caracteres.";
    } elseif (!longitudMaxima($descripcion, 150)) {
        $errores[] = "La descripción no puede superar los 150 caracteres.";
    }

    // 🔹 VALIDACIÓN: FECHA
    if (!campoRequerido($fecha)) {
        $errores[] = "La fecha de la actividad es obligatoria.";
    }

    // 🔹 VALIDACIÓN: HORA
    if (!campoRequerido($hora)) {
        $errores[] = "La hora de la actividad es obligatoria.";
    }

    // 🔹 VALIDACIÓN: LUGAR
    if (!campoRequerido($lugar)) {
        $errores[] = "El lugar es obligatorio.";
    } elseif (!longitudMaxima($lugar, 191)) {
        $errores[] = "El lugar no puede superar los 191 caracteres.";
    }

    // 🔹 VALIDACIÓN: GÉNERO
    if (!campoRequerido($id_genero)) {
        $errores[] = "Debe seleccionar un género.";
    } elseif (!esEnteroPositivo($id_genero) || !in_array($id_genero, [1, 2, 3])) {
        $errores[] = "El género seleccionado no es válido.";
    }

    // 🔹 VALIDACIÓN: CATEGORÍA
    if (!campoRequerido($id_categoria)) {
        $errores[] = "Debe seleccionar una categoría.";
    } elseif (!esEnteroPositivo($id_categoria) || !in_array($id_categoria, [1, 2, 3, 4, 5])) {
        $errores[] = "La categoría seleccionada no es válida.";
    }

    // 🔹 VALIDACIÓN: TIPO
    if (!campoRequerido($id_tipo)) {
        $errores[] = "Debe seleccionar un tipo.";
    } elseif (!esEnteroPositivo($id_tipo) || !in_array($id_tipo, [1, 2])) {
        $errores[] = "El tipo seleccionado no es válido.";
    }

    return $errores;
}
?>