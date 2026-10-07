<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";
include __DIR__ . "/../../db/lib/tutores.php";

$con     = Conex();
$jugador = new jugadores($con);
$tutoresObj = new Tutores($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once __DIR__ . "/validar_jugador.php";
    $errores = validarJugador($_POST);

    $relaciones = json_decode($_POST['tutor_relaciones'] ?? '[]', true);
    if (!is_array($relaciones) || count($relaciones) === 0) {
        $errores[] = "Debe asignar al menos un tutor al jugador";
    }

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            $errores[] = "No se pudo subir la foto. Verifica que no supere 2 MB.";
        } elseif ($_FILES['foto']['size'] > 2 * 1024 * 1024 || @getimagesize($_FILES['foto']['tmp_name']) === false) {
            $errores[] = "La foto debe ser una imagen válida de hasta 2 MB.";
        }
    }

    if (empty($errores)) {
        $foto = null;
        // Verificamos si se subió una foto correctamente
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $datos = array_merge($_POST, ['foto' => $foto, 'activo' => 1]);
        $result = false;
        try {
            $con->begin_transaction();
            $result = $jugador->insert($datos);
            if (!$result) {
                throw new RuntimeException('Error al guardar el jugador.');
            }
            $tutoresObj->guardarRelaciones($con->insert_id, $relaciones);
            $con->commit();
        } catch (Throwable $error) {
            $con->rollback();
        }

        if ($result) {

            $genero_id = (int)$_POST['genero'];
            $categoria = $jugador->getCategoriaByEdad($_POST['fecha_nac']);
            $categoria_id = (int)($categoria['id'] ?? 0);

            header("Location:/backend/jugadores/index.php?ok=1&cat_id={$categoria_id}&gen_id={$genero_id}");
            exit();
        } else {
            $errores[] = "Error al guardar el jugador";
        }

    }

    if (!empty($errores)) {
        $fila        = $_POST;
        $fila['tutor_relaciones'] = $relaciones;
        
        $target      = "guardar.php";
        $titulo_form = "Registrar jugador";
        include_once __DIR__ . "/../../db/lib/tutores.php";
        $tutores_rs = $tutoresObj->getall();
        include_once '../../template/parciales/templateStart.php';
        include "_form.php";
        include_once '../../template/parciales/templateEnd.php';
        exit();
    }
}
?>
