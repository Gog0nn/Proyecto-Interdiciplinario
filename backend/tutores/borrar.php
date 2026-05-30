<?php 
require_once '../../db/lib/conex.php';
require_once '../../db/lib/tutores.php';

$db = Conex();
$tutores = new Tutores($db);
if (isset($_GET['id_tutor'])) {
    if ($tutores->delete($_GET['id_tutor'])) {
        header("Location: index.php?ok=3");
        exit();
    }
    header("Location: index.php?error=3");
    exit();
}

echo "ID no proporcionado.";
exit();
?>