<?php
require_once("../../conex.php");
require_once("validar_tipoactividad.php");
$con = Conex();

$id = $_GET["id"];
$errores = [];

$query = mysqli_query($con, "SELECT * FROM tipo_actividad WHERE id = $id");
$row = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = validarTipoActividad($_POST);

    if (empty($errores)) {
        $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
        mysqli_query($con, "UPDATE tipo_actividad SET descripcion = '$descripcion' WHERE id = $id");
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tipo de Actividad</title>
</head>
<body>
    <h1>Editar Tipo de Actividad</h1>

    <?php if (!empty($errores)): ?>
        <ul style="color:red;">
            <?php foreach ($errores as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $id ?>" method="POST">
        <input type="text" name="descripcion" 
               value="<?= htmlspecialchars($_POST['descripcion'] ?? $row['descripcion']) ?>">
        <input type="submit" value="Guardar">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>