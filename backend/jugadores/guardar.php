<?php
include __DIR__ . "/../../db/lib/conex.php";
include __DIR__ . "/../../db/lib/jugadores.php";

$con     = Conex();
$jugador = new jugadores($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once __DIR__ . "/validar_jugador.php";
    $errores = validarJugador($_POST);

    if (empty($errores)) {
        $foto = null;
        // Verificamos si se subió una foto correctamente
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        }

        $datos = array_merge($_POST, ['foto' => $foto, 'activo' => 1]);
        $jugador->insert($datos);

        $genero_id = (int)$_POST['genero'];
        $categoria = $jugador->getCategoriaByEdad($_POST['fecha_nac']);
        $categoria_id = (int)($categoria['id'] ?? 0);

        header("Location: ../../frontend/views/jugadores.php?genero={$genero_id}&categoria={$categoria_id}");
        exit();

    } else {
        $fila        = $_POST;
        $target      = "guardar.php";
        $titulo_form = "Registrar jugador";
        include_once '../../template/parciales/templateStart.php';
        include "_form.php";
        include_once '../../template/parciales/templateEnd.php';
        exit();
    }
}
?>