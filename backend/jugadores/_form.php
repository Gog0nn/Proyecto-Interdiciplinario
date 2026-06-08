<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Jugador</title>
</head>
<body>

  <h2><?php echo $titulo_form; ?></h2>

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
      echo "<p style='color:red;'>Error al insertar datos del jugador.</p>";
  }
  if (isset($_GET['error']) && $_GET['error'] == 2) {
      echo "<p style='color:red;'>Error al actualizar el jugador.</p>";
  }
  if (!isset($target)) {
      $target = "guardar.php";
  }
  // Si $fila no está definida, inicializamos vacía para evitar errores
  if (!isset($fila)) {
      $fila = [
          'id_jugador'      => '',
          'apellido'        => '',
          'nombre'          => '',
          'CI'              => '',
          'fecha_nac'       => '',
          'nro_contacto'    => '',
          'genero'          => '',
          'direccion'       => '',
          'lugar_nac'       => '',
          'tipo_sangre'     => '',
          'enfermedad_base' => '',
      ];
  }
  ?>

  <form action="<?php echo $target; ?>" method="post">

    <input type="hidden" name="id_jugador" value="<?php echo $fila['id_jugador']; ?>">

    <label for="apellido">Apellido:</label><br>
    <input type="text" value="<?php echo htmlspecialchars($fila['apellido']); ?>"
           id="apellido" name="apellido" maxlength="100" required class="form-control"><br><br>

    <label for="nombre">Nombre:</label><br>
    <input type="text" value="<?php echo htmlspecialchars($fila['nombre']); ?>"
           id="nombre" name="nombre" maxlength="100" required class="form-control"><br><br>

    <label for="CI">CI:</label><br>
    <input type="text" value="<?php echo htmlspecialchars($fila['CI']); ?>"
           id="CI" name="CI" maxlength="20" required class="form-control"><br><br>

    <label for="fecha_nac">Fecha de nacimiento:</label><br>
    <input type="date" value="<?php echo $fila['fecha_nac']; ?>"
           id="fecha_nac" name="fecha_nac" required class="form-control"><br><br>

    <label for="nro_contacto">Nro. de contacto:</label><br>
    <input type="text" value="<?php echo htmlspecialchars($fila['nro_contacto']); ?>"
           id="nro_contacto" name="nro_contacto" maxlength="50" class="form-control"><br><br>

    <label for="genero">Género:</label><br>
    <select id="genero" name="genero" required class="form-control">
      <option value="">-- Seleccionar --</option>
      <option value="1" <?php echo ($fila['genero'] == 1) ? 'selected' : ''; ?>>Masculino</option>
      <option value="2" <?php echo ($fila['genero'] == 2) ? 'selected' : ''; ?>>Femenino</option>
      <option value="3" <?php echo ($fila['genero'] == 3) ? 'selected' : ''; ?>>Mixto</option>
    </select><br><br>

    

    <label for="direccion">Dirección:</label><br>
    <input type="text" value="<?php echo htmlspecialchars($fila['direccion']); ?>"
           id="direccion" name="direccion" maxlength="191" class="form-control"><br><br>

    <label for="lugar_nac">Lugar de nacimiento:</label><br>
    <input type="text" value="<?php echo htmlspecialchars($fila['lugar_nac']); ?>"
           id="lugar_nac" name="lugar_nac" maxlength="100" class="form-control"><br><br>

    <label for="tipo_sangre">Tipo de sangre:</label><br>
    <select id="tipo_sangre" name="tipo_sangre" class="form-control">
      <option value="">-- Seleccionar --</option>
      <?php foreach (['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $tipo) { ?>
        <option value="<?php echo $tipo; ?>" <?php echo ($fila['tipo_sangre'] == $tipo) ? 'selected' : ''; ?>>
          <?php echo $tipo; ?>
        </option>
      <?php } ?>
    </select><br><br>

    

    <a href="index.php" class="btn btn-outline-secondary">Volver al listado</a>
    <input type="submit" value="Guardar" class="btn btn-outline-success">

  </form>