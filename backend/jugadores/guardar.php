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

    // Validar que tenga al menos un tutor asignado
    if (empty($_POST['tutores']) || !is_array($_POST['tutores']) || count($_POST['tutores']) === 0) {
        $errores[] = "Debe asignar al menos un tutor al jugador";
    }

    if (empty($errores)) {
        $foto = null;
        // Verificamos si se subió una foto correctamente
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $datos = array_merge($_POST, ['foto' => $foto, 'activo' => 1]);
        $result = $jugador->insert($datos);

        if ($result) {
            // Obtener el ID del jugador recién creado
            $last_id = $con->insert_id;

            // Asignar tutores al jugador
            foreach ($_POST['tutores'] as $tutor_id) {
                $tutor_id = (int)$tutor_id;
                $con->query("INSERT IGNORE INTO jugador_tutor (id_jugador, id_tutor) VALUES ($last_id, $tutor_id)");
            }

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
        $fila['tutores'] = $_POST['tutores'] ?? []; 
        
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
