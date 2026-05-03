<aside class="col-2 p-3">
    <div class="mb-3">Acciones</div>
    <div class="list-group">
        <!-- Ítem con colapsable -->
        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#inicioSesion">
            <span><i class="bi bi-calendar-event"></i> Inicio de sesión</span>
            <i class="bi bi-chevron-down small"></i>
        </button>
        
        <div class="collapse" id="inicioSesion">
            <div class="list-group list-group-flush ps-3 bg-light">
                <form action=" " class="p-3">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control form-control-sm" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
<!-- Nivel 1: El botón principal de Categorías -->
<button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#categoriasMaster">
    <span><i class="bi bi-tags"></i> Categorías</span>
    <i class="bi bi-chevron-down small"></i>
</button>

<!-- Nivel 1: El contenedor que se abre -->
    <div class="collapse" id="categoriasMaster">
    <div class="list-group list-group-flush ps-3">
        
        <!-- Nivel 2: Botón de Masculinos (dentro del anterior) -->
        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#subMasculino">
            <span>Masculinos</span>
            <i class="bi bi-chevron-right small"></i>
        </button>
        
        <!-- Nivel 2: El contenedor de las sub-categorías -->
        <div class="collapse" id="subMasculino">
            <div class="list-group list-group-flush ps-3 border-start">
                <a href="#" class="list-group-item list-group-item-action border-0 py-1 small italic">Sub 13</a>
                <a href="#" class="list-group-item list-group-item-action border-0 py-1 small italic">Sub 15</a>
            </div>
        </div>
                <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#subFemenino">
            <span>Femeninos</span>
            <i class="bi bi-chevron-right small"></i>
        </button>
        
        <!-- Nivel 2: El contenedor de las sub-categorías -->
        <div class="collapse" id="subFemenino">
            <div class="list-group list-group-flush ps-3 border-start">
                <a href="#" class="list-group-item list-group-item-action border-0 py-1 small italic">Sub 13</a>
                <a href="#" class="list-group-item list-group-item-action border-0 py-1 small italic">Sub 15</a>
            </div>
        </div>

    </div>
    </div>
    <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-gear"></i> Cerrar sesión</a>
</div>

</aside>

