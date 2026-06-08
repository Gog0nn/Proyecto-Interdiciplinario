<?php 
require_once '../../db/lib/conex.php';
require_once '../../db/lib/entrenadores.php';

$db = Conex();
$tutores = new Entrenadores($db);
if (isset($_GET['id_entrenador'])) {
    if ($tutores->delete($_GET['id_entrenador'])) {
        header("Location: index.php?ok=3");
        exit();
    }
    header("Location: index.php?error=3");
    exit();
}

echo "ID no proporcionado.";
exit();
?>