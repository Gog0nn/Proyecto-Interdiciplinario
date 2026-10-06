<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/tutores.php";

header('Content-Type: application/json; charset=utf-8');

$datos = json_decode(file_get_contents('php://input'), true) ?: [];
$nombre = trim($datos['nombre'] ?? '');
$apellido = trim($datos['apellido'] ?? '');
$contacto = trim($datos['contacto'] ?? '');
$jugador_id = (int)($datos['jugador_id'] ?? 0);
$tipo_relacion = trim($datos['tipo_relacion'] ?? 'Tutor Legal');

if ($nombre === '' || $apellido === '' || $contacto === '') {
    http_response_code(422);
    echo json_encode(['error' => 'Nombre, apellido y contacto son obligatorios.']);
    exit;
}
$db = Conex();
$tutores = new Tutores($db);

try {
    $duplicado = null;
    if ($contacto !== '') {
        $stmt = $db->prepare(
            "SELECT id_tutor, nombre, apellido, contacto
             FROM Tutores
             WHERE contacto = ? OR (nombre = ? AND apellido = ?)
             LIMIT 1"
        );
        $stmt->bind_param("sss", $contacto, $nombre, $apellido);
        $stmt->execute();
        $duplicado = $stmt->get_result()->fetch_assoc();
    }

    if ($duplicado) {
        http_response_code(409);
        echo json_encode([
            'error' => 'Este tutor ya está registrado. ¿Deseas vincularlo?',
            'duplicado' => $duplicado
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $db->begin_transaction();
    $tutor_id = $tutores->insertarRapido([
        'nombre' => $nombre,
        'apellido' => $apellido,
        'contacto' => $contacto
    ]);

    if ($jugador_id > 0) {
        $tutores->vincularTutor($jugador_id, $tutor_id, $tipo_relacion);
    }
    $db->commit();

    echo json_encode([
        'ok' => true,
        'tutor' => [
            'id_tutor' => $tutor_id,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'contacto' => $contacto
        ]
    ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $error) {
    $db->rollback();
    error_log('Alta rápida de tutor: ' . $error->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'No se pudo registrar y vincular el tutor.']);
}
