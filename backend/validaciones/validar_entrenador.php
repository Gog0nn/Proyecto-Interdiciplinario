<?php
require_once "helpers.php";

function validarEntrenador($data) {
    $errores = [];

    $apellido     = $data['apellido'] ?? '';
    $nombre       = $data['nombre'] ?? '';
    $fecha_nac    = $data['fecha_nac'] ?? '';
    $nro_contacto = $data['nro_contacto'] ?? '';
    $ci           = $data['ci'] ?? '';

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

    // FECHA DE NACIMIENTO
    if (!campoRequerido($fecha_nac)) {
        $errores[] = "La fecha de nacimiento es obligatoria";
    } else {
        $fecha = DateTime::createFromFormat('Y-m-d', $fecha_nac);
        if (!$fecha || $fecha->format('Y-m-d') !== $fecha_nac) {
            $errores[] = "La fecha de nacimiento no tiene un formato válido";
        } elseif ($fecha >= new DateTime()) {
            $errores[] = "La fecha de nacimiento debe ser anterior a hoy";
        }
    }

    // NRO CONTACTO
    if (!campoRequerido($nro_contacto)) {
        $errores[] = "El número de contacto es obligatorio";
    } elseif (!longitudMaxima($nro_contacto, 50)) {
        $errores[] = "El número de contacto no puede superar 50 caracteres";
    }

    // CI
    if (!campoRequerido($ci)) {
        $errores[] = "La cédula de identidad es obligatoria";
    } elseif (!longitudMaxima($ci, 20)) {
        $errores[] = "La CI no puede superar 20 caracteres";
    }

    return $errores;
}