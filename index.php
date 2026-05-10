<?php
require_once 'conex.php';
echo "<h1>PROYECTO INTERDICIPLINARIO</h1>";
$conn = Conex();
echo "<p style='color:green;'>Conexión a MariaDB exitosa</p>";
$conn->close();
$items = scandir(__DIR__);

// Filtrar solo directorios válidos
$carpetas = [];

foreach ($items as $item) {

    if ($item === '.' || $item === '..') {
        continue;
    }

    // ignorar .git y otros archivos ocultos
    if ($item[0] === '.') {
        continue;
    }

    if (is_dir($item)) {
        $carpetas[] = $item;
    }
}

// ordenar carpetas
sort($carpetas);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Proyecto-Interdiciplinario</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    margin:40px;
    background:#f4f6f8;
}

h1{
    color:#2c3e50;
}

ul{
    list-style:none;
    padding:0;
}

li{
    margin:8px 0;
}

a{
    text-decoration:none;
    color:#1a73e8;
    font-weight:bold;
}

a:hover{
    text-decoration:underline;
}

.carpeta{
    background:white;
    padding:10px;
    border-radius:6px;
    border:1px solid #ddd;
}

</style>

</head>

<body>


<ul>

<?php foreach ($carpetas as $c): ?>

<li class="carpeta">
    <a href="<?php echo $c; ?>" target="_blank">
        Clase <?php echo $c; ?>
    </a>
</li>

<?php endforeach; ?>

</ul>

</body>
</html>