<?php
include __DIR__ . "/db/lib/conex.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SGI - Club Atlético Sacachispas</title>
<!-- Bootstrap 5 y Icons -->
<link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fa;
        color: #334155;
    }
    .hero-section {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: white;
        padding: 60px 0;
        border-bottom: 5px solid #f97316; /* Color representativo (Naranja Sacachispas) */
    }
    .logo-container img {
        max-width: 180px;
        filter: drop-shadow(0 10px 15px rgba(0,0,0,0.3));
        transition: transform 0.3s ease;
    }
    .logo-container img:hover {
        transform: scale(1.05);
    }
    .module-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        border-radius: 20px;
    }
    .module-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.15);
    }
    .icon-box {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: rgba(249, 115, 22, 0.1);
        color: #f97316;
        margin-bottom: 1rem;
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 20px;
    }
</style>
</head>
<body>

<header class="hero-section shadow-lg mb-5">
    <div class="container text-center">
        <div class="logo-container mb-4">
            <!-- Ruta a tu imagen sacachispas -->
            <img src="assets/img/sacachispas.png" alt="Logo Sacachispas" onerror="this.src='https://via.placeholder.com/150?text=Sacachispas+FC'">
        </div>
        <h1 class="display-4 fw-bold">Sistema de Gestión Interna</h1>
        <p class="lead opacity-75">Club Atlético Sacachispas - Panel de Control Administrativo</p>
        
        <?php 
        try {
            $conn = Conex();
            echo '<span class="badge bg-success status-badge"><i class="bi bi-database-check me-1"></i> Base de Datos Conectada</span>';
            $conn->close();
        } catch (Exception $e) {
            echo '<span class="badge bg-danger status-badge"><i class="bi bi-database-exclamation me-1"></i> Error de Conexión</span>';
        }
        ?>
    </div>
</header>

<main class="container mb-5 d-flex justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card module-card shadow-sm text-center border-top border-4 border-warning">
            <div class="card-body p-5">
                <div class="icon-box mx-auto mb-4" style="width: 80px; height: 80px;">
                    <i class="bi bi-shield-lock fs-1"></i>
                </div>
                <h2 class="fw-bold mb-3 text-dark">Panel de Administración</h2>
                <p class="text-muted mb-4">Acceda a la gestión integral de jugadores, categorías y seguimiento físico del club.</p>
                
                <div class="d-grid gap-2">
                    <a href="/template/index.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm"> Ingresar al Sistema de inicio <i class="bi bi-arrow-right-circle ms-2"></i></a>
                    <a href="backend/jugadores/index.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                        Gestion de Jugadores <i class="bi bi-arrow-right-circle ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="container text-center py-4 text-muted border-top">
    <small>&copy; 2026 Club Atlético Sacachispas - Integración de Sistemas UNAE</small>
</footer>

<script src="assets/Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>