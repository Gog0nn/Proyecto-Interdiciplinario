<?php
require_once "../../db/lib/app.php";
require_once "../../db/lib/conex.php";
require_once "../../db/lib/jugadores.php";
require_once "../../db/lib/tutores.php";

$db = Conex();
$jugadorObj = new jugadores($db);
$tutoresObj = new Tutores($db);

// 1. Validar que exista el ID en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_jugador = (int)$_GET['id'];
$res = $jugadorObj->getByID($id_jugador);
$jugador = $res->fetch_assoc();

// 2. Si el jugador no existe, redirigir
if (!$jugador) {
    header("Location: index.php?error=notfound");
    exit;
}

// Obtener categoría sugerida por edad
$categoria_info = $jugadorObj->getCategoriaByEdad($jugador['fecha_nac']);

// Obtener tutores del jugador
$tutores_rs = $tutoresObj->obtenerTutoresPorJugador($id_jugador);

include_once "../../template/parciales/templateStart.php";
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detalles del Jugador</h1>
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listar
        </a>
    </div>

    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <img src="../../assets/img/user-placeholder.png" class="img-fluid rounded-circle mb-3" style="width: 150px;" alt="Foto del jugador">
                    <h3><?php echo $jugador['nombre'] . " " . $jugador['apellido']; ?></h3>
                    <span class="badge <?php echo $jugador['activo'] ? 'bg-success' : 'bg-danger'; ?>">
                        <?php echo $jugador['activo'] ? 'Activo' : 'Inactivo'; ?>
                    </span>
                    <p class="text-muted mt-2">Categoría: <?php echo $categoria_info['nombre']; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Información Personal</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="fw-bold">Cédula de Identidad:</label>
                            <p><?php echo $jugador['CI']; ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fw-bold">Fecha de Nacimiento:</label>
                            <p><?php echo $jugador['fecha_nac']; ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fw-bold">Género:</label>
                            <p><?php echo $jugadorObj->getGeneroSlug($jugador['genero']); ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fw-bold">Tipo de Sangre:</label>
                            <p><?php echo !empty($jugador['tipo_sangre']) ? $jugador['tipo_sangre'] : 'No especificado'; ?></p>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="fw-bold">Dirección:</label>
                            <p><?php echo $jugador['direccion']; ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fw-bold">Lugar de Nacimiento:</label>
                            <p><?php echo $jugador['lugar_nac']; ?></p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="fw-bold">Contacto:</label>
                            <p><?php echo $jugador['nro_contacto']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tutores Asignados</h5>
                    <a href="editar.php?id_jugador=<?php echo $id_jugador; ?>" class="btn btn-light btn-sm">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                </div>
                <div class="card-body">
                    <?php if ($tutores_rs && $tutores_rs->num_rows > 0): ?>
                        <div class="list-group">
                            <?php while ($tutor = $tutores_rs->fetch_assoc()): ?>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1"><?php echo htmlspecialchars($tutor['apellido'] . ", " . $tutor['nombre']); ?></h6>
                                            <p class="mb-0 text-muted">
                                                <i class="bi bi-telephone"></i> <?php echo htmlspecialchars($tutor['contacto']); ?>
                                            </p>
                                        </div>
                                        <span class="badge bg-success">Asignado</span>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning mb-0">
                            <i class="bi bi-exclamation-triangle"></i> Este jugador no tiene tutores asignados.
                            <a href="editar.php?id_jugador=<?php echo $id_jugador; ?>" class="alert-link">Asignar tutores</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "../../template/parciales/templateEnd.php"; ?>
