<?php
require_once "helpers.php";

function validarJugador($data) {
    $errores = [];

    $apellido          = $data['apellido'] ?? '';
    $nombre            = $data['nombre'] ?? '';
    $ci                = $data['ci'] ?? '';
    $fecha_nac         = $data['fecha_nac'] ?? '';
    $nro_contacto      = $data['nro_contacto'] ?? '';
    $genero_id         = $data['genero_id'] ?? '';
    $direccion         = $data['direccion'] ?? '';
    $lugar_nac         = $data['lugar_nac'] ?? '';
    $nro_ficha         = $data['nro_ficha'] ?? '';
    $tipo_sangre       = $data['tipo_sangre'] ?? '';
    $alergias          = $data['alergias'] ?? '';
    $enfermedades_base = $data['enfermedades_base'] ?? '';
    $pais              = $data['pais'] ?? '';

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

    // CI
    if (!campoRequerido($ci)) {
        $errores[] = "La cédula de identidad es obligatoria";
    } elseif (!longitudMaxima($ci, 20)) {
        $errores[] = "La CI no puede superar 20 caracteres";
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

    // GÉNERO 
    if (!campoRequerido($genero_id)) {
        $errores[] = "Debe seleccionar un género";
    } elseif (!esEnteroPositivo($genero_id)) {
        $errores[] = "El género seleccionado no es válido";
    }

    // NRO CONTACTO (opcional pero con límite)
    if (campoRequerido($nro_contacto) && !longitudMaxima($nro_contacto, 50)) {
        $errores[] = "El número de contacto no puede superar 50 caracteres";
    }

    // DIRECCIÓN (opcional pero con límite)
    if (campoRequerido($direccion) && !longitudMaxima($direccion, 150)) {
        $errores[] = "La dirección no puede superar 150 caracteres";
    }

    // LUGAR DE NACIMIENTO (opcional pero con límite)
    if (campoRequerido($lugar_nac) && !longitudMaxima($lugar_nac, 100)) {
        $errores[] = "El lugar de nacimiento no puede superar 100 caracteres";
    }

    // NRO FICHA (opcional pero con límite)
    if (campoRequerido($nro_ficha) && !longitudMaxima($nro_ficha, 20)) {
        $errores[] = "El número de ficha no puede superar 20 caracteres";
    }

    // TIPO DE SANGRE (opcional pero con límite)
    if (campoRequerido($tipo_sangre) && !longitudMaxima($tipo_sangre, 10)) {
        $errores[] = "El tipo de sangre no puede superar 10 caracteres";
    }

    // ALERGIAS (opcional pero con límite)
    if (campoRequerido($alergias) && !longitudMaxima($alergias, 150)) {
        $errores[] = "Las alergias no pueden superar 150 caracteres";
    }

    // ENFERMEDADES BASE (opcional pero con límite)
    if (campoRequerido($enfermedades_base) && !longitudMaxima($enfermedades_base, 150)) {
        $errores[] = "Las enfermedades base no pueden superar 150 caracteres";
    }

    // PAÍS (opcional pero con límite)
    if (campoRequerido($pais) && !longitudMaxima($pais, 50)) {
        $errores[] = "El país no puede superar 50 caracteres";
    }

    return $errores;
}