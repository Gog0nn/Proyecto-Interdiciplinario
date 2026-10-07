<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #004d12 !important;">
    <div class="container-fluid">
        <img src="/template/img/image.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-top me-2">
        <a class="navbar-brand fw-bold text-uppercase" href="/template/index.php" style="font-size: 1.3rem; letter-spacing: 0.5px;">Club Atletico Sacachispas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link <?= set_active('/template/index.php') ?>" href="/template/index.php" style="font-size: 1.1rem;">Inicio</a></li>
                <li class="nav-item"><a class="nav-link <?= set_active('/template/contactos.php') ?>" href="/template/contactos.php" style="font-size: 1.1rem;">Contáctanos</a></li>
                <li class="nav-item"><a class="nav-link <?= set_active('/template/acercade.php') ?>" href="/template/acercade.php" style="font-size: 1.1rem;">Nosotros</a></li>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #009f25 !important;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBackend" aria-controls="navbarBackend" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarBackend">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link <?= set_active('/backend/jugadores/') ?>" href="/backend/jugadores/index.php">Jugadores</a></li>
                <li class="nav-item"><a class="nav-link <?= set_active('/backend/tutores/') ?>" href="/backend/tutores/index.php">Tutores</a></li>
                <li class="nav-item"><a class="nav-link <?= set_active('/backend/entrenadores/') ?>" href="/backend/entrenadores/index.php">Entrenadores</a></li>
                <li class="nav-item"><a class="nav-link <?= set_active('/backend/actividad/') ?>" href="/backend/actividad/index.php">Actividades</a></li>
            </ul>
        </div>
    </div>
</nav>