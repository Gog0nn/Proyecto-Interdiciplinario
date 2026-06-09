<form action="<?php echo $target; ?>" method="POST" class="needs-validation" novalidate>
    
    <input type="hidden" name="id_seguimiento" value="<?php echo isset($fila['id_seguimiento']) ? $fila['id_seguimiento'] : ''; ?>">
    
    <input type="hidden" name="id_jugador" value="<?php echo isset($fila['id_jugador']) ? $fila['id_jugador'] : ''; ?>">

    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><?php echo $titulo_form ?? 'Registrar Seguimiento Físico';  ?></h5>
        </div>
        <div class="card-body">
            
            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha" class="form-label">Fecha del Control</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" 
                        value="<?php echo isset($fila['fecha']) ? $fila['fecha'] : date('Y-m-d'); ?>" required>
                    <div class="invalid-feedback">Por favor, seleccione una fecha válida.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edad" class="form-label">Edad (años)</label>
                    <input type="number" class="form-control" id="edad" name="edad" min="1" max="99"
                           placeholder="Ej: 14" value="<?php echo isset($fila['edad']) ? $fila['edad'] : ''; ?>" required>
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

            <div class="row">
                <div class="col-12 mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="observacion" name="observacion" rows="4" maxlength="1000" placeholder="Agregar observación (máx 1000 caracteres)"><?php echo isset($fila['observacion']) ? htmlspecialchars($fila['observacion']) : ''; ?></textarea>
                    <div class="form-text">Máximo 1000 caracteres.</div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <a href="index.php?id_jugador=<?php echo isset($fila['id_jugador']) ? $fila['id_jugador'] : ''; ?>" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="submit" class="btn btn-success">
                Guardar Registro
            </button>
        </div>
    </div>
</form>

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