<div class="d-flex justify-content-center w-100 my-4">
    <div class="card shadow-sm mx-auto" style="max-width: 800px; width: 100%;">
        <div class="card-body">
            
            <h3 class="h4 mb-3"><?php echo $titulo_form; ?></h3>

            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                <div class="alert alert-danger" role="alert">
                    Error al insertar datos. Por favor, revise los datos ingresados.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error']) && $_GET['error'] == 2): ?>
                <div class="alert alert-danger" role="alert">
                    Error al actualizar los datos. Por favor, revise los datos ingresados.
                </div>
            <?php endif; ?>

            <form action="<?php echo $target; ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id_entrenador" value="<?php echo $fila['id_entrenador'] ?? ''; ?>">
                
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['nombre'] ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" id="apellido" name="apellido" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['apellido'] ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nac" name="fecha_nac"
                            class="form-control" value="<?php echo htmlspecialchars($fila['fecha_nac'] ?? ''); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="CI" class="form-label">Cédula de Identidad</label>
                        <input type="text" id="CI" name="CI" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['CI'] ?? ''); ?>" required>
                    </div>

                    <div class="col-12">
                        <label for="nro_contacto" class="form-label">Contacto</label>
                        <input type="text" id="nro_contacto" name="nro_contacto" maxlength="100"
                            class="form-control" value="<?php echo htmlspecialchars($fila['nro_contacto'] ?? ''); ?>" required>
                    </div>

                    <div class="col-12">
                        <label for="foto" class="form-label d-block">Foto</label>
                        
                        <?php if (!empty($fila['foto'])): ?>
                            <div class="mb-2 d-flex align-items-center gap-3">
                                <img src="data:image/jpeg;base64,<?= base64_encode($fila['foto']) ?>" 
                                     alt="Foto actual" 
                                     class="img-thumbnail" 
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                <span class="text-muted small">
                                    <i class="bi bi-info-circle"></i> Foto actual. Seleccione una nueva solo si desea cambiarla.
                                </span>
                            </div>
                        <?php endif; ?>

                        <input type="file" id="foto" name="foto" accept="image/*" class="form-control">
                    </div>

                    <div class="col-12 d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-floppy"></i> Guardar Entrenador
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">Volver</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>