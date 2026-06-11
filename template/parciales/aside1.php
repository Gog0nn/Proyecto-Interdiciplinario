<?php
date_default_timezone_set('America/Asuncion');
require_once __DIR__ . "/../../db/lib/conex.php";
require_once __DIR__ . "/../../backend/genero/genero.php";
require_once __DIR__ . "/../../db/lib/Actividad.php";

$con = Conex();
$actividadObj = new Actividad($con);
$resActividades = $actividadObj->getALL();
$categorias = [];
$result = $con->query("SELECT * FROM Categoria ORDER BY id_categoria ASC");
while ($row = $result->fetch_assoc()) {
    $categorias[] = $row;
}

$generos = getAll();
?>

<!-- Se removieron las clases 'collapse show' y el id, dejando la barra fija y limpia -->
<aside class="d-flex flex-column p-3 border-end bg-light" style="width: 280px; min-height: 100vh;">
    <div class="mb-2 ps-2 fw-bold text-muted small">Menú</div>
    <div class="list-group mb-4 list-group-flush border-bottom">
        
        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#eventosDetalle">
        
            <span><i class="bi bi-calendar-event me-2"></i>Próximos eventos</span>
            <i class="bi bi-chevron-down small text-muted"></i>
        </button>
        <div class="collapse" id="eventosDetalle">
            <div class="list-group list-group-flush ps-3 bg-transparent">
                <?php while ($r = $resActividades->fetch_assoc()): ?>
                    <?php if (strtotime($r['fecha']) < time()) continue; // Solo mostramos eventos futuros ?>
                    <a href="/backend/actividad/index.php" class="list-group-item list-group-item-action border-0 py-1 small italic text-muted bg-transparent">
                        <?php echo $r['descripcion']; ?> 
                        <span class="text-success ms-1" style="font-size: 0.8rem;">(<?php echo $r['fecha']; ?>)</span>
                    </a>
                <?php endwhile; ?>
            </div>
        </div>

        <a href="/backend/actividad/index.php" class="list-group-item list-group-item-action bg-transparent">
            <i class="bi bi-calendar-check me-2"></i>Todos los Eventos
        </a>
        <a href="/backend/entrenadores/index.php" class="list-group-item list-group-item-action bg-transparent">
            <i class="bi bi-gear me-2"></i>Entrenadores
        </a>
        <a href="/backend/jugadores/index.php" class="list-group-item list-group-item-action bg-transparent">
            <i class="bi bi-people me-2"></i>Jugadores
        </a>
    </div>

    <div class="mb-2 ps-2 fw-bold text-muted small">Acciones</div>
    <div class="list-group list-group-flush">

        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#inicioSesion">
            <span><i class="bi bi-box-arrow-in-right me-2"></i>Inicio de sesión</span>
            <i class="bi bi-chevron-down small text-muted"></i>
        </button>
        <div class="collapse" id="inicioSesion">
            <div class="p-3 bg-white border rounded my-2 shadow-sm">
                <form action=" ">
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Usuario</label>
                        <input type="text" class="form-control form-control-sm" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold">Contraseña</label>
                        <input type="password" class="form-control form-control-sm" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100 mt-1">Entrar</button>
                </form>
            </div>
        </div>


        <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger">
            <i class="bi bi-box-arrow-left me-2"></i>Cerrar sesión
        </a>
    </div>
</aside>

<?php
$con->close(); // Cerramos la conexión al final, después de que todos los bucles terminaron
?>
