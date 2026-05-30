<?php
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../backend/genero/genero.php";
 


$con = Conex();
$categorias = [];
$result = $con->query("SELECT * FROM Categoria ORDER BY edad ASC");
while ($row = $result->fetch_assoc()) {
    $categorias[] = $row;
}
$con->close();

$generos = getAll();
?>
<aside class="col-2 p-3">
    <div class="mb-3">Acciones</div>
    <div class="list-group">

        <!-- Inicio de sesión -->
        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                type="button" data-bs-toggle="collapse" data-bs-target="#inicioSesion">
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

        <!-- Categorías por género (dinámico desde BD) -->
        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                type="button" data-bs-toggle="collapse" data-bs-target="#categoriasMaster">
            <span><i class="bi bi-tags"></i> Categorías</span>
            <i class="bi bi-chevron-down small"></i>
        </button>
        <div class="collapse" id="categoriasMaster">
            <div class="list-group list-group-flush ps-3">

                <?php foreach ($generos as $g): ?>
                <?php
                    // Saltar "Mixto" del aside, solo Masculino y Femenino
                    if ($g['id_genero'] == 3) continue;
                    $targetId = "subGenero" . $g['id_genero'];
                ?>
                <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 py-1"
                        type="button" data-bs-toggle="collapse" data-bs-target="#<?= $targetId ?>">
                    <span><?= htmlspecialchars($g['descripcion']) ?>s</span>
                    <i class="bi bi-chevron-right small"></i>
                </button>
                <div class="collapse" id="<?= $targetId ?>">
                    <div class="list-group list-group-flush ps-3 border-start">
                        <?php foreach ($categorias as $cat): ?>
                        <a href="/frontend/views/jugadores.php?genero=<?= $g['id_genero'] ?>&categoria=<?= $cat['id_categoria'] ?>"
                           class="list-group-item list-group-item-action border-0 py-1 small">
                            <?= htmlspecialchars($cat['descripcion']) ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <a href="#" class="list-group-item list-group-item-action">
            <i class="bi bi-gear"></i> Cerrar sesión
        </a>

    </div>
</aside>