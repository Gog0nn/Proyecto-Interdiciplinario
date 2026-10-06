<?php
$enviado = $_SERVER['REQUEST_METHOD'] === 'POST';
include(__DIR__ . "/parciales/templateStart.php");
?>

<div class="container-fluid py-4 px-3 px-lg-5">
    <div class="border-bottom pb-4 mb-4">
        <span class="text-success fw-semibold small text-uppercase">Club Atlético Sacachispas</span>
        <h1 class="display-6 fw-bold mb-2">Estamos para ayudarte</h1>
        <p class="text-secondary mb-0" style="max-width: 680px;">
            Consultas sobre categorías, entrenamientos, actividades y fichas de jugadores.
            El equipo administrativo te orientará por el canal adecuado.
        </p>
    </div>

    <?php if ($enviado): ?>
        <div class="alert alert-success d-flex align-items-start gap-2" role="status">
            <i class="bi bi-check-circle fs-5"></i>
            <div><strong>Mensaje recibido.</strong><br>Gracias por escribirnos. Revisaremos tu consulta y nos pondremos en contacto.</div>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-xl-5">
            <div class="h-100 p-4 bg-light border-start border-4 border-success">
                <h2 class="h4 fw-bold mb-4">Canales de atención</h2>
                <div class="d-flex gap-3 mb-4">
                    <i class="bi bi-geo-alt text-success fs-4"></i>
                    <div><div class="fw-semibold">Sede del club</div><div class="text-secondary">Juan León Mallorquín, Encarnación, Paraguay</div></div>
                </div>
                <div class="d-flex gap-3 mb-4">
                    <i class="bi bi-clock text-success fs-4"></i>
                    <div><div class="fw-semibold">Atención administrativa</div><div class="text-secondary">Lunes a viernes · 08:00 a 17:00</div></div>
                </div>
                <div class="d-flex gap-3">
                    <i class="bi bi-people text-success fs-4"></i>
                    <div><div class="fw-semibold">Para familias y tutores</div><div class="text-secondary">Incluye el nombre del jugador y su categoría para agilizar la respuesta.</div></div>
                </div>
            </div>
        </div>

        <div class="col-xl-7">
            <div class="border rounded-3 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div><h2 class="h4 fw-bold mb-1">Enviar una consulta</h2><p class="text-secondary mb-0">Te responderemos con la información correspondiente.</p></div>
                    <i class="bi bi-envelope-paper text-success fs-2"></i>
                </div>
                <form action="" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6"><label for="nombre" class="form-label">Nombre completo</label><input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Ana Benítez" required></div>
                        <div class="col-md-6"><label for="email" class="form-label">Correo electrónico</label><input type="email" class="form-control" id="email" name="email" placeholder="nombre@correo.com" required></div>
                        <div class="col-12"><label for="mensaje" class="form-label">Consulta</label><textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Contanos en qué podemos ayudarte" required></textarea></div>
                        <div class="col-12 d-flex justify-content-end"><button type="submit" class="btn btn-success"><i class="bi bi-send me-2"></i>Enviar consulta</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/parciales/templateEnd.php"); ?>
