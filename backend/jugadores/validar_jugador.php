<?php

function validarJugador($datos) {
    $errores = [];

    // 1. Validar Nombre y Apellido (Evitar números)
    // Permite letras (incluyendo acentos/ñ) y espacios.
    if (empty($datos['nombre']) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $datos['nombre'])) {
        $errores[] = "El nombre solo debe contener letras y espacios.";
    }
    if (empty($datos['apellido']) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $datos['apellido'])) {
        $errores[] = "El apellido solo debe contener letras y espacios.";
    }

    // 2. Validar CI y Teléfono/Contacto (Evitar letras y caracteres especiales)
    // Permite únicamente números (0-9).
    if (empty($datos['CI']) || !preg_match("/^[0-9]+$/", $datos['CI'])) {
        $errores[] = "El número de CI solo debe contener números.";
    }
    if (!empty($datos['nro_contacto']) && !preg_match("/^[0-9]+$/", $datos['nro_contacto'])) {
        $errores[] = "El número de contacto solo debe contener números.";
    }

    // 3. Validar Dirección (Evitar caracteres especiales a excepción de '/')
    // Permite letras, números, espacios y la barra '/'
    if (!empty($datos['direccion']) && !preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\/]+$/u", $datos['direccion'])) {
        $errores[] = "La dirección solo puede contener letras, números, espacios y el carácter '/'.";
    }

    // 4. Validar Fecha de nacimiento (Evitar fechas futuras y edad fuera del rango 5-80 años)
    if (empty($datos['fecha_nac'])) {
        $errores[] = "La fecha de nacimiento es obligatoria.";
    } else {
        $fechaNac = DateTime::createFromFormat('Y-m-d', $datos['fecha_nac']);
        $hoy = new DateTime();

        if (!$fechaNac || $fechaNac->format('Y-m-d') !== $datos['fecha_nac']) {
            $errores[] = "El formato de la fecha de nacimiento no es válido.";
        } elseif ($fechaNac > $hoy) {
            $errores[] = "La fecha de nacimiento no puede ser en el futuro.";
        } else {
            // Cálculo de edad
            $edad = $hoy->diff($fechaNac)->y;
            if ($edad < 5 || $edad > 80) {
                $errores[] = "La edad debe estar comprendida entre 5 y 80 años (Edad calculada: {$edad} años).";
            }
        }
    }

    return $errores;
}