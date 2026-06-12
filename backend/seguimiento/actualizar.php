<?php 
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../db/lib/seguimiento.php";
// Asumiendo que vas a crear un archivo para validar los datos del seguimiento
require_once __DIR__ . "/../validaciones/validar_seguimiento.php"; 

$db = Conex();
$seguimiento = new Seguimiento($db);
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Validamos los datos recibidos del formulario de seguimiento
    $errores = validarSeguimiento($_POST);

    // 2. Si hay errores de validación, recargamos el formulario con los errores
    if (!empty($errores)) {
        $fila = $_POST;
        $target = "actualizar.php";
        $titulo_form = "Editar Seguimiento Físico";
        
        include_once __DIR__ . "/../../template/parciales/templateStart.php";
        include "_form.php";
        include_once __DIR__ . "/../../template/parciales/templateEnd.php";
        exit;
    }

    // 3. Si no hay errores, procedemos a actualizar en la base de datos
    $rs = $seguimiento->update($_POST);
    
    // Capturamos el id_jugador para saber a qué historial regresar
    $id_jugador = intval($_POST['id_jugador']);

    if ($rs) {
        // Redirigimos al index de seguimiento de ESTE jugador con mensaje de éxito
        header("Location: index.php?id_jugador=" . $id_jugador . "&success=1");
    } else {
        // Si falla la base de datos, volvemos a editar pasándole ambos IDs obligatorios
        header("Location: editar.php?id=" . $_POST['id_seguimiento'] . "&id_jugador=" . $id_jugador . "&error=1");
    }
    exit;
}
?>