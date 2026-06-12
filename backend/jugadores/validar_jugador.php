<?php
require_once __DIR__ . "/../validaciones/helpers.php";

function validarJugador($data) {
    $errores = [];

    // Capturamos los campos
    $apellido        = $data['apellido']        ?? '';
    $nombre          = $data['nombre']          ?? '';
    $CI              = $data['CI']              ?? '';
    $fecha_nac       = $data['fecha_nac']       ?? '';
    $nro_contacto    = $data['nro_contacto']    ?? '';
    $genero          = $data['genero']          ?? '';
    $direccion       = $data['direccion']       ?? '';
    $lugar_nac       = $data['lugar_nac']       ?? '';
    $tipo_sangre     = $data['tipo_sangre']     ?? '';
    $enfermedad_base = $data['enfermedad_base'] ?? '';

    // 🔹 VALIDACIÓN: APELLIDO
    if (!campoRequerido($apellido)) {
        $errores[] = "El apellido es obligatorio.";
    } elseif (!longitudMinima($apellido, 2)) {
        $errores[] = "El apellido debe tener al menos 2 caracteres.";
    } elseif (!longitudMaxima($apellido, 100)) {
        $errores[] = "El apellido no puede superar los 100 caracteres.";
    }

    // 🔹 VALIDACIÓN: NOMBRE
    if (!campoRequerido($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    } elseif (!longitudMinima($nombre, 2)) {
        $errores[] = "El nombre debe tener al menos 2 caracteres.";
    } elseif (!longitudMaxima($nombre, 100)) {
        $errores[] = "El nombre no puede superar los 100 caracteres.";
    }

    // 🔹 VALIDACIÓN: CI
    if (!campoRequerido($CI)) {
        $errores[] = "La cédula de identidad es obligatoria.";
    } elseif (!esEnteroPositivo($CI)) {
        $errores[] = "La CI debe ser un número válido.";
    } elseif (!longitudMaxima($CI, 20)) {
        $errores[] = "La CI no puede superar los 20 caracteres.";
    }

    // 🔹 VALIDACIÓN: FECHA DE NACIMIENTO
    if (!campoRequerido($fecha_nac)) {
        $errores[] = "La fecha de nacimiento es obligatoria.";
    } else {
        $d = DateTime::createFromFormat('Y-m-d', $fecha_nac);
        if (!$d || $d->format('Y-m-d') !== $fecha_nac) {
            $errores[] = "La fecha de nacimiento no tiene un formato válido.";
        } elseif ($d > new DateTime()) {
            $errores[] = "La fecha de nacimiento no puede ser una fecha futura.";
        }
    }

    // 🔹 VALIDACIÓN: NRO. CONTACTO (opcional pero con formato si se ingresa)
    if (campoRequerido($nro_contacto) && !longitudMaxima($nro_contacto, 50)) {
        $errores[] = "El número de contacto no puede superar los 50 caracteres.";
    }

    // 🔹 VALIDACIÓN: GÉNERO
    if (!campoRequerido($genero)) {
        $errores[] = "Debe seleccionar un género.";
    } elseif (!esEnteroPositivo($genero) || !in_array((int)$genero, [1, 2, 3])) {
        $errores[] = "El género seleccionado no es válido.";
    }

    // 🔹 VALIDACIÓN: DIRECCIÓN (opcional pero con límite)
    if (campoRequerido($direccion) && !longitudMaxima($direccion, 191)) {
        $errores[] = "La dirección no puede superar los 191 caracteres.";
    }

    // 🔹 VALIDACIÓN: LUGAR DE NACIMIENTO (opcional pero con límite)
    if (campoRequerido($lugar_nac) && !longitudMaxima($lugar_nac, 100)) {
        $errores[] = "El lugar de nacimiento no puede superar los 100 caracteres.";
    }

    // 🔹 VALIDACIÓN: TIPO DE SANGRE (opcional pero debe ser valor válido si se ingresa)
    $tipos_validos = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if (campoRequerido($tipo_sangre) && !in_array($tipo_sangre, $tipos_validos)) {
        $errores[] = "El tipo de sangre seleccionado no es válido.";
    }

    // 🔹 VALIDACIÓN: ENFERMEDAD BASE (opcional pero con límite)
   

    return $errores;
}
?>