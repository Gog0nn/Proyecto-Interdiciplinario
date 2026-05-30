<?php
function Conex(): mysqli {
    $host = 'mariadb';
    $user = 'root';
    $pass = 'root';
    $db   = 'gestion_deportiva';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("<p style='color:red;'>Error de conexión: " . $conn->connect_error . "</p>");
    }

    return $conn;
}
?>