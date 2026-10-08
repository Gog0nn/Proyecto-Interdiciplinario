<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";

header('Content-Type: application/json; charset=utf-8');

$termino = trim($_GET['q'] ?? '');
if (mb_strlen($termino) < 3) {
    echo json_encode([]);
    exit;
}

try {
    $tutores = new Tutores(Conex());
    $resultado = $tutores->buscar($termino);
    $respuesta = [];
    while ($tutor = $resultado->fetch_assoc()) {
        $respuesta[] = $tutor;
    }
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
}catch (Throwable $error) {
    http_response_code(500);
    echo json_encode(['error' => $error->getMessage()]);
}
