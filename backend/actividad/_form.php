<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Actividades</title>
</head>
<body>

  <h2><?php echo $titulo_form; ?></h2>
 <!-- //Imprimir errores -->
<?php if (!empty($errores)) { ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errores as $error) { ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<?php 
  if (isset($_GET['error']) && $_GET['error'] == 1) {
      echo "<p style='color:red;'>Error al insertar datos de la actividad.</p>";
  }
  if (!isset($target)) {
      $target="guardar.php";
  }
  ?>
  <?php 
  if (isset($_GET['error']) && $_GET['error'] == 2) {
      echo "<p style='color:red;'>Error al actualizar la actividad.</p>";
  }
  ?>

  <form action="<?php echo $target; ?>" method="post">
    <!-- Campo oculto para id (AUTO_INCREMENT, no se carga manualmente) -->
    <input type="hidden" name="id_actividad" value="<?php echo $fila["id_actividad"]; ?>">
    <label for="nombre">Nombre:</label><br>
    <input type="text" value='<?php echo $fila["nombre"]; ?>' id="nombre" name="nombre" maxlength="100" required class="form-control" ><br><br>
    <label for="descripcion">Descripcion:</label><br>
    <input type="text" value='<?php echo $fila["descripcion"]; ?>' id="descripcion" name="descripcion" maxlength="100" required class="form-control" ><br><br>
    
    <label for="fecha">Fecha:</label><br> 
    <input type="date" value='<?php echo $fila["fecha"]; ?>' id="fecha" name="fecha" required class="form-control" ><br><br>
    
    <label for="hora">Hora:</label><br>
    <input type="time"  value='<?php echo $fila["hora"]; ?>' id="hora" name="hora" class="form-control"><br><br>
    
    <label for="lugar">Lugar:</label><br>
    <input type="text"  value='<?php echo $fila["lugar"]; ?>' id="lugar" name="lugar" maxlength="191" class="form-control"><br><br>
    
    <label for="id_genero">Género:</label><br>
     <select id="id_genero" name="id_genero" required class="form-control">
      <option value="1" <?php echo ($fila["id_genero"] == 1) ? "selected" : ""; ?>>Masculino</option>
      <option value="2" <?php echo ($fila["id_genero"] == 2) ? "selected" : ""; ?>>Femenino</option>
      <option value="3" <?php echo ($fila["id_genero"] == 3) ? "selected" : ""; ?>>Mixto</option>
    </select><br><br>

    <label for="id_categoria">Categoría:</label><br>
    <select id="id_categoria" name="id_categoria" required class="form-control">
      <option value="1" <?php echo ($fila["id_categoria"] == 1) ? "selected" : ""; ?>>Sub-10</option>
      <option value="2" <?php echo ($fila["id_categoria"] == 2) ? "selected" : ""; ?>>Sub-13</option>
      <option value="3" <?php echo ($fila["id_categoria"] == 3) ? "selected" : ""; ?>>Sub-15</option>
      <option value="4" <?php echo ($fila["id_categoria"] == 4) ? "selected" : ""; ?>>Sub-17</option>
      <option value="5" <?php echo ($fila["id_categoria"] == 5) ? "selected" : ""; ?>>Sub-20</option>
    </select><br><br>

    <label for="id_tipo">Tipo:</label><br>
    <select id="id_tipo" name="id_tipo" required class="form-control">
      <option value="1" <?php echo ($fila["id_tipo"] == 1) ? "selected" : ""; ?>>Practica</option>
      <option value="2" <?php echo ($fila["id_tipo"] == 2) ? "selected" : ""; ?>>Partido</option>
    </select><br><br>

    <a href="index.php" class="btn btn-outline-secondary">Volver al listado</a>
    <input type="submit" value="Guardar" class="btn btn-outline-success">
  </form>
</body>
</html>
