<?php
require_once "helpers.php";

function validarSeguimiento($data) {
    $errores = [];

    $jugador_id = $data['jugador_id'] ?? '';
    $fecha      = $data['fecha'] ?? '';
    $edad       = $data['edad'] ?? '';
    $peso       = $data['peso'] ?? '';
    $altura     = $data['altura'] ?? '';

    // JUGADOR
    if (!campoRequerido($jugador_id)) {
        $errores[] = "Debe seleccionar un jugador";
    } elseif (!esEnteroPositivo($jugador_id)) {
        $errores[] = "El jugador seleccionado no es válido";
    }

    //FECHA
    if (!campoRequerido($fecha)) {
        $errores[] = "La fecha del control es obligatoria";
    } else {
        $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$fechaObj || $fechaObj->format('Y-m-d') !== $fecha) {
            $errores[] = "La fecha no tiene un formato válido";
        } elseif ($fechaObj > new DateTime()) {
            $errores[] = "La fecha del control no puede ser futura";
        }
    }

    //EDAD
    if (!campoRequerido($edad)) {
        $errores[] = "La edad es obligatoria";
    } elseif (!esEnteroPositivo($edad)) {
        $errores[] = "La edad debe ser un número entero positivo";
    } elseif ((int)$edad > 99) {
        $errores[] = "La edad no puede superar 99 años";
    }

    //PESO
    if (!campoRequerido($peso)) {
        $errores[] = "El peso es obligatorio";
    } elseif (!is_numeric($peso)) {
        $errores[] = "El peso debe ser un número válido";
    } elseif ((float)$peso <= 0) {
        $errores[] = "El peso debe ser mayor a 0";
    } elseif ((float)$peso > 300) {
        $errores[] = "El peso ingresado no es válido";
    }

    // 🔹 ALTURA
    if (!campoRequerido($altura)) {
        $errores[] = "La altura es obligatoria";
    } elseif (!is_numeric($altura)) {
        $errores[] = "La altura debe ser un número válido";
    } elseif ((float)$altura <= 0) {
        $errores[] = "La altura debe ser mayor a 0";
    } elseif ((float)$altura > 3) {
        $errores[] = "La altura debe expresarse en metros (ej: 1.75)";
    }

    return $errores;
}