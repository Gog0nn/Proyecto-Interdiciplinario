<?php
require_once __DIR__ . "/../../db/lib/conex.php";
function getAll() {
    $con = Conex();
    $result = $con->query("SELECT * FROM Genero ORDER BY id_genero ASC");
    $generos = [];
    while ($row = $result->fetch_assoc()) {
        $generos[] = $row;
    }
    $con->close();
    return $generos;
}

function getById($id) {
    $con = Conex();
    $stmt = $con->prepare("SELECT * FROM Genero WHERE id_genero = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $con->close();
    return $row;
}
