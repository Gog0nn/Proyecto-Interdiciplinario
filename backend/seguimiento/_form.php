<div class="container-fluid py-4 px-3 px-lg-5">
    <div class="mb-4 border-bottom pb-3">
        <a href="index.php?id_jugador=<?php echo isset($fila['id_jugador']) ? $fila['id_jugador'] : ''; ?>" class="btn btn-link p-0 mb-3 text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Volver al historial</a>
        <span class="d-block text-success fw-semibold small text-uppercase">Control deportivo</span>
        <h1 class="h2 fw-bold mb-1"><?php echo htmlspecialchars($titulo_form ?? 'Registrar seguimiento físico'); ?></h1>
        <p class="text-secondary mb-0">Registrá una nueva medición para mantener actualizado el historial del jugador.</p>
    </div>

    <?php if (!empty($errores)): ?>
        <div class="alert alert-danger">
            <strong>Revisá los datos ingresados:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach ($errores as $error): ?><li><?php echo htmlspecialchars($error); ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

<form action="<?php echo $target; ?>" method="POST" class="needs-validation" novalidate>
    
    <input type="hidden" name="id_seguimiento" value="<?php echo isset($fila['id_seguimiento']) ? $fila['id_seguimiento'] : ''; ?>">
    
    <input type="hidden" name="id_jugador" value="<?php echo isset($fila['id_jugador']) ? $fila['id_jugador'] : ''; ?>">

    <div class="border rounded-3 p-4" style="max-width: 900px;">
        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
            <span class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center" style="width: 48px; height: 48px;"><i class="bi bi-clipboard2-pulse fs-4"></i></span>
            <div><h2 class="h5 mb-1">Mediciones físicas</h2><p class="small text-secondary mb-0">La fecha y la edad se completan automáticamente.</p></div>
        </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha" class="form-label">Fecha del Control</label>
                    <input type="date" class="form-control bg-light px-3" id="fecha" name="fecha" 
                        value="<?php echo isset($fila['fecha']) ? $fila['fecha'] : date('Y-m-d'); ?>" readonly>
                    <div class="invalid-feedback">Por favor, seleccione una fecha válida.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edad" class="form-label">Edad (años)</label>
                    <input type="number" class="form-control bg-light px-3" id="edad" name="edad" 
                           value="<?php echo isset($fila['edad']) ? $fila['edad'] : ''; ?>" readonly>
                    <div class="invalid-feedback">Ingrese una edad válida (1 a 99 años).</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="peso" class="form-label">Peso (Kilogramos)</label>
                    <div class="input-group">
                        <input type="number" step="0.1" class="form-control" id="peso" name="peso" min="1" max="250"
                               placeholder="Ej: 55.4" value="<?php echo isset($fila['peso']) ? $fila['peso'] : ''; ?>" required>
                        <span class="input-group-text">kg</span>
                        <div class="invalid-feedback">Ingrese un peso válido.</div>
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="altura" class="form-label">Altura (Metros)</label>
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control" id="altura" name="altura" min="0.5" max="2.5"
                               placeholder="Ej: 1.65" value="<?php echo isset($fila['altura']) ? $fila['altura'] : ''; ?>" required>
                        <span class="input-group-text">m</span>
                        <div class="invalid-feedback">Ingrese una altura válida (Ej: 1.65).</div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="observacion" class="form-label">Observación <span class="text-secondary small">(opcional)</span></label>
                <textarea class="form-control" id="observacion" name="observacion" rows="3" maxlength="1000" placeholder="Anotá una observación sobre el control, si hace falta."><?php echo htmlspecialchars($fila['observacion'] ?? ''); ?></textarea>
            </div>

        </div>
        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
            <a href="index.php?id_jugador=<?php echo isset($fila['id_jugador']) ? $fila['id_jugador'] : ''; ?>" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check2 me-1"></i>Guardar control
            </button>
        </div>
    </div>
</form>
</div>

<script>
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>