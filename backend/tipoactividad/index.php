<?php
include("../../conex.php");
include("validar_tipoactividad.php");

$con = Conex();
$errores = [];
$exito = "";

// --- AQUÍ CAPTURAMOS LOS MENSAJES DE ELIMINAR.PHP ---
if (isset($_GET['error'])) {
    $errores[] = $_GET['error'];
}
if (isset($_GET['exito'])) {
    $exito = $_GET['exito'];
}
// ---------------------------------------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = validarTipoActividad($_POST);

    if (empty($errores)) {
        $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
        $sql = "INSERT INTO TipoActividad (descripcion) VALUES ('$descripcion')";
        
        if (mysqli_query($con, $sql)) {
            $exito = "Tipo de actividad agregado correctamente";
        } else {
            $errores[] = "Error al guardar en la base de datos";
        }
    }
}

$sql = "SELECT * FROM TipoActividad";
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
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 4px; display: inline-block; text-align: left; margin-bottom: 15px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errores as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <br>
            <?php endif; ?>

            <?php if ($exito): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 4px; display: inline-block; margin-bottom: 15px;">
                    <strong><?= htmlspecialchars($exito) ?></strong>
                </div>
                <br>
            <?php endif; ?>

            <input type="text" name="descripcion" placeholder="Descripción"
                value="<?= htmlspecialchars($_POST['descripcion'] ?? '') ?>">
            <input type="submit" value="Agregar">
        </form>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <h2>Lista de Tipos de Actividad</h2>
        <table border="1" style="margin: 0 auto; width: 50%;"> <thead>
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
                    <td><?= $row["id_tipo"] ?></td>
                    <td><?= htmlspecialchars($row["descripcion"]) ?></td>
                    <td><a href="editar.php?id=<?= $row["id_tipo"] ?>">Editar</a></td>
                    <td><a href="eliminar.php?id=<?= $row["id_tipo"] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este tipo de actividad?');">Eliminar</a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>