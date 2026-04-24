<?php
$host = "mariadb";
$usuario = "root";
$password = "root";
$bd = "basquet_bd";

$conn = new mysqli($host, $usuario, $password, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>