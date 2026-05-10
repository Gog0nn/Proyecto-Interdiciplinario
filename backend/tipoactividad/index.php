<?php
include("../../conex.php");
include("validar_tipoactividad.php");

$con = Conex();
$errores = [];
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = validarTipoActividad($_POST);

    if (empty($errores)) {
        $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
        $sql = "INSERT INTO tipo_actividad (descripcion) VALUES ('$descripcion')";
        
        if (mysqli_query($con, $sql)) {
            $exito = "Tipo de actividad agregado correctamente";
        } else {
            $errores[] = "Error al guardar en la base de datos";
        }
    }
}

$sql = "SELECT * FROM tipo_actividad";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Actividad</title>
</head>
<body>
    <div style="text-align: center;">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1>Nuevo Tipo de Actividad</h1>
            <?php if (!empty($errores)): ?>
                <ul style="color:red;">
                    <?php foreach ($errores as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if ($exito): ?>
                <p style="color:green;"><?= $exito ?></p>
            <?php endif; ?>

            <input type="text" name="descripcion" placeholder="Descripción"
                value="<?= htmlspecialchars($_POST['descripcion'] ?? '') ?>">
            <input type="submit" value="Agregar">
        </form>
    </div>

    <div style="text-align: center;">
        <h2>Lista de Tipos de Actividad</h2>
        <table border="1" style="margin: 0 auto; width: 50%;">>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row["descripcion"]) ?></td>
                    <td><a href="editar.php?id=<?= $row["id"] ?>">Editar</a></td>
                    <td><a href="eliminar.php?id=<?= $row["id"] ?>">Eliminar</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>