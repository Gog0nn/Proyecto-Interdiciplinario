<?php

function campoRequerido($valor) {
    return isset($valor) && trim($valor) !== '';
}

function longitudMinima($valor, $minimo) {
    return strlen(trim($valor)) >= $minimo;
}

function longitudMaxima($valor, $maximo) {
    return strlen(trim($valor)) <= $maximo;
}

function soloTexto($valor) {
    return preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u', trim($valor));
}

function esNumero($valor) {
    return is_numeric($valor);
}

function esEnteroPositivo($valor) {
    return filter_var($valor, FILTER_VALIDATE_INT) !== false && $valor > 0;
}

function limpiarTexto($valor) {
    return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
}

function mostrarErrores($errores) {
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}