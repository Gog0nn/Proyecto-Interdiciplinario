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
          'tutores'         => [],
      ];
  }
  $relaciones_iniciales = $relaciones_tutores ?? ($fila['tutor_relaciones'] ?? []);
  ?>

  <form action="<?php echo $target; ?>" method="post" enctype="multipart/form-data">

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

    <section class="border rounded p-3 mb-4" aria-labelledby="tutores-titulo">
      <div class="d-flex justify-content-between align-items-center gap-2 mb-3">
        <div>
          <h4 id="tutores-titulo" class="h5 mb-1">Tutor / Responsable Legal</h4>
          <p class="text-muted small mb-0">Busca por nombre, apellido o contacto.</p>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoTutorModal">
          <i class="bi bi-person-plus me-1"></i> Nuevo Tutor
        </button>
      </div>

      <div class="input-group mb-2">
        <input type="search" id="tutor_busqueda" class="form-control" minlength="3"
               placeholder="Escribe al menos 3 caracteres" autocomplete="off">
        <button type="button" id="limpiar_busqueda_tutor" class="btn btn-outline-secondary" title="Limpiar búsqueda">
          <i class="bi bi-x-lg"></i>
        </button>
      </div>
      <div id="tutor_resultados" class="list-group mb-3" aria-live="polite"></div>

      <div id="tutor_seleccionado" class="d-none bg-light border rounded p-3 mb-3">
        <div class="fw-semibold mb-2">Tutor seleccionado: <span id="tutor_seleccionado_nombre"></span></div>
        <div class="row g-2 align-items-end">
          <div class="col-md-5">
            <label for="tutor_parentesco" class="form-label mb-1">Parentesco</label>
            <select id="tutor_parentesco" class="form-select">
              <option value="Padre">Padre</option>
              <option value="Madre">Madre</option>
              <option value="Tutor Legal">Tutor Legal</option>
              <option value="Abuelo/a">Abuelo/a</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="col-md-2">
            <button type="button" id="agregar_tutor" class="btn btn-primary w-100">Agregar</button>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="fw-semibold">Tutores asignados</span>
        <span id="tutores_contador" class="badge text-bg-secondary">0</span>
      </div>
      <div id="tutores_asignados" class="vstack gap-2"></div>
      <input type="hidden" name="tutor_relaciones" id="tutor_relaciones">
    </section>

    <label for="foto">Foto del Jugador:</label><br>
    <?php if (!empty($fila['foto'])): ?>
        <div class="mb-2 text-muted small">Ya existe una foto guardada. Selecciona una nueva para cambiarla.</div>
    <?php endif; ?>
    <input type="file" id="foto" name="foto" accept="image/*" class="form-control"><br><br>

    <a href="index.php" class="btn btn-outline-secondary">Volver al listado</a>
    <input type="submit" value="Guardar" class="btn btn-outline-success">

  </form>

  <div class="modal fade" id="nuevoTutorModal" tabindex="-1" aria-labelledby="nuevoTutorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="nuevoTutorModalLabel">Registrar nuevo tutor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div id="nuevo_tutor_form">
          <div class="modal-body">
            <div id="nuevo_tutor_error" class="alert alert-danger d-none"></div>
            <div class="row g-3">
              <div class="col-md-6"><label class="form-label" for="nuevo_tutor_nombre">Nombre</label><input class="form-control" id="nuevo_tutor_nombre" required></div>
              <div class="col-md-6"><label class="form-label" for="nuevo_tutor_apellido">Apellido</label><input class="form-control" id="nuevo_tutor_apellido" required></div>
              <div class="col-12"><label class="form-label" for="nuevo_tutor_contacto">Teléfono</label><input class="form-control" id="nuevo_tutor_contacto" required></div>
              <div class="col-md-7"><label class="form-label" for="nuevo_tutor_parentesco">Parentesco</label><select class="form-select" id="nuevo_tutor_parentesco"><option>Padre</option><option>Madre</option><option selected>Tutor Legal</option><option>Abuelo/a</option><option>Otro</option></select></div>
            </div>
          </div>
          <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button><button type="button" id="guardar_nuevo_tutor" class="btn btn-primary">Guardar y asignar</button></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (() => {
      const relaciones = <?= json_encode($relaciones_iniciales, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
      const busqueda = document.getElementById('tutor_busqueda');
      const resultados = document.getElementById('tutor_resultados');
      const seleccionado = document.getElementById('tutor_seleccionado');
      const nombreSeleccionado = document.getElementById('tutor_seleccionado_nombre');
      const lista = document.getElementById('tutores_asignados');
      const relacionesInput = document.getElementById('tutor_relaciones');
      let tutorActual = null;
      let temporizador;

      const escapeHtml = (value) => String(value ?? '').replace(/[&<>'"]/g, (char) => ({'&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;'}[char]));
      const sincronizar = () => { relacionesInput.value = JSON.stringify(relaciones); };
      const renderizar = () => {
        lista.innerHTML = relaciones.length ? relaciones.map((relacion, indice) => `
          <div class="border rounded p-2 d-flex justify-content-between align-items-center gap-2">
            <div><strong>${escapeHtml(relacion.apellido)}, ${escapeHtml(relacion.nombre)}</strong><br><small class="text-muted">${escapeHtml(relacion.contacto || 'Sin teléfono')} · ${escapeHtml(relacion.tipo_relacion)}</small></div>
            <button type="button" class="btn btn-outline-danger btn-sm quitar-tutor" data-indice="${indice}" title="Desvincular"><i class="bi bi-trash"></i></button>
          </div>`).join('') : '<p class="text-muted small mb-0">Todavía no hay tutores asignados.</p>';
        document.getElementById('tutores_contador').textContent = relaciones.length;
        sincronizar();
      };
      const seleccionar = (tutor) => { tutorActual = tutor; nombreSeleccionado.textContent = `${tutor.apellido}, ${tutor.nombre} (${tutor.contacto || 'sin teléfono'})`; seleccionado.classList.remove('d-none'); };
      const buscar = async () => {
        const termino = busqueda.value.trim();
        resultados.innerHTML = '';
        if (termino.length < 3) return;
        const respuesta = await fetch(`../tutores/buscar.php?q=${encodeURIComponent(termino)}`);
        const tutores = await respuesta.json();
        resultados.innerHTML = tutores.length ? tutores.map((tutor) => `<button type="button" class="list-group-item list-group-item-action resultado-tutor" data-tutor='${JSON.stringify(tutor).replace(/'/g, '&#039;')}'>${escapeHtml(tutor.apellido)}, ${escapeHtml(tutor.nombre)} · ${escapeHtml(tutor.contacto || '')}</button>`).join('') : '<div class="list-group-item text-muted">No se encontraron tutores.</div>';
      };
      busqueda.addEventListener('input', () => { clearTimeout(temporizador); temporizador = setTimeout(buscar, 250); });
      resultados.addEventListener('click', (event) => { const boton = event.target.closest('.resultado-tutor'); if (boton) seleccionar(JSON.parse(boton.dataset.tutor)); });
      document.getElementById('limpiar_busqueda_tutor').addEventListener('click', () => { busqueda.value = ''; resultados.innerHTML = ''; seleccionado.classList.add('d-none'); tutorActual = null; });
      document.getElementById('agregar_tutor').addEventListener('click', () => {
        if (!tutorActual || relaciones.some((relacion) => Number(relacion.id_tutor) === Number(tutorActual.id_tutor))) return;
        relaciones.push({...tutorActual, tipo_relacion: document.getElementById('tutor_parentesco').value});
        renderizar();
      });
      lista.addEventListener('click', (event) => { const boton = event.target.closest('.quitar-tutor'); if (boton) { relaciones.splice(Number(boton.dataset.indice), 1); renderizar(); } });
      document.getElementById('guardar_nuevo_tutor').addEventListener('click', async () => {
        const error = document.getElementById('nuevo_tutor_error');
        error.classList.add('d-none');
        const datos = {nombre: document.getElementById('nuevo_tutor_nombre').value.trim(), apellido: document.getElementById('nuevo_tutor_apellido').value.trim(), contacto: document.getElementById('nuevo_tutor_contacto').value.trim(), tipo_relacion: document.getElementById('nuevo_tutor_parentesco').value};
        const respuesta = await fetch('../tutores/guardar_rapido.php', {method: 'POST', headers: {'Content-Type': 'application/json'}, body: JSON.stringify(datos)});
        const resultado = await respuesta.json();
        if (respuesta.status === 409 && resultado.duplicado && confirm(resultado.error)) {
          seleccionar(resultado.duplicado);
          bootstrap.Modal.getOrCreateInstance(document.getElementById('nuevoTutorModal')).hide();
          return;
        }
        if (!respuesta.ok) { error.textContent = resultado.error || 'No se pudo registrar el tutor.'; error.classList.remove('d-none'); return; }
        relaciones.push({...resultado.tutor, tipo_relacion: datos.tipo_relacion});
        renderizar();
        event.target.reset();
        bootstrap.Modal.getOrCreateInstance(document.getElementById('nuevoTutorModal')).hide();
      });
      document.querySelector('form[action="<?= htmlspecialchars($target, ENT_QUOTES) ?>"]').addEventListener('submit', (event) => {
        if (!relaciones.length) { event.preventDefault(); alert('Asigna al menos un tutor.'); }
      });
      renderizar();
    })();
  </script>
